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
                            <div class="dropdown">

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

 <!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


</body>

</html>
