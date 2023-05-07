@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            
            @endif
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục sản phẩm
                </div>
                <div class="card-body">
                    <form action="{{url('admin/product/cat/store-cat')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Tên danh mục</label>
                                    <input class="form-control" type="text" name="title" id="slug" onkeyup="ChangeToSlug()">
                                    @error('title')
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Slug</label>
                                    <input class="form-control" type="text" name="slug" id="convert_slug" >
                                    @error('slug')
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Danh mục cha</label>
                                    <select class="form-control" id="" name="parent_id">
                                        <option value="0">Danh mục cha</option>
                                        @foreach ($cate_product as $key =>$cat)
                                            <option value="{{$cat->id}}">
                                                @php
                                                    $str = '';
                                                    for($i = 0; $i < $cat->level ; $i++){
                                                        echo $str;
                                                        $str.= '--';
                                                    }
                                                @endphp
                                            {{$cat->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" value="Thêm Mới" name="btn-add">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách danh mục
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if ($cat_pros->total()>0)
                            @foreach ($cate_product as $key =>$cat)
                            <tr>
                                <td value="{{$cat->id}}">
                                    @php
                                        $str = '';
                                        for($i = 0; $i < $cat->level ; $i++){
                                            echo $str;
                                            $str.= '--';
                                        }
                                    @endphp
                                    {{$cat->title}}</td>
                                <td>{{$cat->created_at}}</td>
                                <td>
                                    <a href="{{route('cat.edit',$cat->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('admin/product/cat/forceDelete-cat',$cat->id)}}" onclick="return confirm('Bạn có chắc xóa bản ghi này không ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn"><i class="fa fa-trash"></i></a>
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
                    {{ $cat_pros->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection