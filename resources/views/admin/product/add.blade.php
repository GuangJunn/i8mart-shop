@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm ảnh sản phẩm
        </div>
        <div class="card-body">
            <form action="{{url('admin/product/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="slug" onkeyup="ChangeToSlug()">
                            @error('slug')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="convert_slug">
                            @error('slug')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" name="price" id="price">
                            @error('price')
                                        <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Chọn ảnh sản phẩm:</label>
                            <input type="file" class="form-control-file mb-2" name="image">
                            @error('image')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Mô tả ảnh sản phẩm:</label>
                            <input type="file" class="form-control-file mb-2" name="imagedesc[]" multiple="multiple">
                            @error('imagedesc')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="desc" class="form-control" id="intro" cols="30" rows="5"></textarea>
                            @error('desc')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="content" class="form-control" id="intro" cols="30" rows="5"></textarea>
                    @error('content')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat_product_id">
                        <option value="0">Chọn danh mục</option>
                        @foreach ($cat_product as $cat)
                        <option value="{{$cat->id}}">
                            @php
                                $str = '';
                                for($i = 0; $i < $cat->level ; $i++){
                                    echo $str;
                                    $str.= '-- ';
                                }
                            @endphp
                        {{$cat->title}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái sản phẩm</label>
                    <select class="form-control mr-1" id="" name="status">
                        <option value="0">Chọn</option>                   
                            <option value="1">Hết hàng</option>
                            <option value="2">Còn hàng</option>
                    </select>
                    @error('status')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                    
                </div>
                <div class="form-group">
                    <label for="">Trạng thái sản phẩm 2</label>
                    <select class="form-control mr-1" id="" name="status_product">
                        <option value="0">Chọn</option>                   
                            <option value="3">Sản phẩm mới nhất</option>
                            <option value="4">Sản phẩm nổi bật</option>
                    </select>          
                </div>
                <button type="submit" class="btn btn-primary" name="btn-add" value="Thêm mới">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection