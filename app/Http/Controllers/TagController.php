<?php

namespace App\Http\Controllers;

use App\Tag;
use Cassandra\Bigint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $all = Tag::all();

        return response()->json($all, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  String  $value
     * @return Bigint $tagId
     */
    public function store($value)
    {
        $tag = DB::table('tags')
            ->where('value', '=', $value)
            ->get();

        if (count($tag) == 0) {
            $newTag = Tag::create(['value' => $value ]);
            return $newTag->id;
        }

        return $tag->first()->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
