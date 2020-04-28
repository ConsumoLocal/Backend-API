<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Business\BusinessController;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
        $this->middleware('isAdmin')->only(['destroy', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cities = City::all();
        return response()->json($cities->toArray(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response('', 501);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return City::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        return response('', 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        return response('', 501);
    }

    public function getBusinesses($id) {
        $businessController = new BusinessController();
        $businesses = $businessController->getQuery()
            ->where('city', '=', $id)
            ->where('status', '=', 1)
            ->get();

        $finalBusiness = $businessController->businessElementsQuery($businesses);

        return response()->json($finalBusiness->toArray(), 200);
    }
}
