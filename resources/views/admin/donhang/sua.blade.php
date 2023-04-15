@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
         <div class="card col-md-8">
            <div class="card-header">Chi tiết đơn hàng</div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-sm mb-0">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="20%">Sản phẩm</th>
                            <th width="10%">Dung lượng</th>
                            <th width="5%">Màu</th>
                            <th width="2%">SL</th>
                            <th width="10%">Đơn giá</th>
                            <th width="10%">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $tongtien = 0;
                            $ctdh = DB::table('donhang_chitiet')->where('donhang_id',$donhang->id)->get();
                        @endphp
                        @foreach($ctdh as $chitiet)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ DB::table('sanpham')->where('id',$chitiet->id)->first()->tensanpham}}</td>
                                <td>{{ DB::table('dungluong')->where('id',$chitiet->dungluong_id)->first()->dungluong}}</td>
                                <td>{{ DB::table('mau')->where('id',$chitiet->mau_id)->first()->mau}}</td>
                                <td>{{ $chitiet->soluongban }}</td>
                                <td class="text-end">{{ number_format($chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                                <td class="text-end">{{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                            </tr>
                            @php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="4">Tổng tiền sản phẩm:</td>
                            <td class="text-end"><strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a
            href="{{route('admin.donhang.hoadon',['donhang_id'=>$donhang->id])}}"
            class="btn btn-warning"
                    style="width: 200px;
                           left: 650px;
                           position: relative;
                           margin-bottom: 15px;">
            <i class="fa-solid fa-file-pdf"></i>  In hóa đơn
            </a>
        </div>
        <div class="card col-md-4">
            <div class="card-header">Cập nhật đơn hàng</div>
            <div class="card-body">
                <form action="{{ route('admin.donhang.update', ['id' => $donhang->id]) }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="user_id">Khách hàng</label>
                        <input type="text" class="form-control" id="user" name="user_id" value="{{ $donhang->User->name }}" disabled required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="dienthoaigiaohang">Điện thoại giao hàng</label>
                        <input type="text" class="form-control @error('dienthoaigiaohang') is-invalid @enderror" id="dienthoaigiaohang" name="dienthoaigiaohang" value="{{ $donhang->dienthoaigiaohang }}" required />
                        @error('dienthoaigiaohang')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="diachigiaohang">Địa chỉ giao hàng</label>
                        <input type="text" class="form-control @error('diachigiaohang') is-invalid @enderror" id="diachigiaohang" name="diachigiaohang" value="{{ $donhang->diachigiaohang }}" required />
                        @error('diachigiaohang')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="is_thanhtoan">Tình trạng thanh toán</label>
                        <select class="form-select @error('is_thanhtoan') is-invalid @enderror" id="is_thanhtoan" name="is_thanhtoan" required>
                            <option value="">-- Chọn loại --</option>
                            <option value="0" {{ ($donhang->is_thanhtoan == 0) ? 'selected' : '' }} name="is_thanhtoan">Chưa thanh toán</option>
                            <option value="1" {{ ($donhang->is_thanhtoan == 1) ? 'selected' : '' }} name="is_thanhtoan">Đã thanh toán</option>
                        </select>
                        @error('is_thanhtoan')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tinhtrang_id">Tình trạng đơn hàng</label>
                        <select class="form-select @error('tinhtrang_id') is-invalid @enderror" id="tinhtrang_id" name="tinhtrang_id" required>
                            <option value="">-- Chọn loại --</option>
                            @foreach($tinhtrang as $value)
                                <option value="{{ $value->id }}" {{ ($donhang->tinhtrang_id == $value->id) ? 'selected' : '' }}>{{ $value->tinhtrang }}</option>
                            @endforeach
                        </select>
                        @error('tinhtrang_id')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <button type="submit" style="float:right;" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật</button>
                </form>
            </div>
        </div>
</div>
</div>
@endsection
