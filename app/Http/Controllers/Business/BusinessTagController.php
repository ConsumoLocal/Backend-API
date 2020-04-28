<?php

namespace App\Http\Controllers\Business;

use App\BusinessTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessTagController extends Controller
{
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

    public function saveTag($business, $tag)
    {
        $number = DB::table('business_tags')
            ->where('business', '=', $business)
            ->where('tag', '=', $tag)
            ->count();

        if($number == 0) {
            BusinessTag::create([
                'business' => $business,
                'tag' => $tag
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessTag  $businessTag
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessTag $businessTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessTag  $businessTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessTag $businessTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessTag  $businessTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessTag $businessTag)
    {
        //
    }
}
