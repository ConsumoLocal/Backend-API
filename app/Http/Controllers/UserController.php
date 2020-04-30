<?php

namespace App\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Business\BusinessController;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('isAdmin')->only(['destroy', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    public function getBusinesses($id) {
        $businessController = new BusinessController();
        $businesses = Business::withoutGlobalScope(\App\Scopes\ActiveBusinessScope::class)
            ->with(['city', 'status', 'categories', 'tags'])
            ->where('user_id', '=', $id)
            ->get();

        $finalBusiness = $businessController->businessElementsQuery($businesses);

        return response()->json($finalBusiness->toArray(), 200);
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
}
