@extends('admin.layouts.sidebar_admin')

@section('title', 'Dashboard')

@section('content')

<div class="d-flex justify-content-between bg-black align-items-center mb-3" style="padding: 0; margin: 0;">
    <h5 class="text-white mb-0 p-2">DASHBOARD</h5>
    <span class="text-white p-2"><i class="bi bi-person-fill-lock text-warning p-1"></i>Quick Access</span>
</div>
<div class="row mb-3 m-3 d-flex flex-wrap">
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card text-white" style="flex: 1 1 calc(25% - 1rem); background-color: #D9D9D9;" onclick="location.href='{{ route('admin.employee') }}'">
            <div class="card-body d-flex  align-items-center">
                <img src="images/person.png" alt="Person Image" style="width: 80px; height: 80px;">
                <div>
                    <div class="container">
                    <h5 class="card-title text-black">EMPLOYEE</h5>
                    <p class="text-black">Regular: <small>{{$totalRegular}}</small></p>
                    <p class="text-black">Trainee: <small>{{$totalTrainee}}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card text-white" style="flex: 1 1 calc(25% - 1rem); background-color: #D9D9D9;" onclick="location.href='{{ route('admin.events.event_admin') }}'">
            <div class="card-body d-flex align-items-center">
                <img src="images/clock.png" alt="Clock Image" style="width: 80px; height: 80px;">
                <div>
                    <div class="container">
                    <h5 class="card-title text-black">Events</h5>
                    <p class="text-black">Today: <small>
                        @if($todaysEvents > 0)
                         {{$todaysEvents}}
                        @else 0
                        @endif</small></p>
                    <p class="text-black">Upcoming: 2</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card text-white" style="flex: 1 1 calc(25% - 1rem); background-color: #D9D9D9;" onclick="location.href='{{ route('admin.pass_slip.pass_slip_admin') }}'">
            <div class="card-body d-flex align-items-center">
                <img src="images/person.png" alt="Person Image" style="width: 80px; height: 80px;">
                <div>
                    <div class="container">
                    <h5 class="card-title text-black">Pass Slip</h5>
                    <p class="text-black">Teaching: <small>{{$totalTeaching}}</small></p>
                    <p class="text-black">Non-Teaching: <small>{{$totalNon}}</small></p>
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
</style>

@endsection
