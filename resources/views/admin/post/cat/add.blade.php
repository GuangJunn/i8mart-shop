@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            
            @endif
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục bài viết
                </div>
                <div class="card-body">
                    <form action="{{url('admin/post/cat/store-cat')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Tên danh mục</label>
                            <input class="form-control" type="text" name="title" id="slug" onkeyup="ChangeToSlug()">
                            @error('title')
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
                            <label for="">Danh mục</label>
                            <select class="form-control" id="">
                                <option>Chọn danh mục</option>
                                @foreach ($cat_posts as $cat)
                                    <option>{{$cat->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" name="btn-add" value="Thêm mới">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Đường dẫn danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($cat_posts->total()>0)
                                @foreach ($cat_posts as $item)
                                <tr>
                                    <th scope="row">{{$item->title}}</th>
                                    <td scope="row">{{$item->slug}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{route('edit.cat',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{url('admin/post/cat/forceDelete-cat',$item->id)}}" onclick="return confirm('Bạn có chắc xóa bản ghi này không ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr> 
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">Danh sách danh mục trống</td>
                                </tr>     
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection