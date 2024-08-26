<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Document')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link rel="shortcut icon" href="http://example.com/favicon.ico" />
	<link href="{{  asset('bootstrap-5.3.3-dist/css/bootstrap.css')}}" rel="stylesheet" >
    <link href="{{  asset('css/sidebar_admin.css')}}" rel="stylesheet" >
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
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

    <nav>@include('admin.layouts.admin')</nav>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="container d-flex ">
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
            </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.employee')}}" class="sidebar-link {{ Route::is('admin.employee') ? 'active' : '' }}">
                            <i class="bi bi-person-circle"></i>
                            <span>Employee</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.visitor_admin') }}" class="sidebar-link {{ Route::is('admin.visitor_admin') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                            <span>Visitors</span>
                        </a>
                    </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.pass_slip_admin') }}" class="sidebar-link {{ Route::is('admin.pass_slip_admin') ? 'active' : '' }}">
                                        <i class="bi bi-pass"></i>
                                        <span>Pass Slip</span>
                                    </a>
                                </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('admin.vehicle_sticker') }}" class="sidebar-link {{ Route::is('admin.vehicle_sticker') ? 'active' : '' }}">
                                            <i class="bi bi-car-front-fill"></i>
                                            <span>Vehicle Stickers</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{ route('violation')}}" class="sidebar-link {{ Route::is('violation') ? 'active' : '' }}">
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
                                        <a href="{{ route('admin.lost_found_admin')}}" class="sidebar-link {{ Route::is('admin.lost_found_admin') ? 'active' : '' }}">
                                            <i class="bi bi-box-seam-fill"></i>
                                            <span>Lost and Found</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="{{route('admin.event_admin')}}" class="sidebar-link {{ Route::is('admin.event_admin') ? 'active' : '' }}">
                                            <i class="bi bi-calendar-week-fill"></i>
                                            <span>Events</span>
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
    {{-- <script src="{{ asset('js/sidebar.js') }}"></script> --}}
    <script>
        const hamburger = document.querySelector("#toggle-btn");

hamburger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
    hamburger.classList.toggle("show");
});

document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggle-btn");

    function adjustSidebar() {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove("expand");
            toggleBtn.classList.add("show");
        } else {
            sidebar.classList.add("expand");
            toggleBtn.classList.remove("show");
        }
    }

    adjustSidebar();

    window.addEventListener("resize", adjustSidebar);
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>
