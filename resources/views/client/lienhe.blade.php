@extends('layouts.client')

@section('title', 'Home')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">LIÊN HỆ</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('client')}}">Home</a></li>
                        <li class="active">Liên hệ</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->
    <div class="container contact" style="background: ">
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.6272952611885!2d105.43015021461053!3d10.37165579259696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a731e7546fd7b%3A0x953539cd7673d9e5!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBBbiBHaWFuZyAtIMSQSFFHIFRQSENN!5e0!3m2!1svi!2s!4v1680165049906!5m2!1svi!2s"
                width="1200" height="300" style="border:0;" allowfullscreen=""
                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
    <br><br><br>
    <div class="container">
        <div class="heading_s1">
            <h2 style="text-align:center"><strong class="order-total">Hãy để lại thông tin để chúng tôi có thể liên hệ bạn</strong></h2>
        </div>
    </div>
    <br><br><br><br>
    <!-- SECTION -->
    <div class="container">
        <!-- row -->
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1">
                            <h3><strong class="order-total">THÔNG TIN CỦA BẠN</strong></h3>
                        </div>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control{{ ($errors->has('name') || $errors->has('name')) ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Nhập tên của bạn *" required />
                                @if ($errors->has('email') || $errors->has('username'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control{{ ($errors->has('email') || $errors->has('username')) ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Nhập Email của bạn *" required />
                                @if ($errors->has('email') || $errors->has('username'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ empty($errors->first('email')) ? $errors->first('username') : $errors->first('email') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Nhập lời nhắn của bạn..." class="form-control" rows="5" id="comment"></textarea>
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group" style="width: 100px ">
                                <button type="submit" class="primary-btn submit">GỬI THÔNG TIN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="heading_s1">
                    <h3><strong class="order-total">THÔNG TIN LIÊN HỆ CHÚNG TÔI</strong></h3>
                </div><br>
                <div class="col-sm">
                    <h4>Giờ làm việc: 8:00 am - 21:00 pm</h4>
                    <h4>Email: tekno@gmail.com</h4>
                    <h4>Số điện thoại: 0386015481</h4>
                    <h4>Địa chỉ: 18, Ung Văn Khiêm, phường Đông Xuyên, thành phố Long Xuyên</h4>
                    <h4>Fax: +84 (8) 3623 3818.</h4>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /SECTION -->
@endsection
