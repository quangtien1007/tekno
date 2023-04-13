@extends('layouts.client')

@section('title', 'Đơn hàng chi tiết')

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Đơn hàng chi tiết</h3>
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
                <div class="col-md-9">
                    <table class="table table" id="chitiet_dh">
                        <thead class="table-bordered">
                            <th>Hình ảnh</th>
                            <th>Dung lượng</th>
                            <th>Màu</th>
                            <th>Số lượng</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Ngày mua</th>
                            <th>Giá</th>
                        </thead>
                        <tbody class="table-bordered" id>
                            @foreach ($dhct as $item)
                            @php
                                $sanpham = DB::table('sanpham')->where('id',$item->sanpham_id)->first();
                            @endphp
                            <td><img src="{{env('APP_URL').'/images/sanpham/'.$sanpham->hinhanh }}" width="100" alt=""></td>
                            <td>{{DB::table('dungluong')->where('id',$item->dungluong_id)->first()->dungluong}}</td>
                            <td>{{DB::table('mau')->where('id',$item->mau_id)->first()->mau}}</td>
                            <td>{{$item->soluongban}}</td>
                            <td>
                                @if ($dh->is_thanhtoan == 0)
                                Chưa thanh toán
                                @else
                                Đã thanh toán
                                @endif
                            </td>
                            <td>{{DB::table('tinhtrang')->where('id',$dh->tinhtrang_id)->first()->tinhtrang}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{number_format($item->dongiaban)}}đ</td>
                            @endforeach
                        </tbody>
                        <tfoot>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td><strong> Tổng tiền: </strong></td>
                         <td>
                             <strong>
                                 {{number_format(DB::table('donhang_chitiet')
                                 ->select('dongiaban',DB::raw('SUM(dongiaban)'))
                                 ->groupBy('dongiaban')
                                 ->first()->dongiaban)}}đ
                             </strong>
                         </td>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-3">
                    <table class="table table-bordered">
                        <thead>
                            <th>Thông tin giao hàng</th>
                        </thead>
                        <tbody>
                           <td>
                                {{Auth::user()->name}} <br>
                                {{$dh->diachigiaohang}} <br>
                                {{$dh->dienthoaigiaohang}} <br>
                           </td>
                           <tr></tr>
                        </tbody>

                    </table>
                </div>
            </div>
            <style>
                /* style="@if($item->mau_id == 6) display:none @endif" */
                #chitiet_dh td{
                    vertical-align: middle;
                    text-align: center;
                }
            </style>
            <!-- /row -->
            <div style="float: right;font-style:italic">
                <h6>*Để yêu cầu hủy đơn hàng vui lòng nhắn tin với shop</h6>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
