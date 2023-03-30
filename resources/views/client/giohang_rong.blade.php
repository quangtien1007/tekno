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
                    <h3 class="breadcrumb-header">Giỏ hàng</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('client')}}">Home</a></li>
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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="text-center order_complete">
                        <i style="font-size: 40px" class="fal fa-shopping-cart"></i>
                        <div class="heading_s1">
                            <h3>Giỏ hàng chưa có sản phẩm!</h3>
                        </div>
                        <p>Giỏ hàng của bạn đang rỗng, xin hãy lấp đầy nó bằng việc duyệt qua các sản phẩm của cửa hàng và bỏ vào giỏ các sản phẩm mà bạn yêu thích và có ý định sẽ sở hữu nó.</p>
                        <a href="{{ route('client') }}" class="primary-btn">TIẾP TỤC MUA SẮM</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
