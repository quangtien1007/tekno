@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Viết bài</div>
		<div class="card-body">
			<form action="{{route('admin.baiviet.add')}}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="mb-3">
					<label class="form-label" for="tieude">Tiêu đề bài viết</label>
					<input type="text" class="form-control @error('tieude') is-invalid @enderror" id="tieude" name="tieude" value="{{ old('tieude') }}" required />
					@error('tieude')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label" for="thumbnail">Thumbnail</label>
					<input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" />
					@error('thumbnail')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>

                <div class="mb-3">
					<label class="form-label" for="noidung">Nội dung</label>
					<textarea class="form-control" id="myeditorinstance" name="noidung">{{ $form[0]->form }}</textarea>
				</div>

				<button type="submit" class="btn btn-primary"><i class="fal fa-save"></i> Đăng bài</button>
			</form>
		</div>
	</div>
@endsection
