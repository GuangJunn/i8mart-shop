<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\CatProduct;
use App\Page;
use App\Slider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function show (){
        $categorys = CatProduct::where('parent_id','0')->get();
        $cat_products = CatProduct::get();
        
        $product_laps = CatProduct::join('products','products.cat_product_id','=','cat_products.id')
        ->where('cat_products.parent_id',6)
        ->limit(8)->get();

        $product_phone = CatProduct::join('products','products.cat_product_id','=','cat_products.id')
        ->where('cat_products.parent_id',5)
        ->limit(8)->get();

        $product_ipad = CatProduct::join('products','products.cat_product_id','=','cat_products.id')
        ->where('cat_products.parent_id',8)
        ->limit(4)->get();

        $product_watch = CatProduct::join('products','products.cat_product_id','=','cat_products.id')
        ->where('cat_products.parent_id',9)
        ->limit(4)->get();

        $outstanding_products = Product::where('status_product',4)->limit(8)->get();
        $latest_product = Product::where('status_product',3)->get();
        $pages = Page::all();
        $sliders = Slider::all();
        return view('pages.home',compact('product_phone','product_laps','product_ipad','product_watch','categorys','cat_products','outstanding_products','latest_product','pages','sliders'));
    }
}
