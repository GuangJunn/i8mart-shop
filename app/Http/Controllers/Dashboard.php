<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Order;

class Dashboard extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request,$next){
            session(['module_active' => 'dashboard']);

            return $next($request);
        });
    }
    function show(){
        $color = array(
            'Đang xử lý' =>'primary',
            'Đang giao hàng' =>'warning',
            'Hoàn thành' =>'success',
            'Hủy đơn' =>'dark',
        );

        $total = Order::sum('total');

        $count_user_processing = Order::where('status','Đang xử lý')->get()->count();
        $count_user_delivery = Order::where('status','Đang giao hàng')->get()->count();
        $count_user_success = Order::where('status','Hoàn thành')->get()->count();
        $count_user_delete = Order::where('status','Hủy đơn')->get()->count();
        $count_user_price = Order::count('total');

        $count = [
            $count_user_processing,
            $count_user_delivery,
            $count_user_success,
            $count_user_delete
        ];
        
        $orders = Order::orderBy('id','desc')->paginate(8);
        return view('admin.dashboard',compact('orders','count','count_user_price','color','total'));
    }
}
 