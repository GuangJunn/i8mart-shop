<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="{{asset('images/icon-logo.png')}}" type="image/x-icon">
        <title>ISMART STORE</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('reset.css')}}" rel="stylesheet" type="text/css"/>

        <!-- CSS Slider Product -->
        <link type="text/css" rel="stylesheet" href="{{asset('css/lightgallery.min.css')}}" />
        <link rel="stylesheet" href="{{asset('css/lightslider.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/prettify.css')}}"/>

        <link href="{{asset('css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('responsive.css')}}" rel="stylesheet" type="text/css"/>

        <script src="{{asset('js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('js/main.js')}}" type="text/javascript"></script>  

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">

        <!-- JavaScript Slider Product -->
        <script src="{{asset('js/jquery.min.js')}}"></script> 
        <script src="{{asset('js/lightslider.js')}}"></script> 
        <script src="{{asset('js/lightgallery-all.min.js')}}"></script> 
        <script src="{{asset('js/prettify.js')}}"></script> 
        <script src="{{asset('js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>

        <!-- JavaScript -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('css/carousel/owl.theme.css')}}"/>

        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <!-- Semantic UI theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
        <!-- Bootstrap theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right" style="height:44px">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="{{url('/')}}" title="">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/bai-viet')}}" title="">Bài viết</a>
                                    </li>
                                    @foreach ($pages as $page)
                                    <li>
                                        <a href="{{url('chi-tiet-trang',$page->slug)}}" title="">{{$page->title}}</a>
                                    </li>
                                    @endforeach                                                           
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="{{url('/')}}" title="" id="logo" class="fl-left"><img src="{{asset('images/logo.png')}}"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="POST" action="{{url('/tim-kiem')}}">
                                    @csrf
                                    <input type="text" name="keyword" id="keywords" placeholder="Tìm kiếm sản phẩm ở đây" style="width: 355px">
                                    <input type="submit" id="sm-s" value="Tìm kiếm">                               
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num"></span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <div id="btn-cart">
                                        <a href="{{url('gio-hang/')}}" style="color: #fff">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <span id="num">{{Cart::count()}}</span>
                                        </a>
                                    </div>                  
                                        @if (Cart::count()>0)
                                        <div id="dropdown">
                                            <p class="desc" >Có <span style="color: red; font-weight:bold">{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p>
                                            @foreach (Cart::content() as $row)
                                            <ul class="list-cart">
                                                <li class="clearfix">
                                                    <a href="" title="" class="thumb fl-left">
                                                        <img src="{{url($row->options->image)}}" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="" title="" class="product-name">{{$row->name}}</a>
                                                        <p class="price">{{number_format($row->price,0,'','.')}}đ</p>
                                                        <p class="qty">Số lượng: <span>{{$row->qty}}</span></p>
                                                    </div>
                                                </li>
                                            </ul>
                                            @endforeach
                                            <div class="total-price clearfix">
                                                <p class="title fl-left">Tổng:</p>
                                                <p class="price fl-right">{{number_format(Cart::total(),0,'','.')}}đ</p>
                                            </div>
                                            
                                            
                                            <div class="action-cart clearfix">
                                                <a href="{{url('gio-hang/')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                                <a href="{{url('/thanh-toan')}}" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                            </div>
                                        </div>
                                        @else
                                        <div id="dropdown" style="height:50px">
                                            <p class="desc" >Có <span style="color: red; font-weight:bold">{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p>
                                        </div>
                                        @endif        
                                        
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="main-content-wp" class="home-page clearfix">
                    <div class="wp-inner">
                        @yield('content')
                        @yield('sidebar')
                    </div>
                </div>
<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <h3 class="title">ISMART</h3>
                <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                <div id="payment">
                    <div class="thumb">
                        <img src="{{asset('images/img-foot.png')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                    </li>
                    <li>
                        <p>0987.654.321 - 0989.989.989</p>
                    </li>
                    <li>
                        <p>vshop@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title">Chính sách mua hàng</h3>
                <ul class="list-item">
                    <li>
                        <a href="" title="">Quy định - chính sách</a>
                    </li>
                    <li>
                        <a href="" title="">Chính sách bảo hành - đổi trả</a>
                    </li>
                    <li>
                        <a href="" title="">Chính sách hội viện</a>
                    </li>
                    <li>
                        <a href="" title="">Giao hàng - lắp đặt</a>
                    </li>
                </ul>
            </div>
            <div class="block" id="newfeed">
                <h3 class="title">Bảng tin</h3>
                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                <div id="form-reg">
                    <form method="POST" action="">
                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                        <button type="submit" id="sm-reg">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
        </div>
    </div>
</div>
</div>
<div id="btn-top"><img src="{{asset('images/icon-to-top.png')}}" alt=""/></div>
<div id="fb-root"></div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    function AddCart(id){
        $.ajax({
            url: 'AddCart/'+id,
            type:'GET',
        }).done(function(response){
            console.log(response);
            $(".list-cart").html(response);
            alertify.success('Thêm sảm phẩm thành công');
        })
    }
</script>
<script>
    $(document).ready(function () {

$('.increment-btn').click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<10){
        value++;
        $(this).parents('.quantity').find('.qty-input').val(value);
    }

});

$('.decrement-btn').click(function (e) {
    e.preventDefault();
    var decre_value = $(this).parents('.quantity').find('.qty-input').val();
    var value = parseInt(decre_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>1){
        value--;
        $(this).parents('.quantity').find('.qty-input').val(value);
    }
});
});
</script>
<script>
    $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:5,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
</script>


</body>
</html>