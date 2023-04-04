@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Tình trạng đơn hàng</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('admin.tinhtrang.create') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="60%">Tình trạng</th>
						<th width="10%">Sửa</th>
						<th width="10%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tinhtrang as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td class="text-start">{{ $value->tinhtrang }}</td>
							<td class="text-center"><a href="{{ route('admin.tinhtrang.edit', ['id' => $value->id]) }}"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="{{ route('admin.tinhtrang.delete', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa tình trạng {{ $value->tinhtrang }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
