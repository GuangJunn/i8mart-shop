@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            
            @endif
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm ảnh slider
                </div>
                <div class="card-body">
                    <form action="{{url('admin/slider/store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="image">Chọn ảnh:</label>
                            <input type="file" class="form-control-file mb-2" name="image">
                            @error('image')
                                <small class="form-text text-danger">{{$message}}</small>
                             @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" name="btn-add" value="Thêm mới">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Đường dẫn ảnh</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Người tạo</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t=0
                            @endphp
                            @foreach ($sliders as $slider)
                            @php
                                $t++
                            @endphp
                                <tr>
                                    <td>{{$t}}</td>
                                    <td>{{$slider->name}}</td>
                                    <td><img src="{{url($slider->image)}}" alt="" width="120px" height="44px"></td>
                                    <th>{{$slider->user->name}}</th>
                                    <td>{{$slider->created_at}}</td>
                                    <td>
                                        <a href="{{route('forceDelete.slider',$slider->id)}}" onclick="return confirm('Bạn có chắc xóa bản ghi này không ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection