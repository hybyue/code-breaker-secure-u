<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Urdaneta City University Login Page">
    <meta name="author" content="UCU">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('tailwindcharts/css/tailwind.min.css')}}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
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
    <div class="d-flex flex-column align-items-center justify-content-center min-vh-100 p-2">
        <div class="login-header">
            <img src="{{ URL('images/UCU-logo.png') }}" alt="UCU Logo" class="logo">
            <h1 class="h3 font-weight-normal text-white">Secure-U</h1>
        </div>
        <div class="login-container mb-5">
            <form method="post" action="{{ route('login.action') }}">
                @csrf
                <div class="container m-0 p-0">
                    <h3 class="text-center text-2xl font-extrabold">Login</h3>
                    <p class="text-center">Good day! welcome to Sercure-U website</p>
                </div>
                <div class="mt-2">
                    <label for="email" class="block text-md font-medium text-gray-900">Email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required>
                    <span class="text-red-500" id="emailError"></span>
                </div>

                <div class="mb-2 relative">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-red-500 focus:border-red-500 w-full p-2.5" placeholder="••••••••" required>
                    <!-- Show Password Toggle -->
                    <button type="button" id="togglePassword" class="mt-4 absolute inset-y-0 right-3 text-gray-500 focus:outline-none">
                        👁
                    </button>
                </div>
                <span class="text-red-500 text-sm" id="passwordError"></span>

                <div class="flex items-center justify-between">
                    <label for="remember" class="flex items-center">

                    </label>
                    <a href="{{URL('/forgot-password')}}" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                </div>
                <button type="submit" class="w-full flex justify-center py-2 mt-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-white-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sign-in">Sign in</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁' : '🙈';
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('form').on('submit', function(e) {
                e.preventDefault();

                $('#emailError').text('');
                $('#passwordError').text('');
                $('#email, #password').removeClass('border-red-500');

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
                        if (xhr.status === 429) {
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
                                title: xhr.responseJSON.message,
                            });

                            // Extract time from message and disable button
                            const message = xhr.responseJSON.message;
                            const timeMatch = message.match(/(\d+) minute[s]? and (\d+) second[s]?|(\d+) second[s]?/);

                            if (timeMatch) {
                                let totalSeconds;
                                if (timeMatch[1] && timeMatch[2]) {
                                    // Minutes and seconds format
                                    totalSeconds = (parseInt(timeMatch[1]) * 60) + parseInt(timeMatch[2]);
                                } else {
                                    // Seconds only format
                                    totalSeconds = parseInt(timeMatch[3]);
                                }

                                $submitButton.prop('disabled', true);
                                setTimeout(() => {
                                    $submitButton.prop('disabled', false);
                                    $submitButton.html(originalButtonText);
                                }, totalSeconds * 1000);

                                $submitButton.prop('disabled', false);
                                $submitButton.html(originalButtonText);
                            }
                        } else if (xhr.status === 404) {
                            $('#emailError').text(xhr.responseJSON.message);
                            $('#email').addClass('border-red-500');
                        } else if (xhr.status === 401) {
                            $('#passwordError').text(xhr.responseJSON.message);
                            $('#password').addClass('border-red-500');
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

                            $submitButton.prop('disabled', false);
                            $submitButton.html(originalButtonText);
                        } else if (xhr.status === 419) {
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
                                title: 'Session expired. Please refresh the page.',
                            });
                            $submitButton.prop('disabled', false);
                            $submitButton.html(originalButtonText);
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
                            $submitButton.prop('disabled', false);
                            $submitButton.html(originalButtonText);
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
