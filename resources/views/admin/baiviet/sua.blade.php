@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Viết bài</div>
		<div class="card-body">
			<form action="{{route('admin.baiviet.update',['id'=>$baiviet->id])}}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="mb-3">
					<label class="form-label" for="tieude">Tiêu đề bài viết</label>
					<input type="text" class="form-control @error('tieude') is-invalid @enderror" id="tieude" name="tieude" value="{{ $baiviet->tieude }}" required />
					@error('tieude')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="thumbnail">Thumbnail</label>
					@if(!empty($baiviet->thumbnail))
						<img class="d-block rounded img-thumbnail" src="{{ env('APP_URL') . '/images/' . $baiviet->thumbnail }}" width="200" />
						<span class="d-block small text-danger">Bỏ trống nếu muốn giữ nguyên ảnh cũ.</span>
					@endif
					<input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" value="{{$baiviet->thumbnail}}" />
					@error('thumbnail')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

                <div class="mb-3">
					<label class="form-label" for="noidung">Nội dung</label>
					<textarea class="form-control" id="myeditorinstance" name="noidung">{{ $baiviet->noidung }}</textarea>
				</div>

				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Đăng bài</button>
			</form>
		</div>
	</div>
@endsection
