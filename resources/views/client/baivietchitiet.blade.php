@extends('layouts.client')

@section('title', $tenloai ? $tenloai : 'Tin tức')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Tin tức</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{route('client')}}">Trang chủ</a></li>
                        <li class="active">{{$baiviet->tieude}}</li>
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
                <div class="col-md-8">
                    <h3>{{$baiviet->tieude}}</h3>
                    <i class="fa-solid fa-calendar-days text-danger"></i><h7> {{$baiviet->created_at}}</h7>&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa-solid fa-user text-danger"></i><a style="pointer:cursor;"> {{ $author->name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="fa-solid fa-eye" style="color: #db0000;"></i><a> {{$baiviet->luotxem}}</a>
                    <br><br>
                    <div class="rosw">
                        <img src="{{ env('APP_URL') . '/images/' . $baiviet->thumbnail }}" width="800px" alt="">
                    </div>
                    <br>
                    <div class="row content">
                        @php
                            echo $baiviet->noidung;
                        @endphp
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <div class="ads">
                        <img src="https://gstatic.gvn360.com/2023/01/1_SIDE-WEB.png" alt="">
                    </div>
                    <div class="post_viewed">
                        @foreach (session('baivietvuaxem') as $item)
                            <div>
                                {{$item->tieude}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
