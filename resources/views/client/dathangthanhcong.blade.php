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
                    <h3 class="breadcrumb-header">Đặt hàng thành công</h3>
                    <ul class="breadcrumb-tree">
                        <li class="active"><a href="{{route('client')}}">Trang chủ</a></li>
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
                    <i style="font-size:30pt" class="fal fa-check-circle"></i>
                    <div class="heading_s1">
                        <h3>Bạn đã đặt hàng thành công!</h3>
                    </div>
                    <p>Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đang được xử lý và sẽ hoàn thành trong vòng 3-6 giờ. Bạn sẽ nhận được một email xác nhận khi đơn đặt hàng của bạn được hoàn thành.</p>
                    <a href="{{ route('client') }}" class="btn btn-fill-out">TIẾP TỤC MUA SẮM</a>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
