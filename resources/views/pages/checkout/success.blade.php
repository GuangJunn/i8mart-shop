@extends('layouts.unimart')

@section('content')
<div id="wrapper" class="wp-inner clearfix">
    
</div>
<div class="notification" style="text-align:center; margin-top:15px;">
    <p style="font-size:30px; color:#49B265; font-weight:bold">Đã đặt hàng thành công</p>
    <span >Cảm ơn quý khách hàng đã mua hàng tại I8mart</span><br>
    <span >Chúng tôi sẽ liên hệ với quý Khách để xác nhận đơn hàng trong thời gian sớm nhất</span><br>
    <span style="font-size:20px; color:#e50914; font-weight:bold">Cảm ơn quý khách đã tin tưởng</span><br>
    
    <a href="{{url('/')}}" class="btn btn-warning p-2" style="margin-top:10px">Quay về trang chủ</a>
</div>
<div class="card-body">
    <p style="font-weight:600"><span><i class="fa fa-info-circle" style="color: #E50914"></i></span> THÔNG TIN KHÁCH</p>  
    <table class="table table-striped table-checkall" style="border: 1px ">       
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
    
</div>
<div class="card-body" style="display: flex; flex-direction: column;">
    <p style="font-weight:600"><span><i class="fa fa-info-circle" style="color: #E50914"></i></span> CHI TIẾT ĐƠN HÀNG</p>  
        <table class="table table-striped table-checkall" style="text-align: center">
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
                        <td style="padding-top: 30px">{{$t}}</td>
                        <td><a style="color:#000" href="{{url('chi-tiet-san-pham',$details->slug)}}"><img src="{{url($details->image)}}" alt="" width="80px"></td>
                        <td style="padding-top: 30px;"><a style="color:#000" href="{{url('chi-tiet-san-pham',$details->slug)}}">{{$details->product_name}}</a></td>
                        <td style="padding-top: 30px">{{number_format($details->product_price,0,'','.')}} đ</td>
                        <td style="padding-top: 30px">{{$details->product_qty}}</td>
                        <td style="padding-top: 30px">{{number_format(($details->product_qty * $details->product_price))}}đ</td>
                    </tr>
                    @endforeach   
                    <tr style="background: rgb(231, 231, 231)">
                        <td colspan="5" style="font-weight:bold">Tổng giá trị đơn hàng:</td>
                        <td style="font-weight:bold">{{number_format($order->total,0,'','.')}} đ</td>
                    </tr>             
            </tbody>
        </table>
</div>
@endsection