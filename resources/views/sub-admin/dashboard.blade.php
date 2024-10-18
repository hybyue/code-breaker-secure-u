@extends('layouts.sidebar')

@section('title', 'Dashboard')
<link rel="stylesheet" href="{{ asset('tailwindcharts/css/flowbite.min.css')}}">

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h4>Dashboard</h4>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('visitors.subadmin') }}'">
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

<div class="row p-3">
    <div class="col-md-6">
        <div class="container">
            <div id="timeLabel" class="text-lg font-bold mb-4"><h4>Select Time Period</h4></div>
                <div class="flex space-x-2 mb-4">
                    <button onclick="fetchData('monthly')" id="monthlyBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Monthly</button>
                    <button onclick="fetchData('yearly')" id="yearlyBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Yearly</button>
                </div>
                <canvas id="visitorChart" class="bg-white shadow-md rounded-lg p-4"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="container">
            <div id="pieLabel" class="text-lg font-bold mb-4"><h4>Pie Chart</h4></div>
            <canvas id="visitorPieChart" class="bg-white shadow-md rounded-lg p-4"></canvas>
        </div>
    </div>
</div>



<script src="{{ asset('js/chart.js') }}"></script>
<script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
<script src="{{ asset('tailwindcharts/js/flowbite.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

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

    .event-title {
        font-weight: bold;
    }
    .icon-container{
        background-color:#cf1818;
        width: 100px;
        height: 80px;
        border-radius: 5px;
    }
    .icon-container i{
        vertical-align: middle;
    }
    #visitorPieChart {
        width: 100%;
        max-width: 400px;
        height: 140px;
    }
</style>

@endsection
