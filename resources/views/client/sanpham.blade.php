@extends('layouts.client')

@section('title', $tenloai ? $tenloai : 'Sản phẩm')

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
                    <form action="{{route('client.sanpham.search')}}" method="post">
                        @csrf
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Giá</h3>
                        <div class="price-filter">
                            {{-- <div id="slider-formatr"></div> --}}
                            {{-- <input type="number" id="input-formatr"> --}}
                            <div id="price-slider"></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="text" name="price_min">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="text" name="price_max">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        {{-- <input type="hidden" name="loaisanpham_id" value="{{$lsp->id}}"> --}}
                    </div>
                    <br>
                    <button type="submit" class="primary-btn"><i class="fa-solid fa-magnifying-glass"></i>  Tìm</button>
                </form>
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
                                                <a href="{{route('client.sanpham.danhmucchitiet',['tenloai_slug'=> $lsp->tenloai_slug,'tenhang_slug'=>$item->tenhang_slug])}}">
                                                    <img src="{{ env('APP_URL') . '/images/' . $item->hinhanh }}" width="100" class="img-thumbnail" />
                                                    </a>
                                                <a>({{count(DB::table('sanpham')->where('hangsanxuat_id',$item->id)->where('loaisanpham_id',$lsp->id)->get())}})</a>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Bán chạy</h3>
                        @foreach (getSanPhamBanChay() as $item)
                        @php
                            $banchay = DB::table('sanpham')->where('id',$item->sanpham_id)->get();
                        @endphp
                        @foreach ($banchay as $value)
                        <div class="product-widget">
                            <div class="product-img">
                                <img src="{{ env('APP_URL').'/images/sanpham/'. $value->hinhanh}}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{DB::table('loaisanpham')->where('id',$value->loaisanpham_id)->first()->tenloai}}</p>
                                <h3 class="product-name">
                                    <a href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => DB::table('loaisanpham')->where('id',$value->loaisanpham_id)->first()->tenloai_slug, 'tensanpham_slug' => $value->tensanpham_slug]) }}">
                                    {{$value->tensanpham}}
                                    </a>
                                </h3>
                                <h4 class="product-price">
                                    {{number_format($value->dongia)}}
                                    <del class="product-old-price">{{number_format($value->dongia + ($value->dongia*0.1))}}<sup>đ</sup></del>
                                </h4>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
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
                                <form action="{{ route('client.sanpham.search') }}" method="post">
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
                        @php
                            $lsp = DB::table('loaisanpham')->where('id',$item->loaisanpham_id)->first();
                        @endphp
                        <!-- product -->
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="{{ env('APP_URL') . '/images/sanpham/' . $item->hinhanh }}" alt="">
                                    <div class="product-label">
                                        <span class="sale">-10%</span>
                                        <span class="new">MỚI</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$lsp->tenloai}}</p>
                                    <h3 class="product-name">
                                        <a id="url{{$item->id}}" href="{{ route('client.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $item->tensanpham_slug]) }}">{{ $item->tensanpham }}</a>
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
                        </div>
                        <!-- /product -->

                        <div class="clearfix visible-sm visible-xs"></div>
                         <!-- input hidden de so sanh san pham -->
                         <input type="hidden" value="{{$item->loaisanpham_id}}" id="cate{{$item->id}}">
                         <input type="hidden" value="{{$item->thongsokythuat}}" id="tskt{{$item->id}}">
                         <input type="hidden" value="{{$item->loaisanpham}}" id="cate{{$item->id}}">
                         <input type="hidden" value="{{$item->tensanpham}}" id="name{{$item->id}}">
                         <input type="hidden" value="{{$item->dongia}}" id="price{{$item->id}}">
                         <input type="hidden" value="{{ env('APP_URL') . '/images/sanpham/'.$item->hinhanh }}" id="image{{$item->id}}">
                          <!-- /input hidden de so sanh san pham -->
                        @endforeach
                    </div>
                    <!-- /store products -->
                   <!-- Modal -->
                   <div class="container">
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                      <div style="width: 1200px" class="modal-dialog modal-xl">

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
                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
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
