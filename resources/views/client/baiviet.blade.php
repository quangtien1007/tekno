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
                    <h3 class="breadcrumb-header">Tin tức</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Home</a></li>
                        <li class="active">Tin tức</li>
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
                <div>
                    <div class="row justify-content-center">
                        <div class="col">
                            <a href="">
                                <img src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100/https://cdn.tgdd.vn/2023/03/banner/jgid-1920x450.jpg" alt="Los Angeles" class="d-block" style="width:100%">
                            </a>
                        </div>
                    </div>
                    <br>
                    <h3>Tin mới nhất</h3>
                    <div class="row"style="background: rgb(239, 239, 239);border-radius:10px">
                        @foreach($baiviet as $value)
                        <div class="col-lg-12 col-md-4 col-6">
                                        <div class="news">
                                            <div class="news-thumbnail col-md-12">
                                                <a href="{{ route('client.baivietchitiet', ['tieude_slug' => $value->tieude_slug]) }}">
                                                    <img width="300" src="{{ env('APP_URL') . '/storage/app/' . $value->thumbnail }}" />
                                                </a>
                                            </div>
                                            <div class="news-info">
                                                <div class="news-title">
                                                    <a href="{{ route('client.baivietchitiet', ['tieude_slug' => $value->tieude_slug]) }}">
                                                        <strong>{{$value->tieude}}</strong>
                                                    </a>
                                                </div>
                                                <div class="des">
                                                    <div class="compact_content">
                                                        @php
                                                            echo $value->noidung;
                                                            $author = DB::table('users')->where('id',$value->author_id)->first();
                                                        @endphp
                                                    </div>
                                                </div>
                                                <div class="news-footer">
                                                    <i class="fa-solid fa-calendar-days"></i><h7> {{$value->created_at}}</h7>&nbsp;&nbsp;&nbsp;&nbsp;
                                                   <i class="fa-solid fa-user"></i><a style="pointer:cursor;"> {{ $author->name}}</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                   <i class="fa-solid fa-eye" ></i><a> {{$value->luotxem}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach
                                    <style>
                                    </style>
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
