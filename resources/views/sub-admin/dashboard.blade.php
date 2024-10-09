@extends('layouts.sidebar')

@section('title', 'Dashboard')

@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h4>Dashboard</h4>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card-onclick card text-white" style="background-color:#D9D9D9;" onclick="location.href='{{ route('sub-admin.visitors.visitor') }}'">
                <div class="card-body d-flex justify-content-between">
                    <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                        <i class="bi bi-person-fill" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                    </div>
                    <div class="container">
                        <h5 class="card-title text-black">Total Visitor</h5>
                        <div class="row d-flex justify-content-between align-items-between">
                            <div class="col-md-4"> <small class="text-end text-black">Today: {{ $todayVisitors }}</small></div>
                            <div class="col-md-4"><h4 class="text-end text-black">{{ $totalVisitors }}</h4></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card-onclick card text-white" style="background-color:#D9D9D9;" onclick="location.href='#'">
                <div class="card-body d-flex justify-content-between">
                    <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                        <i class="bi bi-file-earmark-person" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                    </div>
                    <div class="container">
                        <h5 class="card-title text-black">Violations</h5>
                        <h4 class="text-end text-black">4</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card-onclick card text-white" style="background-color:#D9D9D9;" onclick="location.href='{{ route('sub-admin.pass_slip.pass_slip') }}'">
                <div class="card-body d-flex justify-content-between">
                    <div class="icon-container text-center d-flex justify-content-center align-items-center" >
                        <i class="bi bi-pass" style="font-size: 50px; color: white; vertical-align: middle;"></i>
                    </div>
                    <div class="container">
                        <h5 class="card-title text-black">Pass Slip</h5>
                        <div class="row d-flex justify-content-between align-items-between">
                            <div class="col-md-4"><small class="text-end text-black">Today: {{ $todayPassSlips }}</small></div>
                            <div class="col-md-4"><h4 class="text-end text-black">{{ $totalPassSlips }}</h4></div>
                        </div>
                    </div>
                </div>
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
        background-color:#A10D0D;
        width: 100px;
        height: 80px;
        border-radius: 5px;
    }
    .icon-container i{
        vertical-align: middle;
    }
</style>
@endsection
