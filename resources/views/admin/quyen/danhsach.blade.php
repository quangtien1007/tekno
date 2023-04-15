@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Quyền</div>
            <div class="card-body table-responsive">
                <p><a href="{{ route('admin.quyen.create') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
                <table class="table table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th width="20%">Quyền</th>
                            <th width="20%">Tên</th>
                            <th width="15%">Nhóm quyền</th>
                            <th class="text-center" width="5%">Sửa</th>
                            <th class="text-center" width="5%">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            @foreach ($role as $value)
                                <tr>
                                    <td>{{ $value->display_name }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->group }}</td>
                                    <td class="text-center"><a href="{{route('admin.quyen.edit',['id'=>$value->id])}}"><i class="fa-regular fal fa-edit text-success"></i></a></td>
                                    <td class="text-center">
                                        <a href="{{route('admin.quyen.delete',['id'=>$value->id])}}" onclick="return confirm('Bạn có muốn xóa quyền {{ $value->display_name }} không?')">
                                            <i class="fa-regular fal fa-trash-alt text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
