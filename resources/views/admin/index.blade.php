@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-md-5 chart">
                <div class="card-header">Thống kê doanh thu tháng</div>
                    <div class="card-body">
                        <span class="result-total">
                        <div>
                            <h6>Đơn hàng bán được</h6>
                            <h3><img width="50" src="{{env('APP_URL').'/images/index/order.png'}}">    {{$thongke['tongdonhang'] }}</h3>
                        </div>
                        <div>
                            <h6>Sản phẩm bán được</h6>
                            <h3><img width="50" src="{{env('APP_URL').'/images/index/received.png'}}">    {{$thongke['tongsanpham'] }}</h3>
                        </div>
                        </span>
                        <br>
                        <h4>Tổng doanh thu:</h4>
                        <span class="result-total">
                            <h1 style="font-style:oblique"><img width="50" src="{{env('APP_URL').'/images/index/salary.png'}}"> {{number_format($thongke['doanhthu'])}}<sup>đ</sup></h1>
                        </span>
                    </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6 chart">
                    <canvas height="350" width="350" id="totalChart"></canvas>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <p>Sản phẩm bán được</p>
            </div>
        </div>
        <br><br>
        <h3 class="title-detail">Chi tiết các sản phẩm đã bán được</h3>
        <br><br>
        <div class="row">
            <div class="col-md-5 chart">
                <canvas height="500" id="phoneChart"></canvas>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5 chart">
                <canvas height="500" id="laptopChart"></canvas>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <p>Điện thoại bán được theo hãng</p>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <p>Laptop bán được theo hãng</p>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div style="" class="col-md-5 chart">
                <canvas height="500" id="tabletChart"></canvas>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5 chart">
                <canvas height="500" id="mouseChart"></canvas>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-5">
                <p>Tablet bán được theo hãng</p>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <p>Chuột, bàn phím bán được theo hãng</p>
            </div>
        </div>
        </div>
        <style>
            .chart{
                border-radius: 20px;
                border: 1px solid gray;
                box-shadow: 10px 10px 5px 5px gray;
            }
            .title-detail{
                text-align: center;
                text-transform: uppercase;
                font-weight: bold
            }
            p{
                text-align: center;
                font-weight: bold
            }
            .result-total{
                display: flex;
                justify-content: space-around;
            }
        </style>
        <script type="text/javascript">
        $(document).ready(function () {
        var ctx = document.getElementById("totalChart").getContext('2d');

        var totalChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Điện thoại",	"Laptop",	"Tablet",	"Chuột, bàn phím"],
                datasets: [{
                    data: [{{$thongke['dienthoai']}},	{{$thongke['laptop']}},{{$thongke['tablet']}},{{$thongke['chuotbanphim'] ? $thongke['chuotbanphim'] : 0}}], // Specify the data values array

                    borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896'], // Add custom color border
                    backgroundColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896'], // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},

            options: {
              responsive: true, // Instruct chart js to respond nicely.
              maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });

        var ctx = document.getElementById("phoneChart").getContext('2d');

        var phoneChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["iPhone","Samsung","Oppo","Vivo","Xiaomi"],
                datasets: [{
                    type: "bar",
                    label: ["Điện thoại bán được"],
                    lineTension: 0,
                    fill: false,
                    data: [73,	33,	29,	28, 60], // Specify the data values array
                    borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896','#00124996'], // Add custom color border
                    backgroundColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896','#00124996'], // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},
            options: {
              responsive: true, // Instruct chart js to respond nicely.
              maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });

        var ctx = document.getElementById("laptopChart").getContext('2d');

        var laptopChart   = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Macbook","Asus","HP","Acer","Lenovo"],
                datasets: [{
                    type: "bar",
                    label: ["Laptop bán được"],
                    lineTension: 0,
                    fill: false,
                    data:[22,33,	29,	28, 60], // Specify the data values array
                    borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896','#00124996'], // Add custom color border
                    backgroundColor: ['#2196f38c', '#f663368c', '#6645570', '#968896','#00124996'], // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},
            options: {
              responsive: true, // Instruct chart js to respond nicely.
              maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });

        var ctx = document.getElementById("tabletChart").getContext('2d');

        var tabletChart   = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["iPad","Samsung","Lenovo","Realme","Xiaomi"],
                datasets: [{
                    type: "bar",
                    label: ["Tablet bán được"],
                    lineTension: 0,
                    fill: false,
                    data: [20,	18,	9,3, 3], // Specify the data values array
                    borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896','#00124996'], // Add custom color border
                    backgroundColor: ['#2196f38c', '#f663368c', '#6645570', '#968896','#00124996'], // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},
            options: {
              responsive: true, // Instruct chart js to respond nicely.
              maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });

        var ctx = document.getElementById("mouseChart").getContext('2d');

        var mouseChart   = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Corsair","Logitech","DareU","Apple"],
                datasets: [{
                    type: "bar",
                    label: ["Chuột, bàn phím bán được"],
                    lineTension: 0,
                    fill: false,
                    data: [66,98,2,32], // Specify the data values array
                    borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896',], // Add custom color border
                    backgroundColor: ['#2196f38c', '#f663368c', '#6645570', '#968896'], // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]},
            options: {
              responsive: true, // Instruct chart js to respond nicely.
              maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
            }
        });
        });
        </script>
@endsection
