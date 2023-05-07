@extends('layouts.unimart')

@section('content')
<div class="section" id="breadcrumb-wp">
    <div class="wp-inner">
        <div class="section-detail">
            <ul class="list-item clearfix">
                <li>
                    <a href="{{url('/')}}" title="">Trang chủ</a>
                </li>
                <li>
                    <a href="" title="">Thanh toán</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="wrapper" class="wp-inner clearfix">
    <div class="section" id="customer-info-wp">
        <div class="section-head">
            <h1 class="section-title">Thông tin khách hàng</h1>
        </div>
        <p class="attention">(Chú ý: Nhập đúng thông tin để tránh việc giao hàng nhầm địa chỉ)</p>
        <div class="section-detail">
            <form method="POST" action="{{url('pages/checkout/store')}}" name="form-checkout">
                @csrf
                <div class="form-row clearfix">
                    <div class="form-col fl-left">
                        <label for="fullname">Họ tên</label>
                        <input type="text" name="name" id="fullname" placeholder="Nguyễn Văn A">
                        @error('name')
                            <small style="font-style:italic; color:red; font-size:12px">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-col fl-right">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="vanA@gmail.com">
                        @error('email')
                            <small style="font-style:italic; color:red; font-size:12px">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row clearfix">
                    <div class="form-col fl-left">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" placeholder="Nhập địa chỉ">
                        @error('address')
                            <small style="font-style:italic; color:red; font-size:12px">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-col fl-right">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" placeholder="Nhập số điện thoại">
                        @error('phone')
                            <small style="font-style:italic; color:red; font-size:12px">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="notes">Ghi chú <span style="font-style: italic; color:red; font-size:15px">(*) Không bắt buộc</span></label>
                        <textarea name="note" placeholder="Nhập ghi chú ..." rows="10" cols="73"></textarea>
                    </div>
                </div>
        </div>
    </div>
    <div class="section" id="order-review-wp">
        <div class="section-head">
            <h1 class="section-title">Thông tin đơn hàng</h1>
        </div>
        <div class="section-detail">
            <table class="shop-table">
                <thead>
                    <tr>
                        <th style="text-align: center">SẢN PHẨM</th>
                        <th>SỐ LƯỢNG</th>
                        <th style="text-align:right">TỔNG</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cart-item">
                        @foreach (Cart::content() as $row)                  
                        <tr>
                            <td>
                                <img src="{{url($row->options->image)}}" alt="" name="image" style="display:inline; vertical-align: middle;" width="50px">
                                {{$row->name}}
                            </td>
                            <td class="product-name" style="text-align: center">{{$row->qty}}</td>
                            <td style="text-align:right">{{number_format(($row->price * $row->qty),0,'','.')}}đ</td>
                        </tr>
                        @endforeach
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="order-total">
                        <td>Tổng đơn hàng:</td>
                        <td colspan="2" style="text-align:right"><strong class="total-price ">{{number_format(Cart::total(),0,'','.')}}đ</strong></td>
                    </tr>
                </tfoot>
            </table>
            <div id="payment-checkout-wp">
                <ul id="payment_methods">
                    <li>
                        <input type="radio" id="payment-home" name="payment_method" value="Thanh toán tại nhà" checked="checked">
                        <label for="payment-home">Thanh toán tại nhà</label>
                    </li>
                </ul>
            </div>
            <div class="place-order-wp clearfix">
                <input type="submit" id="order-now" value="Đặt hàng" name="btn-order">
            </div>
        </form>
        </div>
    </div>
</div>
@endsection