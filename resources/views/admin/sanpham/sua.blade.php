@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Sửa sản phẩm</div>
		<div class="card-body">
			<form action="{{ route('admin.sanpham.update', ['id' => $sanpham->id]) }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="mb-3">
					<label class="form-label" for="loaisanpham_id">Loại sản phẩm</label>
					<select class="form-select @error('loaisanpham_id') is-invalid @enderror" id="loaisanpham_id" name="loaisanpham_id" required>
						<option value="">-- Chọn loại --</option>
						@foreach($loaisanpham as $value)
							<option value="{{ $value->id }}" {{ ($sanpham->loaisanpham_id == $value->id) ? 'selected' : '' }}>{{ $value->tenloai }}</option>
						@endforeach
					</select>
					@error('loaisanpham_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="hangsanxuat_id">Hãng sản xuất</label>
					<select class="form-select @error('hangsanxuat_id') is-invalid @enderror" id="hangsanxuat_id" name="hangsanxuat_id" required>
						<option value="">-- Chọn loại --</option>
						@foreach($hangsanxuat as $value)
							<option value="{{ $value->id }}" {{ ($sanpham->hangsanxuat_id == $value->id) ? 'selected' : '' }}>{{ $value->tenhang }}</option>
						@endforeach
					</select>
					@error('hangsanxuat_id')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="tensanpham">Tên sản phẩm</label>
					<input type="text" class="form-control @error('tensanpham') is-invalid @enderror" id="tensanpham" name="tensanpham" value="{{ $sanpham->tensanpham }}" required />
					@error('tensanpham')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="dongia">Đơn giá</label>
					<input type="number" min="0" class="form-control @error('dongia') is-invalid @enderror" id="dongia" name="dongia" value="{{ $sanpham->dongia }}" required />
					@error('dongia')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="hinhanh">Hình ảnh sản phẩm</label>
					@if(!empty($sanpham->hinhanh)) 
						<img class="d-block rounded img-thumbnail" src="{{ env('APP_URL') . '/public/images/sanpham/' . $sanpham->hinhanh }}" width="100" />
						<span class="d-block small text-danger">Bỏ trống nếu muốn giữ nguyên ảnh cũ.</span>
					@endif
					<input type="file" class="form-control @error('hinhanh') is-invalid @enderror" id="hinhanh" name="hinhanh" value="{{ $sanpham->hinhanh }}" />
					@error('hinhanh')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>


				<div class="mb-3">
					<label class="form-label" for="hinhanhmota">Hình ảnh mô tả</label>
					<input type="file" multiple='multiple' class="form-control @error('hinhanhmota') is-invalid @enderror" id="hinhanh" name="hinhanhmota[]" value="{{ $sanpham->hinhanhmota }}" />
					@error('hinhanhmota')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="motasanpham">Mô tả sản phẩm</label>
					<textarea class="form-control" id="myeditorinstance" name="motasanpham">{{ $sanpham->motasanpham ? $sanpham->motasanpham : $form[0]->form }}</textarea>
				</div>

                <div class="mb-3">
					<label class="form-label" for="thongsokythuat">Thông số kỹ thuật</label>
					<textarea class="form-control" id="myeditorinstance" name="thongsokythuat">{{ $sanpham->thongsokythuat ? $sanpham->thongsokythuat : $form[1]->form }}</textarea>
				</div>

				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật</button>
			</form>
		</div>
	</div>
@endsection
