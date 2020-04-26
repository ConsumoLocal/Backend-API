<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessCategory;
use App\BusinessStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Collection;

class BusinessController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('isAdmin')->only(['destroy', 'update']);
    }

    public function getQuery() {
        return DB::table('businesses')
            ->join('business_statuses', 'businesses.status', '=', 'business_statuses.id')
            ->join('cities', 'cities.id', '=', 'businesses.city')
            ->select('businesses.*', 'business_statuses.value AS status', 'cities.id AS cityId', 'cities.name AS city');
    }

    public function businessElementsQuery($businesses) {
        foreach ($businesses as $business) {
            $categories = DB::table('business_categories')
                ->join('categories', 'categories.id', '=', 'business_categories.category')
                ->where('business_categories.business', '=', $business->id)
                ->select('categories.id', 'categories.value')
                ->get();

            $tags = DB::table('business_tags')
                ->join('tags', 'business_tags.tag', '=', 'tags.id')
                ->where('business_tags.business', '=', $business->id )
                ->select('tags.value AS tag')
                ->get();

            $links = DB::table('business_links')
                ->join('links', 'links.id', '=', 'business_links.link')
                ->join('link_data_types', 'link_data_types.id', '=', 'links.data_type')
                ->where('business_links.business', '=', $business->id)
                ->select('links.name', 'links.imagePath AS imageUrl', 'link_data_types.value AS dataType', 'business_links.value')
                ->get();

            $business->tags = $tags;

            $business->categories = $categories;

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
            ->where('businesses.status', '=', 'Active')
            ->get();
        $finalBusiness = $this->businessElementsQuery($allBusiness);

        return response()->json($finalBusiness->toArray(), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllWithStatus($status)
    {
        if($status == 'all') {
            $allBusiness = $this->getQuery()
                                ->get();



            $finalBusiness = $this->businessElementsQuery($allBusiness);

            return response()->json($finalBusiness->toArray(), 200);
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
        $business = $this->getQuery()
            ->where('businesses.id','=', $id)
            ->get();
        if (count($business) == 0) {
            return response()->json(['error' => 'Business not found'], 404);
        }
        $finalBusiness = $this->businessElementsQuery($business);
        return $finalBusiness;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->statusValidator($request->all())->validate();

        $business = Business::find($id);

        $data = $request->all();
        $idStatus = DB::table('business_statuses')
            ->select('id')
            ->where('value', '=', $data['status'])
            ->get();

        $status = $idStatus->first();
        $business->status = $status->id;
        $business->save();

        return response()->json($this->show($id), 202);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            //TODO: Set preferred link id from link table
            'preferredLink' => ['required'],
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
     * Get a validator for an incoming business creation request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function statusValidator(array $data)
    {
        return Validator::make($data, [
            'status'   => ['required'],
        ]);
    }

    protected function LinksValidator(array $data)
    {
        return Validator::make($data, [
            'serviceId'   => ['required'],
            'value'       => ['required']
        ]);
    }

    /**
     * Create a new Business instance after validation.
     *
     * @param  array  $data
     * @return Business
     */
    protected function create(array $data) {

        $business = Business::create([
            'user_id'       => $data['user_id'],
            'name'          => $data['name'],
            'description'   => $data['description'],
            'imageUrl'      => $data['imageUrl'],
            'address'       => $data['address'],
            'email'         => $data['email'],
            'preferredLink' => $data['preferredLink'],
            'latitude'      => $data['latitude'],
            'longitude'     => $data['longitude'],
            'city'          => $data['city'],
        ]);

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

        // Create links
        if(isset($data['links'])) {
            $linksController = new BusinessLinkController();
            $links = $data['links'];
            foreach ($links as $link) {
                $linksController->store($business->id, $link['link'], $link['value']);
            }

            $business->links = $links;
        }

        return $business;
    }
}
