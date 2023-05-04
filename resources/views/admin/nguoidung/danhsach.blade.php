@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Người dùng</div>
            <div class="card-body table-responsive">
                <p><a href="{{ route('admin.nguoidung.create') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
                <table class="table table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Họ và tên</th>
                            <th width="7%">Email</th>
                            <th width="7%">Quyền hạn</th>
                            <th width="15%">Địa chỉ</th>
                            <th width="7%">Số điện thoại</th>
                            <th class="text-center" width="5%">Sửa</th>
                            <th class="text-center" width="5%">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nguoidung as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>
                                    @php
                                        $role_id = DB::table('model_has_roles')->where('model_id',$value->id)->first();
                                    @endphp
                                    @if($value->is_admin == 1)
                                    {{DB::table('roles')->where('id',$role_id->role_id)->first()->display_name}}
                                    @else
                                    Khách hàng
                                    @endif
                                </td>
                                <td>{{ $value->diachi }}</td>
                                <td>{{ $value->sodienthoai }}</td>
                                <td class="text-center"><a  href="{{ route('admin.nguoidung.edit', ['id' => $value->id]) }}"><i class="fa-regular fal fa-edit text-success"></i></a></td>
                                <td class="text-center"><a onclick="return confirm('Bạn có muốn xóa tài khoản {{ $value->email }} không?')" href="{{ route('admin.nguoidung.delete', ['id' => $value->id]) }}"><i class="fa-regular fal fa-trash-alt text-danger"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
