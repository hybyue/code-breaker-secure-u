<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Document')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="shortcut icon" href="http://example.com/favicon.ico" />
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css')}}" rel="stylesheet" >
    <link href="{{ asset('css/sidebar.css')}}" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">

    @stack('styles')
    @stack('scripts')

    <style>
        a.sidebar-link:hover {
            background-color: #2c2c2c;
        }
        a.sidebar-link.active {
            background-color: #1e1e1e;
            border-left: 2px solid #3b7ddd;
        }

    </style>

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />

</head>
<body>
    <div class="loading-bar"></div>

    <nav>@include('user')</nav>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="container">
                <button id="toggle-btn" type="button"><i class="bi bi-list"></i></button>
                <div class="sidebar-logo sidebar-header">
                    <h4 class="text-white text-center">Secure-U</h4>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="{{ route('sub-admin.dashboard') }}" class="sidebar-link {{ Route::is('sub-admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('visitors.subadmin') }}" class="sidebar-link {{ Route::is('visitors.subadmin') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Visitors</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('sub-admin.pass_slip.pass_slip') }}" class="sidebar-link {{ Route::is('sub-admin.pass_slip.pass_slip') ? 'active' : '' }}">
                        <i class="bi bi-pass"></i>
                        <span>Pass Slip</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a href="{{ route('sub-admin.sticker.vehicle_sticker_list') }}" class="sidebar-link {{ Route::is('sub-admin.sticker.vehicle_sticker_list') ? 'active' : '' }}">
                        <i class="bi bi-car-front-fill"></i>
                        <span>Vehicle Stickers</span>
                    </a>
                </li> --}}
                <li class="sidebar-item">
                    <a href="{{route('sub-admin.lost.lost_found')}}" class="sidebar-link {{ Route::is('sub-admin.lost.lost_found') ? 'active' : '' }}">
                        <i class="bi bi-box-seam-fill"></i>
                        <span>Lost and Found</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('sub-admin.violation.violation')}}" class="sidebar-link {{ Route::is('sub-admin.violation.violation') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-person"></i>
                        <span>Violation</span>
                    </a>
                </li>
            </ul>
        </aside>


        <div class="main p-3" style="background-color: #f5f3f3;">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

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
