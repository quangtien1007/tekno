@extends('layouts.client')

@section('title', 'Đăng nhập')

@section('content')
  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row justify-content-md-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h2><strong class="order-total">Đăng nhập</strong></h2>
                        </div>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                Email:<input type="text" class="input{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Tên đăng nhập hoặc Email *" required />
                                @if ($errors->has('email') || $errors->has('username'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                Password:<input type="password" class="input @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu *" required />
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="login_footer form-group">
                                <div class="check-form">
                                    <div class="custome-checkbox">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                        <label class="form-check-label" for="remember"><span>Nhớ thông tin đăng nhập</span></label>
                                    </div>
                                </div>
                                <a href="#">Quên mật khẩu?</a>
                            </div>
                            <div class="form-group" style="text-align: center">
                                <button type="submit" class="primary-btn order-submit login">ĐĂNG NHẬP</button>
                            </div>
                        </form>
                        <div class="different_login">
                            <span>Hoặc</span>
                        </div>
                        <ul class="btn-login text-center">
                            <li><a href="#" class="primary-btn order-submit login" style="background: #1d6aeb"><i class="fa-brands fa-facebook"></i>  Facebook</a></li>or
                            <li><a href="#" class="primary-btn order-submit login" style="background: #e1e1e1;color:#1d6aeb;"><img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" width="20" alt="">       Google</a></li>
                        </ul>
                        <div class="form-note">Bạn chưa có tài khoản? <a href="{{ route('user.dangky') }}">Đăng ký ngay</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<!-- /SECTION -->
@endsection
