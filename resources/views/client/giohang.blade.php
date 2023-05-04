@extends('layouts.client')

@section('title', 'Giỏ hàng')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Giỏ hàng</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('client')}}">Trang chủ</a></li>
                        <li class="active">Giỏ hàng</li>
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
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="danger">
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Sản phẩm</th>
                                    <th class="product-price">Đơn giá</th>
                                    <th class="product-storage">Dung lượng</th>
                                    <th class="product-color">Màu</th>
                                    <th class="product-quantity">Số lượng</th>
                                    <th class="product-subtotal">Thành tiền</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Cart::content() as $value)
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img width="100" src="{{ env('APP_URL') . '/images/sanpham/' . $value->options->image }}" /></a></td>
                                        <td class="product-name" data-title="Product"><a href="#">{{ $value->name }}</a></td>
                                        <td class="product-price" data-title="Price">{{ number_format($value->price) }}<sup>đ</sup></td>
                                        <td class="product-storage" data-title="Storage">
                                            <a href="#">{{ $value->storage }}
                                            </a>
                                        </td>
                                        <td class="product-color" data-title="Color"><a href="#">{{ $value->color }}</a></td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity">
                                                <a class="minus" href="{{ route('client.giohang.down', ['row_id' => $value->rowId]) }}"><i class="fa-solid fa-minus"></i></a>
                                                <input readonly type="text" name="qty" value="{{ $value->qty }}" class="qty" size="4" />
                                                <a class="plus" href="{{ route('client.giohang.up', ['row_id' => $value->rowId]) }}"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">{{ number_format($value->price * $value->qty) }}<sup>đ</sup></td>
                                        <td class="product-remove" data-title="Remove"><a href="{{ route('client.giohang.delete', ['row_id' => $value->rowId]) }}"><i class="fa-solid fa-xmark"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <style>
                                input[type="text"]{
                                    text-align: center;
                                }
                                td{
                                    vertical-align: middle;
                                }
                            </style>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-sm-4 col-md-8 mb-3 t1">
                                                <div class="coupon field_form input t" style="margin-top: 10px">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Mã giảm giá?" />
                                                </div>
                                                    <input class="primary-btn order-submit" type="submit"></button>
                                            </div>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-sm-8 col-md-12">
                                            <a style="float: right;" href="{{ route('client.giohang.destroy') }}" class="primary-btn order-submit" type="submit">XÓA GIỎ HÀNG</a>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <style>
                td{
                    text-align: center;
                    vertical-align: center;
                }
                div.t1 { display: table; }
                div.t {
                    display: table-cell;
                    width: 100%;
                }
                div.t > input {
                    width: 100%;
                }
            </style>
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="border p-3 p-md-4">
                        <div class="heading_s1 mb-3">
                            <h4>Tổng tiền giỏ hàng</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="cart_total_label">Tổng tiền sản phẩm</td>
                                        <td class="cart_total_amount">{{ Cart::subtotal() }}<sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Thuế VAT (10%)</td>
                                        <td class="cart_total_amount">{{ Cart::tax() }}<sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Phí vận chuyển</td>
                                        <td class="cart_total_amount">Miễn phí vận chuyển</td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Tổng thanh toán</td>
                                        <td class="cart_total_amount"><strong>{{ number_format(Cart::total()) }}<sup>đ</sup></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('client.dathang.create') }}" class="primary-btn order-submit">TIẾN HÀNH THANH TOÁN</a>
                    </div>
                </div>
            </div>
        </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
