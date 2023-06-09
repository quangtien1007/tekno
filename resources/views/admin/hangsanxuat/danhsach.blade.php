@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
                <div class="card-header">Hãng sản xuất</div>
                <div class="card-body table-responsive">
                    <p>
                        <a href="{{ route('admin.hangsanxuat.create') }}" class="btn btn-info"><i class="fal fa-plus"></i> Thêm mới</a>
                        <a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i> Nhập từ Excel</a>
                        <a href="{{ route('admin.hangsanxuat.export') }}" class="btn btn-success"><i class="fal fa-download"></i> Xuất ra Excel</a>
                    </p>
                    <table class="table table-stried table-hover table-sm mb-0">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Hình ảnh</th>
                                <th width="35%">Tên hãng</th>
                                <th width="30%">Tên hãng không dấu</th>
                                <th class="text-center" width="5%">Sửa</th>
                                <th class="text-center" width="5%">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hangsanxuat as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ env('APP_URL') . '/images/' . $value->hinhanh }}" width="100" class="img-thumbnail" /></td>
                                    <td>{{ $value->tenhang }}</td>
                                    <td>{{ $value->tenhang_slug }}</td>
                                    <td class="text-center"><a href="{{ route('admin.hangsanxuat.edit', ['id' => $value->id]) }}"><i class="fa-regular fal fa-edit text-success"></i></a></td>
                                    <td class="text-center"><a href="{{ route('admin.hangsanxuat.delete', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa hãng sản xuất {{ $value->tenhang }} không?')"><i class=" fa-regular fal fa-trash-alt text-danger"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
</div>
	<form action="{{ route('admin.hangsanxuat.import') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="importModalLabel">Nhập từ Excel</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-0">
							<label for="file_excel" class="form-label">Chọn tập tin Excel</label>
							<input type="file" class="form-control" id="file_excel" name="file_excel" required />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fal fa-times"></i> Hủy bỏ</button>
						<button type="submit" class="btn btn-danger"><i class="fal fa-upload"></i> Nhập dữ liệu</button>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection
