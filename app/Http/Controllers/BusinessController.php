<?php

namespace App\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function getAll() {
       return Business::all();

    }

    public function withId($id) {
        return Business::find($id);
    }

    public function create(Request $request) {
        return Business::create($request->all());
    }

//    public function update(Request $request, Business $business) {
//        $business->update($request->all());
//
//        return $response()->json($business, 201);
//    }
}
