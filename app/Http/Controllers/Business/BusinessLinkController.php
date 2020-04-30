<?php

namespace App\Http\Controllers\Business;

use App\BusinessLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessLinkController extends Controller
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
    public function store($business, $link, $value)
    {
        $link = BusinessLink::create([
            'business' => $business,
            'link'      => $link,
            'value'     => $value
        ]);
        return $link->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessLink  $businessLink
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessLink $businessLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessLink  $businessLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $linkId)
    {
        // TODO: finish link update
        print_r($linkId);
        $this->linkValueValidator($request->all())->validate();

//        if (request()->user()->id == $businessLink->business()->user_id || request()->user()->admin) {
//            $businessLink->value = $request->all()['value'];
//            $businessLink->save();
//            return response()->json($businessLink, 201);
//        } else {
//            return response()->json(['Error' => 'Missing value'], 201);
//        }
    }

    function linkValueValidator($data) {
        return Validator::make($data, [
            'value'   => ['required'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessLink  $businessLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessLink $businessLink)
    {
        //
    }
}
