<?php

namespace App\Http\Controllers\Business;

use App\Business;
use App\BusinessLink;
use App\Http\Controllers\Controller;
use App\Link;
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
        $this->linkValidator($request->all())->validate();
        $data = $request->all();
        $business = Business::findOrFail($data['business'])->first();

        $currentUser = $request->user();

        $link = Link::find($data['link'])->first();
        if(!isset($link)) {
            return response()->json(['error' => 'The provided link is invalid'], 422);
        }

        if($business->user_id == $currentUser->id || $currentUser->admin) {
            $link = BusinessLink::create([
                'business'  => $business->id,
                'link'      => $link->id,
                'value'     => $data['value']
            ]);

            return response()->json($link, 201);

        } else {
            return response()->json(['error' => 'You are not authorized to add this link'], 401);
        }
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

    function linkValidator($data) {
        return Validator::make($data, [
            'value'   => ['required'],
            'business'   => ['required'],
            'link'   => ['required']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessLink  $businessLink
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $businessLink= BusinessLink::findOrFail($id);
        if (request()->user()->id == $businessLink->business()->first()->user_id || request()->user()->admin) {
            $businessLink->delete();
            return response()->json(['message' => 'Link deleted'], 202);

        }else {
            return response()->json(['error' => 'You are not authorized to delete this link'], 401);
        }
    }

}
