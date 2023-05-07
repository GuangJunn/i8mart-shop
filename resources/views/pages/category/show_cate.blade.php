@extends('layouts.unimart')

@section('content')
<div class="secion" id="breadcrumb-wp">
    <div class="secion-detail">
        <ul class="list-item clearfix">
            <li>
                <a href="http://localhost:8888/gg/laravel/unismart" title="Trang chủ">Trang chủ</a>
            </li>
           
            <li>
                <a href="" title="{{$cat_name}}">{{$cat_name}}</a>
            </li>
            
        </ul>
    </div>
</div>
<div class="main-content fl-right">
    @if($list_items->count() > 0)
        <div class="section" id="list-product-wp">
            <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><span style="padding: 5px 10px; background:#000; color:#fff; margin-top:10px">{{$cat_name}}</span></h3>   
                           
                <div class="filter-wp fl-right">
                    <p class="desc">Hiển thị {{$list_items->count()}} trên {{$product_count}} sản phẩm</p>
                    <div class="form-filter"style="display:flex">
                        <div class="dropdown mr-4">
                            <button class="btn btn dropdown-toggle" data-toggle="dropdown" type="button" id="dropdownMenu1">
                                Sắp xếp sản phẩm
                            </button>
                            <div class="dropdown-menu dropdown-menu-left " aria-labelledby="dropdownMenu1">
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'asc']) }}" style="padding: 4px 16px">Từ A - Z</a>
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'desc']) }}" style="padding: 4px 16px">Từ Z - A</a>
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'price_desc']) }}" style="padding: 4px 16px">Giá từ thấp đến cao</a>
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'price_asc']) }}" style="padding: 4px 16px">Giá cao đến thấp</a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <button class="select btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Lọc theo giá
                            </button>
                            <div class="dropdown-menu dropdown-mneu-right" aria-labelledby="dropdownMenu2" >
                                <a class="dropdown-item" href="{{url()->current() }}" style="padding: 4px 16px">Tất cả</a>
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 1]) }}" style="padding: 4px 16px">Giá dưới 5 triệu</a>
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 2]) }}" style="padding: 4px 16px">Giá từ 5 - 10 triệu</a>
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 3]) }}" style="padding: 4px 16px">Giá từ 10 - 20 triệu</a>
                                <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 4]) }}" style="padding: 4px 16px">Giá trên 20 triệu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-detail" style="margin-top:10px">
                <ul class="list-item clearfix">
                    @foreach ($list_items as $cat)
                    <li>
                        <a href="{{url('chi-tiet-san-pham',$cat->slug)}}" title="" class="thumb">
                            <img src="{{url($cat->image)}}" style="height: 190px" class="bob-on-hover">
                        </a>
                        <a href="{{url('chi-tiet-san-pham',$cat->slug)}}" title="" class="product-name">{{$cat->name}}</a>
                        <div class="price">
                            <span class="new">{{number_format($cat->price,0,'','.')}}đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="{{url('them-san-pham/'.$cat->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="{{url('chi-tiet-san-pham',$cat->slug)}}" title="Mua ngay" class="buy-now fl-right">Xem ngay</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
    <div style="display: flex; justify-content: space-between;">
        <div style="margin: 5px 0"><span style="padding: 5px 10px; background:#000; color:#fff; font-size:21px; text-transform: uppercase; font-weight:500">{{$cat_name}}</span></div>
        <div class="filter-wp">
            <p class="desc">Hiển thị {{$list_items->count()}} trên {{$product_count}} sản phẩm</p>
            <div class="form-filter"style="display:flex">
                <div class="dropdown mr-4">
                    <button class="btn btn dropdown-toggle" data-toggle="dropdown" type="button" id="dropdownMenu1">
                        Sắp xếp sản phẩm
                    </button>
                    <div class="dropdown-menu dropdown-menu-left " aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'asc']) }}" style="padding: 4px 16px">Từ A - Z</a>
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'desc']) }}" style="padding: 4px 16px">Từ Z - A</a>
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'price_desc']) }}" style="padding: 4px 16px">Giá từ thấp đến cao</a>
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 'price_asc']) }}" style="padding: 4px 16px">Giá cao đến thấp</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="select btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Lọc theo giá
                    </button>
                    <div class="dropdown-menu dropdown-mneu-right" aria-labelledby="dropdownMenu2" >
                        <a class="dropdown-item" href="{{url()->current() }}" style="padding: 4px 16px">Tất cả</a>
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 1]) }}" style="padding: 4px 16px">Giá dưới 5 triệu</a>
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 2]) }}" style="padding: 4px 16px">Giá từ 5 - 10 triệu</a>
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 3]) }}" style="padding: 4px 16px">Giá từ 10 - 20 triệu</a>
                        <a class="dropdown-item" href="{{request()->fullUrlWithQuery (['orderby' => 4]) }}" style="padding: 4px 16px">Giá trên 20 triệu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="alert alert-dark mt-3">Hiện danh mục <b>{{$cat_name}}</b> chưa có sản phẩm mở bán</div>
    @endif
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