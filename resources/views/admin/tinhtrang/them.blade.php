@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Thêm tình trạng</div>
		<div class="card-body">
			<form action="{{ route('admin.tinhtrang.add') }}" method="post">
				@csrf
				
				<div class="mb-3">
					<label class="form-label" for="tinhtrang">Tên tình trạng</label>
					<input type="text" class="form-control @error('tinhtrang') is-invalid @enderror" id="tinhtrang" name="tinhtrang" value="{{ old('tinhtrang') }}" required />
					@error('tinhtrang')
						<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
					@enderror
				</div>
				
				<button type="submit" class="btn btn-success"><i class="fal fa-save"></i> Thêm vào CSDL</button>
			</form>
		</div>
	</div>
@endsection