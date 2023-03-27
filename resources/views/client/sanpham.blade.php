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
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('client')}}">Trang chủ</a></li>
                        <li><a href="#">Sản phẩm</a></li>
                        <li class="active">{{$tenloai}} </li>
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
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <form action="" method="post">
                        @csrf
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Giá</h3>
                        <div class="price-filter">
                            <div id="price-slider"></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number" name="price-min">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number" name="price-max">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Thương hiệu</h3>
                        <div class="checkbox-filter">
                            @if (isset($hangsanxuat))
                                @foreach ($hangsanxuat as $value)
                                @php
                                    $hsx = DB::table('hangsanxuat')->where('id',$value->hangsanxuat_id)->get();
                                @endphp
                                    @foreach ($hsx as $item)
                                        <div class="input-checkbox">
                                            <input type="checkbox" id="brand-{{$item->id}}">
                                            <label for="brand-{{$item->id}}">
                                                <span></span>
                                                {{$item->tenhang}}
                                                <small>({{count(DB::table('sanpham')->where('hangsanxuat_id',$item->id)->get())}})</small>
                                            </label>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                        <button type="submit" class="primary-btn"><i class="fa-solid fa-magnifying-glass"></i>  Tìm</button>
                    </div>
                    <!-- /aside Widget -->
                    </form>
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Bán chạy</h3>
                        <div class="product-widget">
                            <div class="product-img">
                                <img src="./img/product01.png" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Lọc:
                                <form action="{{ route('client.sanpham') }}" method="post">
                                    @csrf
                                    @if(isset($tenloai))
										<input type="hidden" id="tenloai_slug" name="tenloai_slug" value="{{ Str::slug($tenloai, '-') }}" />
									@endif
                                {{-- <select class="input-select"> --}}
                                <select class="input-select" id="sapxep" name="sapxep" onchange="if(this.value != 0) { this.form.submit(); }">
                                    <option value="default" {{ session('sapxep') == 'default' ? 'selected' : '' }}>Sắp xếp mặc định</option>
									<option value="popularity" {{ session('sapxep') == 'popularity' ? 'selected' : '' }}>Mua nhiều nhất</option>
									<option value="date" {{ session('sapxep') == 'date' ? 'selected' : '' }}>Hàng mới nhất</option>
									<option value="price" {{ session('sapxep') == 'price' ? 'selected' : '' }}>Xếp theo giá: thấp đến cao</option>
									<option value="price-desc" {{ session('sapxep') == 'price-desc' ? 'selected' : '' }}>Xếp theo giá: cao xuống thấp</option>
                                </select>
                                </form>
                            </label>

                            <label>
                                Hiển thị:
                                <select class="input-select">
                                    <option value="0">20</option>
                                    <option value="1">50</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        @foreach ($sanpham as $item)
                        <!-- product -->
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{ env('APP_URL') . '/storage/app/sanpham/' . $item->hinhanh }}" alt="">
                                    <div class="product-label">
                                        <span class="sale">-10%</span>
                                        <span class="new">MỚI</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first()->tenloai}}</p>
                                    <h3 class="product-name">
                                        <a href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
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
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">yêu thích</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">thêm vào so sánh</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <form action="{{route('client.giohang.them')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="tensanpham_slug" value="{{$item->tensanpham_slug}}">
                                        <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> thêm vào giỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /product -->

                        <div class="clearfix visible-sm visible-xs"></div>
                        @endforeach
                    </div>
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        {{-- <span class="store-qty">Showing 20-100 products</span> --}}
                        {{-- <ul class="store-pagination">
                            <li class="active">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul> --}}
                        {{$sanpham->links()}}
                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
