@extends('layouts.client')

@section('title')

@section('content')
<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
                                <img src="{{ env('APP_URL') . '/images/index/poster_macbook.jpg' }}" alt="">
							</div>
							<div class="shop-body">
                                <h3>Laptop<br>Giảm giá</h3>
								<a href="{{route('client.sanpham.danhmuc',['tenloai_slug'=>'laptop'])}}" class="cta-btn">khám phá ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                <img src="{{ env('APP_URL') . '/images/index/poster_headphones.jpg' }}" alt="">
                            </div>
							<div class="shop-body">
                                <h3>Phụ kiện<br>Giảm giá</h3>
								<a href="{{route('client.sanpham.danhmuc',['tenloai_slug'=>'tai-nghe'])}}" class="cta-btn">khám phá ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
                        <div class="shop">
                            <div class="shop-img">
                                {{-- {{dd(env('APP_URL'))}} --}}
                                <img src="{{ env('APP_URL') . '/images/index/poster_iphone.jpg' }}" alt="">
							</div>
							<div class="shop-body">
								<h3>Điện thoại<br>Giảm giá</h3>
								<a href="{{route('client.sanpham.danhmuc',['tenloai_slug'=>'dien-thoai'])}}" class="cta-btn">khám phá ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản phẩm mới</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Điện thoại</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
                                        @foreach ($sanpham as $item)
                                        @php
                                            $tenloai = DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first();
                                        @endphp
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{ env('APP_URL') . '/images/sanpham/'.$item->hinhanh }}" alt="">
												<div class="product-label">
													<span class="sale">-10%</span>
													<span class="new">MỚI</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first()->tenloai}}</p>
												<h3 class="product-name">
                                                    <a id="url{{$item->id}}" href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $tenloai->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
                                                </h3>
												<h4 class="product-price">{{number_format($item->dongia)}}<sup>đ</sup>
                                                    <del class="product-old-price">{{number_format($item->dongia + ($item->dongia*0.1))}}<sup>đ</sup></del>
                                                </h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
                                                    <div class="product-btns">
                                                        <button onclick="addToWishlist({{$item->id}})" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào yêu thích</span></button>
                                                        <button onclick="addToCompare({{$item->id}})" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">thêm vào so sánh</span></button>
												</div>
											</div>
											<div class="add-to-cart">
                                                <form action="{{route('client.giohang.add')}}" method="post">
                                                    @csrf
                                                    @php
                                                        $dungluong_mau = DB::table('dungluong_mau')->where('sanpham_id',$item->id)->first();
                                                    @endphp
                                                    <input type="hidden" name="tensanpham_slug" value="{{$item->tensanpham_slug}}">
                                                    <input type="hidden" name="dlsp" value="{{DB::table('dungluong')->where('id',$dungluong_mau->dungluong_id)->first()->dungluong}}">
                                                    <input type="hidden" name="msp" value="{{DB::table('mau')->where('id',$dungluong_mau->mau_id)->first()->mau}}">
                                                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                </form>
											</div>
                                            <!-- input hidden de so sanh san pham -->
                                            <input type="hidden" value="{{$item->loaisanpham_id}}" id="cate{{$item->id}}">
                                            <input type="hidden" value="{{$item->tensanpham}}" id="name{{$item->id}}">
                                            <input type="hidden" value="{{$item->thongsokythuat}}" id="tskt{{$item->id}}">
                                            <input type="hidden" value="{{$item->dongia}}" id="price{{$item->id}}">
                                            <input type="hidden" value="{{$item->thongsokythuat}}" id="tskt{{$item->id}}">
                                            <input type="hidden" value="{{ env('APP_URL') . '/images/sanpham/'.$item->hinhanh }}" id="image{{$item->id}}">
                                             <!-- /input hidden de so sanh san pham -->
										</div>
										<!-- /product -->
                                        @endforeach
										<!-- /product -->

									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- Products tab & slick -->
				</div>
                  <!-- Modal -->
                  <div class="container">
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                      <div style="width:1200px" class="modal-dialog modal-xl">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                              <h4 style="float: left;position:fixed;" class="modal-title">So sánh sản phẩm (Tối đa 2 sản phẩm)</h4>
                              <button style="position: absolute;right:20px;" type="button" class="close" data-dismiss="modal"><i class="fa-solid fa-xmark fa-lg"></i></button>
                          </div>
                          <style>
                            td{
                                text-align: center;
                                vertical-align: middle;
                            }
                          </style>
                          <div class="row modal-body" id="row_compare"></div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3 id="days">02</h3>
										<span>Ngày</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="hours">10</h3>
										<span>Giờ</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="minutes">34</h3>
										<span>Phút</span>
									</div>
								</li>
								<li>
									<div>
										<h3 id="seconds">60</h3>
										<span>Giây</span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">deal hot trong tuần</h2>
							<p>Giảm giá sản phẩm đến 50%</p>
							<a class="primary-btn cta-btn" href="#">Mua ngay</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Laptop bán chạy</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab2">Laptop</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
                                        @foreach ($laptop1 as $item)
                                        @php
                                            $tenloai = DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first();
                                        @endphp
										<!-- product -->
										<div class="product">
											<div class="product-img">
												<img src="{{env('APP_URL') . '/images/sanpham/'.$item->hinhanh}}" alt="">
												<div class="product-label">
													<span class="sale"> -10%</span>
													<span class="new">MỚI</span>
												</div>
											</div>
											<div class="product-body">
												<p class="product-category">{{DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first()->tenloai}}</p>
												<h3 class="product-name">
                                                    <a id="url{{$item->id}}" href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $tenloai->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
                                                </h3>
												<h4 class="product-price">{{number_format($item->dongia)}}<sup>đ</sup>
                                                    <del class="product-old-price">{{number_format($item->dongia + ($item->dongia*0.1))}}<sup>đ</sup></del>
                                                </h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
													<button onclick="addToWishlist({{$item->id}})" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">yêu thích</span></button>
													<button onclick="addToCompare({{$item->id}})" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">thêm vào so sánh</span></button>
												</div>
											</div>
											<div class="add-to-cart">
												<form action="{{route('client.giohang.add')}}" method="post">
                                                    @csrf
                                                    @php
                                                        $dungluong_mau = DB::table('dungluong_mau')->where('sanpham_id',$item->id)->first();
                                                    @endphp
                                                    <input type="hidden" name="tensanpham_slug" value="{{$item->tensanpham_slug}}">
                                                    <input type="hidden" name="dlsp" value="{{DB::table('dungluong')->where('id',$dungluong_mau->dungluong_id)->first()->dungluong}}">
                                                    <input type="hidden" name="msp" value="{{DB::table('mau')->where('id',$dungluong_mau->mau_id)->first()->mau}}">
                                                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
                                                </form>
											</div>
										</div>
										<!-- /product -->
                                         <!-- input hidden de so sanh san pham -->
                                         <input type="hidden" value="{{$item->loaisanpham_id}}" id="cate{{$item->id}}">
                                         <input type="hidden" value="{{$item->tensanpham}}" id="name{{$item->id}}">
                                         <input type="hidden" value="{{$item->dongia}}" id="price{{$item->id}}">
                                         <input type="hidden" value="{{$item->thongsokythuat}}" id="tskt{{$item->id}}">
                                         <input type="hidden" value="{{ env('APP_URL') . '/images/sanpham/'.$item->hinhanh }}" id="image{{$item->id}}">
                                          <!-- /input hidden de so sanh san pham -->
                                        @endforeach
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="section-title">
							<h4 class="title">Phụ kiện</h4>
							<div class="section-nav">
								<div id="slick-nav-3" class="products-slick-nav"></div>
							</div>
						</div>

						<div class="products-widget-slick" data-nav="#slick-nav-3">
							<div>
                                <!-- product widget -->
                                @foreach ($tainghe as $item)
                                @php
                                    $tenloai = DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first();
                                @endphp
								<div class="product-widget">
									<div class="product-img">
										<img src="{{env('APP_URL') . '/images/sanpham/'.$item->hinhanh}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first()->tenloai}}</p>
										<h3 class="product-name">
                                            <a href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $tenloai->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
                                        </h3>
                                        <h4 class="product-price">{{number_format($item->dongia)}}<sup>đ</sup>
                                            <del class="product-old-price">{{number_format($item->dongia + ($item->dongia*0.1))}}<sup>đ</sup></del>
                                        </h4>
									</div>
								</div>
                                <!-- /product widget -->
                                @endforeach
							</div>

							<div>
                                @foreach ($cusac as $item)
								<div class="product-widget">
									<div class="product-img">
										<img src="{{env('APP_URL') . '/images/sanpham/'.$item->hinhanh}}" alt="">
									</div>
									<div class="product-body">
										<p class="product-category">{{DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first()->tenloai}}</p>
                                        <h3 class="product-name">
                                            <a href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $tenloai->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
                                        </h3>
                                        <h4 class="product-price">{{number_format($item->dongia)}}<sup>đ</sup>
                                            <del class="product-old-price">{{number_format($item->dongia + ($item->dongia*0.1))}}<sup>đ</sup></del>
                                        </h4>
									</div>
								</div>
                                <!-- /product widget -->
                                @endforeach
							</div>
						</div>
					</div>

					<div class="col-md-6 col-xs-6">
						<div class="section-title">
							<h4 class="title">Bán chạy</h4>
							<div class="section-nav">
								<div id="slick-nav-4" class="products-slick-nav"></div>
							</div>
						</div>
						<div class="products-widget-slick" data-nav="#slick-nav-4">
							<div>
								 <!-- product widget -->
                                 @foreach ($tablet as $item)
                                 <div class="product-widget">
                                     <div class="product-img">
                                         <img src="{{env('APP_URL') . '/images/sanpham/'.$item->hinhanh}}" alt="">
                                     </div>
                                     <div class="product-body">
                                         <p class="product-category">{{DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first()->tenloai}}</p>
                                         <h3 class="product-name">
                                            <a href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $tenloai->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
                                        </h3>
                                         <h4 class="product-price">{{number_format($item->dongia)}}<sup>đ</sup>
                                             <del class="product-old-price">{{number_format($item->dongia + ($item->dongia*0.1))}}<sup>đ</sup></del>
                                         </h4>
                                     </div>
                                 </div>
                                 <!-- /product widget -->
                                 @endforeach
							</div>
							<div>
								 <!-- product widget -->
                                 @foreach ($laptop as $item)
                                 <div class="product-widget">
                                     <div class="product-img">
                                        <img src="{{env('APP_URL') . '/images/sanpham/'.$item->hinhanh}}" alt="">
                                     </div>
                                     <div class="product-body">
                                         <p class="product-category">{{DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first()->tenloai}}</p>
                                         <h3 class="product-name">
                                            <a href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $tenloai->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
                                        </h3>
                                         <h4 class="product-price">{{number_format($item->dongia)}}<sup>đ</sup>
                                             <del class="product-old-price">{{number_format($item->dongia + ($item->dongia*0.1))}}<sup>đ</sup></del>
                                         </h4>
                                     </div>
                                 </div>
                                 <!-- /product widget -->
                                 @endforeach
							</div>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Đăng ký để nhận thông báo <strong>KHUYẾN MÃI</strong></p>
							<form>
								<input class="input" type="email" placeholder="Nhập email của bạn">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Đăng ký</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->
@endsection
