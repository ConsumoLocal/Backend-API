<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = DB::table('categories', 'C')
            ->select('C.id','C.value')
            ->whereNull('C.parent')
            ->get();

        foreach ($categories as $cat) {
            $subcategories = DB::table('categories', 'S')
                ->select('S.id','S.value')
                ->where('S.parent', '=', $cat->id)
                ->get();

            $cat->subcategories = $subcategories;


        }
        return response()->json($categories, 200);
    }

    public function business(Request $request) {
        if (isset($request->all()['categories'])) {
            $categories = $request->all()['categories'];
            $businessController = new BusinessController();
            $finalBusiness = array();
            $businesses = DB::table('businesses')
                ->join('business_categories', 'business_categories.business', '=', 'businesses.id')
                ->join('categories', 'categories.id', '=', 'business_categories.category')
                ->whereIn('categories.id', $categories)
                ->orWhereIn('categories.parent', $categories)
                ->select('businesses.id', 'categories.id AS category')
                ->get();

            foreach ($businesses as $business) {
                $completeBusiness = $businessController->show($business->id);
                array_push($finalBusiness, $completeBusiness);
            }
            return response()->json($finalBusiness, 200);
        } else {
            return response()->json(['error' => 'No categories array provided'], 422);
        }

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
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        return response('', 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        return response('', 501);
    }
}
