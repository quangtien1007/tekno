@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Thêm sản phẩm</div>
		<div class="card-body">
			<form action="{{ route('admin.sanpham.them') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="mb-3">
					<label class="form-label" for="loaisanpham_id">Loại sản phẩm</label>
					<select class="form-select @error('loaisanpham_id') is-invalid @enderror" id="loaisanpham_id" name="loaisanpham_id" required>
						<option value="">-- Chọn --</option>
						<?php
							showCategories($loaisanpham);
						?>
					</select>
					@error('loaisanpham_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="loaisanpham_id">Hãng sản xuất</label>
					<select class="form-select @error('loaisanpham_id') is-invalid @enderror" id="hangsanxuat_id" name="hangsanxuat_id" required>
						<option value="">-- Chọn --</option>
						@foreach ($hangsanxuat as $item)
							<option value="{{$item->id}}">{{$item->tenhang}}</option>
						@endforeach
					</select>
					@error('loaisanpham_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="tensanpham">Tên sản phẩm</label>
					<input type="text" class="form-control @error('tensanpham') is-invalid @enderror" id="tensanpham" name="tensanpham" value="{{ old('tensanpham') }}" required />
					@error('tensanpham')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="dongia">Đơn giá</label>
					<input type="number" min="0" class="form-control @error('dongia') is-invalid @enderror" id="dongia" name="dongia" value="{{ old('dongia') }}" required />
					@error('dongia')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
					<input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" value="{{ old('hinhanh') }}" />
					@error('hinhanh')
					<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="hinhanhmota">Hình ảnh mô tả</label>
					<input type="file" multiple='multiple' class="form-control @error('hinhanhmota') is-invalid @enderror" id="hinhanh" name="hinhanhmota[]" value="{{ old('hinhanhmota') }}" />
					@error('hinhanhmota')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="mausanpham">Màu của sản phẩm:</label> &nbsp
					Đen<input type="checkbox" value="Đen" name="mausanpham[]" id="chk_den" onclick="handleCheckedBlack()"> &nbsp
					<span id="sl_den" style="display: none">Số lượng<input id="isl_den" class="form-control" name="mausanpham[]" type="number" disabled></span>
					<span id="gt_den" style="display: none">Giá trị<input id="igt_den" class="form-control" name="mausanpham[]" type="number" disabled></span>

					Đỏ<input type="checkbox" value="Đỏ" name="mausanpham[]" id="chk_do" onclick="handleCheckedRed()">
					<span id="sl_do" style="display: none">Số lượng<input id="isl_do" class="form-control" name="mausanpham[]" type="number" disabled></span>
					<span id="gt_do" style="display: none">Giá trị<input id="igt_do" class="form-control" name="mausanpham[]" type="number" disabled></span>

					Vàng<input type="checkbox" value="Vàng" name="mausanpham[]" id="chk_vang" onclick="handleCheckedYellow()">&nbsp
					<span id="sl_vang" style="display: none">Số lượng<input id="isl_vang" class="form-control" name="mausanpham[]" type="number" disabled></span>
					<span id="gt_vang" style="display: none">Giá trị<input id="igt_vang" class="form-control" name="mausanpham[]" type="number" disabled></span>

					Trắng<input type="checkbox" value="Trắng" name="mausanpham[]" id="chk_trang" onclick="handleCheckedWhite()">&nbsp
					<span id="sl_trang" style="display: none">Số lượng<input id="isl_trang" class="form-control" name="mausanpham[]" type="number" disabled></span>
					<span id="gt_trang" style="display: none">Giá trị<input id="igt_trang" class="form-control" name="mausanpham[]" type="number" disabled></span>

					Xanh<input type="checkbox" value="Xanh" name="mausanpham[]" id="chk_xanh" onclick="handleCheckedBlue()">&nbsp
					<span id="sl_xanh" style="display: none">Số lượng<input id="isl_xanh" class="form-control" name="mausanpham[]" type="number" disabled></span>
					<span id="gt_xanh" style="display: none">Giá trị<input id="igt_xanh" class="form-control" name="mausanpham[]" type="number" disabled></span>

					Tím<input type="checkbox" value="Tím" name="mausanpham[]" id="chk_tim" onclick="handleCheckedPurple()"> &nbsp
					<span id="sl_tim" style="display: none">Số lượng<input id="isl_tim" class="form-control" name="mausanpham[]" type="number" disabled></span>
					<span id="gt_tim" style="display: none">Giá trị<input id="igt_tim" class="form-control" name="mausanpham[]" type="number" disabled></span>
					<a href="" class="form-label">Mau khac</a>
				</div>

				<div class="mb-3">
					<label class="form-label" for="dungluong">Dung lượng:</label> &nbsp
					64GB<input type="checkbox" value="64GB" name="dungluong[]" id="dl64" onclick="handleChecked64()"> &nbsp
					<span id="sl64" style="display: none">Số lượng<input id="isl64" class="form-control" name="dungluong[]" type="number" disabled></span>
					<span id="gt64" style="display: none">Gia tri<input id="igt64" class="form-control" name="dungluong[]" type="number" disabled></span>

					128GB<input type="checkbox" value="128GB" name="dungluong[]" id="dl128" onclick="handleChecked128()">&nbsp
					<span id="sl128" style="display: none">Số lượng<input id="isl128" class="form-control" name="dungluong[]" type="number" disabled></span>
					<span id="gt128" style="display: none">Gia tri<input id="igt128" class="form-control" name="dungluong[]" type="number" disabled></span>

					256GB<input type="checkbox" value="256GB" name="dungluong[]" id="dl256" onclick="handleChecked256()">&nbsp
					<span id="sl256" style="display: none">Số lượng<input id="isl256" class="form-control" name="dungluong[]" type="number" disabled></span>
					<span id="gt256" style="display: none">Gia tri<input id="igt256" class="form-control" name="dungluong[]" type="number" disabled></span>

					512GB<input type="checkbox" value="512GB" name="dungluong[]" id="dl512" onclick="handleChecked512()">&nbsp
					<span id="sl512" style="display: none">Số lượng<input id="isl512" class="form-control" name="dungluong[]" type="number" disabled></span>
					<span id="gt512" style="display: none">Gia tri<input id="igt512" class="form-control" name="dungluong[]" type="number" disabled></span>

					1TB<input type="checkbox" value="1TB" name="dungluong[]" id="dl1" onclick="handleChecked1()"> &nbsp
					<span id="sl1" style="display: none">Số lượng<input id="isl1" class="form-control" name="dungluong[]" type="number" disabled></span>
					<span id="gt1" style="display: none">Gia tri<input id="igt1" class="form-control" name="dungluong[]" type="number" disabled></span>
				</div>

				<div class="mb-3">
					<label class="form-label" for="motasanpham">Mô tả sản phẩm</label>
					<textarea class="form-control" id="myeditorinstance" name="motasanpham">{{$form[0]->form }}</textarea>
				</div>

                <div class="mb-3">
					<label class="form-label" for="thongsokythuat">Thông số kỹ thuật</label>
					<textarea class="form-control" id="myeditorinstance" name="thongsokythuat">{{ $form[1]->form }}</textarea>
				</div>

				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Thêm vào CSDL</button>
			</form>
		</div>
	</div>
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
				showCategories($categories, $item->id, $char . '--- ');
			}
		}
	}

?>
