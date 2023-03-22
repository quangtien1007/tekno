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
                    <h3 class="breadcrumb-header">Regular Page</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Home</a></li>
                        <li class="active">Blank</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->
    <!-- SECTION -->
    <div class="section pb_70">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-map2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Địa chỉ</span>
                            <p>18 Ung Văn Khiêm, P. Đông Xuyên, TPLX</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-envelope-open"></i>
                        </div>
                        <div class="contact_text">
                            <span>Địa chỉ Email</span>
                            <a href="larashop@gmail.com">larashop@gmail.com</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="contact_wrap contact_style3">
                        <div class="contact_icon">
                            <i class="linearicons-tablet2"></i>
                        </div>
                        <div class="contact_text">
                            <span>Điện thoại</span>
                            <p>+84 2963 01 11 10</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading_s1">
                        <h2>Để lại lời nhắn</h2>
                    </div>
                    <p class="leads">Nếu quý khách cần thêm thông tin hoặc phản hồi hãy để lại lời nhắn.</p>
                    <div class="field_form">
                        <form method="post" name="enq">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên *" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email *" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Điện thoại *" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Chủ đề *" required />
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Nội dung lời nhắn *" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-fill-out">GỞI LỜI NHẮN</button>
                                </div>
                                <div class="col-md-12">
                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
                    <div id="map" class="contact_map2" data-zoom="14" data-latitude="10.370575" data-longitude="105.431131" data-icon="{{ asset('images/marker.png') }}"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="text-center order_complete">
                    <i class="fal fa-check-circle"></i>
                    <div class="heading_s1">
                        <h3>Bạn đã đặt hàng thành công!</h3>
                    </div>
                    <p>Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đang được xử lý và sẽ hoàn thành trong vòng 3-6 giờ. Bạn sẽ nhận được một email xác nhận khi đơn đặt hàng của bạn được hoàn thành.</p>
                    <a href="{{ route('client') }}" class="btn btn-fill-out">TIẾP TỤC MUA SẮM</a>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div> --}}
    <!-- /SECTION -->
@endsection
