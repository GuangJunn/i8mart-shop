<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;

class AdminOrderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request,$next){
            session(['module_active' => 'order']);

            return $next($request);
        });
    }

    function list(Request $request){
        $status = $request->input('status');
        $orders= Order::orderBy('id','desc')->paginate(10);
        
        $list_act = [
            'Đang xử lý' =>'Đang xử lý',
            'Đang giao hàng' =>'Đang giao hàng',
            'Hoàn thành' =>'Hoàn thành',
            'Hủy đơn' =>'Hủy đơn',
            'Xóa đơn hàng' => 'Xóa đơn hàng'
        ];

        $color = array(
            'Đang xử lý' =>'primary',
            'Đang giao hàng' =>'warning',
            'Hoàn thành' =>'success',
            'Hủy đơn' =>'dark',
        );

        if($status == 'Đang xử lý'){
            $orders= Order::where('status','Đang xử lý')
            ->orderBy('id','desc')
            ->paginate(10);
        }
        elseif($status == 'Đang giao hàng'){
            $orders= Order::where('status','Đang giao hàng')
            ->orderBy('id','desc')
            ->paginate(10);
        }
        elseif($status == 'Hoàn thành'){
            $orders= Order::where('status','Hoàn thành')
            ->orderBy('id','desc')
            ->paginate(10);
        }
        elseif($status == 'Hủy đơn'){
            $orders= Order::where('status','Hủy đơn')
            ->orderBy('id','desc')
            ->paginate(10);
        }
        else{
            $keyword = "";// Tại 1 biến trống
            if($request->input('keyword')){
            $keyword = $request->input('keyword');
            $orders= Order::where('name','LIKE',"%{$keyword}%")->paginate(10);
            }
        }   

        // Danh sách màu trạng thái
       

        $count_user_processing = Order::where('status','Đang xử lý')->get()->count();
        $count_user_delivery = Order::where('status','Đang giao hàng')->get()->count();
        $count_user_success = Order::where('status','Hoàn thành')->get()->count();
        $count_user_delete = Order::where('status','Hủy đơn')->get()->count();
        $count_user_price = Order::all()->count();

        $count = [
            $count_user_processing,
            $count_user_delivery,
            $count_user_success,
            $count_user_delete,
            $count_user_price
        ];
        return view('admin/order/list',compact('orders','count','list_act','color'));
    }

    function order_detail($id){
        $order = Order::find($id);
        $orders_status = $order->status;

        // Danh sách màu trạng thái
        $color = array(
            'Đang xử lý' =>'primary',
            'Đang giao hàng' =>'warning',
            'Hoàn thành' =>'success',
            'Hủy đơn' =>'dark',
        );
        $list_action = [
            'Đang xử lý' =>'Đang xử lý',
            'Đang giao hàng' =>'Đang giao hàng',
            'Hoàn thành' =>'Hoàn thành',
            'Hủy đơn' =>'Hủy đơn',
        ];

        $order_details = Order::join('order_details','orders.id','=','order_details.order_id')
        ->join('products','products.id','=','order_details.product_id')
            ->where('order_id',$id)
            ->select('orders.*','order_details.*','products.*')
            ->get();
        // return $order_details;
        return view('admin/order/order_details',compact('order','order_details','list_action','orders_status','color'));
    }

    function update(Request $request,$id){
        $order_code = Order::find($id)->code;
        $request->input('status');
        $status = $request->input('status');

        Order::where('code',$order_code)->update(['status'=>$status]);
        return redirect('admin/order/list')->with('status','Cập nhật trạng thái đơn hàng ' .$order_code. ' thành công');
    }
    

    function action(Request $request){
        $list_check = $request->input('list_check');

       if($list_check){
            $act =$request->input('act');

            if($act == 'Đang xử lý'){
                Order::whereIn('id', $list_check)->update(['status'=>$act]);
                return redirect('admin/order/list')->with('status','Đã chuyển trạng thái đơn hàng thành công');
            }
            if($act == 'Đang giao hàng'){
                Order::whereIn('id', $list_check)->update(['status'=>$act]);
                return redirect('admin/order/list')->with('status','Đã chuyển trạng thái đơn hàng thành công');
            }
            if($act == 'Hoàn thành'){
                Order::whereIn('id', $list_check)->update(['status'=>$act]);
                return redirect('admin/order/list')->with('status','Đã chuyển trạng thái đơn hàng thành công');
            }
            if($act == 'Hủy đơn'){
                Order::whereIn('id', $list_check)->update(['status'=>$act]);
                return redirect('admin/order/list')->with('status','Đã chuyển trạng thái đơn hàng thành công');
            }

            if($act == 'Xóa đơn hàng'){
                    Order::whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/order/list')->with('status','Đã xóa đơn hàng vĩnh viễn');
            }
            
       }else{
           return redirect('admin/order/list')->with('status','Bạn cần chọn phần tử cần thực thi');
       }
    }
}
