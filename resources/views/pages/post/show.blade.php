@extends('layouts.unimart')

@section('content')
<div class="secion" id="breadcrumb-wp">
    <div class="secion-detail">
        <ul class="list-item clearfix">
            <li>
                <a href="{{url('/')}}" title="">Trang chủ</a>
            </li>
            <li>
                <a href="{{url('bai-viet')}}" title="">Bài viết</a>
            </li>
        </ul>
    </div>
</div>
<div class="main-content fl-right">
    <div class="section" id="list-blog-wp">
        <div class="section-head clearfix">
            <h1 style="font-size: 32px; font-weight:bold; padding-bottom:15px">Bài viết</h1>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                @foreach ($posts as $post)
                    <li class="clearfix">
                        <a href="{{url('chi-tiet-bai-viet',$post->slug)}}" title="" class="thumb fl-left">
                            <img src="{{url($post->image)}}" alt="" style="height:175px">
                        </a>
                        <div class="info fl-right">
                            <a href="{{url('chi-tiet-bai-viet',$post->slug)}}" title="" class="title">{{$post->name}}</a>
                            <span class="create-date">{{$post->created_at}}</span>
                            <span class="cate-post">Biên tập viên:{{$post->user->name}}</span>
                            <span class="desc" style="font-size:13px; margin-top:5px">{!!$post->desc!!}</span>
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