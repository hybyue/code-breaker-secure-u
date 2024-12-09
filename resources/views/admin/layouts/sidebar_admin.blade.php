<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Document')</title>

    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<link rel="shortcut icon" href="http://example.com/favicon.ico" />
	<link href="{{  asset('bootstrap-5.3.3-dist/css/bootstrap.css')}}" rel="stylesheet" >
    <link href="{{  asset('css/sidebar_admin.css')}}" rel="stylesheet" >
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
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
        body {
            overflow-x: hidden;
            width: 100%;
        }
        .navbar-left {
            display: flex;
            align-items: center;
        }
        .navbar-logo {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .drop-me {
            z-index: 5000;
        }
        .navbar .profile-picture {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #b9b9b9;
    }


    .btn-group .btn {
        margin-right: 5px;
    }

    </style>
</head>
<body>
    <div class="loading"></div>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #A10D0D">
        <div class="container-fluid">
            <div class="navbar-left">
                <div class="d-flex align-items-center">
                    <img src="{{ URL('images/UCU-logo.png') }}" alt="UCU Logo" class="navbar-logo">
                    <span class="navbar-title text-white">Urdaneta City University</span>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center">

                @if (Route::has('login'))
                    @auth
                        <div class="dropdown">
                            <a class="btn dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @if(auth()->user()->profile_picture)
                                <img src="{{ asset(auth()->user()->profile_picture) }}"
                                     alt="Profile Picture"
                                     style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; vertical-align: middle; border: 3px solid #b9b9b9;">
                            @else
                                <i class="bi bi-person-circle" style="font-size: 35px; color: white; vertical-align: middle;"></i>
                            @endif
                         </a>
                            <ul class="dropdown-menu dropdown-menu-end drop-me" aria-labelledby="userMenuButton">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.layouts.profile_admin') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('auth.change-password') }}">Change
                                        password</a></li>
                                <li><a class="dropdown-item" href="{{ url('/logout') }}">Sign out</a></li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-light ms-2">Register</a>
                        @endif
                    @endauth
                @endif


            </div>
        </div>
    </nav>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="container">
                <button id="toggle-btn" type="button"><i class="bi bi-list"></i></button>

                <div class="sidebar-logo mt-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ URL('images/smo1.png') }}"
                             alt="SMO Logo"
                             class="sidebar-smo-logo">
                        <h6 class="font-text-bold text-white mb-0 ms-1">Security Management Office</h6>
                    </div>
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


            <li class="sidebar-item {{
                Route::is('admin.pass_slip.pass_slip_admin') ||
                Route::is('admin.looping.loopings') ? 'active' : ''
            }}">
                <a href="#" class="sidebar-link has-dropdown" data-bs-target="#passSlip">
                    <i class="bi bi-pass"></i>
                    <span>Pass Slip Management</span>
                </a>
                <ul id="passSlip" class="sidebar-dropdown">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.pass_slip.pass_slip_admin') }}"
                           class="sidebar-link {{ Route::is('admin.pass_slip.pass_slip_admin') ? 'active' : '' }}">
                           With Pass Slip
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.looping.loopings') }}"
                           class="sidebar-link {{ Route::is('admin.looping.loopings') ? 'active' : '' }}">
                           Without Pass Slip
                        </a>
                    </li>
                </ul>
            </li>



                <li class="sidebar-item">
                    <a href="{{ route('admin.lost.lost_found_admin')}}" class="sidebar-link {{ Route::is('admin.lost.lost_found_admin') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Lost and Found</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.violation.violation')}}" class="sidebar-link {{ Route::is('admin.violation.violation') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-person"></i>
                        <span>Violation</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a href="{{route('admin.register')}}" class="sidebar-link {{ Route::is('admin.register') ? 'active' : '' }}">
                        <i class="bi bi-lock"></i>
                        <span>Create Account</span>
                    </a>
                </li> --}}
            <li class="sidebar-item {{
                Route::is('admin.employees.all_employee') ||
                Route::is('admin.students.student') ? 'active' : ''
            }}">
                <a href="#" class="sidebar-link has-dropdown" data-bs-target="#info">
                    <i class="bi bi-person-vcard-fill"></i>
                    <span>Information</span>
                </a>
                <ul id="info" class="sidebar-dropdown">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.employees.all_employee') }}"
                           class="sidebar-link {{ Route::is('admin.employees.all_employee') ? 'active' : '' }}">
                           Employees
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.students.student') }}"
                           class="sidebar-link {{ Route::is('admin.students.student') ? 'active' : '' }}">
                           Students
                        </a>
                    </li>
                </ul>
            </li>

                {{-- <li class="sidebar-item">
                    <a href="{{ route('admin.activity') }}" class="sidebar-link {{ Route::is('admin.activity') ? 'active' : '' }}">
                        <i class="bi bi-arrow-right-circle"></i>
                        <span>Activity Log</span>
                    </a>
                </li> --}}
            </ul>
        </aside>
        <div class="main" style="background-color: #f5f4f4;">
            @yield('content')
        </div>
    </div>



{{-- <!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}


<script src="{{ asset('js/sidebar_admin.js') }}"></script>
<script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('offline_extender/js/dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('offline_extender/js/dataTables.bootstrap5.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>




</body>
</html>
