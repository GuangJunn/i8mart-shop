<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Illuminate\Support\Facades\Auth;
class AdminSliderController extends Controller
{
    //
    function list(){
        $sliders = Slider::paginate(5);
        return view('admin/slider/list', compact('sliders'));
    }

    function store(Request $request){
        $request->validate(
            [             
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'image' => 'Ảnh Slider',
            ],
            );

            $input = $request->all();// Lay tat ca DL

            if($request->hasFile('image')){
                $file = $request->file('image');
    
                // Lấy tên File
                $filename =  $file->getClientOriginalName();

                // Lấy đuôi File
                $file->getClientOriginalExtension();
                // Lấy kishc thước File
                $file->getSize();
    
                $path =  $file->move('public/uploads/slider', $file->getClientOriginalName());// Tao duong dan file tam thoi
                $image = 'public/uploads/slider/'.$filename;// $thumbnail = Duong dan file
    
                $input['image'] = $image;
            }
            Slider::create([
                'name'=>$image,
                'image' => $image,
                'user_id' => Auth::user()->id
            ]);

            return redirect('admin/slider/list')->with('status','Thêm slider thành công');
    }

    public function forcedelete($id)
    {   
        Slider::where('id', $id)->forceDelete();
        return redirect('admin/slider/list')->with('status','Đã xóa slider vĩnh viễn');
    }
}
