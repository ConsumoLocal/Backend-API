<?php

namespace App\Http\Controllers\Business;

use App\BusinessLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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
    public function store($business, $link, $value)
    {
        $link = BusinessLink::create([
            'business' => $business,
            'link'      => $link,
            'value'     => $value
        ]);
        return $link->id;
    }

    public function storeLink(Request $request) {

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
     * @param  \App\BusinessLink  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentLink = BusinessLink::findOrFail($id);
        $this->linkValueValidator($request->all())->validate();

        if ($request->user()->id == $currentLink->business()->first()->user_id || $request->user()->admin) {
            $currentLink->value = $request->all()['value'];
            $currentLink->save();
            return response()->json($currentLink, 201);
        } else {
            return response()->json(['error' => 'You are not authorized to change this link content'], 401);
        }
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
