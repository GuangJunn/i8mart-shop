<?php

namespace App\Http\Controllers;

use App\CatPost;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Page;
use App\CatProduct;

class AdminPostController extends Controller
{

 /*------------------------------------ Post ------------------------*/
    //Post
    function __construct()
    {
        $this->middleware(function($request,$next){
            session(['module_active' => 'post']);

            return $next($request);
        });
    }

    function list(Request $request){
        $status = $request->input('status');

        $user = User::find(1)->user;

        $list_act = [
            'delete' =>'Xóa tạm thời',
        ];
        if($status == 'wait'){
            $list_act = [
            'restore' =>'Khôi phục',
            'forceDelete' =>'Xóa vĩnh viễn',
            ];
            $posts= Post::join('cat_posts','cat_posts.id','=','posts.cat_post_id')
            ->with('user')
            ->select('cat_posts.title','posts.*')
            ->orderBy('id','desc')
            ->onlyTrashed()->paginate(5);
            
            }else{
            $keyword = "";// Tại 1 biến trống
            if($request->input('keyword')){
            $keyword = $request->input('keyword');
            }
            $posts = Post::join('cat_posts','cat_posts.id','=','posts.cat_post_id')
            ->with('user')
            ->select('cat_posts.title','posts.*',)
            ->where('name','LIKE',"%{$keyword}%")
            ->orderBy('id','desc')
            ->paginate(5);
            // $products= Product::where('name','LIKE',"%{$keyword}%")->paginate(5);
        }
        $count_user_active = Post::count();
        $count_user_trash = Post::onlyTrashed()->count();

        $count = [$count_user_active,$count_user_trash];
        return view('admin/post/list',compact('posts','list_act','count'));
    }

    function add(){
        $cat_posts = CatPost::all();
        return view('admin/post/add', compact('cat_posts'));
    }

    function store(Request $request){
        $request->validate(
            [
                'name' => 'required| string| max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'desc' => 'required| string',
                'content' => 'required| string',
                'cat_post_id'=> 'required| string',
                'slug'=> 'required| string',

            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên bài viết',
                'image' => 'Ảnh bài viết',
                'desc' => 'Mô tả bài viết',
                'content' => 'Chi tiết bài viết',
                'cat_post_id'=> 'Danh mục bài viết',
                'slug'=> 'Đườmg dẫn bài viết',
            ],
        );
        
        $input = $request->all();// Lay tat ca DL

        if($request->hasFile('image')){
            $file = $request->file('image');

            // Lấy tên File
            $filename =  $file->getClientOriginalName();

            $path =  $file->move('public/uploads/post', $file->getClientOriginalName());// Tao duong dan file tam thoi
            $image = 'public/uploads/post/'.$filename;// $thumbnail = Duong dan file

            $input['image'] = $image;
        }
        Post::create([
            'name' => $request['name'],
            'image' => $image,
            'desc' => $request['desc'],
            'user_id' => Auth::user()->id,
            'content' => $request['content'],
            'cat_post_id' => $request['cat_post_id'],
            'status' => $request['status'],
            'slug' => $request['slug'],
        ]);

        return redirect('admin/post/list')->with('status','Đã tạo bài viết thành công');
    }

    function action(Request $request){
        $list_check = $request->input('list_check');

       if($list_check){
           $act =$request->input('act');
           if($act == 'delete'){
               Post::destroy($list_check);
               return redirect('admin/post/list')->with('status','Đã chuyển trạng thái thành công');
           }

           if($act == 'restore'){
               Post::withTrashed()
               ->whereIn('id',$list_check)
               ->restore();
               return redirect('admin/post/list')->with('status','Đã chuyển trạng thái thành công');
           }

           if($act == 'forceDelete'){
               Post::withTrashed()
               ->whereIn('id',$list_check)
               ->forceDelete();
               return redirect('admin/post/list')->with('status','Bạn đã xóa thành viên vĩnh viễn');
           }
       }else{
           return redirect('admin/post/list')->with('status','Bạn cần chọn phần tử cần thực thi');
       }
    }

    public function forcedelete($id)
    {   
        Post::where('id', $id)->forceDelete();
        return redirect('admin/post/list')->with('status','Đã xóa bài viết vĩnh viễn thành công');
    }

