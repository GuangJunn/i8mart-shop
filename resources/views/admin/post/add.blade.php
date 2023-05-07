@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{url('admin/post/store')}}" method="POST" enctype="multipart/form-data">
                @csrf     
                <div class="form-group">
                    <label for="image">Chọn ảnh bài viết:</label>
                    <input type="file" class="form-control-file mb-2" name="image">
                    @error('image')
                        <small class="form-text text-danger">{{$message}}</small>
                     @enderror
                </div>   
                <div class="row">            
                    <div class="col-6" style="padding-right: none">
                        <div class="form-group">
                            <label for="name">Tiêu đề bài viết</label>
                            <input class="form-control" type="text" name="name" id="slug" onkeyup="ChangeToSlug()">
                            @error('name')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6" style="padding-right: none">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="convert_slug">
                            @error('slug')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc">Miêu tả ngắn bài viết</label>
                    <textarea name="desc" class="form-control" id="desc" cols="30" rows="5"></textarea>
                    @error('desc')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                    @error('content')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat_post_id">
                      <option>Chọn danh mục</option>
                      @foreach ($cat_posts as $cat_post)
                        <option value="{{$cat_post->id}}">{{$cat_post->title}}</option>
                      @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="btn-add" value="Thêm mới">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection