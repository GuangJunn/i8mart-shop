<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Product;
use App\CatProduct;
use Gloudemans\Shoppingcart\Facades\Cart;

class AdminPageController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function($request,$next){
            session(['module_active' => 'page']);

            return $next($request);
        });
    }

    function list(Request $request){
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Chờ duyệt',
        ];

        if($status == 'wait'){
            $list_act = [
                'restore' => 'Công Khai',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $pages = Page::onlyTrashed()->paginate(5);
        }else{
            $pages = Page::paginate(5);
        }

        $count_page_active = Page::count();
        $count_page_wait = Page::onlyTrashed()->count();

        $count = [$count_page_active,$count_page_wait];
        return view('admin/page/list', compact('pages','count','list_act'));
    }

    function add(){
        return view('admin/page/add');
    }

    function store(Request $request){
         $request->validate(
            [
                'title' => 'required| string| max:255',
                'content' => 'required| string',
                'slug' => 'required| string',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'title' => 'Tiêu đề trang',
                'content' =>'Nội dung',
                'slug' =>'Đường dẫn trang',
            ]
            );

            Page::create([
                'title' => $request['title'],
                'content' => $request['content'],
                'slug' => $request['slug'],
            ]);

            return redirect('admin/page/list')->with('status','Đã tạo trang thành công');
    }

    function delete($id){
        $page= Page::find($id);
        $page->delete();

        return redirect('admin/page/list')->with('status','Đã chuyển trạng thái thành công');
    }

    public function forcedelete($id)
    {   
        Page::where('id', $id)->forceDelete();
        return redirect('admin/page/list')->with('status','Đã xóa vĩnh viễn thành công thành công');
    }

    function action(Request $request){
         $list_check = $request->input('list_check');

        if($list_check){
            $act =$request->input('act');
            if($act == 'delete'){
                Page::destroy($list_check);
                return redirect('admin/page/list')->with('status','Đã chuyển trạng thái thành công thành công');
            }

            if($act == 'restore'){
                Page::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect('admin/page/list')->with('status','Đã chuyển trạng thái thành công thành công');
            }

            if($act == 'forceDelete'){
                Page::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect('admin/page/list')->with('status','Bạn đã xóa thành viên vĩnh viễn');
            }
        }else{
            return redirect('admin/page/list')->with('status','Bạn cần chọn phần tử cần thực thi');
        }
    }

    function edit($id){
        $page=Page::find($id);

        return view('admin/page/edit',compact('page'));
    }

    function update(Request $request, $id){
        
        $request->validate(
            [
                'title' => 'required| string| max:255',
                'content' => 'required| string',
                'slug' => 'required| string',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'title' => 'Tiêu đề trang',
                'content' =>'Nội dung',
                'slug' =>'Đường dẫn trang',
            ]
        );

        Page::where('id',$id)->update([
            'title' => $request['title'],
            'content' => $request['content'],
            'slug' => $request['slug'],
        ]);

        return redirect('admin/page/list')->with('status','Bạn đã cập nhật thông tin thành công');
    }

    /*------------------------------------ PAGE FONT-END ------------------------*/
    function details_page($slug){
        $categorys = CatProduct::where('parent_id','0')->get();
        $pages = Page::all();
        $latest_product = Product::where('status_product',3)->get();
        $cat_products = CatProduct::get();

        $page_details = Page::where('pages.slug',$slug)->get();
        return view('pages.page.details_page', compact('categorys','latest_product','page_details','pages','cat_products'));
    }
}
