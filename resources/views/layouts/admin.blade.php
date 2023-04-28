<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<title>@yield('title', 'Trang chủ quản trị') - {{ config('app.name', 'Tekno') }}</title>

	<!-- CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.png') }}" />

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- fotnawesome pro -->
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" />
	<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="{{ asset('assets/js/index.js')}}"></script>
	<script>
	  tinymce.init({
		selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
		plugins: 'code table lists',
		toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
	  });
	</script>
	@yield('javascript')
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-expand-md navbar-light shadow-sm bg-white">
			<div class="container-fluid">
				<a class="navbar-brand" href="{{ route('admin') }}">
					<img class="logo_light" src="{{ asset('images/logo-tekno-tekno.png') }}" />
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="{{route('admin')}}"><i class="fa-solid fa-chart-simple"></i></i> Thống kê bán hàng</a>
						</li>
					</ul>
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						@guest
							@if (Route::has('login'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('login') }}"><i class="fal fa-fw fa-sign-in-alt"></i> Đăng nhập</a>
								</li>
							@endif
							@if (Route::has('register'))
								<li class="nav-item">
									<a class="nav-link" href="{{ route('register') }}"><i class="fal fa-fw fa-user-plus"></i> Đăng ký</a>
								</li>
							@endif
						@else
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-gear"></i> Quản lý
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('admin.donhang.index') }}"><i class="fa-solid fa-cart-arrow-down"></i> Đơn hàng</a></li>
									<li><a class="dropdown-item" href="{{ route('admin.sanpham.index') }}"><i class="fa-solid fa-cubes"></i> Sản phẩm</a></li>
									<li><a class="dropdown-item" href="{{ route('admin.baiviet.index') }}"><i class="fa-solid fa-newspaper"></i> Bài viết</a></li>
                                    <li><a class="dropdown-item" href="{{ route('inbox.index') }}"><i class="fa-brands fa-rocketchat"></i> Chat</a></li>
                                    {{-- <li><a class="dropdown-item" href="{{ route('admin.thongke.index') }}"><i class="fa-brands fa-rocketchat"></i> Thống kê</a></li> --}}
                                    @role('admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.quyen.index') }}"><i class="fa-solid fa-shield-check"></i> Quyền</a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.loaisanpham.index') }}"><i class="fa-solid fa-list"></i> Loại sản phẩm</a></li>
									<li><a class="dropdown-item" href="{{ route('admin.hangsanxuat.index') }}"><i class="fa-solid fa-copyright"></i> Hãng sản xuất</a></li>
									<li><a class="dropdown-item" href="{{ route('admin.nguoidung.index') }}"><i class="fa-solid fa-users"></i> Tài khoản </a></li>
									<li><a class="dropdown-item" href="{{ route('admin.tinhtrang.index') }}"><i class="fa-regular fa-rectangle-list"></i></i> Tình trạng</a></li>
                                    @endrole
								</ul>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="fa-solid fa-user-tie"></i> {{ Auth::user()->name }}
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="#"><i class="fal fa-fw fa-key"></i> Đổi mật khẩu</a></li>
									<li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fal fa-fw fa-power-off"></i> Đăng xuất</a></li>
									<form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
										@csrf
									</form>
								</ul>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		<main class="pt-3 pb-2">
            @include('flash-massage')
			@yield('content')
		</main>

		<hr class="shadow-sm" />
		<footer>Bản quyền &copy; {{ date('Y') }} bởi {{ config('app.name', 'Laravel') }}.</footer>
	</div>
	<script src="{{asset('assets/js/index.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
