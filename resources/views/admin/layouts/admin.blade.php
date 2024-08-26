<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <style>
        .navbar-left {
            display: flex;
            align-items: center;
        }

        .navbar-logo {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .navbar-title {
            font-size: 20px;
            font-weight: bold;
        }

        .drop-me {
            z-index: 1000;
        }
        .notification-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #A10D0D">
            <div class="container-fluid">
                <div class="navbar-left">
                    <img src="{{ URL('images/UCU-logo.png') }}" alt="Logo" class="navbar-logo">
                    <span class="navbar-title text-white">Urdaneta City University</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    @if (Route::has('login'))
                    @auth
                    <button class="btn btn-dark notification-button ">
                        <i class="bi bi-bell-fill"></i>
                    </button>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSiyWg33WlX7U9e3dvdcAO0VQ3VM9RUlXJBcA&s" alt="User" width="40" height="40">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end drop-me" aria-labelledby="userMenuButton">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard')}}">Home</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.layouts.profile_admin') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('auth.change-password')}}">Change password</a></li>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="{{ asset('bootstrap-5.3.3-dist/bootstrap.js') }}"></script>

</body>

</html>
