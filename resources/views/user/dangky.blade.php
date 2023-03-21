@extends('layouts.frontend')

@section('title', 'Đăng ký')

@section('content')
	<div class="breadcrumb_section bg_gray page-title-mini">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="page-title">
						<h1>Đăng ký</h1>
					</div>
				</div>
				<div class="col-md-6">
					<ol class="breadcrumb justify-content-md-end">
						<li class="breadcrumb-item"><a href="{{ route('frontend') }}">Trang chủ</a></li>
						<li class="breadcrumb-item active">Đăng ký</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	
	<div class="main_content">
		<div class="login_register_wrap section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-6 col-md-10">
						<div class="login_wrap">
							<div class="padding_eight_all bg-white">
								<div class="heading_s1">
									<h3>Đăng ký tài khoản</h3>
								</div>
								<form action="{{ route('register') }}" method="post">
									@csrf
									<div class="form-group">
										<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Họ và tên *" required />
										@error('name')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="form-group">
										<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email *" required />
										@error('email')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="form-group">
										<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu *" required />
										@error('password')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="form-group">
										<input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Xác nhận mật khẩu *" required />
										@error('password_confirmation')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<input type="hidden" class="form-control" id="is_admin" name="is_admin" value="0" />
									<div class="login_footer form-group">
										<div class="chek-form">
											<div class="custome-checkbox">
												<input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
												<label class="form-check-label" for="remember"><span>Tôi đồng ý với các điều khoản.</span></label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-fill-out btn-block">ĐĂNG KÝ</button>
									</div>
								</form>
								<div class="different_login">
									<span>Hoặc</span>
								</div>
								<ul class="btn-login list_none text-center">
									<li><a href="#" class="btn btn-facebook"><i class="ion-social-facebook"></i>Facebook</a></li>
									<li><a href="#" class="btn btn-google"><i class="ion-social-googleplus"></i>Google</a></li>
								</ul>
								<div class="form-note text-center">Bạn đã có tài khoản? <a href="{{ route('user.dangnhap') }}">Đăng nhập</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection