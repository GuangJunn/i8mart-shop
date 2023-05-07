<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;
use App\Page;

class CartController extends Controller
{
    //
    function show(){
        $pages = Page::all();
        return view('pages.cart.details_cart',compact('pages'));
    }

    function add($id){
        $product = Product::find($id);

        // Cart::destroy(); //Xóa toàn bộ sản phẩm

        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => 1, 
            'price' => $product->price, 
            'options' => ['image' => $product->image]
        ]);
        return redirect('/gio-hang');
    }

    function add_cart($id){
        $product = Product::find($id);

        // Cart::destroy(); //Xóa toàn bộ sản phẩm

        Cart::add([
            'id' => $product->id, 
            'name' => $product->name, 
            'qty' => 1, 
            'price' => $product->price, 
            'options' => ['image' => $product->image]
        ]);
    }

    function remove($rowId){
        Cart::remove($rowId);
        return redirect('gio-hang');
    }

    function destroy(){
        Cart::destroy();
        return redirect('gio-hang');
    }

    function update(Request $request){
        $data = $request ->get('qty');
        foreach ($data as $k => $v){
            Cart::update($k , $v);
        }
        return redirect('gio-hang');
    }
}
