@extends('layouts.admin')
@section('content')
<div class="container">
<div class="row">
    <div class="card col-md-6">
        <div class="card-header">Thống kê doanh thu tháng</div>
            <div class="card-body">
                <h3>Tổng đơn hàng bán được: {{$thongke['tongdonhang'] }}</h3>
                <h3>Tổng số sản phẩm được bán: {{$thongke['tongsanpham'] }}</h3>
                <h3>Tổng doanh thu sản phẩm bán được là:</h3><br>
                <h1 style="font-style:oblique;float: right;">{{number_format($thongke['doanhthu'])}}<sup>đ</sup></h1>
            </div>
        </div>
        <div class="col-md-6">
            <canvas width="500" id="totalChart"></canvas>
        </div>
</div>

<br><br><br>
<div class="row">
    <div class="col-md-5">
        <canvas height="500" id="phoneChart"></canvas>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5">
        <canvas height="500" id="laptopChart"></canvas>
    </div>

</div>
<br><br><br>
<div class="row">
    <div style="background: #bc2626:transparent:100%" class="col-md-5">
        <canvas height="500" id="tabletChart"></canvas>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-5">
        <canvas height="500" id="mouseChart"></canvas>
    </div>
</div>
{{-- {{dd($data[9])}} --}}
</div>
<script type="text/javascript">
$(document).ready(function () {
var ctx = document.getElementById("totalChart").getContext('2d');

var totalChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Điện thoại",	"Laptop",	"Tablet",	"Chuột, bàn phím"],
        datasets: [{
            data: [{{$thongke['dienthoai']}},	{{$thongke['laptop']}},{{$thongke['tablet']}},{{$thongke['chuotbanphim']}}], // Specify the data values array

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
