@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Chỉnh sửa thông tin thành viên: 
            <span class="badge badge-primary p-2">{{$user->role}}</span>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors ->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($user->role == 'Toàn quyền')
        <div class="card-body">
            <form action="{{route('user.update',$user->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" disabled value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password" >
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm" >
                </div>
                <button type="submit" name="btn-update" value="Cập Nhật" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
        @else
        <div class="card-body">
            <form action="{{route('user.update',$user->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" disabled value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password" >
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password-confirm" >
                </div>

                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="" name="role">
                        <option value="0">Chọn quyền</option>
                        <option value="Toàn quyền">Toàn quyền</option>
                        <option value="Quản lý bài viết, trang và slider">Quản lý bài viết, trang và slider</option>
                        <option value="Quản lý sản phẩm và đơn hàng">Quản lý sản phẩm và đơn hàng</option>
                    </select>
                </div>

                <button type="submit" name="btn-update" value="Cập Nhật" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
        @endif
        
    </div>
</div>
@endsection

