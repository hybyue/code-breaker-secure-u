<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Document')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link rel="shortcut icon" href="http://example.com/favicon.ico" />
	<link href="{{  asset('bootstrap-5.3.3-dist/css/bootstrap.css')}}" rel="stylesheet" >
    <link href="{{  asset('css/sidebar_admin.css')}}" rel="stylesheet" >
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
    @stack('styles')
    @stack('scripts')
    <style>
        a.sidebar-link:hover {
            background-color: #303030;
        }
        a.sidebar-link.active {
            background-color: #1e1e1e;
            border-left: 2px solid #3b7ddd;
        }

    </style>
</head>
<body>

    <div class="loading-bar"></div>

    <nav>@include('admin.layouts.admin')</nav>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="container d-flex">
                <button id="toggle-btn" type="button"><i class="bi bi-list"></i></button>
                <div class="sidebar-logo sidebar-header">
                    <a href="#"><span class="underline-flase">Admin</span></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.employee')}}" class="sidebar-link {{ Route::is('admin.employee') ? 'active' : '' }}">
                        <i class="bi bi-person-circle"></i>
                        <span>Security Staff</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.visitors.visitor_admin') }}" class="sidebar-link {{ Route::is('admin.visitors.visitor_admin') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Visitors</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.pass_slip.pass_slip_admin') }}" class="sidebar-link {{ Route::is('admin.pass_slip.pass_slip_admin') ? 'active' : '' }}">
                        <i class="bi bi-pass"></i>
                        <span>Pass Slip</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a href="{{ route('admin.vehicle_sticker.vehicle_sticker') }}" class="sidebar-link {{ Route::is('admin.vehicle_sticker.vehicle_sticker') ? 'active' : '' }}">
                        <i class="bi bi-car-front-fill"></i>
                        <span>Vehicle Stickers</span>
                    </a>
                </li> --}}
                <li class="sidebar-item">
                    <a href="{{ route('admin.violation.violation')}}" class="sidebar-link {{ Route::is('admin.violation.violation') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-person"></i>
                        <span>Violation</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.register')}}" class="sidebar-link {{ Route::is('admin.register') ? 'active' : '' }}">
                        <i class="bi bi-lock"></i>
                        <span>Create Account</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.lost.lost_found_admin')}}" class="sidebar-link {{ Route::is('admin.lost.lost_found_admin') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Lost and Found</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.employees.all_employee')}}" class="sidebar-link {{ Route::is('admin.employees.all_employee') ? 'active' : '' }}">
                        <i class="bi bi-person-vcard-fill"></i>
                        <span>Employees</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.students.student')}}" class="sidebar-link {{ Route::is('admin.students.student') ? 'active' : '' }}">
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.events.event_admin')}}" class="sidebar-link {{ Route::is('admin.events.event_admin') ? 'active' : '' }}">
                        <i class="bi bi-calendar-week-fill"></i>
                        <span>Announcements</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.activity') }}" class="sidebar-link {{ Route::is('admin.activity') ? 'active' : '' }}">
                        <i class="bi bi-arrow-right-circle"></i>
                        <span>Activity Log</span>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="main">
            @yield('content')
        </div>
    </div>

    @yield('header')
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/sidebar_admin.js') }}"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>



</body>
</html>
