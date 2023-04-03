<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title', 'Trang chủ') - {{ config('app.name', 'Tekno') }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script> --}}
        <script src="{{asset('assets/js/index.js')}}"></script>


         <!-- fotnawesome pro -->
        <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />

		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
        <script src="{{asset('assets/js/flashjs/dist/flash.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('assets/js/flashjs/dist/flash.min.css')}}">
        <!-- Latest compiled and minified CSS -->

		<!-- Slick -->
		<link rel="stylesheet" href="{{asset('assets/css/slick.css')}}"/>
		<link rel="stylesheet" href="{{asset('assets/css/slick-theme.css')}}"/>

		<!-- nouislider -->
		<link rel="stylesheet" href="{{asset('assets/css/nouislider.min.css')}}"/>

		<!-- Font Awesome Icon -->
		{{-- <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}"> --}}
        <script src="https://kit.fontawesome.com/80a51985d7.js" crossorigin="anonymous"></script>

		<!-- Custom stlylesheet -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>
        @livewireStyles

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +84-038-601-5481</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> tekno@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 18, Ung Văn Khiêm</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> VND</a></li>
						<li><a href="{{ route('user') }}"><i class="fa fa-user-o"></i> Tài khoản</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{route('client')}}" class="logo">
									<img src="{{ asset('images/logo_light.png') }}" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="{{route('client.sanpham')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
									<input required name="search" class="input" placeholder="Tìm kiếm tại đây...">
									<button class="search-btn">Tìm kiếm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
                                    <tbody>
                                        <a id="wishlist_list" href="{{route('client.yeuthich')}}">
                                            <i class="fa fa-heart-o"></i>
                                            <span>Yêu thích</span>
                                            <div id="wishlist-qty" class="qty"></div>
                                        </a>
                                    </tbody>
								</div>
								<!-- /Wishlist -->

								<!-- Cart -->
								<div class="dropdown">
									<a style="cursor: pointer" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										<div class="qty">{{ Cart::count() ?? 0 }}</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
                                            @foreach(Cart::content() as $value)
											<div class="product-widget">
												<div class="product-img">
													<img src="{{ env('APP_URL') . '/storage/app/sanpham/' . $value->options->image }}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name">
                                                        <a href="#">{{ $value->name }}</a></h3>
													<h4 class="product-price"><span class="qty">{{ $value->qty }} x</span>{{ number_format($value->price) }}</h4>
												</div>
                                                <a class="delete" href="{{ route('client.giohang.xoa', ['row_id' => $value->rowId]) }}"><i class="fa fa-close"></i></a>
											</div>
                                            @endforeach
										</div>
										<div class="cart-summary">
											<h5>Tổng tiền: {{ Cart::priceTotal() }}đ</h5>
										</div>
										<div class="cart-btns">
											<a href="{{ route('client.giohang') }}">Xem giỏ hàng</a>
											<a href="{{ route('client.dathang') }}">Thanh toán  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="#">Trang chủ</a></li>
						<li><a href="#">Hot Deals</a></li>
						@foreach ($navdata as $item)
                        <li>
                            <a class=""
                            href="{{ route('client.sanpham.danhmuc',
                            ['tenloai_slug' => $item->tenloai_slug]) }}">
                            {{ $item->tenloai }}
                            </a>
                        </li>
                        @endforeach
                        <li><a href="{{ route('client.baiviet') }}">Tin tức</a></li>
                        <li><a href="{{ route('client.lienhe') }}">Liên hệ</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
        @if(session()->has('success'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('success') }}
            </div>
        @endif
        <script type="text/javascript">
        $(document).ready(function(){
          $(".alert-success").delay(8000).slideUp(300);
            });
        </script>
        @yield('content')

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title"></h3>
								<p>Cửa hàng chúng tôi chuyên cung cấp các sản phẩm công nghệ mới nhất với chất lượng tốt nhất thị trường.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>18, Ung Văn Khiêm</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+84-38-601-5481</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>tekno@gmail.com</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Theo loại</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptop</a></li>
									<li><a href="#">Điện thoại</a></li>
									<li><a href="#">Tablet</a></li>
									<li><a href="#">Phụ kiện</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Thông tin</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Liên hệ</a></li>
									<li><a href="#">Chính sách bảo hành</a></li>
									<li><a href="#">Chính sách đổi tra</a></li>
									<li><a href="#">Quy chế hoạt động</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Dịch vụ</h3>
								<ul class="footer-links">
									<li><a href="{{route('user')}}">Tài khoản</a></li>
									<li><a href="{{route('client.giohang')}}">Xem giỏ hàng</a></li>
									<li><a href="{{route('client.yeuthich')}}">Yêu thích</a></li>
									<li><a href="#">Theo dõi đơn hàng</a></li>
									<li><a href="{{route('inbox.index')}}">Trợ giúp</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->
			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script>  {{ config('app.name', 'Laravel') }} All rights reserved
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->
        @livewire('test', ['users' => getUserMessage() , 'messages' => $messages ?? null])
		<!-- jQuery Plugins -->
		<script src="{{asset('assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/js/slick.min.js')}}"></script>
		<script src="{{asset('assets/js/nouislider.min.js')}}"></script>
		<script src="{{asset('assets/js/jquery.zoom.min.js')}}"></script>
		<script src="{{asset('assets/js/main.js')}}"></script>
        @livewireScripts
	</body>
</html>
