@extends('admin.layouts.sidebar_admin')

@section('title', 'Create an account')
<link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">

@section('content')
<div class="container mt-3">
    <h4>Create Account</h4>
</div>
<div class="container mt-3 d-flex flex-column align-items-center justify-content-center">
    <div class="login-container">
        <div class="container text-center">
            <h4>Register</h4>
            <span>Create an account for your staff</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('register.save') }}" class="login-form">
            @csrf
            <div class="form-group text-start">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required value="{{ old('name') }}">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group text-start">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="name@company.com" required value="{{ old('email') }}">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group row text-start">
               <div class="col-md-12">
                <label for="password">Password</label>
                <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>

                <div class="input-group-append">
                    <button class="btn btn-primary generate-password" type="button">Generate</button>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-lg btn-outline-secondary show-password" type="button"><i class="bi bi-eye-slash"></i></button>
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
               </div>
            </div>
            </div>
            <div class="form-group row text-start">
                <div class="col-md-12">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required>
                <div class="input-group-append">
                    <button class="btn btn-lg btn-outline-secondary show-password" type="button"><i class="bi bi-eye-slash"></i></button>
                </div>
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary btn-block mt-4">Create an account</button>
        </form>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){

        function generatePassword() {
    let charsetLower = "abcdefghijklmnopqrstuvwxyz";
    let charsetUpper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let charsetNumbers = "0123456789";
    let charsetSymbols = "_!@#$%^&*()<>?";
    let password = "";

    password += charsetLower.charAt(Math.floor(Math.random() * charsetLower.length));
    password += charsetUpper.charAt(Math.floor(Math.random() * charsetUpper.length));
    password += charsetNumbers.charAt(Math.floor(Math.random() * charsetNumbers.length));
    password += charsetSymbols.charAt(Math.floor(Math.random() * charsetSymbols.length));

    let length = 8;
    let allCharset = charsetLower + charsetUpper + charsetNumbers + charsetSymbols;

    for (let i = password.length; i < length; i++) {
        password += allCharset.charAt(Math.floor(Math.random() * allCharset.length));
    }

    password = password.split('').sort(() => 0.5 - Math.random()).join('');

    return password;
}

$('.generate-password').on('click', function() {
    let password = generatePassword();
    $('#password').val(password);
    $('#password_confirmation').val(password);
});

$('.show-password').on('click', function() {
    let passwordInput = $(this).closest('.input-group').find('input');
    let passwordFieldType = passwordInput.attr('type');
    let newPasswordFieldType = passwordFieldType == 'password' ? 'text' : 'password';
    passwordInput.attr('type', newPasswordFieldType);
    $(this).html(newPasswordFieldType == 'password' ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>');
});

    });
</script>
@endsection

@push('styles')
<style>
    .login-container {
        background: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
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

.form-group .input-group-append .generate-password {
    border-radius: 0 !important;
}

.form-group .input-group-append .show-password {
    border-left: none !important;
    border-radius: 0 0.25rem 0.25rem 0 !important;
    border: 1px solid #ced4da;
}
</style>
@endpush
