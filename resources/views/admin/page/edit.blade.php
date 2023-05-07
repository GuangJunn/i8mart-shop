@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors ->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header font-weight-bold">
            Thêm trang
        </div>
        <div class="card-body">
            <form action="{{url('admin/page/update',$page->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Tiêu đề trang</label>
                    <input class="form-control" type="text" name="title" id="name" value="{{$page->title}}" onkeyup="ChangeToSlug()">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input class="form-control" type="text" name="slug" id="convert_slug" value="{{$page->slug}}">
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{$page->content}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="btn-update" value="Cập nhật">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection