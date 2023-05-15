@extends('layouts.unimart')

@section('content')

<div class="main-content fl-right">
    <div class="section" id="slider-wp">
        <div class="section-detail">
            @foreach ($sliders as $item)
            <div class="item" style="height:385px">
                <img src="{{url($item->image)}}" alt="">
            </div>
            @endforeach
        </div>
    </div>
    <div class="section" id="support-wp">
        <div class="section-detail">
            <ul class="list-item clearfix">
                <li>
                    <div class="thumb">
                        <img src="{{asset('images/icon-1.png')}}">
                    </div>
                    <h3 class="title">Miễn phí vận chuyển</h3>
                    <p class="desc">Tới tận tay khách hàng</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{asset('images/icon-2.png')}}">
                    </div>
                    <h3 class="title">Tư vấn 24/7</h3>
                    <p class="desc">1900.9999</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{asset('images/icon-3.png')}}">
                    </div>
                    <h3 class="title">Tiết kiệm hơn</h3>
                    <p class="desc">Với nhiều ưu đãi cực lớn</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{asset('images/icon-4.png')}}">
                    </div>
                    <h3 class="title">Thanh toán nhanh</h3>
                    <p class="desc">Hỗ trợ nhiều hình thức</p>
                </li>
                <li>
                    <div class="thumb">
                        <img src="{{asset('images/icon-5.png')}}">
                    </div>
                    <h3 class="title">Đặt hàng online</h3>
                    <p class="desc">Thao tác đơn giản</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="section" id="list-product-wp">
        <div class="section-head">
            <h3 class="section-title" style="border-bottom: 2px solid #000">Sản phẩm nổi bật</span></h3>
        </div>
        <div class="section-detail">
            <ul class="list-item clearfix">
                @foreach ($outstanding_products as $outstanding)
                <li>
                    <a href="{{url('chi-tiet-san-pham',$outstanding->slug)}}" title="" class="thumb" >
                        <img src="{{url($outstanding->image)}}" height="189px" class="bob-on-hover">
                    </a>
                    <a href="{{url('chi-tiet-san-pham',$outstanding->slug)}}" title="" class="product-name">{{$outstanding->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($outstanding->price,0,'','.')}} đ</span>
                    </div>
                    <div class="action clearfix">
                        <a onclick="AddCart({{$outstanding->id}})" href="javascript:" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="{{url('chi-tiet-san-pham',$outstanding->slug)}}" title="Mua ngay" class="buy-now fl-right">Xem ngay</a>
                    </div>
                </li>
                @endforeach   
            </ul>
        </div>
    </div>
    <div class="section" id="list-product-wp">
        <div class="section-head">
            <h3 class="section-title" style="border-bottom: 2px solid #000">Điện thoại</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item clearfix">
                @foreach ($product_phone as $phone)
                <li>
                    <a href="{{url('chi-tiet-san-pham',$phone->slug)}}" title="" class="thumb">
                        <img src="{{url($phone->image)}}" height="189px" class="bob-on-hover" >
                    </a>
                    <a href="{{url('chi-tiet-san-pham',$phone->slug)}}" title="" class="product-name">{{$phone->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($phone->price,0,'','.')}} đ</span>
                    </div>
                    <div class="action clearfix">
                        <a onclick="AddCart({{$phone->id}})" href="javascript:" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="{{url('chi-tiet-san-pham',$outstanding->slug)}}" title="Mua ngay" class="buy-now fl-right">Xem ngay</a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="section" id="list-product-wp">
        <div class="section-head">
            <h3 class="section-title" style="border-bottom: 2px solid #000">Laptop</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item clearfix">
                @foreach ($product_laps as $laps)
                <li>
                    <a href="{{url('chi-tiet-san-pham',$laps->slug)}}" title="" class="thumb">
                        <img src="{{url($laps->image)}}" height="189px" class="bob-on-hover" style="height: 189px">
                    </a>
                    <a href="{{url('chi-tiet-san-pham',$laps->slug)}}" title="" class="product-name">{{$laps->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($laps->price,0,'','.')}} đ</span>
                    </div>
                    <div class="action clearfix">
                        <a onclick="AddCart({{$laps->id}})" href="javascript:" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="{{url('them-san-pham/'.$laps->id)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                    </div>
                </li>
                @endforeach     
            </ul>
        </div>
    </div>

    <div class="section" id="list-product-wp">
        <div class="section-head">
            <h3 class="section-title" style="border-bottom: 2px solid #000">Máy tính bảng</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item clearfix">
                @foreach ($product_ipad as $ipad)
                <li>
                    <a href="{{url('chi-tiet-san-pham',$ipad->slug)}}" title="" class="thumb">
                        <img src="{{url($ipad->image)}}" height="189px" class="bob-on-hover" style="height: 189px">
                    </a>
                    <a href="{{url('chi-tiet-san-pham',$ipad->slug)}}" title="" class="product-name">{{$ipad->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($ipad->price,0,'','.')}} đ</span>
                    </div>
                    <div class="action clearfix">
                        <a onclick="AddCart({{$ipad->id}})" href="javascript:" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="{{url('them-san-pham/'.$ipad->id)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                    </div>
                </li>
                @endforeach     
            </ul>
        </div>
    </div>

    <div class="section" id="list-product-wp">
        <div class="section-head">
            <h3 class="section-title" style="border-bottom: 2px solid #000">Đồng hồ thông minh</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item clearfix">
                @foreach ($product_watch as $watch)
                <li>
                    <a href="{{url('chi-tiet-san-pham',$watch->slug)}}" title="" class="thumb">
                        <img src="{{url($watch->image)}}" height="189px" class="bob-on-hover" style="height: 189px">
                    </a>
                    <a href="{{url('chi-tiet-san-pham',$watch->slug)}}" title="" class="product-name">{{$watch->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($watch->price,0,'','.')}} đ</span>
                    </div>
                    <div class="action clearfix">
                        <a onclick="AddCart({{$watch->id}})" href="javascript:" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="{{url('them-san-pham/'.$watch->id)}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                    </div>
                </li>
                @endforeach     
            </ul>
        </div>
    </div>
