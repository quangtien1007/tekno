@extends('layouts.client')

@section('title', 'Quản lý tài khoản')

@section('content')
	<div class="main_content">
         <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Tài khoản</h3>
                    <ul class="breadcrumb-tree">
                        <li class="active"><a href="{{route('client')}}">Trang chủ</a></li>
                        <li class="active"><a href="#">Tài khoản</a></li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-4">
						<div class="dashboard_menu">
							<ul class="nav nav-tabs flex-column" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="ti-layout-grid2"></i>Trang chủ</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="ti-shopping-cart-full"></i>Đơn hàng của tôi</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="ti-location-pin"></i>Sổ địa chỉ</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="account-detail-tab" data-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="ti-id-badge"></i>Thông tin tài khoản</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-lock"></i>Đăng xuất</a>
									<form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
										@csrf
									</form>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-10 col-md-8">
						<div class="tab-content dashboard_content">
							<div class="tab-pane fade" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
								<div class="card">
									<div class="card-header">
										<h3>Trang chủ khách hàng</h3>
									</div>
									<div class="card-body">
										<p class="text-center"><img src="{{ asset('images/consumer.png') }}" /></p>
										<p>Xin chào khách hàng {{ Auth::user()->name }}.</p>
										<p class="text-justify">Từ trang chủ khách hàng, bạn có thể dễ dàng kiểm tra và xem các <a href="javascript:void(0);" onclick="$('#orders-tab').trigger('click')">đơn hàng</a> của mình, quản lý <a href="javascript:void(0);" onclick="$('#address-tab').trigger('click')">sổ địa chỉ</a> giao hàng và thanh toán và chỉnh sửa thông tin <a href="javascript:void(0);" onclick="$('#account-detail-tab').trigger('click')">hồ sơ cá nhân.</a></p>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
								<div class="card">
									<div class="card-header">
										<h3>Đơn hàng của tôi</h3>
									</div>
                                    <style>
                                        td{
                                            text-align: center
                                        }
                                    </style>
									<div class="card-body">
										<div class=" table table-responsive ">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th width="10%">#</th>
														<th>Sản phẩm</th>
														<th>Ngày đặt hàng</th>
														<th>Trạng thái</th>
														<th>Đơn giá</th>
														<th width="10%">Chi tiết</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($donhang as $item)
													@php
														$id_sp = DB::table('donhang_chitiet')->where('donhang_id',$item->id)->first();
													@endphp
													<tr>
														<td>#{{ $item->id }}</td>
														<td>{{ DB::table('sanpham')->where('id',$id_sp->sanpham_id)->first()->tensanpham}}</td>
														<td>{{ $item->created_at }}</td>
														<td>
                                                            <span style="padding: 10px" class="{{ DB::table('tinhtrang')->where('id',$item->tinhtrang_id)->first()->badge}}" >
                                                                {{ DB::table('tinhtrang')->where('id',$item->tinhtrang_id)->first()->tinhtrang }}
                                                            </span>
                                                        </td>
														<td>
                                                            {{ number_format(DB::table('donhang_chitiet')->where('donhang_id',$item->id)->first()->dongiaban) }}đ
                                                        </td>
														<td>
															<a href="{{route('client.donhang.chitiet',['donhang_id'=>$item->id])}}" style="padding: 10px" type="button" class="btn badge bg-secondary" >
																Chi tiết
                                                            </a>
														</td>
													</tr>
													@endforeach
                                                    <style>
                                                    td{
                                                        vertical-align: middle;
                                                    }
                                                    </style>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
								<div class="row">
									<div class="col-sm-12">
										<div class="card">
											<div class="card-header">
												<h3>Địa chỉ giao hàng</h3>
											</div>
											<div class="card-body">
												<address id="address">
                                                    <div id="info-address">
                                                        {{ Auth::user()->name }}<br />
                                                        {{ Auth::user()->diachi}} <br>
                                                        {{ Auth::user()->sodienthoai}}
                                                    </div>
                                                    <div id="edit-address" style="display: none">
                                                        <form id="edit-address-form" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="diachi">Địa chỉ</label>
                                                                <input class="form-control" value="{{Auth::user()->diachi}}" type="textarea" name="diachi">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="sodienthoai">Số điện thoại</label>
                                                                <input class="form-control" type="number" value="{{Auth::user()->sodienthoai}}" name="sodienthoai">
                                                            </div>
                                                            <button class="primary-btn">Cập nhật</button>
                                                        </form>
                                                    </div>
												</address>
												<a id="edit-address1" class="btn btn-fill-out">Chỉnh sửa</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
								<div class="card">
									<div class="card-header">
										<h3>Thông tin tài khoản</h3>
									</div>
									<div class="card-body">
                                        <form id="edit-user-form" method="POST">
										{{-- <form id="edit-user-form" data-action="{{ route('user.CapNhatHoSo') }}" method="post"> --}}
											@csrf
											<div class="form-group">
												<label>Họ và tên <span class="required">*</span></label>
												<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ Auth::user()->name }}" required />
												@error('name')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>
											<div class="form-group">
												<label>Địa chỉ Email <span class="required">*</span></label>
												<input id="email" class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ Auth::user()->email }}" required />
												@error('email')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>
											<div class="form-group">
												<label>Mật khẩu mới</label>
												<input id="password" class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Bỏ trống nếu muốn giữ nguyên mật khẩu cũ." />
												@error('password')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>
											<div class="form-group">
												<label>Xác nhận mật khẩu mới</label>
												<input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" type="password" placeholder="Bỏ trống nếu muốn giữ nguyên mật khẩu cũ." />
												@error('password_confirmation')
													<div class="invalid-feedback"><strong>{{ $message }}</strong></div>
												@enderror
											</div>

											<button id="btn-submit" class="primary-btn order-submit">Cập nhật thông tin</button>
										</form>
									</div>
								</div>
                                <script type="text/javascript">
                                var editBtn = document.getElementById('edit-address1');
                                var formEdit = document.getElementById('edit-address');
                                var address = document.getElementById('info-address');
                                editBtn.onclick = function(){
                                    if(formEdit.style.display == 'none'){
                                        formEdit.style.display = 'block';
                                        address.style.display = 'none';
                                    }else{
                                        formEdit.style.display = 'none'
                                        address.style.display = 'block';
                                    }

                                }
                                $(document).ready(function(){
                                var form = '#edit-user-form';
                                var form = '#edit-address-form';

                                $("#edit-user-form").on('submit',function(event){
                                    event.preventDefault();
                                    $.ajax({
                                        url: '{{route('user.capnhathoso')}}',
                                        type: 'POST',
                                        data: new FormData(this),
                                        dataType: 'JSON',
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        success:function(data)
                                        {
                                            // console.log(new FormData(this));
                                            $(form).trigger("reset");
                                            // alert(data.success)
                                            swal(data.title, data.info, data.status);
                                            // location.reload();
                                            console.log(data);
                                        },
                                        error: function(data) {
                                        }
                                    });
                                });

                                $("#edit-address-form").on('submit',function(event){
                                    event.preventDefault();
                                    $.ajax({
                                        url: '{{route('user.capnhatdiachi')}}',
                                        type: 'POST',
                                        data: new FormData(this),
                                        dataType: 'JSON',
                                        contentType: false,
                                        cache: false,
                                        processData: false,
                                        success:function(data)
                                        {
                                            // console.log(new FormData(this));
                                            $(form).trigger("reset");
                                            // alert(data.success)
                                            swal(data.title, data.info, data.status);
                                            // location.reload();
                                            console.log(data);
                                        },
                                        error: function(data) {
                                        }
                                    });
                                });

                                });
                                </script>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
