@extends('layouts.unimart')

@section('content')
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Trang Giỏ Hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if (Cart::count() > 0)
    <p class="desc">Có <span style="color: red; font-weight:bold">{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <form action="{{url('/cap-nhat-gio-hang')}}" method="POST">
                    @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t=0
                        @endphp
                        @foreach (Cart::content() as $row)
                        @php
                            $t++
                        @endphp
                            <tr>
                                <td>{{$t}}</td>
                                <td>
                                    <a href="{{url('chi-tiet-san-pham/'.$row->id)}}" title="" class="thumb">
                                        <img src="{{url($row->options->image)}}" alt="" name="image" >
                                    </a>
                                </td>
                                <td>
                                    <span>{{$row->name}}</span>
                                </td>
                                <td>{{number_format($row->price,0,'','.')}}đ</td>
                                <td>
                                    <input type="number" value="{{$row->qty}}" class="num-order" min="1" name="qty[{{$row->rowId}}]">
                                </td>
                                <td>{{number_format(($row->total),0,'','.')}}đ</td>
                                <td>
                                    <a href="{{url('xoa-san-pham',$row->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach                       
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <strong>{{number_format(Cart::total(),0,'','.')}}đ</strong></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <a href="{{url('/')}}" title="" id="buy-more">Mua tiếp</a>
                                        <a href="{{url('/xoa-gio-hang')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
                                        <input type="submit" value="Cập nhật giỏ hàng" name="btn-update" id="update-cart">
                                        <a href="{{url('/thanh-toan')}}" title="" id="checkout-cart">Thanh toán</a>                            
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
            </div>
        </div>  
    </div>
    @else
    <div id="wrapper" class="wp-inner clearfix">
        <h2>HIỆN TRONG GIỎ HÀNG KHÔNG CÓ SẢN PHẨM</h2>
        <a href="{{url('/')}}" title="" id="buy-more">Quay về trang chủ</a>
    </div>
    @endif
    
</div>
@endsection