@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
    {{-- <div class="col-md-8"></div> --}}
	<div class="card">
		<div class="card-header">Thêm sản phẩm</div>
		<div class="card-body">
			<form action="{{ route('admin.sanpham.add') }}" method="post" enctype="multipart/form-data">
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
					<label class="form-label" for="dungluong">Dung lượng:</label> &nbsp; <br>
                    <div class="row" style="">
                        <div class="col-sm-3">64GB<input type="checkbox" value="64GB" name="dungluong[]" id="dl64" onclick="handleChecked('mausanpham_64','dl64')"></div>
                        <div class="col-sm-2">Đỏ<input onclick="handleCheckColor('mausanpham_64','sl_do_64')" id="mausanpham_64" disabled type="checkbox">&nbsp;&nbsp;<input id="sl_do_64" disabled type="text"></div>

                        <div class="col-sm-2">Xanh<input onclick="handleCheckColor('mausanpham_64','sl_xanh_64')" id="mausanpham_64" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_xanh_64" type="text"></div>

                        <div class="col-sm-2">Trắng<input onclick="handleCheckColor('mausanpham_64','sl_trang_64')" id="mausanpham_64" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_trang_64" type="text"></div>
                        <div class="col-sm-2">Vàng<input onclick="handleCheckColor('mausanpham_64','sl_vang_64')" id="mausanpham_64" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_vang_64" type="text"></div>

                    </div>
					<div class="row" id="">
                        <div class="col-sm-3">128GB<input type="checkbox" value="128GB" name="dungluong[]" id="dl128" onclick="handleChecked('mausanpham_128','dl128')"></div>
                        <div class="col-sm-2">Đỏ<input onclick="handleCheckColor('mausanpham_128','sl_do_128')" id="mausanpham_128" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_do_128" type="text"></div>

                        <div class="col-sm-2">Xanh<input onclick="handleCheckColor('mausanpham_128','sl_xanh_128')" id="mausanpham_128" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_xanh_128" type="text"></div>

                        <div class="col-sm-2">Trắng<input onclick="handleCheckColor('mausanpham_128','sl_trang_128')" id="mausanpham_128" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_trang_128" type="text"></div>
                        <div class="col-sm-2">Vàng<input onclick="handleCheckColor('mausanpham_128','sl_vang_128')" id="mausanpham_128" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_vang_128" type="text"></div>

                    </div>

					<div class="row" id="">
                        <div class="col-sm-3">256GB<input type="checkbox" value="256GB" name="dungluong[]" id="dl256" onclick="handleChecked('mausanpham_256','dl256')"></div>
                        <div class="col-sm-2">Đỏ<input onclick="handleCheckColor('mausanpham_256','sl_do_256')" id="mausanpham_256" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_do_256" type="text"></div>

                        <div class="col-sm-2">Xanh<input onclick="handleCheckColor('mausanpham_256','sl_xanh_256')" id="mausanpham_256" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_xanh_256" type="text"></div>
                        <div class="col-sm-2">Trắng<input onclick="handleCheckColor('mausanpham_256','sl_trang_256')" id="mausanpham_256" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_trang_256" type="text"></div>
                        <div class="col-sm-2">Vàng<input onclick="handleCheckColor('mausanpham_256','sl_vang_256')" id="mausanpham_256" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_vang_256" type="text"></div>
                    </div>

					<div class="row" id="">
                        <div class="col-sm-3">512GB<input type="checkbox" value="512GB" name="dungluong[]" id="dl512" onclick="handleChecked('mausanpham_512','dl512')"></div>
                        <div class="col-sm-2">Đỏ<input onclick="handleCheckColor('mausanpham_512','sl_do_512')" id="mausanpham_512" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_do_512" type="text"></div>
                        <div class="col-sm-2">Xanh<input onclick="handleCheckColor('mausanpham_512','sl_xanh_512')" id="mausanpham_512" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_xanh_512" type="text"></div>
                        <div class="col-sm-2">Trắng<input onclick="handleCheckColor('mausanpham_512','sl_trang_512')" id="mausanpham_512" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_trang_512" type="text"></div>
                        <div class="col-sm-2">Vàng<input onclick="handleCheckColor('mausanpham_512','sl_vang_512')" id="mausanpham_512" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_vang_512" type="text"></div>

                    </div>

					<div class="row" id="">
                        <div class="col-sm-3">1TB<input type="checkbox" value="128GB" name="dungluong[]" id="dl1" onclick="handleChecked('mausanpham_1','dl1')"></div>
                        <div class="col-sm-2">Đỏ<input onclick="handleCheckColor('mausanpham_1','sl_do_1')" id="mausanpham_1" name="sl_do_1" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_do_1" type="text"></div>
                        <div class="col-sm-2">Xanh<input onclick="handleCheckColor('mausanpham_1','sl_xanh_1')" id="mausanpham_1" name="sl_xanh_1" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_xanh_1" type="text"></div>
                        <div class="col-sm-2">Trắng<input onclick="handleCheckColor('mausanpham_1','sl_trang_1')" id="mausanpham_1" name="sl_trang_1" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_trang_1" type="text"></div>
                        <div class="col-sm-2">Vàng<input onclick="handleCheckColor('mausanpham_1','sl_vang_1')" id="mausanpham_1" name="sl_vang_1" disabled type="checkbox">&nbsp;&nbsp;<input disabled id="sl_vang_1" type="text"></div>
                    </div>
				</div>

				<div class="mb-3">

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
