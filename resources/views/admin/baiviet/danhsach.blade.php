@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Danh sách bài viết</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('admin.baiviet.create') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="55%">Bài viết</th>
                        <th>Ngày đăng</th>
						<th width="10%">Sửa</th>
                        @role('admin')
						<th width="10%">Xóa</th>
                        @endrole
					</tr>
				</thead>
				<tbody>
                    @foreach ($baiviet as $item)
						<tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->tieude}}</td>
                            <td>{{$item->created_at}}</td>
							<td class="text-center"><a href="{{route('admin.baiviet.edit',['id'=>$item->id])}}"><i class="fal fa-edit"></i></a></td>
                            @role('admin')
							<td class="text-center"><a href="{{ route('admin.baiviet.delete', ['id' => $item->id]) }}" onclick="return confirm('Bạn có muốn xóa bài viết {{ $item->tieude }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
                            @endrole
						</tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
