@extends('admin.layouts.sidebar_admin')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-right',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                icon: 'success',
                title: "{{ session('success') }}",
            });
        </script>
    @endif
    </div>
<div class="container mt-3">
    <h5 class="text-black mb-0 p-2 font-weight-bold">DASHBOARD</h5>
</div>

<div class="row container mb-4 align-items-center">
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('admin.visitors.visitor_admin') }}'">
            <div class="card-body d-flex justify-content-between">
                <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                    <i class="bi bi-person-fill" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                </div>
                <div class="container">
                        <h5 class="card-title">Visitor</h5>
                        <h4 class="text-end">{{$totalVisitor}}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('admin.pass_slip.pass_slip_admin')}}'">
            <div class="card-body d-flex justify-content-between">
                <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                    <i class="bi bi-pass" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                </div>
                <div class="container">
                     <h5 class="card-title">Pass Slip</h5>
                        <div class="row d-flex justify-content-between align-items-between">
                            <div class="col-md-6"><small class="text-end">Late: {{ $latePassSlips }}</small></div>
                            <div class="col-md-4"><h4 class="text-end">{{ $totalPassSlip }}</h4></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('admin.violation.violation') }}'">
            <div class="card-body d-flex justify-content-between">
                <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                    <i class="bi bi-file-earmark-person" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                </div>
                <div class="container">
                    <h5 class="card-title">Violations</h5>
                    <div class="row d-flex justify-content-between align-items-between">
                        <div class="col-md-4"><small class="text-end"></small></div>
                        <div class="col-md-4"><h4 class="text-end">{{ $totalViolation }}</h4></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('admin.lost.lost_found_admin') }}'">
            <div class="card-body d-flex justify-content-between">
                <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                    <i class="bi bi-box-seam-fill" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                </div>
                <div class="container">
                    <h5 class="card-title">Lost and Found</h5>
                    <div class="row d-flex justify-content-between align-items-between">
                        <div class="col-md-6"><small class="text-end">To Transfer: {{ $sevenDayOldItems }}</small></div>
                        <div class="col-md-4"><h4 class="text-end">{{ $totalLostFound }}</h4></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('admin.employees.all_employee') }}'">
            <div class="card-body d-flex justify-content-between">
                <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                    <i class="bi bi-person-vcard-fill" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                </div>
                <div class="container">
                    <h5 class="card-title">Employees</h5>
                    <div class="row d-flex justify-content-between align-items-between">
                        <div class="col-md-4"><small class="text-end"></small></div>
                        <div class="col-md-4"><h4 class="text-end">{{ $totalEmployees }}</h4></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('admin.students.student') }}'">
            <div class="card-body d-flex justify-content-between">
                <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                    <i class="bi bi-person-lines-fill" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                </div>
                <div class="container">
                    <h5 class="card-title">Students</h5>
                    <h4 class="text-end">{{ $totalStudent }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row p-3">
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
        <div id="pieLabel" class="h4 font-weight-bold mb-4">Overall Percentages</div>
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

<script src="{{ asset('js/chart_admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
<style>
    .icon-container{
        background-color:#cf1818;
        width: 100px;
        height: 80px;
        border-radius: 5px;
    }
    .icon-container i{
        vertical-align: middle;
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
