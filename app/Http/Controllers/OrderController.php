<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Order;
use App\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Mail\Gmail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //
    function show(){
        $pages = Page::all();

        return view('pages.checkout.show_checkout',compact('pages'));
    }
    function store(Request $request){
            $request->validate(
                [
                    'name' => 'required| string| max:255',
                    'email' => 'required| string| email| max:255',
                    'address' => 'required| string',
                    'phone' => 'required| string | max:12',
                    'payment_method'=> 'required| string',  
                ],
                [
                    'required' => ':attribute không được để trống',
                ],
                [
                    'name' => 'Họ và tên',
                    'email' => 'Email',
                    'address' => 'Địa chỉ',
                    'phone' => 'Số điện thoại',
                    'payment_method'=> 'Phương thức thanh toán',
                ],
            );
            $order_code = "ISM_" . strtoupper(substr(md5(time()), 0, 4)) ;
            $order = Order::create([
                'code' =>  $order_code,
                'name' => $request['name'],
                'email' => $request['email'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'note' => $request['note'] ? $request['note'] : '',
                'payment_method' => $request['payment_method'],
                'total' => Cart::total(),
                'status' => 'Đang xử lý',
            ]);

            
            $contents = Cart::content();
            foreach($contents as $content){
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $content->id,
                    'product_name' => $content->name,
                    'product_price' => $content->price,
                    'product_qty' => $content->qty,
                ]);
            };
            $order_details = Order::join('order_details','orders.id','=','order_details.order_id')
            ->join('products','products.id','=','order_details.product_id')
            ->where('order_id',$order->id)
            ->select('orders.*','order_details.*','products.*')
            ->get();

            $data = [
                'code' =>  $order_code,
                'name' => $request['name'],
                'email' => $request['email'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'note' => $request['note'] ? $request['note'] : '',
                'total' => Cart::total(),
                'order_details' => $order_details
            ];
            // return $data;
            Mail::to($request['email'])->send(new Gmail($data));

            Cart::destroy();
            return redirect('dat-hang-thanh-cong');           
    }

    function success(){
        $pages = Page::all();

        $order = Order::orderBy('id','desc')->first();
        $order_id= $order->id;
        $order_details = Order::join('order_details','orders.id','=','order_details.order_id')
        ->join('products','products.id','=','order_details.product_id')
            ->where('order_id',$order_id)
            ->select('orders.*','order_details.*','products.*')
            ->get();
        // return $order_details;
        return view('pages/checkout/success',compact('pages','order','order_details'));
    }
}
