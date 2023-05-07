@extends('layouts.admin')

@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if (session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            
            @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách trang</h5>
        </div>
        <div class="card-body">
            <div class="analytic">
                <span class="text-primary">Trạng thái :</span>
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Công khai<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'wait'])}}" class="text-primary">Chờ duyệt<span class="text-muted">({{$count[1]}})</span></a>
            </div>
            <form action="{{url('admin/page/action')}}" method="">
                @csrf
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name="act" required>
                    <option>Chọn</option>
                    @foreach ($list_act as $k=>$act)
                        <option value="{{$k}}">{{$act}}</option>
                    @endforeach
                </select>
                
                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
            </div>
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">STT</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Đường dẫn trang</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pages->total()>0)
                    @php
                    $t=0
                    @endphp
                    @foreach ($pages as $page)
                    @php
                        $t++
                    @endphp
                    <tr>
                        <td>
                            <input type="checkbox" name="list_check[]" value="{{$page->id}}">
                        </td>
                        <td scope="row">{{$t}}</td>
                        <th><a href="">{{$page->title}}</a></th>
                        <td><a href="">{{$page->slug}}</a></td>
                        <td>{{$page->created_at}}</td>
                        <td>
                            <a href="{{route('page.edit',$page->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('forcedelete_page',$page->id)}}" onclick="return confirm('Bạn có chắc xóa bản ghi này không ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Xóa vĩnh viễn"><i class="fa fa-trash"></i></a>
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">Không tìm thấy bản ghi nào</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </form>
            {{ $pages->links() }}
        </div>
    </div>
</div>
@endsection