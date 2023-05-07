@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{url('admin/post/update',$posts->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Chọn ảnh bài viết:</label>
                    <input type="file" class="form-control-file mb-2" name="image">
                    <input type="hidden" name="old_image" value="{{$posts->image}}">
                    <img src="{{url($posts->image)}}" alt="" width="80px">
                    @error('image')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="row">            
                    <div class="col-6" style="padding-right: none">
                        <div class="form-group">
                            <label for="name">Tiêu đề bài viết</label>
                            <input class="form-control" type="text" name="name" id="slug" onkeyup="ChangeToSlug()" value="{{$posts->name}}">
                            @error('name')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6" style="padding-right: none">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="convert_slug" value="{{$posts->slug}}">
                            @error('slug')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="desc">Miêu tả ngắn bài viết</label>
                    <textarea name="desc" class="form-control" id="desc" cols="30" rows="5">{{$posts->desc}}</textarea>
                    @error('desc')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{$posts->content}}</textarea>
                    @error('content')
                        <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat_post_id">
                      <option>Chọn danh mục</option>
                      @foreach ($cat_posts as $cat_post)
                      @if ($cat_post->id == $posts->cat_post_id)
                                <option selected="selected" value="{{$cat_post->id}}" selected>{{$cat_post->title}}</option>
                            @else
                                <option value="{{$cat_post->id}}">{{$cat_post->title}}</option>
                            @endif
                      @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="btn-update" value="Cập nhật">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection