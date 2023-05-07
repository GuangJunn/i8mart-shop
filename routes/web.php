<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.unimart');
// });

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'HomeController@show');

Route::get('/danh-muc-san-pham/{slug}','AdminProductController@show');

Route::get('/chi-tiet-san-pham/{slug}','AdminProductController@details_product');

// Tìm kiếm
Route::post('/tim-kiem','SearchController@search');


// BÀI VIẾT
Route::get('/bai-viet','AdminPostController@index');
Route::get('/chi-tiet-bai-viet/{slug}','AdminPostController@details_post');

// TRANG
Route::get('/chi-tiet-trang/{slug}','AdminPageController@details_page');

// GIỎ HÀNG
Route::get('/gio-hang','CartController@show');
Route::get('AddCart/{id}','CartController@add_cart');
Route::get('/them-san-pham/{id}','CartController@add');
Route::get('/xoa-san-pham/{rowId}','CartController@remove');
Route::get('/xoa-gio-hang','CartController@destroy');
Route::post('/cap-nhat-gio-hang','CartController@update');

// THANH TOÁN
Route::get('/thanh-toan','OrderController@show');
Route::post('pages/checkout/store','OrderController@store');
Route::get('/dat-hang-thanh-cong','OrderController@success');


// // SEND MAIL
// Route::get('pages/mails/notifi','DemoController@send_mail');

Auth::routes();

Route::middleware('auth')->group(function(){
    // Danh sách các route
    Route::get('dashboard','Dashboard@show');
    Route::get('admin','Dashboard@show');

    // User
    #Danh sách Thành Viên
    Route::get('admin/user/list','AdminUserController@list');
    #Thêm Mới Thành Viên
    Route::get('admin/user/add','AdminUserController@add');
    Route::post('admin/user/store','AdminUserController@store');
    # Xóa thành viên
    Route::get('admin/user/delete/{id}','AdminUserController@delete')->name('delete_user');
    # Các thao tác
    Route::get('admin/user/action','AdminUserController@action');
    # Chỉnh sửa thông tin
    Route::get('admin/user/edit/{id}','AdminUserController@edit')->name('user.edit');
    # Cập nhật thông tin
    Route::post('admin/user/update/{id}','AdminUserController@update')->name('user.update');

    
    
    // Product
    Route::get('admin/product/list','AdminProductController@list');
    Route::get('admin/product/add','AdminProductController@add');
    Route::post('admin/product/store','AdminProductController@store');
    Route::get('admin/product/edit/{id}','AdminProductController@edit')->name('product.edit');
    Route::post('admin/product/update/{id}','AdminProductController@update')->name('product.update');
    Route::get('admin/product/action','AdminProductController@action');
    Route::get('admin/product/cat/forceDelete/{id}','AdminProductController@forceDelete')->name('forceDelete.product');


    Route::get('admin/product/add-gallery/{id}','AdminProductController@add_gallery');
    Route::post('admin/product/store-gallery/{id}','AdminProductController@store_gallery');
    
    
    // Product Category
    Route::get('admin/product/cat/add-cat','AdminProductController@add_cat');
    Route::post('admin/product/cat/store-cat','AdminProductController@store_cat');
    Route::get('admin/product/cat/forceDelete-cat/{id}','AdminProductController@forceDelete_cat');
    Route::get('admin/product/cat/edit-cat/{id}','AdminProductController@edit_cat')->name('cat.edit');
    Route::post('admin/product/cat/update-cat/{id}','AdminProductController@update_cat');

    
    
    
    // Order
    Route::get('admin/order/list','AdminOrderController@list');
    Route::get('admin/order/order-detail/{id}','AdminOrderController@order_detail');
    Route::post('admin/order/update/{id}','AdminOrderController@update');
    Route::get('admin/order/action','AdminOrderController@action');

    
    
    // Post
    Route::get('admin/post/list','AdminPostController@list');
    Route::get('admin/post/add','AdminPostController@add');
    Route::post('admin/post/store','AdminPostController@store');
    Route::get('admin/post/edit/{id}','AdminPostController@edit')->name('post.edit');
    Route::post('admin/post/update/{id}','AdminPostController@update');
    Route::get('admin/post/action','AdminPostController@action');
    Route::get('admin/post/cat/forceDelete/{id}','AdminPostController@forceDelete')->name('forceDelete.post');

    // Post Category
    Route::get('admin/post/cat/add-cat','AdminPostController@add_cat');
    Route::post('admin/post/cat/store-cat','AdminPostController@store_cat');
    Route::get('admin/post/cat/forceDelete-cat/{id}','AdminPostController@forceDelete_cat');
    Route::get('admin/post/cat/edit-cat/{id}','AdminPostController@edit_cat')->name('edit.cat');
    Route::post('admin/post/cat/update-cat/{id}','AdminPostController@update_cat');
    

    
    
    //Page
    # Danh sách trang
    Route::get('admin/page/list','AdminPageController@list');
    # Thêm trang
    Route::get('admin/page/add','AdminPageController@add');
    Route::post('admin/page/store','AdminPageController@store');
    # Chuyên trạng thái trang
    Route::get('admin/page/delete/{id}','AdminPageController@delete')->name('delete.page');
    # Các thao tác
    Route::get('admin/page/action','AdminPageController@action');
    Route::get('admin/page/forcedelete/{id}','AdminPageController@forcedelete')->name('forcedelete_page');
    Route::get('admin/page/edit/{id}','AdminPageController@edit')->name('page.edit');
    Route::post('admin/page/update/{id}','AdminPageController@update');

    // SLIDER
    Route::get('admin/slider/list','AdminSliderController@list');
    Route::post('admin/slider/store','AdminSliderController@store');
    Route::get('admin/slider/forceDelete/{id}','AdminSliderController@forceDelete')->name('forceDelete.slider');
});