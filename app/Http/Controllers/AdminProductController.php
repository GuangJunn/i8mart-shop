<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CatProduct;
use App\ListImage;
use App\Product;
use App\Page;

use Gloudemans\Shoppingcart\Facades\Cart;

class AdminProductController extends Controller
{
    //
    function __construct(){
        $this->middleware(function($request,$next){
            session(['module_active' => 'product']);

            return $next($request);
        });
    }

    /*------------------------------------ Product ------------------------*/
    // Product

    function list(Request $request){
        
        $status = $request->input('status');

        $list_act = [
            'delete' =>'Xóa tạm thời',
        ];
        if($status == 'trash'){
            $list_act = [
            'restore' =>'Khôi phục',
            'forceDelete' =>'Xóa vĩnh viễn',
            ];
            $products= Product::join('cat_products','cat_products.id','=','products.cat_product_id')
            ->select('cat_products.title','products.*')
            ->onlyTrashed()
            ->orderBy('id','desc')
            ->paginate(8);
            }
            elseif($status == 'stocking'){
                $products = Product::join('cat_products','cat_products.id','=','products.cat_product_id')
                ->where('status',2)
                ->select('cat_products.title','products.*')
                ->orderBy('id','desc')
                ->paginate(8);
            }
            elseif($status == 'out_stock'){
                $products = Product::join('cat_products','cat_products.id','=','products.cat_product_id')
                ->where('status',1)
                ->select('cat_products.title','products.*')
                ->orderBy('id','desc')
                ->paginate(8);
            }
            elseif($status == 'new'){
                $products = Product::join('cat_products','cat_products.id','=','products.cat_product_id')
                ->where('status_product',3)
                ->select('cat_products.title','products.*')
                ->orderBy('id','desc')
                ->paginate(8);
            }
            elseif($status == 'outstanding'){
                $products = Product::join('cat_products','cat_products.id','=','products.cat_product_id')
                ->where('status_product',4)
                ->select('cat_products.title','products.*')
                ->orderBy('id','desc')
                ->paginate(8);
            }else{
            $keyword = "";// Tại 1 biến trống
            if($request->input('keyword')){
            $keyword = $request->input('keyword');
            }
            $products = Product::join('cat_products','cat_products.id','=','products.cat_product_id')
            ->select('cat_products.title','products.*')
            ->where('name','LIKE',"%{$keyword}%")
            ->orderBy('id','desc')
            ->paginate(8);
        }
        
        $count_user_active = Product::count();
        $count_user_trash = Product::onlyTrashed()->count();

        // Trạng thái sản phẩm còn hàng hết hàng
        $count_user_stocking = Product::where('status',1)->get()->count();
        $count_user_out_stock = Product::where('status',2)->get()->count();

        // Trạng thái mới và nổi bật
        $count_user_new = Product::where('status_product',3)->get()->count();
        $count_user_outstanding = Product::where('status_product',4)->get()->count();

        $count = [
            $count_user_active,
            $count_user_trash,
            $count_user_stocking,
            $count_user_out_stock,
            $count_user_new,
            $count_user_outstanding
        ];

        
        return view('admin/product/list', compact('products','list_act','count'));
    }

    function add(){
        $cat_product = $this->getCategoryProduct();
        return view('admin/product/add', compact('cat_product'));
    }