</div>
@endsection

@section('sidebar')
<style>
    .category-item{
        position: relative;
    }
    .category-item-icon{
        position: absolute;
        top: 50%;
        right: 5%;
        transform: translateY(-50%);
        color: #000;
    }
    .category-list-sub-item {
        position: relative;
        list-style: none;
    }
    .category-list-sub-link {
        position: relative;
        display: block;
        font-size: 16px;
        text-decoration: none;
        color: #171313;
        padding: 9px 20px;
        border-bottom: 1px solid #eee;
    }
    .category-list-sub-link:hover {
        right: -2px;
        color: var(--primary-color);
        background: #eee;
        text-decoration: none;
    }
    
    .list-sub-menu{
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
        width: 250px;
        z-index: 1;
        border: 1px solid #ececec;
        background: #fff;
        padding: 0;
    }
    .category-sub-item--active:hover .list-sub-menu{
        display: block;
    }
</style>
<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item"> 
                {{-- Lấy danh mục cha --}}
                @foreach ($categorys as $key => $cat)    
                <li class="category-item">
                    <a href="{{url('danh-muc-san-pham',$cat->slug)}}" title="">{{$cat->title}}</a>
                    @if ($cat->count())
                        <i class="category-item-icon fa fa-angle-right" aria-hidden="true"></i>
                    @endif
                    {{-- Lấy danh mục con --}}
                    <ul class="sub-menu">
                        @foreach ($cat_products as $keysub => $cat_sub)
                        @if ($cat_sub->parent_id == $cat->id)
                        <li class="category-list-sub-item category-sub-item {{ $keysub == 0 ? '--active' : ''}}">
                            <a href="{{url('danh-muc-san-pham',$cat_sub->slug)}}" title="" class="category-list-sub-link">{{$cat_sub->title}}</a>   
                            {{-- Lấy danh mục cha --}}               
                            <ul class="list-sub-menu">
                            @foreach ($cat_products as $key => $sub)
                                @if ($sub->parent_id == $cat_sub->id)    
                                <li class="category-list-sub-item">
                                    <a href="{{url('danh-muc-san-pham',$sub->slug)}}" title="" class="category-list-sub-link">{{$sub->title}}</a>  
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @endforeach 
            </ul>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm mới nhất</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                @foreach ($latest_product as $latest)
                <li class="clearfix">
                    <a href="{{url('chi-tiet-san-pham',$latest->slug)}}" title="" class="thumb fl-left">
                        <img src="{{url($latest->image)}}" height="50px">
                    </a>
                    <div class="info fl-right">
                        <a href="{{url('chi-tiet-san-pham',$latest->slug)}}" title="" class="product-name">{{$latest->name}}</a>
                        <div class="price">
                            <span class="new">{{number_format($latest->price,0,'','.')}}đ</span>
                        </div>
                        <a href="{{url('chi-tiet-san-pham',$latest->slug)}}" title="" class="buy-now">Xem Ngay</a>
                    </div>
                </li>
                @endforeach              
            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="{{asset('images/banner.png')}}" alt="">
            </a>
        </div>
    </div>
</div>
@endsection