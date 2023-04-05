@extends('layouts.client')

@section('title', 'Đăng ký')

@section('content')
	<div class="main_content">
		<div class="login_register_wrap section">
			<div class="container">
				<div class="row justify-content-center">
                    <div class="col-md-3"></div>
					<div class="col-md-6">
						<div class="login_wrap">
							<div class="padding_eight_all bg-white">
								<div class="heading_s1">
									<h3>Đăng ký tài khoản</h3>
								</div>
								<form action="{{ route('register') }}" method="post">
									@csrf
									<div class="form-group">
										<input type="text" class="input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Họ và tên *" required />
										@error('name')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="form-group">
										<input type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email *" required />
										@error('email')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="form-group">
										<input type="password" class="input @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu *" required />
										@error('password')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<div class="form-group">
										<input type="password" class="input @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Xác nhận mật khẩu *" required />
										@error('password_confirmation')
											<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
										@enderror
									</div>
									<input type="hidden" class="input" id="is_admin" name="is_admin" value="0" />
									<div class="login_footer form-group">
										<div class="chek-form">
											<div class="custome-checkbox">
												<input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
												<label class="form-check-label" for="remember"><span>Tôi đồng ý với các điều khoản.</span></label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" style="background: #444444" class="primary-btn order-submit login">ĐĂNG KÝ</button>
									</div>
								</form>
								<div class="different_login">
									<span>Hoặc</span>
								</div>
								<ul class="btn-login list_none text-center">
									<li><a href="#" class="primary-btn order-submit login" style="background: #1d6aeb"><i class="fa-brands fa-facebook"></i>  Facebook</a></li>or
                            <li><a href="#" class="primary-btn order-submit login" style="background: #e1e1e1;color:#1d6aeb;"><img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" width="20" alt="">       Google</a></li>
								</ul>
								<div class="form-note">Bạn đã có tài khoản? &nbsp;&nbsp;<a href="{{ route('user.dangnhap') }}"><strong>Đăng nhập</strong></a></div>
							</div>
						</div>
					</div>
                    <div class="col-md-3"></div>
				</div>
			</div>
		</div>
	</div>
@endsection
