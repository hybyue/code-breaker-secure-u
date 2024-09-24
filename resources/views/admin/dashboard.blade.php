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
            timer: 2500,
            timerProgressBar: true,
            icon: 'success',
            title: session.success,
        });
    </script>
@endif
</div>
<div class="d-flex justify-content-between bg-black align-items-center mb-3" style="padding: 0; margin: 0;">
    <h5 class="text-white mb-0 p-2">DASHBOARD</h5>
    <span class="text-white p-2"><i class="bi bi-person-fill-lock text-warning p-1"></i>Quick Access</span>
</div>

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
</div>

<!-- Announcements and Upcoming Events -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Today's Announcements -->
    <div class="col-md-4">
        <div class="card mb-1">
            <div class="card-body">
                <h5>Today's Announcement(s)</h5>
                @if ($todayEvents->count() > 0)
                    <!-- Loop through today's events -->
                    @foreach ($todayEvents as $event)
                        <div class="event-box mb-2 p-2">
                            <strong>{{ $event->title }}</strong><br>
                            <small><strong>Date: </strong>{{ $event->date_start->format('M d, Y') }}</small><br>
                            <small><strong>Details:</strong> {{ $event->description }}</small><br>
                        </div>
                    @endforeach
                @else
                    <p>No announcement today.</p>
                @endif
            </div>
        </div>

        <!-- Upcoming Announcements -->
        <div class="card mt-1">
            <div class="card-body">
                <h5>Upcoming Announcement(s)</h5>
                @if ($upcomingEvents->count() > 0)
                    <!-- Loop through upcoming events -->
                    @foreach ($upcomingEvents as $event)
                        <div class="event-box mb-2 p-2">
                            <strong>{{ $event->title }}</strong><br>
                            <small><strong>Date: </strong>{{ $event->date_start->format('M d, Y') }}
                                @if($event->date_end)
                                to {{ $event->date_end->format('M d, Y') }}
                                @endif
                            </small><br>
                            <small><strong>Details:</strong> {{ $event->description }}</small><br>
                        </div>
                    @endforeach
                @else
                    <p>No upcoming announcements.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar CSS and JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js'></script>

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

// <!-- Custom CSS for nested boxes -->
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
</style>

@endsection
