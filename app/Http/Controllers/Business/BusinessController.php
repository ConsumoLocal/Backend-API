<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\BusinessCategory;
use App\BusinessStatus;
use App\Http\Controllers\Controller;
use App\Scopes\ActiveBusinessScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Collection;
use App\Http\Controllers\TagController;

class BusinessController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('getImage');
        $this->middleware('isAdmin')->only(['destroy', 'update']);
    }

    ///
    public function getQuery() {

        return Business::with(['city', 'status', 'categories', 'tags']);

    }

    public function businessElementsQuery($businesses) {
        foreach ($businesses as $business) {
            $links = DB::table('business_links')
                ->join('links', 'links.id', '=', 'business_links.link')
                ->join('link_data_types', 'link_data_types.id', '=', 'links.data_type')
                ->where('business_links.business', '=', $business->id)
                ->select('links.name', 'links.imagePath AS imageUrl', 'link_data_types.value AS dataType', 'business_links.value', 'business_links.id')
                ->get();

            $business->links = $links;
        }
        return $businesses;
    }

    public function uploadImage(Request $request) {
        if ($request->hasFile('image')) {
            $path = Storage::putFile('business', $request->file('image'));
            return response()->json(['imagePath' => $path], 201);
        } else {
            return response()->json(['error' => 'Missing image file'], 422);
        }
    }

    public function getImage($id) {
        $business = Business::findOrFail($id);
        $headers = [
            "Content-Type: image/png"
        ];

        if (isset($business->imageUrl)) {
            return response()->file(storage_path().'/app/'.$business->imageUrl, $headers)->setStatusCode('200');
        } else {
            return response()->json(['error' => 'Missing image file'], 417);
        }
    }

    /**
     * Display a listing of all business with an active status.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $allBusiness = $this->getQuery()
            ->get();
        $allBusiness = $this->businessElementsQuery($allBusiness);

        return response()->json($allBusiness->toArray(), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllWithStatus($status)
    {
        if($status == 'all') {
            $allBusiness = Business::withoutGlobalScope(\App\Scopes\ActiveBusinessScope::class)
                ->with(['city', 'status', 'categories', 'tags'])
                ->get();

            $allBusiness = $this->businessElementsQuery($allBusiness);
            return response()->json($allBusiness->toArray(), 200);
        }
        $allBusiness = $this->getQuery()
            ->where('business_statuses.value', '=', $status)
            ->get();
        $finalBusiness = $this->businessElementsQuery($allBusiness);
        return response()->json($finalBusiness->toArray(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $business = $this->create($request->all());

        $business->sendBusinessWelcomeEmail();

        DB::commit();

        return response()->json($this->show($business->id), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $business = Business::withoutGlobalScope(\App\Scopes\ActiveBusinessScope::class)
            ->with(['city', 'status', 'categories', 'tags'])
            ->where('businesses.id', '=', $id)
            ->get();

        if (count($business) == 0) {
            return response()->json(['error' => 'Business not found'], 404);
        }
        $business = $this->businessElementsQuery($business);
        return $business;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $business = Business::withoutGlobalScope(\App\Scopes\ActiveBusinessScope::class)->findOrFail($id);

        DB::beginTransaction();

        $data = $request->all();

        if(isset($data['name']) && $data['name'] != "") {
            $business->name = $data['name'];
        }

        if(isset($data['description']) && $data['description'] != "") {
            $business->description = $data['description'];
        }

        if(isset($data['imageUrl']) && $data['imageUrl'] != "") {
            $actualImagePath = $business->imageUrl;
            Storage::delete($actualImagePath);
            $business->imageUrl = $data['imageUrl'];
        }

        if(isset($data['preferredLink']) && $data['preferredLink'] != "") {
            $link = $business->links()->where('id', $data['preferredLink'])->first();
            if(isset($link)) {
                $business->preferredLink = $data['preferredLink'];
            } else {
                return response()->json(
                    ['error' => 'The new preferred link for this business does not exist'], 422);
            }

        }

        if(isset($data['email']) && $data['email'] != "") {
            $business->email = $data['email'];
        }

        if(isset($data['status']) && $data['status'] != "") {
            $statusValue = ucfirst($data['status']);
            $newStatus = BusinessStatus::all()
                ->where('value', '=', $statusValue)
                ->first();

            if(!isset($newStatus)) {
                return response()->json(
                    ['error' => 'Wrong status received'], 422);
            }

            $business->status = $newStatus->id;

            if(!isset($data['notify']) && $newStatus->id == 1) {
                $business->sendBusinessActiveEmail();
            } elseif(isset($data['notifyStatus']) && $data['notifyStatus'] == true && $newStatus == 1) {
                $business->sendBusinessActiveEmail();
            }
        }

        $business->save();
        DB::commit();

        return response()->json($this->show($id), 202);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Business  $business
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $business = Business::withoutGlobalScope(\App\Scopes\ActiveBusinessScope::class)->findOrFail($id);
        if (request()->user()->id == $business->user_id || request()->user()->admin) {
            $business->delete();
            return response()->json(['Message' => 'Business Deleted'], 202);
        } else {
            return response()->json(['error' => 'You do not have permission to delete this business'], 401);
        }
    }

    // Controller internal operations

    /**
     * Get a validator for an incoming business creation request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id'       => ['required'],
            'name'          => ['required'],
            'description'   => ['required'],
            'address'       => ['required'],
            'email'         => ['required'],
            'latitude'      => ['required'],
            'longitude'     => ['required'],
            'city'          => ['required'],
            'categories'    => ['required', 'array'],
            'links'         => ['required', 'array'],
            'links.*.link'  => ['required'],
            'links.*.value'  => ['required'],
        ]);
    }

    /**
     * Create a new Business instance after validation.
     *
     * @param  array  $data
     * @return Business
     */
    protected function create(array $data) {
        DB::beginTransaction();
        $business = Business::create([
            'user_id'       => $data['user_id'],
            'name'          => $data['name'],
            'description'   => $data['description'],
            'imageUrl'      => $data['imageUrl'],
            'address'       => $data['address'],
            'email'         => $data['email'],
            'latitude'      => $data['latitude'],
            'longitude'     => $data['longitude'],
            'city'          => $data['city'],
        ]);

        // Create links
        if(isset($data['links'])) {
            $linksController = new BusinessLinkController();
            $links = $data['links'];
            $preferedLink = null;
            foreach ($links as $link) {
                $businessLinkId = $linksController->store($business->id, $link['link'], $link['value']);
                if(isset($data['preferredLink']) && isset($link['id']) && $link['id'] == $data['preferredLink']) {
                    $business->preferredLink = $businessLinkId;
                    $business->save();
                }
            }

            $business->links = $links;
        }

        // Create categories
        $categories = $data['categories'];

        foreach ($categories as $id) {
            BusinessCategory::create([
                'business'  => $business->id,
                'category'  => $id

            ]);
        }
        $business->categories = $categories;

        // Create tags
        // Only inserts tags that are not already created
        if(isset($data['tags'])) {
            $tags = $data['tags'];

            $tagsController = new TagController();
            $businessTag = new BusinessTagController();
            foreach ($tags as $tag) {
                $id = $tagsController->store($tag);
                $businessTag->saveTag($business->id, $id);
            }

            $business->tags = $tags;
        }
        return $business;
    }
}
