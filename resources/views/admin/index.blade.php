@extends('layouts.admin')

@section('content')
	<div class="card justify-content-center">
		<div class="card-header">Trang chủ</div>
		<div class="card-body">
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif
			Doanh số của tháng
		</div>
        <!-- Chart Start -->
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-md-3"></div>
        </div>
        <!-- Chart End -->
        <script type="text/javascript">
        $(document).ready(function () {
            const ctx = document.getElementById("myChart");

            var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["2023/03/17", "2023/03/20", "2023/03/23", "2023/03/26", "2023/03/29", "2023/04/03"],
                datasets: [
                {
                    type: "line",
                    label: "Sản phẩm bán được",
                    data: [25, 13, 30, 35, 25, 40],
                    lineTension: 0,
                    fill: true
                }
                ]
            }
            });

        });
        </script>
	</div>
@endsection
