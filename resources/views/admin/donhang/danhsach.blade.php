@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Đơn hàng</div>
		<div class="card-body table-responsive">
			<p><a href="{{ route('client') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p>
			<table class="table table-bordered table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="6%">Khách hàng</th>
						<th width="25%">Thông tin giao hàng</th>
						<th width="10%">Ngày đặt</th>
						<th width="8%">Tình trạng</th>
						<th width="8%">Thanh toán</th>
						<th width="10%">Phương thức thanh toán</th>
						<th width="3%">Sửa</th>
						<th width="3%">Xóa</th>
					</tr>
				</thead>
				<tbody>
					@foreach($donhang as $value)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $value->User->name }}</td>
							<td>
								<span class="d-block">Điện thoại: <strong>{{ $value->dienthoaigiaohang }}</strong></span>
								<span class="d-block">Địa chỉ giao: <strong>{{ $value->diachigiaohang }}</strong></span>
								<span class="d-block">Sản phẩm:</span>
								<table class="table table-bordered table-hover table-sm mb-0">
									<thead>
										<tr>
											<th width="5%">#</th>
											<th width="10%">Sản phẩm</th>
											<th width="5%">SL</th>
											<th width="10%">Đơn giá</th>
											<th width="15%">Thành tiền</th>
										</tr>
									</thead>
									<tbody>
										@php $tongtien = 0; @endphp
										@foreach($value->DonHang_ChiTiet as $chitiet)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $chitiet->SanPham->tensanpham }}</td>
												<td>{{ $chitiet->soluongban }}</td>
												<td class="text-end">{{ number_format($chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
												<td class="text-end">{{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
											</tr>
											@php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
										@endforeach
										<tr>
											<td colspan="4">Tổng tiền sản phẩm:</td>
											<td class="text-end"><strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup></td>
										</tr>
									</tbody>
								</table>
							</td>
							<td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
							<td>{{ $value->TinhTrang->tinhtrang }}</td>
							<td>
								@if ($value->is_thanhtoan==1)
									Đã thanh toán
								@else
								Chưa thanh toán
								@endif
							</td>
							<td style="align-item: center">
								@if ($value->pt_thanhtoan == 'paypal')
									<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/39/PayPal_logo.svg/1200px-PayPal_logo.svg.png" alt="logo-paypal" width="100px">
								@elseif ($value->pt_thanhtoan == 'vnpay')
								<img src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-VNPAY-QR-1.png" alt="logo-paypal" width="100px">
								@else
								<img src="https://cdn-icons-png.flaticon.com/512/5619/5619958.png" alt="logo-paypal" width="100px">
								@endif
							</td>
							<td class="text-center"><a href="{{ route('admin.donhang.edit', ['id' => $value->id]) }}"><i class="fal fa-edit"></i></a></td>
							<td class="text-center"><a href="{{ route('admin.donhang.delete', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa đơn hàng của khách {{ $value->User->name }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection
