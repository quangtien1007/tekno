@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Người dùng</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('admin.nguoidung.create') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="20%">Họ và tên</th>
						<th width="20%">Tên đăng nhập</th>
						<th width="35%">Email</th>
						<th width="10%">Quyền hạn</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($nguoidung as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->name }}</td>
							<td>{{ $value->username }}</td>
							<td>{{ $value->email }}</td>
							<td>{{ $value->role }}</td>
							<td class="text-center"><a  href="{{ route('admin.nguoidung.edit', ['id' => $value->id]) }}"><i class="fal fa-edit text-success"></i></a></td>
							<td class="text-center"><a href="{{ route('admin.nguoidung.delete', ['id' => $value->id]) }}"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
