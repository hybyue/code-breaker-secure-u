@extends('admin.layouts.sidebar_admin')

@section('title', 'Dashboard')
<link rel="stylesheet" href="{{ asset('tailwindcharts/css/flowbite.min.css')}}">


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
            title: {{ session('success') }},
        });
    </script>
@endif
</div>
<div class="container mt-3">
    <h5 class="text-black mb-0 p-2">DASHBOARD</h5>
</div>
{{--
<!-- Dashboard Cards -->
<div class="row mb-3 m-3">
    <!-- Employee Card -->
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card bg-light text-black card-onclick" onclick="location.href='{{ route('admin.employee') }}'">
            <div class="card-body d-flex align-items-center">
                <img src="images/person.png" alt="Person Image" class="card-img">
                <div class="ml-3">
                    <h5 class="card-title">EMPLOYEE</h5>
                    <p>Regular: <small>{{ $totalRegular }}</small></p>
                    <p>Trainee: <small>{{ $totalTrainee }}</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Card -->
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card bg-light text-black card-onclick" onclick="location.href='{{ route('admin.events.event_admin') }}'">
            <div class="card-body d-flex align-items-center">
                <img src="images/clock.png" alt="Clock Image" class="card-img">
                <div class="ml-3">
                    <h5 class="card-title">Events</h5>
                    <p>Today: <small>{{ $todaysEvents > 0 ? $todaysEvents : 0 }}</small></p>
                    <p>Upcoming: <small>2</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pass Slip Card -->
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card bg-light text-black card-onclick" onclick="location.href='{{ route('admin.pass_slip.pass_slip_admin') }}'">
            <div class="card-body d-flex align-items-center">
                <img src="images/person.png" alt="Person Image" class="card-img">
                <div class="ml-3">
                    <h5 class="card-title">Pass Slip</h5>
                    <p>Teaching: <small>{{ $totalTeaching }}</small></p>
                    <p>Non-Teaching: <small>{{ $totalNon }}</small></p>
                </div>
            </div>
        </div>
    </div>
</div> --}}


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
                    <h4 class="text-end">{{$totalPassSlip}}</h4>
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
                        <div class="col-md-4"><small class="text-end">Today</small></div>
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
                        <div class="col-md-4"><small class="text-end">Today</small></div>
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
                        <div class="col-md-4"><small class="text-end">Today</small></div>
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
                    <h5 class="card-title">Total Students</h5>
                    <h4 class="text-end">{{ $totalStudent }}</h4>
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
<script src="{{ asset('js/chart_admin.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
<script src="{{ asset('tailwindcharts/js/flowbite.min.js') }}"></script>
<style>
    .event-box {
        border: 1px solid #303030;
        border-radius: 5px;
        background-color: #fce6e6;
    }

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
        color: #ffffff;
        border: none;
        padding: 5px;
        transition: transform 0.3s;
    }

    .fc-event:hover {
        transform: scale(1.05);
    }

    .event-title {
        font-weight: bold;
    }

    /* Responsive Card Image */
    .card-img {
        width: 80px;
        height: 80px;
    }

    /* Responsive Design */
    @media (max-width: 758px) {
        .card-body {
            flex-direction: column;
            text-align: center;
        }

        .ml-3 {
            margin-left: 0;
        }

        .card-img {
            width: 60px;
            height: 60px;
        }
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
</style>

@endsection
