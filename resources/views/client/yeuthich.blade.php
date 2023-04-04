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
                    <h3 class="breadcrumb-header">Sản phẩm yêu thích</h3>
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
                        <table class="table table-bordered" id="table_wishlist">
                            <thead>
                                <tr class="danger">
                                    <th class="product-thumbnail">&nbsp;Hình</th>
                                    <th class="product-name">Sản phẩm</th>
                                    <th class="product-price">Đơn giá</th>
                                    <th class="product-storage">Xem</th>
                                    <th class="product-remove">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-lg-4 col-md-8 mb-3 t1">
                                                <div class="coupon field_form input-group t">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Mã giảm giá?" />
                                                </div>
                                                    <input class="primary-btn order-submit" type="submit"></button>
                                            </div>
                                            <div class="col-lg-8 col-md-4">
                                                <a style="cursor: pointer; float: right;" onclick="deleteAllWishlist()" class="primary-btn">XÓA GIỎ HÀNG</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <style>
                table{
                    border-radius: 20px;
                }
                td{
                    text-align: center;
                    vertical-align: middle;
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
        </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
