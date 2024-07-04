<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\MajorCategory;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $keyword = $request->keyword;

    if ($request->category !== null) {
        $shops = Shop::where('category_id', $request->category)->paginate(15);
        $total_count = Shop::where('category_id', $request->category)->count();
        $category = Category::find($request->category);
        $major_category = MajorCategory::find($category->major_category_id);
    } elseif ($keyword !== null) {
        $shops = Shop::where('name', 'like', "%{$keyword}%")->paginate(15);
        $total_count = $shops->total();
        $category = null;
        $major_category = null;
    } else {
        $shops = Shop::paginate(15);
        $total_count = $shops->total();
        $category = null;
        $major_category = null;
    }

    $categories = Category::with('shops')->get();
    $major_categories = MajorCategory::all();

    return view('shops.index', compact('shops', 'category', 'major_category', 'categories', 'major_categories', 'total_count', 'keyword'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('shops.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop();
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->save();
 
        return to_route('shops.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $reviews = $shop->reviews()->get();
        return view('shops.show', compact('shop', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        $categories = Category::all();

        return view('shops.edit', compact('shop', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $shop->name = $request->input('name');
        $shop->description = $request->input('description');
        $shop->update();

        return to_route('shops.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();

        return to_route('shops.index');
    }
}
