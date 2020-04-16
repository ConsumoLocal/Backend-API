<?php

namespace App\Http\Controllers;

use App\LinkDataType;
use Illuminate\Http\Request;

class LinkDataTypeController extends Controller
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
        return LinkDataType::all();
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
     * @param  \App\LinkDataType  $linkDataType
     * @return \Illuminate\Http\Response
     */
    public function show(LinkDataType $linkDataType)
    {
        return $linkDataType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LinkDataType  $linkDataType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LinkDataType $linkDataType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LinkDataType  $linkDataType
     * @return \Illuminate\Http\Response
     */
    public function destroy(LinkDataType $linkDataType)
    {
        //
    }
}
