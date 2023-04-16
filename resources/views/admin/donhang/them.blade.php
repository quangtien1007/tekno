@extends('layouts.admin')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="card col-md-8">
            <div class="card-header">Tạo đơn hàng</div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label bg-red" for="tenkh">Khách hàng</label>
                        <input type="text" class="form-control" id="tenkh" name="tenkh" required />
                        @error('tenkh')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="sub_sanpham">Sản phẩm</label>
                        <select class="form-select js-example-tags" name="sanpham_id" id="sub_sanpham" required>
                            @foreach ($sanpham as $item)
                            <option name="sanpham_id" value="{{$item->id}}" selected="selected">{{$item->tensanpham}}</option>
                            @endforeach
                        </select>
                        @error('sub_sanpham')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="dungluong_id">Dung lượng</label>
                            <select id="sub_dungluong" name="msp" class="form-select">
                            </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="sub_mau">Màu</label>
                            <select id="sub_mau" name="msp" class="form-select">
                            </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="soluong">Số lượng</label>
                        <input type="number" class="form-control @error('soluong') is-invalid @enderror" id="soluong" name="soluong"  required />
                        @error('soluong')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="dienthoaigiaohang">Điện thoại khách hàng</label>
                        <input type="text" class="form-control @error('dienthoaigiaohang') is-invalid @enderror" id="dienthoaigiaohang" name="dienthoaigiaohang"  required />
                        @error('dienthoaigiaohang')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                    </div>


                    <button type="submit" style="float:right;" class="btn btn-primary"><i class="fal fa-save"></i> Cập nhật</button>
                    <script>
                        $(document).ready(function () {
                            $(".js-example-tags").select2({
                                tags: true
                            });
                            $('#sub_sanpham').on('change', function () {
                                let id = $(this).val();
                                $('#sub_dungluong').empty();
                                $('#sub_dungluong').append(`<option value="0" disabled selected>Processing...</option>`);
                                $.ajax({
                                type: 'GET',
                                url: '/getDungLuongTheoSanPham/' + id ,
                                success: function (response) {
                                var response = JSON.parse(response);
                                console.log(response);
                                $('#sub_dungluong').empty();
                                response.forEach(element => {
                                        $('#sub_dungluong').append(`<option value="${element['dungluong']}">${element['dungluong']}</option>`);
                                        $('#sub_mau').append(`<option value="${element['mau']}">${element['mau']}</option>`);
                                        });
                                    }
                                });
                            });
                            $('#sub_dungluong').on('change', function () {
                                let id = $(this).val();
                                let spid = $('#sp_id').val();
                                $('#sub_mau').empty();
                                $('#sub_mau').append(`<option value="0" disabled selected>Processing...</option>`);
                                $.ajax({
                                type: 'GET',
                                url: '/getMauTheoDungLuong/' + id + '/' + spid,
                                success: function (response) {
                                var response = JSON.parse(response);
                                console.log(response);
                                $('#sub_mau').empty();
                                response.forEach(element => {
                                        $('#sub_mau').append(`<option value="${element['mau']}">${element['mau']}</option>`);
                                        });
                                    }
                                });
                            });
                        });
            </script>
                </form>
            </div>
        </div>
        <div class="col-md-2"></div>
</div>
</div>
@endsection
