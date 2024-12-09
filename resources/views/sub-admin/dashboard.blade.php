@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="font-weight-bold">Dashboard</h4>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ url('/sub-admin/visitor') }}'">
                <div class="card-body d-flex justify-content-between">
                    <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                        <i class="bi bi-person-fill" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                    </div>
                    <div class="container">
                        <h5 class="card-title">Total Visitor</h5>
                        <div class="row d-flex justify-content-between align-items-between">
                            <div class="col-md-4"> <small class="text-end">Today: {{ $todayVisitors }}</small></div>
                            <div class="col-md-4"><h4 class="text-end">{{ $totalVisitors }}</h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='#'">
                <div class="card-body d-flex justify-content-between">
                    <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                        <i class="bi bi-file-earmark-person" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                    </div>
                    <div class="container">
                        <h5 class="card-title">Violations</h5>
                        <h4 class="text-end">{{ $totalViolation }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('sub-admin.pass_slip.pass_slip') }}'">
                <div class="card-body d-flex justify-content-between">
                    <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                        <i class="bi bi-pass" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                    </div>
                    <div class="container">
                        <h5 class="card-title">Pass Slip</h5>
                        <div class="row d-flex justify-content-between align-items-between">
                            <div class="col-md-4"><small class="text-end">Today: {{ $todayPassSlips }}</small></div>
                            <div class="col-md-4"><h4 class="text-end">{{ $totalPassSlips }}</h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Bar Chart Column -->
        <div class="col-md-6">
            <div id="timeLabel" class="h4 font-weight-bold mb-3">Select Time Period</div>
            <div class="d-flex mb-3">
                <button onclick="fetchData('weekly')" id="weeklyBtn" class="btn btn-primary me-2">Weekly</button>
                <button onclick="fetchData('monthly')" id="monthlyBtn" class="btn btn-primary me-2">Monthly</button>
                <button onclick="fetchData('yearly')" id="yearlyBtn" class="btn btn-primary">Yearly</button>
            </div>
            <div class="chart-container position-relative">
                <div id="barChartLoader" class="chart-loader d-none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <canvas id="visitorChart" class="bg-white shadow-md rounded-lg p-4"></canvas>
            </div>
        </div>

        <!-- Pie Chart Column -->
        <div class="col-md-6">
            <div id="pieLabel" class="h4 font-weight-bold mb-4">Pie Chart</div>
            <div class="chart-container-pie position-relative">
                <div id="pieChartLoader" class="chart-loader d-none mt-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <canvas id="visitorPieChart" class="bg-white shadow-md rounded-lg p-4 mt-5"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/chart.js') }}"></script>
<script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Add your chart JS code here
</script>

<style>
    .card-onclick {
        transition: transform 0.3s;
        cursor: pointer;
    }
    .card-onclick:hover {
        transform: scale(1.03);
    }
    .fc-event-container {
        background-color: #f0f0f0;
        border-radius: 5px;
    }
    .fc-event {
        background-color: #292b2e;
        color: #000000;
        border: none;
        padding: 5px;
        transition: transform 0.3s;
    }
    .fc-event:hover {
        transform: scale(1.05);
        color: #000000;
        background-color: #747474;
    }
    .icon-container{
        background-color:#cf1818;
        width: 100px;
        height: 80px;
        border-radius: 5px;
    }
    #visitorPieChart, #visitorChart {
        height: 100% !important;
        width: 100% !important;
    }
    .chart-container {
        position: relative;
        height: 400px !important;
        width: 100%;
        margin-bottom: 20px;
    }
    .chart-container-pie {
        position: relative;
        height: 450px !important;
        width: 100%;
        margin-bottom: 10px;
    }
    .chart-loader {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
</style>

@endsection
