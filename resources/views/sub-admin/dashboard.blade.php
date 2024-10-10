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
            <div class="card-onclick card text-white" style="background-color:#2c3539;" onclick="location.href='{{ route('sub-admin.visitors.visitor') }}'">
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
                        <h4 class="text-end">4</h4>
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

{{-- <div class="row p-3">
    <div class="col-md-6">
<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-dark-800 p-4 md:p-6">

    <div class="grid grid-cols-2 py-3">
      <dl>
        <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Visitor</dt>
        <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">100</dd>
      </dl>
      <dl>
        <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Pass Slip</dt>
        <dd class="leading-none text-xl font-bold text-red-600 dark:text-red-500">999</dd>
      </dl>
    </div>

    <div id="bar-chart"></div>
      <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">

      </div>
  </div>



    </div>

    <div class="col-md-6">

        <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">

            <div class="flex justify-between items-start w-full">
                <div class="flex-col items-center">
                  <div class="flex items-center mb-1">
                      <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Website traffic</h5>
                      <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                      </svg>
                      <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                          <div class="p-3 space-y-2">
                              <h3 class="font-semibold text-gray-900 dark:text-white">Activity growth - Incremental</h3>
                              <p>Report helps navigate cumulative growth of community activities. Ideally, the chart should have a growing trend, as stagnating chart signifies a significant decrease of community activity.</p>
                              <h3 class="font-semibold text-gray-900 dark:text-white">Calculation</h3>
                              <p>For each date bucket, the all-time volume of activities is calculated. This means that activities in period n contain all activities up to period n, plus the activities generated by your community in period.</p>
                              <a href="#" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg></a>
                      </div>
                      <div data-popper-arrow></div>
                  </div>
                </div>
                <button id="dateRangeButton" data-dropdown-toggle="dateRangeDropdown" data-dropdown-ignore-click-outside-class="datepicker" type="button" class="inline-flex items-center text-blue-700 dark:text-blue-600 font-medium hover:underline">31 Nov - 31 Dev <svg class="w-3 h-3 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
                </button>
                <div id="dateRangeDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-80 lg:w-96 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="p-3" aria-labelledby="dateRangeButton">
                      <div date-rangepicker datepicker-autohide class="flex items-center">
                          <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Start date">
                          </div>
                          <span class="mx-2 text-gray-500 dark:text-gray-400">to</span>
                          <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="End date">
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="flex justify-end items-center">


            </div>
            </div>

            <!-- Line Chart -->
            <div class="py-6" id="pie-chart"></div>

          </div>

    </div>
</div> --}}

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
</div>


    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-1">
                <div class="card-body">
                    <h5>Today's Announcement(s)</h5>

                    @if ($todayEvents->count() > 0)
                    <div class="card">
                            @foreach ($todayEvents as $event)
                            <div class="card-body text-start">
                                    <strong >{{ $event->title }}</strong><br>
                                    <small><strong>Date: </strong> {{ $event->date_start->format('M d, Y') }}
                                        @if($event->date_end = $event->date_start)

                                        @else
                                        to {{ $event->date_end->format('M d, Y') }}
                                    @endif</small>
                                    <br>
                                    <small><strong>Details:</strong> {{ $event->description }}</small><br>
                            </div>
                            @endforeach
                        </div>
                    @else
                    <p>No announcement today.</p>
                    @endif


                </div>
            </div>
            <div class="card mt-1">
                <div class="card-body">
                    <h5>Upcoming Announcement(s)</h5>
                    @if ($upcomingEvents->count() > 0)
                    <div class="card">
                            @foreach ($upcomingEvents as $event)
                            <div class="card-body">
                                    <strong>{{ $event->title }}</strong><br>
                                    <small><strong>Date: </strong> {{ $event->date_start->format('M d, Y') }}
                                        @if($event->date_end)
                                        to {{ $event->date_end->format('M d, Y') }}
                                    @endif</small>
                                    <br>
                                    <small><strong>Details:</strong> {{ $event->description }}</small><br>
                            @endforeach
                            </div>
                    </div>
                    @else
                        <p>No upcoming Announcement.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

<!-- FullCalendar CSS and JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script>

<script src='{{ asset('fullcalendar/main.min.js') }}'></script>
<script src="{{ asset('tailwindcharts/js/apexcharts.js') }}"></script>
<script src="{{ asset('tailwindcharts/js/flowbite.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('visitorChart').getContext('2d');
    let visitorChart;

    function fetchData(timePeriod) {
        // Update the time label
        const timeLabel = document.getElementById('timeLabel');
        timeLabel.textContent = `${capitalizeFirstLetter(timePeriod)} Statistics`;

        // Update button colors
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.classList.remove('bg-blue-700', 'bg-blue-500');
            button.classList.add('bg-blue-500');
        });

        document.getElementById(`${timePeriod}Btn`).classList.remove('bg-blue-500');
        document.getElementById(`${timePeriod}Btn`).classList.add('bg-blue-700');

        // Fetch data based on the time period (weekly, monthly, yearly)
        fetch(`/visitor-data?timePeriod=${timePeriod}`)
            .then(response => response.json())
            .then(data => {
                updateChart(timePeriod, data.labels, data.visitor, data.passSlip, data.lost, data.violation);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function updateChart(timePeriod, labels, visitors, pass_slips, lost_found, violations) {
        // Format labels for months if 'monthly' is selected
        if (timePeriod === 'monthly') {
            labels = labels.map(monthNum => {
                return new Date(0, monthNum - 1).toLocaleString('en-US', { month: 'long' });
            });
        }

        // Destroy the previous chart instance if it exists
        if (visitorChart) {
            visitorChart.destroy();
        }

        // Create a new chart instance
        visitorChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                {
                    label: 'Visitor',
                    data: visitors,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Pass Slips',
                    data: pass_slips,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Lost and Found',
                    data: lost_found,
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 2
                },
                {
                    label: 'Violations',
                    data: violations,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
                }
            ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Initial load with monthly data
    fetchData('monthly');
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
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                @foreach ($events as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->date_start->format('Y-m-d') }}',
                        @if ($event->date_end)
                            end: '{{ $event->date_end->addDay()->format('Y-m-d') }}',
                        @endif
                    },
                @endforeach
            ],
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });
        calendar.render();
    });
</script>

@endsection
