@extends('layouts.client')

@section('title', 'Đặt hàng')

@section('content')
 <!-- BREADCRUMB -->
 <div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Đặt hàng</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{route('client')}}">Trang chủ</a></li>
                    <li class="active">Đặt hàng</li>
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

            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Thông tin đặt hàng</h3>
                    </div>
                    {{-- <style>
                        input{
                            text-align:top;
                        }
                    </style> --}}
                    <form action="{{route('client.dathang.add')}}" method="post" id="checkoutform">
                        @csrf
                            <div class="form-group">
                                <input type="text" style="text-align: top" class="input" name="name" placeholder="Họ và tên *" value="{{ Auth::user()->name ?? '' }}" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="input" name="email" placeholder="Địa chỉ Email *" value="{{ Auth::user()->email ?? '' }}" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="input" name="diachigiaohang" placeholder="Địa chỉ giao hàng *" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="input" name="dienthoaigiaohang" placeholder="Điện thoại *" required />
                            </div>
                            @guest
                            <div class="form-group">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="create-account" name="createaccount">
                                    <label for="create-account">
                                        <span></span>
                                        Create Account?
                                    </label>
                                    <div class="caption">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                                        <input class="input" type="password" name="password" placeholder="Enter Your Password">
                                    </div>
                                </div>
                            </div>
                            @endguest
                        </div>
                        <!-- /Billing Details -->

                        <!-- Shiping Details -->
                        <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">ĐỊA CHỈ GIAO HÀNG KHÁC</h3>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address">
                                <label for="shiping-address">
                                    <span></span>
                                    Giao tới một địa chỉ khác?
                                </label>
                                <div class="caption">
                                    <div class="form-group">
                                        <input type="text" class="input" name="name2" placeholder="Họ và tên *" value="{{ Auth::user()->name ?? '' }}"  />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="input" name="email2" placeholder="Địa chỉ Email *" value="{{ Auth::user()->email ?? '' }}"  />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="input" name="diachigiaohang2" placeholder="Địa chỉ giao hàng *"  />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="input" name="dienthoaigiaohang2" placeholder="Điện thoại *"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Shiping Details -->

                        <!-- Order notes -->
                        <div class="order-notes">
                            <textarea class="input" placeholder="Ghi chú.."></textarea>
                        </div>
                        <!-- /Order notes -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">ĐƠN HÀNG CỦA BẠN</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>SẢN PHẨM</strong></div>
                                <div><strong>TỔNG CỘNG</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach(Cart::content() as $value)
                                <div class="order-col">
                                    <div>{{ $value->name }}<span class="product-qty">- {{$value->color}} - {{$value->storage}} x {{ $value->qty }}</span></div>
                                    <div>{{ number_format($value->price * $value->qty) }}<sup>đ</sup></div>
                                </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div>Tiền ship</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div>Tổng tiền sản phẩm</div>
                                <div><strong>{{ Cart::subtotal() }}<sup>đ</sup></strong></div>
                            </div>
                            <div class="order-col">
                                <div>Thuế VAT(10%)</div>
                                <div><strong>{{ Cart::tax() }}<sup>đ</sup></strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TỔNG THANH TOÁN</strong></div>
                                <div><strong class="order-total">{{ number_format(Cart::total()) }}<sup>đ</sup></strong></div>
                            </div>
                        </div>
                        <div class="order-col">
                            <div><strong>PHƯƠNG THỨC THANH TOÁN</strong></div>
                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input checked type="radio" name="payment_opt" id="payment-1" value="cod">
                                <label for="payment-1">
                                    <span></span>
                                    COD (Thanh toán khi nhận hàng)
                                </label>
                                <div class="caption">
                                    <p>Thanh toán khi đơn hàng đến tay của bạn</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment_opt" id="payment-2" value="vnpay">
                                <label for="payment-2">
                                    <span></span>
                                    Ví điện tử VNPay
                                </label>
                                <div class="caption">
                                    <p>Thanh toán online qua ví điện tử VNPay</p>
                                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR.png" width="100" alt="">
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment_opt" id="payment-3" value="paypal">
                                <label for="payment-3">
                                    <span></span>
                                    Thanh toán bằng Paypal
                                </label>
                                <div class="caption">
                                    <p>Thanh toán online qua ngân hàng điện tử quốc tế - Paypal</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                Tôi đã đọc và chấp nhận <a href="#"><strong>chính sách bảo mật</strong></a>
                            </label>
                        </div>
                        <input type="hidden" name="redirect" id="">
                        <button type="submit" class="primary-btn order-submit">Thanh toán</a>
                </form>
            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
@endsection
