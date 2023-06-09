@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Sản phẩm</div>
            <div class="card-body table-responsive">
                <p>
                    <a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary"><i class="fal fa-plus"></i> Thêm mới</a>
                    <a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal"><i class="fal fa-upload"></i> Nhập sản phẩm từ Excel</a>
                    <a href="#nhap" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importDL"><i class="fal fa-upload"></i> Nhập dung lượng và màu từ Excel</a>
                    <a href="{{ route('admin.sanpham.export') }}" class="btn btn-success"><i class="fal fa-download"></i> Xuất sản phẩm ra Excel</a>
                    <a href="{{ route('admin.sanpham.exportdlmau') }}" class="btn btn-success"><i class="fal fa-download"></i> Xuất dung lượng và màu ra Excel</a>
                </p>
                    <div class="custom_select">
                        <form action="{{ route('admin.sanpham.sort') }}" method="post">
                            @csrf
                            <select class="form-control form-control" id="sapxep" name="sapxep" onchange="if(this.value != 0) { this.form.submit(); }">
                                <option value="default" {{ session('sapxep') == 'default' ? 'selected' : '' }}>Sắp xếp mặc định</option>
                                <?php
                                    showCategories($selectdata);
                                ?>
                            </select>
                        </form>
                    </div>
                {{ $sanpham->links() }} <br>

                <table class="table table-hover mt-3 mb-3">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="10%">Hình ảnh</th>
                            <th width="13%">Loại sản phẩm</th>
                            <th width="20%">Tên sản phẩm</th>
                            <th width="15%">Màu sản phẩm</th>
                            <th width="5%">SL</th>
                            <th width="10%">Đơn giá</th>
                            <th class="text-center" width="5%">Sửa</th>
                            @role('admin')
                            <th class="text-center" width="5%">Xóa</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sanpham as $value)
                            <tr>
                                <td>{{ $loop->index + $sanpham->firstItem() }}</td>
                                <td><img src="{{ env('APP_URL') . '/images/sanpham/' . $value->hinhanh }}" width="80" class="img-thumbnail" /></td>
                                <td>{{ $value->LoaiSanPham->tenloai }}</td>
                                <td>{{ $value->tensanpham }}</td>
                                <td>
                                        @foreach (DB::table('dungluong_mau')->where('sanpham_id',$value->id)->distinct()->get('mau_id') as $item)
                                            {{DB::table('mau')->where('id',$item->mau_id)->first()->mau}}
                                        @endforeach
                                </td>
                                <td>@if(isset(DB::table('dungluong_mau')->first()->soluongton))
                                    {{ DB::table('dungluong_mau')
                                    ->select('soluongton',DB::raw('SUM(soluongton)'))->where('sanpham_id',$value->id)
                                    ->groupBy('soluongton')
                                    ->first()->soluongton }}
                                    @endif</td>
                                <td>{{ number_format($value->dongia) }}đ</td>
                                <td class="text-center"><a href="{{ route('admin.sanpham.edit', ['id' => $value->id]) }}"><i class="fa-regular fal fa-edit text-success"></i></a></td>
                                @role('admin')
                                <td class="text-center"><a href="{{ route('admin.sanpham.delete', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm {{ $value->tensanpham }} không?')"><i class="fa-regular fal fa-trash-alt text-danger"></i></a></td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sanpham->links() }}
            </div>
        </div>
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
	<form action="{{ route('admin.sanpham.importdlmau') }}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="modal fade" id="importDL" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="importModalLabel">Nhập dung lượng và màu từ Excel</h5>
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
