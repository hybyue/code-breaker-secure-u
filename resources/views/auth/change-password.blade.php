<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <style>
        .profile-card {
            width: 100%;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .profile-card {
                width: 100%;
            }
        }
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .login-header {
            text-align: center;
        }

        .login-form {
            text-align: center;
        }

        .alert {
            background-color: rgb(40, 197, 1)
            margin-top: 20px;
            width: 100%;
        }

    .form-group .input-group-append .generate-passwords {
        border-radius: 0 !important;
    }

    .form-group .input-group-append .show-passwords {
        border-left: none !important;
        border-radius: 0 0.25rem 0.25rem 0 !important;
        border: 1px solid #ced4da;
    }
    .text-danger {
            margin-top: 0;
            margin-bottom: 5px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="p-3 mt-2">
        <a href="{{ url('/back') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-4">
            <div class="profile-card card text-center text-white" style="background-color: #2C3539;">
                <div class="card-body">
                    <img src="{{ asset('images/zoro.png') }}" alt="Profile Picture" class="profile-picture">
                    <h3 class="card-title">{{ $user->name }}</h3>
                    <p class="card-text"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                    @if ($employees)
                        <p class="card-text">ID No.: {{ $employees->id_number }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-card card text-center text-lg-start border-0 mt-5 p-2 rounded shadow">
                <div class="card-body p-4">
                    <h5 class="card-title">Change Password</h5>
                    <form method="POST" action="{{ route('password.change') }}" class="login-form mt-3">
                        @csrf

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="form-group text-start">
                            <label for="current_password">Current Password</label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password">
                                <div class="input-group-append">
                                    <button class="btn btn-md btn-outline-secondary show-passwords" type="button"><i class="bi bi-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                        @error('current_password')
                        <span class="text-start text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group text-start">
                            <label for="new_password">New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password">
                                <div class="input-group-append">
                                    <button class="btn btn-md btn-primary generate-passwords" type="button">Generate</button>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-md btn-outline-secondary show-passwords" type="button"><i class="bi bi-eye-slash"></i></button>
                                </div>

                            </div>
                        </div>
                        @error('new_password')
                        <span class="text-start text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group text-start">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Confirm New Password">
                                <div class="input-group-append">
                                    <button class="btn btn-md btn-outline-secondary show-passwords" type="button"><i class="bi bi-eye-slash"></i></button>
                                </div>
                                <br>
                            </div>
                        </div>
                        @error('new_password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-block mt-4">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<script>
    $(document).ready(function(){

        function generatePassword(){
            let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_!@#$%^&*()<>?";
            let password = "";
            let length= 12;

            for (let i = 0; i < length; i++) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }
            return password;
        }

        $('.generate-passwords').on('click', function(){

            let password = generatePassword();

            $('#new_password').val(password);
            $('#new_password_confirmation').val(password);
        });

        $('.show-passwords').on('click', function(){
            let passwordInput = $(this).closest('.input-group').find('input');
            let passwordFieldType = passwordInput.attr('type');
            let newPasswordFieldType= passwordFieldType=='password' ? 'text' : 'password';
            passwordInput.attr('type', newPasswordFieldType);
            $(this).html(newPasswordFieldType=='password' ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>');

        });
    });
</script>

</body>
</html>
