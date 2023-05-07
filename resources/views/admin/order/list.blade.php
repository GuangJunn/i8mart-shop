@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>         
            @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
            <div class="form-search form-inline">
                <form action="#">
                    <input type="text" class="form-control form-search" name="keyword" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic" style="margin-bottom: 15px">
                <a href="http://localhost:8888/gg/laravel/unismart/admin/order/list" class="text-primary">Tất cả<span class="text-muted"> ({{$count[4]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'Đang xử lý'])}}" class="text-primary">Đang xử lý<span class="text-muted"> ({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'Đang giao hàng'])}}" class="text-primary">Đang giao hàng<span class="text-muted"> ({{$count[1]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'Hoàn thành'])}}" class="text-primary">Hoàn thành<span class="text-muted"> ({{$count[2]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'Hủy đơn'])}}" class="text-primary">Hủy đơn<span class="text-muted"> ({{$count[3]}})</span></a>
            </div>
        <form action="{{url('admin/order/action')}}" method="">
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="act">
                    <option>Chọn</option>
                    @foreach ($list_act as $k=>$act)
                        <option value="{{$act}}">{{$act}}</option>
                    @endforeach 
                </select>
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
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
                @if ($orders->total()>0)
                    @php
                        $t=0
                    @endphp
                    @foreach ($orders as $order)
                    @php
                        $t++
                    @endphp
                        <tr>
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{$order->id}}">
                            </td>
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
                    @else
                        <tr>
                            <td colspan="8">Danh sách sản phẩm trống</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </form>
            {{$orders->links()}}
        </div>
    </div>
</div>
@endsection