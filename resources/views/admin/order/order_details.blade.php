@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>         
    @endif
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0" style="font-weight:bold">Thông tin khách hàng</h5>          
        </div>
        <div class="card-body">
            <p style="font-weight:600"><span><i class="fa fa-info-circle" style="color: #E50914"></i></span> THÔNG TIN KHÁCH</p>
           
            <table class="table table-striped table-checkall">       
                <thead>
                    <tr>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Phương thức thanh toán</th>
                        <th scope="col">Thời gian đặt hàng</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{$order->code}}</td>
                            <td>
                                {{$order->name}} <br>
                                {{$order->phone}}
                            </td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Ghi chú đơn hàng:</th>
                            <td colspan="5">{{$order->note}}</td>
                        </tr>
                </tbody>
            </table>

            <p style="font-weight:600; text-transform:uppercase"><span><i class="fa fa-list" aria-hidden="true" style="color: #E50914"></i></i></span> Tình trạng đơn hàng: <span class="badge badge-@if($orders_status == 'Đang xử lý'){{$color[$orders_status]}}@elseif($orders_status == 'Đang giao hàng'){{$color[$orders_status]}}@elseif($orders_status == 'Hoàn thành'){{$color[$orders_status]}}@elseif($orders_status == 'Hủy đơn'){{$color[$orders_status]}}@endif p-2">{{$order->status}}</span></p>
            <div class="form-action form-inline py-3">
                <form action=" {{url('admin/order/update',$order->id)}} " method="POST">
                    @csrf
                <select class="form-control mr-1 col-4" id="" width="50px" name="status">
                    <option value="0">Chọn tình trạng đơn hàng</option>
                        @foreach ($list_action as $action)
                    <option value="{{$action}}">{{$action}}</option>
                @endforeach  
                </select>
                <input type="submit" name="btn-update" onclick="return confirm('Bạn có chắc cập nhật trạng thái đơn hàng này không ?')" value="Cập nhật đơn hàng" class="btn btn-primary">
            </form>
            </div>
            
        </div>
    </div>

    <div class="card" style="margin-top: 30px">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 " style="font-weight:bold">Chi tiết đơn hàng</h5>          
        </div>
        <div class="card-body" >
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                        @php
                            $t=0
                        @endphp
                        @foreach ($order_details as $details)
                        @php
                            $t++
                        @endphp
                        <tr>
                            <td>{{$t}}</td>
                            <td><img src="{{url($details->image)}}" alt="" width="80px"></td>
                            <td><a href="#">{{$details->product_name}}</a></td>
                            <td>{{number_format($details->product_price,0,'','.')}} đ</td>
                            <td>{{$details->product_qty}}</td>
                            <td>{{number_format(($details->product_qty * $details->product_price))}}đ</td>
                        </tr>
                        @endforeach                
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection