<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Urdaneta City University Login Page">
    <meta name="author" content="UCU">
    <title>Login</title>
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/bg-ucu.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            z-index: 1;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.336);
            z-index: -1;
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

        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .logo {
            max-width: 100px;
        }

        .login-header {
            text-align: center;
        }

        .login-form {
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #A10D0D; height:60px;">
        <div class="container-fluid">
            <div class="navbar-left">
                <img src="{{ URL('images/UCU-logo.png') }}" alt="Logo" class="navbar-logo">
                <span class="navbar-title text-white">Urdaneta City University</span>
            </div>
        </div>
    </nav>
    <div class=" d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="login-header">
            <img src="{{ URL('images/UCU-logo.png') }}" alt="UCU Logo" class="logo">
            <h1 class="h3 font-weight-normal text-white">Secure-U</h1>
        </div>
        <div class="login-container">
            <form method="post" action="{{route('password.request')}}" class="login-form">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
                @endif

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <div class="container">
                    <h4 class="text-center">Request a password email reset link</h4>
                </div>
                <div class="form-group text-start mt-2">
                    <label for="email ">Your email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="name@company.com" required="">
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Submit</button>

                <p >
                    <a href="{{route('login')}}">Login</a>
                </p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>