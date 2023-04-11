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
                        @php
                            $mau = DB::table('mausanpham')->get();
                        @endphp
                <div class="mb-3">
					<label class="form-label" for="dungluong">Dung lượng:</label> &nbsp; <br>
                    <div class="row" style="">
                        <div class="col-sm-3">64GB<input type="checkbox" value="1" name="dungluong_mau[]" id="dl_64" onclick="handleChecked('mau_64','dl_64')"></div>
                        @foreach ($mau as $item)
                        <div class="col-sm-2">{{$item->mau}}
                            <input value="{{$item->id}}" name="dungluong_mau[]" onclick="handleCheckColor('mau_64','{{Str::slug($item->mau,'.')}}_64')" id="mau_64" disabled type="checkbox">&nbsp;&nbsp;
                            <input name="dungluong_mau[]" id="{{Str::slug($item->mau,'.')}}_64" disabled type="text">
                        </div>
                        @endforeach
                    </div>
					<div class="row" id="">
                        <div class="col-sm-3">128GB<input type="checkbox" value="2" name="dungluong_mau[]" id="dl_128" onclick="handleChecked('mau_128','dl_128')"></div>
                        @foreach ($mau as $item)
                        <div class="col-sm-2">{{$item->mau}}
                            <input value="{{$item->id}}" name="dungluong_mau[]" onclick="handleCheckColor('mau_128','{{Str::slug($item->mau,'.')}}_128')" id="mau_128" disabled type="checkbox">&nbsp;&nbsp;
                            <input name="dungluong_mau[]" id="{{Str::slug($item->mau,'.')}}_128" disabled type="text">
                        </div>
                        @endforeach
                    </div>

					<div class="row" id="">
                        <div class="col-sm-3">256GB<input type="checkbox" value="3" name="dungluong_mau[]" id="dl_256" onclick="handleChecked('mau_256','dl_256')"></div>
                        @foreach ($mau as $item)
                        <div class="col-sm-2">{{$item->mau}}
                            <input value="{{$item->id}}" name="dungluong_mau[]" onclick="handleCheckColor('mau_256','{{Str::slug($item->mau,'.')}}_256')" id="mau_256" disabled type="checkbox">&nbsp;&nbsp;
                            <input name="dungluong_mau[]" id="{{Str::slug($item->mau,'.')}}_256" disabled type="text">
                        </div>
                        @endforeach
                    </div>

					<div class="row" id="">
                        <div class="col-sm-3">512GB<input type="checkbox" value="4" name="dungluong_mau[]" id="dl_512" onclick="handleChecked('mau_512','dl_512')"></div>
                        @foreach ($mau as $item)
                        <div class="col-sm-2">{{$item->mau}}
                            <input value="{{$item->id}}" name="dungluong_mau[]" onclick="handleCheckColor('mau_512','{{Str::slug($item->mau,'.')}}_512')" id="mau_512" disabled type="checkbox">&nbsp;&nbsp;
                            <input name="dungluong_mau[]" id="{{Str::slug($item->mau,'.')}}_512" disabled type="text">
                        </div>
                        @endforeach
                    </div>

					<div class="row" id="">
                        <div class="col-sm-3">1TB<input type="checkbox" value="5" name="dungluong[]" id="dl_1" onclick="handleChecked('mau_1','dl_1')"></div>
                        @foreach ($mau as $item)
                        <div class="col-sm-2">{{$item->mau}}
                            <input value="{{$item->id}}" name="dungluong_mau[]" onclick="handleCheckColor('mau_1','{{Str::slug($item->mau,'.')}}_1')" id="mau_1" disabled type="checkbox">&nbsp;&nbsp;
                            <input name="dungluong_mau[]" id="{{Str::slug($item->mau,'.')}}_1" disabled type="text">
                        </div>
                        @endforeach
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
