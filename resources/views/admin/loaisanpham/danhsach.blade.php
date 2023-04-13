@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">Loại sản phẩm</div>
            <div class="card-body table-responsive">
                <p><a href="{{ route('admin.loaisanpham.create') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
                <table class="table table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="35%">Tên loại</th>
                            <th width="40%">Tên loại không dấu</th>
                            <th class="text-center" width="5%">Sửa</th>
                            <th class="text-center" width="5%">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loaisanpham as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @if ($value->parent_id != 0)
                                <td>{{ '--'.$value->tenloai }}</td>
                                @else
                                    <td>{{$value->tenloai }}</td>
                                @endif
                                <td>{{ $value->tenloai_slug }}</td>
                                <td class="text-center"><a href="{{ route('admin.loaisanpham.edit', ['id' => $value->id]) }}"><i class="fa-regular fal fa-edit text-success"></i></a></td>
                                <td class="text-center"><a href="{{ route('admin.loaisanpham.delete', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa loại sản phẩm {{ $value->tenloai }} không?')"><i class="fa-regular fal fa-trash-alt text-danger"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
