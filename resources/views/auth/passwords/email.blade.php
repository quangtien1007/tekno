@extends('layouts.admin')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">Khôi phục mật khẩu</div>
				<div class="card-body">
					@if(session('status'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<span class="font-weight-bold text-primary"><i class="fal fa-check-circle"></i> {{ session('status') }}</span>
						</div>
					@endif
					<form method="post" action="{{ route('password.email') }}">
						@csrf
						<div class="mb-3">
							<label class="form-label" for="email">Địa chỉ Email</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required />
							@error('email')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							@enderror
						</div>
						<div class="mb-0">
							<button type="submit" class="btn btn-primary"><i class="fal fa-paper-plane"></i> Gởi liên kết khôi phục mật khẩu</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection