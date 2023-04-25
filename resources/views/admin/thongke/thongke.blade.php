@extends('layouts.admin')
@section('content')
<canvas width="500" id="myChart"></canvas>
<script type="text/javascript">
$(document).ready(function () {
var ctx = document.getElementById("myChart").getContext('2d');

var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Tokyo",	"Mumbai",	"Mexico City",	"Shanghai"],
        datasets: [{
            data: [{{$tongDonHang}},	50,	2424,	14040], // Specify the data values array

            borderColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896'], // Add custom color border
            backgroundColor: ['#2196f38c', '#f443368c', '#3f51b570', '#00968896'], // Add custom color background (Points and Fill)
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
