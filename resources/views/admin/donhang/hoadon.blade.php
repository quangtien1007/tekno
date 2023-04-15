<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tekno - Thông tin hóa đơn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    body {
        font-family:'Times New Roman', Times, serif;
    }
    h1{
        font-family:'Courier New', Courier, monospace;
    }
</style>
<body>
    <h1>Tekno</h1>
    <p>{{$date}}</p>
    <p>Khach hang: <strong>{{Auth::user()->name}}</strong></p>
        <!-- row -->
        <div class="row">
            <div class="col-md-9">
                <table class="table table" id="chitiet_dh">
                    <thead class="table-bordered">
                        <th>San pham</th>
                        <th>Dung luong</th>
                        <th>Mau</th>
                        <th>So luong</th>
                        <th>Ngay mua</th>
                        <th>Gia</th>
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
                        <td>{{$item->created_at}}</td>
                        <td>{{number_format($item->dongiaban)}}đ</td>
                        @endforeach
                    </tbody>
                    <tfoot>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td><strong> Tong tien: </strong></td>
                     <td>
                         <strong>
                             {{(number_format(DB::table('donhang_chitiet')
                             ->select('dongiaban',DB::raw('SUM(dongiaban) as tong'))
                             ->groupBy('dongiaban')
                             ->first()->tong))}}VND
                         </strong>
                     </td>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-3">
                <table class="table table-bordered">
                    <thead>
                        <th>Thong tin giao hang</th>
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
            #chitiet_dh td{
                vertical-align: middle;
                text-align: center;
            }
        </style>
        <!-- /row -->
    </div>

</body>


</html>