    function edit($id){
        $posts = Post::find($id);
        $cat_posts = CatPost::all();
        return view('admin.post.edit',compact('posts','cat_posts'));
    }

    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required| string| max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'desc' => 'required| string',
                'content' => 'required| string',
                'cat_post_id'=> 'required| string',
                'slug'=> 'required| string',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên bài viết',
                'image' => 'Ảnh bài viết',
                'desc' => 'Mô tả bài viết',
                'content' => 'Chi tiết bài viết',
                'cat_post_id'=> 'Danh mục bài viết',
                'slug'=> 'Danh mục bài viết',
            ],
        );
        $input = $request->all();// Lay tat ca DL
        $image = $request['old_image'];

        if($request->hasFile('image')){
            $file = $request->file('image');

            // Lấy tên File
            $filename =  $file->getClientOriginalName();

            $path =  $file->move('public/uploads/post', $file->getClientOriginalName());// Tao duong dan file tam thoi
            $image = 'public/uploads/post/'.$filename;// $thumbnail = Duong dan file

            $input['image'] = $image;
        }
        Post::where('id',$id)->update([
            'name' => $request['name'],
            'image' => $image,
            'desc' => $request['desc'],
            'content' => $request['content'],
            'cat_post_id' => $request['cat_post_id'],
            'slug' => $request['slug'],
        ]);

        return redirect('admin/post/list')->with('status','Bạn đã cập nhật thông tin bài viết thành công');
    }



 /*------------------------------------ Post Category ------------------------*/
    //Post Category
    function add_cat(){
        $cat_posts = CatPost::paginate(5);
        return view('admin.post.cat.add', compact('cat_posts'));
    }

    function store_cat(Request $request){
        $request->validate(
            [
                'title' => 'required| string | max:255',
                'slug' => 'required| string | max:255',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'title' => 'Tên danh mục',
                'slug' => 'Đường dẫn danh mục',
            ]
            );

            CatPost::create([
                'title' => $request['title'],
                'slug' => $request['slug'],
                'parent_id' => $request['parent_id'] = '0',
            ]);

            return redirect('admin/post/cat/add-cat')->with('status','Đã tạo danh mục thành công');
    }

    public function forceDelete_cat($id)
    {   
        CatPost::where('id', $id)->forceDelete();
        return redirect('admin/post/cat/add-cat')->with('status','Đã xóa danh mục vĩnh viễn');
    }

    function edit_cat($id){
        $cat_post = CatPost::find($id);
        $cat_posts = CatPost::paginate(5);
        return view('admin.post.cat.edit',compact('cat_post','cat_posts'));
    }

    function update_cat(Request $request, $id){
        
        $request->validate(
            [
                'title' => 'required| string | max:255',
                'slug' => 'required| string | max:255',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'title' => 'Tên danh mục',
                'slug' => 'Đường dẫn danh mục',
            ]
            );

            CatPost::where('id',$id)->update([
                'title' => $request['title'],
                'slug' => $request['slug'],
                'parent_id' => $request['parent_id'] = '0',
            ]);

            return redirect('admin/post/cat/add-cat')->with('status','Đã cập nhật danh mục thành công');
    }

     /*------------------------------------ Post FONT-END ------------------------*/

    function index(){
        
        $categorys = CatProduct::where('parent_id','0')->get();
        $cat_products = CatProduct::get();
        $latest_product = Product::where('status_product',3)->get();
        $pages = Page::all();

        $posts= Post::join('cat_posts','cat_posts.id','=','posts.cat_post_id')
            ->with('user')
            ->select('cat_posts.title','posts.*')
            ->paginate(8);
        
        return view('pages.post.show', compact('categorys','latest_product','posts','pages','cat_products'));
    }

    function details_post($slug){
        $categorys = CatProduct::where('parent_id','0')->get();
        $cat_products = CatProduct::get();
        $latest_product = Product::where('status_product',3)->get();
        $pages = Page::all();

        $details_post = Post::join('cat_posts','cat_posts.id','=','posts.cat_post_id')
        ->where('posts.slug',$slug)
        ->with('user')
        ->select('cat_posts.title','posts.*')
        ->get();

        
        return view('pages.post.details_post', compact('categorys','latest_product','details_post','pages','cat_products'));
    }
}
