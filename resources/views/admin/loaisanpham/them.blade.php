@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Thêm loại sản phẩm</div>
            <div class="card-body">
                <form action="{{ route('admin.loaisanpham.add') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="parent_id">Category</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="0">Parent</option>
                            <?php showCategories($category)?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tenloai">Tên loại</label>
                        <input type="text" class="form-control @error('tenloai') is-invalid @enderror" id="tenloai" name="tenloai" value="{{ old('tenloai') }}" required />
                        @error('tenloai')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success"><i class="fal fa-save"></i> Thêm vào CSDL</button>
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
