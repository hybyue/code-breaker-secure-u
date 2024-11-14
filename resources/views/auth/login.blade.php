<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Urdaneta City University Login Page">
    <meta name="author" content="UCU">
    <title>Login</title>
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('tailwindcharts/css/tailwind.min.css')}}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
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
        .colored-toast.swal2-icon-success {
    background-color: #48941c !important;
}
.colored-toast.swal2-icon-error {
    background-color: #ff4747 !important;
}
.colored-toast.swal2-icon-warning {
    background-color: #f8bb86 !important;
}
.colored-toast.swal2-icon-info {
    background-color: #3fc3ee !important;
}
.colored-toast.swal2-icon-question {
    background-color: #87adbd !important;
}
.colored-toast .swal2-title {
    color: white;
}
.colored-toast .swal2-close {
    color: white;
}
.colored-toast .swal2-html-container {
    color: white;
}
.border-red-500 {
    border-color: #ff4747 !important;
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
    <div class="d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="login-header">
            <img src="{{ URL('images/UCU-logo.png') }}" alt="UCU Logo" class="logo">
            <h1 class="h3 font-weight-normal text-white">Secure-U</h1>
        </div>
        <div class="login-container mb-5">
            <form method="post" action="{{ route('login.action') }}">
                @csrf
                {{-- @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                <div class="container m-0 p-0">
                    <h3 class="text-center text-2xl font-extrabold">Login</h3>
                    <p class="text-center">Good day! welcome to Sercure-U website</p>
                </div>
                <div class="mt-2">
                    <label for="email" class="block text-md font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required>
                    <span class="text-red-500" id="emailError"></span>
                </div>

                <div>
                    <label for="password" class="block text-md font-medium text-gray-900">Password</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="••••••••" required>
                    <span class="text-red-500" id="passwordError"></span>
                </div>
                <div class="flex items-center justify-between">
                    <label for="remember" class="flex items-center">

                    </label>
                    <a href="{{URL('/forgot-password')}}" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                </div>
                <button type="submit" class="w-full flex justify-center py-2 mt-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Sign in</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();

                var $submitButton = $('button[type="submit"]');
                var originalButtonText = $submitButton.html();

                $.ajax({
                    url: "{{ route('login.action') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {

                        $submitButton.prop('disabled', true);
                        $submitButton.html('Signing in...');
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            window.location.href = response.redirect;
                        } else {
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
                                icon: 'error',
                                title: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 404) {
                                $('#emailError').text(xhr.responseJSON.message);
                                $('#email').addClass('border-red-500');
                        } else if( xhr.status === 401){
                            $('#passwordError').text(xhr.responseJSON.message);
                            $('#password').addClass('border-red-500');
                        } else if (xhr.status === 429) {
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
                                icon: 'error',
                                title: "Too many login attempts. Please try again in 10 minutes.",
                            });
                        } else if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            const errorMessage = Object.values(errors).flat().join('\n');

                            Swal.fire({
                                toast: true,
                                position: 'top-right',
                                iconColor: 'white',
                                customClass: {
                                    popup: 'colored-toast',
                                },
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                icon: 'error',
                                title: errorMessage,
                            });
                        } else {
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
                                icon: 'error',
                                title: 'An unexpected error occurred',
                            });
                        }
                    },
                    complete: function(xhr, status) {
                        if (status !== 'success') {
                        $submitButton.prop('disabled', false);
                        $submitButton.html(originalButtonText);
                    }
                    }
                });
            });
        });
    </script>


</body>

</html>
