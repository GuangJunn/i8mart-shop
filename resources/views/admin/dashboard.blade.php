@extends('layouts.admin')

@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col-3">
            <div class="card text-white bg-danger    mb-3">
                <div class="card-header font-weight-bold">DOANH SỐ</div>
                <div class="card-body">
                    <h5 class="card-title">{{number_format($total,0,'','.')}} đ</h5>
                    <p class="card-text" style="font-size:14px">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        
        <div class="col-2">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header font-weight-bold">ĐANG XỬ LÝ</div>
                <div class="card-body">
                    <h5 class="card-title"><a href=""></a>{{$count[0]}} Đơn</h5>
                    <p class="card-text" style="font-size:14px">Số lượng đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>

        <div class="col-2">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header font-weight-bold">ĐƠN GIAO HÀNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[1]}} Đơn</h5>
                    <p class="card-text" style="font-size:14px">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header font-weight-bold">ĐƠN HÀNG THÀNH CÔNG</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[2]}} Đơn</h5>
                    <p class="card-text" style="font-size:14px">Đơn hàng giao dịch thành công</p>
                </div>
            </div>
        </div>

        <div class="col-2">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header font-weight-bold">ĐƠN HÀNG HỦY</div>
                <div class="card-body">
                    <h5 class="card-title">{{$count[3]}} Đơn</h5>
                    <p class="card-text" style="font-size:14px">Số đơn bị hủy trong hệ thống</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            ĐƠN HÀNG MỚI
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $t=0
                    @endphp
                    @foreach ($orders as $order)
                    @php
                        $t++
                    @endphp
                        <tr>
                            <td>{{$t}}</td>
                            <td>{{$order->code}}</td>
                            <td>
                                <a href="{{url('admin/order/order-detail/'.$order->id)}}">{{$order->name}} <br>
                                {{$order->phone}}</a>
                            </td>
                            <td>{{number_format($order->total,0,'','.')}}đ</td>
                            <td><span class="badge badge-@if($order->status == 'Đang xử lý'){{$color[$order->status]}}@elseif($order->status == 'Đang giao hàng'){{$color[$order->status]}}@elseif($order->status == 'Hoàn thành'){{$color[$order->status]}}@elseif($order->status == 'Hủy đơn'){{$color[$order->status]}}@endif p-2">{{$order->status}}</span></td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{url('admin/order/order-detail/'.$order->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Chi tiết đơn hàng"><i class="far fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>

</div>
@endsection
