@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        Danh mục sản phẩm
    </div>
    <div class="card-body">
        <form action="{{url('admin/product/cat/update-cat',$cat_product->id)}}" method="POST">
            @csrf
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="title">Tên danh mục</label>
                        <input class="form-control" type="text" name="title" id="slug" value="{{$cat_product->title}}" onkeyup="ChangeToSlug()">
                        @error('title')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="slug">Đường dẫn danh mục</label>
                        <input class="form-control" type="text" name="slug" id="convert_slug" value="{{$cat_product->slug}}">
                        @error('slug')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" value="Cập nhật" name="btn-update">Cập nhật</button>
        </form>
    </div>
</div>
@endsection