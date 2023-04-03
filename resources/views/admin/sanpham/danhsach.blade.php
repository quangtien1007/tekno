@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Sản phẩm</div>
		<div class="card-body table-responsive">
			<p>
				<a href="{{ route('admin.sanpham.create') }}" class="btn btn-info"><i class="fal fa-plus"></i> Thêm mới</a>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i>Nhập sản phẩm từ Excel</a>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importMau"><i class="fal fa-upload"></i>Nhập màu từ Excel</a>
				<a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importDL"><i class="fal fa-upload"></i>Nhập dung lượng từ Excel</a>
				<a href="{{ route('admin.sanpham.xuat') }}" class="btn btn-success"><i class="fal fa-download"></i> Xuất ra Excel</a>
			</p>
				<div class="custom_select">
					<form action="{{ route('admin.sanpham.search') }}" method="post">
						@csrf
						<select class="form-control form-control" id="sapxep" name="sapxep" onchange="if(this.value != 0) { this.form.submit(); }">
							<option value="default" {{ session('sapxep') == 'default' ? 'selected' : '' }}>Sắp xếp mặc định</option>
							<?php 
								showCategories($selectdata);
							?>
						</select>
					</form>
				</div>
<br>
			{{ $sanpham->links() }}

			<table class="table table-bordered table-hover table-sm mt-3 mb-3">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="10%">Hình ảnh</th>
						<th width="15%">Loại sản phẩm</th>
						<th width="35%">Tên sản phẩm</th>
						<th width="10%">Màu sản phẩm</th>
						<th width="5%">SL</th>
						<th width="10%">Đơn giá</th>
						<th width="5%">Sửa</th>
						<th width="5%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sanpham as $value)
						<tr>
							<td>{{ $loop->index + $sanpham->firstItem() }}</td>
							<td class="text-center"><img src="{{ env('APP_URL') . '/storage/app/sanpham/' . $value->hinhanh }}" width="80" class="img-thumbnail" /></td>
							<td>{{ $value->LoaiSanPham->tenloai }}</td>
							<td>{{ $value->tensanpham }}</td>
							<td>
								@for ($j=0; $j <= count($sanpham)+1;$j++)
									@foreach ($sanpham->where('id',$value->id) as $item)
									<span width='30px' style='background:#{{ isset(explode('|',$item->mausanpham)[$j]) ? explode('|',$item->mausanpham)[$j] : '' }}'>&nbsp&nbsp&nbsp&nbsp&nbsp</span>
									@endforeach
								@endfor
							</td>
							<td class="text-end">{{ $value->soluong }}</td>
							<td class="text-end">{{ number_format($value->dongia) }}</td>
							<td class="text-center"><a href="{{ route('admin.sanpham.edit', ['id' => $value->id]) }}"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="{{ route('admin.sanpham.delete', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->tensanpham }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{ $sanpham->links() }}
		</div>
	</div>
	
	<form action="{{ route('admin.sanpham.import') }}" method="post" enctype="multipart/form-data">
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
	<form action="{{ route('admin.mausanpham.import') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="modal fade" id="importMau" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="importModalLabel">Nhập từ Excel asdsa</h5>
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
	<form action="{{ route('admin.dlsanpham.import') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="modal fade" id="importDL" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="importModalLabel">Nhập từ Excel asdsa</h5>
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
<?php 
function showCategories($categories, $parent_id = 0, $char = '')
	{
		foreach ($categories as $key => $item) {
			// Nếu là chuyên mục con thì hiển thị
			if ($item->parent_id == $parent_id) {
				// Xử lý hiển thị chuyên mục
				echo '<option value="'.$item->id.'">'.$char.$item->tenloai.'</option>';
				// Xóa chuyên mục đã lặp
				unset($categories[$key]);

				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				showCategories($categories, $item->id, $char . ' -- ');
			}
		}
	}
?>