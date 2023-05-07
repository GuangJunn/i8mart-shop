<?php

namespace App\Http\Controllers;
use App\Product;
use App\CatProduct;
use App\Page;
use App\Slider;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    function search(Request $request){

        $keywords = $request->keyword;

        $categorys = CatProduct::where('parent_id','0')->get();
        $cat_products = CatProduct::get();
        $latest_product = Product::where('status_product',3)->get();
        $pages = Page::all();
        $sliders = Slider::all();

        $product_count = Product::count();
        $search_product = Product::where('name','LIKE','%'.$keywords.'%')->get();

        return view('pages.searchs.search',compact('categorys','cat_products','latest_product','pages','sliders','search_product','product_count','keywords'));
    }

    
}
