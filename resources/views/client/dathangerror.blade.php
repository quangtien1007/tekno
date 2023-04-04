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
                    <h3 class="breadcrumb-header">Có lỗi khi đặt hàng</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('client')}}">Trang chủ</a></li>
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
                <div class="text-center order_complete">
                    <i class="fal fa-check-circle"></i>
                    <div class="heading_s1">
                        <h3>Đặt hàng không thành công!</h3>
                    </div>
                    <p>Có lỗi khi đặt hàng! Vui lòng thử đặt hàng ! </p>
                    <a href="{{ route('client') }}" class="btn btn-fill-out">TIẾP TỤC MUA SẮM</a>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