    function store(Request $request){
        $request->validate(
            [
                'name' => 'required| string| max:255',
                'price' => 'required| string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'desc' => 'required| string',
                'content' => 'required| string',
                'cat_product_id'=> 'required| string',
                'status'=> 'required',
                'status_product' => 'required',
                'slug'=> 'required| string',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá sản phẩm',
                'image' => 'Ảnh sản phẩm',
                'desc' => 'Mô tả sản phẩm',
                'content' => 'Chi tiết sản phẩm',
                'cat_product_id'=> 'Danh mục sản phẩm',
                'status'=> 'Trạng thái sản phẩm',
                'status_product' => 'Trạng thái sản phẩm 2',
                'slug' => 'Đường dẫn sản phẩm',
            ],
        );
        
        $input = $request->all();// Lay tat ca DL

        if($request->hasFile('image')){
            $file = $request->file('image');
            
            // Lấy tên File
            $filename =  $file->getClientOriginalName();

            $path =  $file->move('public/uploads/product', $file->getClientOriginalName());// Tao duong dan file tam thoi
            $image = 'public/uploads/product/'.$filename;// $thumbnail = Duong dan file

            $input['image'] = $image;
        }
    
        $product=Product::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'image' => $image,
            'desc' => $request['desc'],
            'content' => $request['content'],
            'cat_product_id' => $request['cat_product_id'],
            'status' => $request['status'],
            'status_product' => $request['status_product'] ? $request['status_product'] : '0',
            'slug' => $request['slug'],
        ]);

        $product_id = $product->id; 

        if($request->hasFile('imagedesc')){
            $file = $request->file('imagedesc');
            foreach($file as $item){
                // Lấy tên File
            $filenames =  $item->getClientOriginalName();
            $typefiles =  $item->getClientOriginalExtension();
            $names=pathinfo($filenames, PATHINFO_FILENAME);
            $images = "public/uploads/product/gallery/".$filenames;
            if(file_exists($images)){
                $filenames = $names ."-Copy." . $typefiles;
                $images = "public/uploads/product/gallery/".$filenames;
                $t = 1;
                while(file_exists($images)){
                    $copys = "-Copy({$t}).";
                    $images = "public/uploads/product/gallery/" .$names. $copys.$typefiles;
                    $filenames = $names. $copys. $typefiles;
                    $t++;
                }
            }
            $item->move('public/uploads/product/gallery', $filenames);

            ListImage::create([
                'name' => $images,
                'imagedesc' => $images,         
                'product_id' => $product_id,
            ]);
            }         
        }      
        return redirect('admin/product/list')->with('status','Đã tạo sản phẩm thành công');
    }

    function edit($id){
        $product = Product::find($id);
        $list_gallery= ListImage::where('product_id',$id)->get();

        // return $list_gallery;
        $cat_product = $this->getCategoryProduct();
        $status = Product::where('status',$id)->get();
        return view('admin.product.edit',compact('product','cat_product','status','list_gallery'));
    }

    function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required| string| max:255',
                'price' => 'required| string',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'desc' => 'required| string',
                'content' => 'required| string',
                'cat_product_id'=> 'required| string',
                'status'=> 'required',
                'status_product' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên sản phẩm',
                'price' => 'Giá sản phẩm',
                'image' => 'Ảnh sản phẩm',
                'desc' => 'Mô tả sản phẩm',
                'content' => 'Chi tiết sản phẩm',
                'cat_product_id'=> 'Danh mục sản phẩm',
                'status'=> 'Trạng thái sản phẩm',
                'status_product' => 'Trạng thái sản phẩm 2',
                'slug' => 'Đường dẫn sản phẩm',
            ],
        );
        $input = $request->all();// Lay tat ca DL
        $image = $request['old_image'];

        if($request->hasFile('image')){
            $file = $request->file('image');

            // Lấy tên File
            $filename =  $file->getClientOriginalName();

            $path =  $file->move('public/uploads/product', $file->getClientOriginalName());// Tao duong dan file tam thoi
            $image = 'public/uploads/product/'.$filename;// $thumbnail = Duong dan file

            $input['image'] = $image;
        }

        Product::where('id',$id)->update([
            'name' => $request['name'],
            'price' => $request['price'],
            'image' => $image,
            'desc' => $request['desc'],
            'content' => $request['content'],
            'cat_product_id' => $request['cat_product_id'],
            'status' => $request['status'],
            'status_product' => $request['status_product'] ? $request['status_product'] : '0',
            'slug' => $request['slug'],
        ]);

        $image = $request['old_imagedesc'];
        if($request->hasFile('imagedesc')){
            $file = $request->file('imagedesc');
            foreach($file as $item){
                // Lấy tên File
            $filenames =  $item->getClientOriginalName();
            $typefiles =  $item->getClientOriginalExtension();
            $names=pathinfo($filenames, PATHINFO_FILENAME);
            $images = "public/uploads/product/gallery/".$filenames;
            if(file_exists($images)){
                $filenames = $names ."-Copy." . $typefiles;
                $images = "public/uploads/product/gallery/".$filenames;
                $t = 1;
                while(file_exists($images)){
                    $copys = "-Copy({$t}).";
                    $images = "public/uploads/product/gallery/" .$names. $copys.$typefiles;
                    $filenames = $names. $copys. $typefiles;
                    $t++;
                }
            }
            $item->move('public/uploads/product/gallery', $filenames);

            ListImage::where('id',$id)->update([
                'name' => $images,
                'imagedesc' => $images,         
                'product_id' => $id,
            ]);
            }         
        }
        return redirect('admin/product/list')->with('status','Bạn đã cập nhật thông tin sản phẩm thành công');
    }

    
    function action(Request $request){
        $list_check = $request->input('list_check');

       if($list_check){
           $act =$request->input('act');
           if($act == 'delete'){
               Product::destroy($list_check);
               return redirect('admin/product/list')->with('status','Đã chuyển trạng thái thành công thành công');
           }

           if($act == 'restore'){
               Product::withTrashed()
               ->whereIn('id',$list_check)
               ->restore();
               return redirect('admin/product/list')->with('status','Đã chuyển trạng thái thành công thành công');
           }

           if($act == 'forceDelete'){
               Product::withTrashed()
               ->whereIn('id',$list_check)
               ->forceDelete();
               return redirect('admin/product/list')->with('status','Bạn đã xóa sản phẩm vĩnh viễn');
           }
       }else{
           return redirect('admin/product/list')->with('status','Bạn cần chọn phần tử cần thực thi');
       }
    }

    public function forcedelete($id){   
        Product::where('id', $id)->forceDelete();
        return redirect('admin/product/list')->with('status','Đã xóa sản phẩm vĩnh viễn thành công');
    }



    /*------------------------------------ Product Cat ------------------------*/
    //Product Cat
    function add_cat(){
        $cat_pros = CatProduct::paginate(50);
        $cate_product = $this->getCategoryProduct();
        return view('admin.product.cat.add', compact('cat_pros','cate_product'));
    }
    public function getCategoryProduct(){
        $category = CatProduct::orderBy('id','ASC')->get();
        $listCategory = [];
        CatProduct::recursive($category, $parents = 0, $level = 1, $listCategory);
        return $listCategory;
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

            CatProduct::create([
                'title' => $request['title'],
                'slug' => $request['slug'],
                'parent_id'=> $request['parent_id'],
            ]);

            return redirect('admin/product/cat/add-cat')->with('status','Đã tạo danh mục thành công');
    }

    public function forceDelete_cat($id){   
        CatProduct::where('id', $id)->forceDelete();
        return redirect('admin/product/cat/add-cat')->with('status','Đã xóa danh mục vĩnh viễn');
    }

    function edit_cat($id){
        $cat_product = CatProduct::find($id);
        $cate_product = $this->getCategoryProduct();
        return view('admin.product.cat.edit',compact('cat_product','cate_product'));
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

            CatProduct::where('id',$id)->update([
                'title' => $request['title'],
                'slug' => $request['slug'],
            ]);

            return redirect('admin/product/cat/add-cat')->with('status','Đã cập nhật danh mục thành công');
    }


    /*------------------------------------ PRODUCT SHOW INDEX ------------------------*/
    function show(Request $request ,$slug){
        


        $pages = Page::all();

        $latest_product = Product::where('status_product',3)->limit(6)->get();
        $cat_products = CatProduct::get();

        $images = ListImage::all();
        
        $categorys = CatProduct::where('parent_id','0')->get();

        $category = CatProduct::where('slug',$slug)->first();
        $cat_id=$category->id;
        $cat_name = $category->title;
        $cat_slug = $category->slug;

        $orderby = array(
            'products.price',
            'asc',
            '>',
            '!=',
            0,
            0
        );
        if($request->orderby){
            if($request->orderby == "price_desc"){
                $orderby[1] ="desc";
            }elseif($request->orderby == "asc"){
                $orderby[0] = "products.name";
                $orderby[1] = "asc";
            }elseif($request->orderby == "desc"){
                $orderby[0] = "products.name";
                $orderby[1] = "desc";
            }elseif($request->orderby == 1){
                $orderby[2] = "<";
                $orderby[4] = "5000000";
            }elseif($request->orderby == 2){
                $orderby[2] = ">";
                $orderby[4] = "5000000";
                $orderby[3] = "<";
                $orderby[5] = "10000000";
            }elseif($request->orderby == 3){
                $orderby[2] = ">";
                $orderby[4] = "10000000";
                $orderby[3] = "<";
                $orderby[5] = "20000000";
            }elseif($request->orderby == 4){
                $orderby[2] = ">";
                $orderby[4] = "20000000";
            }else{
                $orderby[1] ="asc";
            }
        }
        if($category->parent_id == 0){
            // Đếm tổng số lượng sản phẩm
            $product_count = Product::count();
            // catpr = 5 
            $list_items= CatProduct::join('products','products.cat_product_id','=','cat_products.id')
            ->where([
                ['cat_products.parent_id',$cat_id],
                ['products.price',$orderby[2],$orderby[4]],
                ['products.price',$orderby[3],$orderby[5]],
                ])
            ->orderBy($orderby[0],$orderby[1])
            ->paginate(12);
            return view('pages.category.show_cate',compact('categorys','cat_products','latest_product','list_items','cat_name','pages','category','images','product_count','cat_slug'));
        }else{
            $product_count = Product::count();
            $list_items= CatProduct::join('products','products.cat_product_id','=','cat_products.id')
            ->where([
                ['products.cat_product_id',$cat_id],
                ['products.price',$orderby[2],$orderby[4]],
                ['products.price',$orderby[3],$orderby[5]],
                ])
            ->orderBy($orderby[0],$orderby[1])
            ->paginate(12);
            return view('pages.category.show_cate',compact('categorys','cat_products','latest_product','list_items','cat_name','pages','category','images','product_count'));
        }       
    }

    function details_product($slug){
        $categorys = CatProduct::where('parent_id','0')->get();
        

        $cat_products = CatProduct::get();
        $pages = Page::all();

        $products = Product::where('slug',$slug)->first();
        $product_id=$products->id;
        $product_name=$products->name;

        $latest_product = Product::where('status_product',3)->get();    

        $gallery = ListImage::where('product_id',$product_id)->get();

        $product_detail = Product::join('cat_products','cat_products.id','=','products.cat_product_id')
        ->where('products.id',$product_id)
        ->select('cat_products.title','products.*')
        ->get();

        $related_product = CatProduct::join('products','products.cat_product_id','=','cat_products.id')
        ->select('products.*', 'cat_products.title') //cái tiêu đề là cái gì 
        ->where([
            ['products.cat_product_id', $products->cat_product_id], //Chỗ này lấy ra sản phẩm theo danh mục
            ['products.id', '<>', $products->id] //sản phẩm có id phải khác với sản phẩm có id hiện tại đang ở trang chi tiết
        ])
        ->orderby('products.price', 'desc') //Chỗ này khi lấy sắp xếp để lấy được sản phẩm mới từ admin 
        ->limit(4)
        ->get();
        return view('pages.product.details_product',compact('categorys','latest_product','product_detail','product_name','related_product','pages','cat_products','gallery'));
    }

    
}


