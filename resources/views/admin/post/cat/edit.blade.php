@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            
            @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục bài viết
                </div>
                <div class="card-body">
                    <form action="{{url('admin/post/cat/update-cat',$cat_post->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Tên danh mục</label>
                            <input class="form-control" type="text" name="title" id="slug" value="{{$cat_post->title}}" onkeyup="ChangeToSlug()">
                        </div>
                        <div class="form-group">
                            <label for="slug">Đường dẫn danh mục</label>
                            <input class="form-control" type="text" name="slug" id="convert_slug" value="{{$cat_post->slug}}">
                            @error('slug')
                                <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select class="form-control" id="">
                                <option>Chọn danh mục</option>
                                @foreach ($cat_posts as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" name="btn-update" value="Cập nhật">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection