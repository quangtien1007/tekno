@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-header">Tất cả đơn hàng</div>
		<div class="card-body table-responsive">
			{{-- <p><a href="{{ route('admin') }}" class="btn btn-success"><i class="fal fa-plus"></i> Thêm mới</a></p> --}}
			<table class="table table-stried table-hover table-sm mb-0">
				<thead>
					<tr>
						<th width="5%">#</th>
						<th width="6%">Khách hàng</th>
						<th width="15%">Thông tin giao hàng</th>
						<th width="10%">Ngày đặt</th>
						<th width="8%">Tình trạng</th>
						<th width="8%">Thanh toán</th>
						<th width="10%">Phương thức thanh toán</th>
						<th class="text-center" width="3%">Chi tiết</th>
						<th class="text-center" width="3%">Xóa</th>
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
							</td>
							<td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
							<td>
                                <span style="padding: 10px" class="{{ DB::table('tinhtrang')->where('id',$value->tinhtrang_id)->first()->badge}}">
                                    {{ $value->TinhTrang->tinhtrang }}
                                </span>
                            </td>
							<td>
								@if ($value->is_thanhtoan==1)
									<span style="padding:10px" class="badge bg-success">Đã thanh toán</span>
								@else
								    <span style="padding: 10px" class="badge bg-danger">Chưa thanh toán</span>
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
							<td class="text-center"><a href="{{ route('admin.donhang.edit', ['id' => $value->id]) }}"><i class="fa-regular fa-circle-info fa-lg"></i></a></td>
							<td class="text-center"><a href="{{ route('admin.donhang.delete', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa đơn hàng của khách {{ $value->User->name }} không?')"><i class="fal fa-trash-alt text-danger"></i></a></td>
						</tr>
					@endforeach
                    <style>
                        td{
                            text-align: left;
                        }
                    </style>
				</tbody>
			</table>
		</div>
	</div>
@endsection
