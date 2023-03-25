@extends('layouts.client')

@section('title', 'Home')

@section('content')
        @php
			$var = DB::table('sanpham')->where('id',$sanpham->id)->first();
			$images = explode('|',$var->hinhanhmota);
		@endphp
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="{{route('client')}}">Trang chủ</a></li>
							<li><a href="{{ route('client.sanpham.danhmuc', ['tenloai_slug' => $loaisanpham->tenloai_slug]) }}">{{ $loaisanpham->tenloai }}</a></li>
							<li><a href="#">{{ $sanpham->tensanpham }}</a></li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<img src="{{ env('APP_URL') . '/storage/app/sanpham/' . $sanpham->hinhanh}}"  alt="">
							</div>
                            @foreach ($images as $item)
							<div class="product-preview">
								<img src="{{env('APP_URL').$item}}" alt="s"/>
							</div>
                            @endforeach
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<img src="{{ env('APP_URL') . '/storage/app/sanpham/' . $sanpham->hinhanh}}"  alt="">
							</div>

                            @foreach ($images as $item)
							<div class="product-preview">
								<img src="{{env('APP_URL').$item}}"/>
							</div>
                            @endforeach
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
                        <form action="{{route('client.giohang.them')}}" method="post">
                            @csrf
						<div class="product-details">
							<h2 class="product-name">{{$sanpham->tensanpham}}</h2>
                            <input type="hidden" name="tensanpham_slug" value="{{$sanpham->tensanpham_slug}}">
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Review(s) | Add your review</a>
							</div>
							<div>
								<h4 class="product-price">{{number_format($sanpham->dongia)}}<sup>đ</sup>
                                    <del class="product-old-price">{{number_format($sanpham->dongia + ($sanpham->dongia*0.1))}}<sup>đ</sup></del>
                                </h4>
								<span class="product-available">In Stock</span>
							</div>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

							<div class="product-options">
								<label>
									D.Lượng
									<select name="dlsp" class="input-select">
                                        @foreach ($dl->where('sanpham_id',$sanpham->id) as $item)
										<option value="{{$item->dungluong}}">{{$item->dungluong}}</option>
                                        @endforeach
									</select>
								</label>
								<label>
									Màu
									<select name="msp" class="input-select">
                                        @foreach ($msp->where('sanpham_id',$sanpham->id) as $item)
										<option value="{{$item->mau}}">{{$item->mau}}</option>
                                        @endforeach
									</select>
								</label>
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input name="qty" type="number" value="1" readonly>
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> thêm vào giỏ</button>
							</div>

                        </form>
							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> yêu thích</a></li>

							</ul>

							<ul class="product-links">
								<li>Category:</li>
								<li><a href="#">Tai nghe</a></li>
								<li><a href="#">Accessories</a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>

					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Mô tả sản phẩm</a></li>
								<li><a data-toggle="tab" href="#tab2">Thông số kỹ thuật</a></li>
								<li><a data-toggle="tab" href="#tab3">Đánh giá (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											@php
                                                echo $sanpham->motasanpham;
                                            @endphp
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<p>
                                            </p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
                                                    @php
                                                    $danhgia = DB::table('danhgia')->where('sanpham_id',$sanpham->id)->get();
                                                    @endphp
                                                    @foreach ($danhgia as $item)
													<li>
														<div class="review-heading">
															<h5 class="name">{{DB::table('users')->where('id',$item->user_id)->first()->name}}</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
                                                                @if(isset($item->sao))
                                                                    @for ($i = 0; $i < $item->sao; $i++)
                                                                    <i class="fa fa-star"></i>
                                                                    @endfor
                                                                    @for ($i = 0; $i < 5 - $item->sao; $i++)
                                                                    <i class="fa fa-star-o empty"></i>
                                                                    @endfor
                                                                @endif
															</div>
														</div>
														<div class="review-body">
															<p>{{$item->noidung}}</p>
														</div>
													</li>
                                                    @endforeach
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
                                        <!-- /Reviews -->
                                        <?php
                                        if (Auth::user()) {
                                            $is_danhgia = DB::table('danhgia')->where('user_id',Auth::user()->id)->where('sanpham_id',$sanpham->id)->first();
                                            $donhang = DB::table('donhang')->where('user_id',Auth::user()->id)->where('tinhtrang_id',8)->first();//Đơn hàng thành công
                                        ?>
                                        @if ($donhang && !$is_danhgia)
										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form" action="{{route('client.danhgia')}}" method="POST">
                                                    @csrf
													<input class="input" type="text" name="ten" placeholder="Tên của bạn">
													<textarea class="input" name="noidung" placeholder="Đánh giá của bạn"></textarea>
													<div class="input-rating">
														<span>Đánh giá: </span>
														<div class="stars">
															<input id="star5" name="sao" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="sao" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="sao" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="sao" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="sao" value="1" type="radio"><label for="star1"></label>
                                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                                            <input type="hidden" name="sanpham_id" value="{{$sanpham->id}}">
														</div>
													</div>
													<button type="submit" class="primary-btn">Gửi đánh giá</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
                                        @endif
                                        <?php } ?>
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Sản phẩm tương tự</h3>
						</div>
					</div>
                    @foreach($sanphamlienquan as $value)
                    @php
                        $tenloai = DB::table('loaisanpham')->where('id',$value->loaisanpham_id)->first();
                    @endphp
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="{{ env('APP_URL') . '/storage/app/sanpham/' . $value->hinhanh }}" alt="">
								<div class="product-label">
									<span class="sale">-10%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">{{DB::table('loaisanpham')->where('id',$sanpham->loaisanpham_id)->first()->tenloai}}</p>
								<h3 class="product-name">
                                    <a id="url{{$value->id}}" href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $tenloai->tenloai_slug, 'tensanpham_slug' => $value->tensanpham_slug]) }}">{{ $value->tensanpham }}</a>
                                </h3>
								<h4 class="product-price">{{number_format($value->dongia)}}
                                    <del class="product-old-price">{{number_format($value->dongia + ($value->dongia*0.1))}}</del>
                                </h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">yêu thích</span></button>
									<button onclick="addToCompare({{$value->id}})" class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">thêm vào so sánh</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> thêm vào giỏ</button>
							</div>
                              <!-- input hidden de so sanh san pham -->
                              <input type="hidden" value="{{$value->tensanpham}}" id="name{{$value->id}}">
                              <input type="hidden" value="{{$value->dongia}}" id="price{{$value->id}}">
                              <input type="hidden" value="{{ env('APP_URL') . '/storage/app/sanpham/'.$value->hinhanh }}" id="image{{$value->id}}">
                               <!-- /input hidden de so sanh san pham -->
						</div>
					</div>
					<!-- /product -->
                    @endforeach

					<div class="clearfix visible-sm visible-xs"></div>
                       <!-- Modal -->
                  <div class="container">
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                      <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                            <h4 class="modal-title">So sánh sản phẩm (Tối đa 3 sản phẩm)</h4>
                          </div>
                          <div class="modal-body">
                            <table class="table" id="row_compare">
                                <thead>
                                  <tr>
                                      <th>Hỉnh ảnh</th>
                                      <th>Sản phẩm</th>
                                      <th>Giá</th>
                                        <th>Thông số kỹ thuật</th>
                                  </tr>
                                </thead>
                                <tbody>

                                </tbody>
                              </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
@endsection
