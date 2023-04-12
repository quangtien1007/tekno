@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Loại sản phẩm</div>
            <div class="card-body table-responsive">
                <p><a href="{{ route('admin.loaisanpham.create') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
                <table class="table table-bordered table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="35%">Tên loại</th>
                            <th width="40%">Tên loại không dấu</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($loaisanpham as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if ($value->parent_id != 0)
                                <td>{{ '--'.$value->tenloai }}</td>
                                @else
                                    <td>{{$value->tenloai }}</td>
                                @endif
                                <td>{{ $value->tenloai_slug }}</td>
                                <td class="text-center"><a href="{{ route('admin.loaisanpham.sua', ['id' => $value->id]) }}"><i class="fal fa-edit"></i></a></td>
                                <td class="text-center"><a href="{{ route('admin.loaisanpham.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa loại sản phẩm {{ $value->tenloai }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
                            </tr>
                        @endforeach --}}
                        <?php
                            showCategories($loaisanpham);
                        ?>

                    </tbody>
                </table>
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
				echo '<tr>';
				echo '<td value="'.$item->id.'">'.$item->id.'</option>';
				echo '<td value="'.$item->id.'">'.$char.$item->tenloai.'</option>';
				echo '<td value="'.$item->id.'">'.$item->tenloai_slug.'</option>';
				echo '<td class="text-center">'.'<a href="">'.'<i class="fal fa-edit"></i>'.'</a>'.'</option>';
				echo '<td class="text-center">'.'<a href="admin/loaisanpham/sua/'.$item->id.'">'.'<i class="fal fa-trash-alt text-danger"></i>'.'</a>'.'</option>';
				echo '</tr>';
				// Xóa chuyên mục đã lặp
				unset($categories[$key]);

				// Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
				showCategories($categories, $item->id, $char . '--- ');
			}
		}
	}

?>
