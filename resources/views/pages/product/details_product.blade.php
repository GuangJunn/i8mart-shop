@extends('layouts.unimart')

@section('content')

<div class="secion" id="breadcrumb-wp">
    <style>
        .lSSlideOuter .lSPager.lSGallery img {
            display: block;
            height: 77.39px;
            max-width: 100%;
        }
        
        li.active{
            border: 1px solid #cacaca;
        }
    </style>
    <div class="secion-detail">
        <ul class="list-item clearfix">
            <li>
                <a href="{{url('/')}}" title="Trang chủ">Trang chủ</a>
            </li>
            <li>
                <a href="" title="{{$product_name}}">{{$product_name}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="main-content fl-right">
    @foreach ($product_detail as $detail)
    <div class="section" id="detail-product-wp">
        <div class="section-detail clearfix">
            <div class="thumb-wp fl-left">
                <ul id="imageGallery" class="lightSlider">
                    <li data-thumb="{{url($detail->image)}}" data-src="{{url($detail->image)}}" >
                        <img width="100%" src="{{url($detail->image)}}" style="border:none">
                    </li>
                    @foreach ($gallery as $item)
                    <li data-thumb="{{url($item->imagedesc)}}" data-src="{{url($item->imagedesc)}}" >
                        <img width="100%" src="{{url($item->imagedesc)}}" style="border:none"/>
                      </li>
                    @endforeach
                  </ul>
            </div>
            <div class="thumb-respon-wp fl-left">
                <img src="{{url($detail->image)}}" alt="">
            </div>
            <div class="info fl-right">
                <h3 class="product-name">{{$detail->name}}</h3>
                <div class="desc" style="font-size: 12px">
                    {!!$detail->desc!!}
                </div>
                <hr style="color: black">
                <div class="num-product">
                    <span class="title">Trạng thái sản phẩm: </span>
                    @if ($detail->status == 1)
                        <span class="status">Hết hàng</span>
                    @else
                        <span class="status">Còn hàng</span>
                    @endif
                </div>
                <p class="price">{{number_format($detail->price,0,'','.')}}đ</p>
                <a href="{{url('them-san-pham/'.$detail->id)}}" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
            </div>
        </div>
    </div>
    <div class="section" id="post-product-wp">
        <div class="section-head">
            <h3 class="section-title">Mô tả sản phẩm</h3>
        </div>
        <div class="section-detail">       
                {!!$detail->content!!}               
        </div>
    </div>            
    @endforeach
    
    <div class="section" id="list-product-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm liên quan</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                @foreach ($related_product as $relate)
                <li>
                    <a href="{{url('chi-tiet-san-pham',$relate->slug)}}" title="{{$relate->name}}" class="thumb">
                        <img src="{{url($relate->image)}}" style="height: 190px" class="bob-on-hover">
                    </a>
                    <a href="{{url('chi-tiet-san-pham/',$relate->slug)}}" title="{{$relate->name}}" class="product-name">{{$relate->name}}</a>
                    <div class="price">
                        <span class="new">{{number_format($relate->price,0,'','.')}}đ</span>
                    </div>
                    <div class="action clearfix">
                        <a href="{{url('them-san-pham/'.$relate->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                        <a href="{{url('chi-tiet-san-pham',$relate->slug)}}" title="Mua ngay" class="buy-now fl-right">Xem ngay</a>
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