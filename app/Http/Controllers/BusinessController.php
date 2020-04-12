<?php

namespace App\Http\Controllers;

use App\Business;
use App\BusinessCategory;
use App\BusinessStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Collection;

class BusinessController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index')->except('show');
        $this->middleware('isAdmin')->only(['destroy', 'update']);
    }

    protected function getQuery() {
        return DB::table('businesses')
            ->join('business_statuses', 'businesses.status', '=', 'business_statuses.id')
            ->join('cities', 'cities.id', '=', 'businesses.city')
            ->select('businesses.*', 'business_statuses.value AS status', 'cities.id AS cityId', 'cities.name AS city');
    }


    protected function appendCategories($data) {
        foreach ($data as $business) {
            $categories = DB::table('business_categories')
                ->join('categories', 'categories.id', '=', 'business_categories.category')
                ->where('business_categories.business', '=', $business->id)
                ->select('categories.id', 'categories.value')
                ->get();

            $business->categories = $categories;
        }
        return $data;
    }

    /**
     * Display a listing of all business with an active status.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $allBusiness = $this->getQuery()
            ->where('businesses.status', '=', '4')
            ->get();
        $finalBusiness = $this->appendCategories($allBusiness);

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

            $finalBusiness = $this->appendCategories($allBusiness);

            return response()->json($finalBusiness->toArray(), 200);
        }
        $allBusiness = $this->getQuery()
            ->where('business_statuses.value', '=', $status)
            ->get();
        $finalBusiness = $this->appendCategories($allBusiness);
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

        return response()->json($business->toArray(), 201);
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
        $finalBusiness = $this->appendCategories($business);
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
            'phone'         => ['required', 'max:30'],
            'website'       => ['required'],
            'preferredLink' => ['required'],
            'email'         => ['required'],
            'latitude'      => ['required'],
            'longitude'     => ['required'],
            'city'          => ['required'],
            'categories'    => ['required', 'array']
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
            'phone'         => $data['phone'],
            'website'       => $data['website'],
            'email'         => $data['email'],
            'preferredLink' => $data['preferredLink'],
            'latitude'      => $data['latitude'],
            'longitude'     => $data['longitude'],
            'city'      => $data['city'],
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

        return $business;
    }
}
