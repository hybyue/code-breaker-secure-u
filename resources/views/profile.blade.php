<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.min.css">

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
        .personal-info, .designation-info {
            margin-bottom: 20px;
        }
        .info-title {
            font-weight: bold;
        }
        @media (max-width: 768px) {
            .profile-card {
                width: 100%;
            }
        }


        .colored-toast.swal2-icon-success {
            background-color: #3a8f09 !important;
        }
        .colored-toast.swal2-icon-error {
            background-color: #ad1111 !important;
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

    </style>

</head>
<body>
    <nav>@include('user')</nav>
    <div class="container">
        @if(session('status') === 'success')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    icon: 'success',
                    title: "{{ session('success') }}",
                });
            });
        </script>
        @endif
    </div>
    <div class="p-3 mt-2">
        <button onclick="window.location.href='{{ route('sub-admin.dashboard') }}';" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left"></i> Back
        </button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="profile-card card text-center text-white" style="background-color: #2C3539;">
                <div class="card-body">
                    <img src="{{ asset('images/zoro.png') }}" alt="Profile Picture" class="profile-picture">
                    @if ($user)
                    <h3 class="card-title">{{ $user->first_name }} @if($user->middle_name){{ $user->middle_name }}. @endif {{ $user->last_name }}</h3>
                    <p class="card-text">{{ $user->email }} </p>
                    @if($user->id_number)<p class="card-text">ID No. {{ $user->id_number }}</p>@endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-card card">
                <div class="card-body">
                    @if ($user->civil_status && $user->gender && $user->contact_no && $user->date_birth && $user->employment_type)
                        <div class="row personal-info">
                            <h3>Personal Information</h3>
                                <p><span class="info-title">Civil Status:</span> {{ $user->civil_status }}</p>
                                <p><span class="info-title">Gender:</span> {{ $user->gender }}</p>
                                <p><span class="info-title">Contact No:</span> {{ $user->contact_no }}</p>
                                <p><span class="info-title">Date of Birth:</span> @if($user->date_birth){{ \Carbon\Carbon::parse($user->date_birth)->format('F d, Y')}} @endif</p>
                                <p><span class="info-title">Employment Type:</span> {{ $user->employment_type }}</p>
                            </div>
                    @else
                        <p>No employee information available.</p>
                    @endif
                </div>
                <div class="text-end">
                    @if($user->civil_status && $user->gender && $user->contact_no && $user->date_birth && $user->employment_type)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePersonalInformation">Edit Profile</button>
                    @else
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPersonalInformatioinModal">Add Profile Information</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Personal Information Modal -->
    <div class="modal fade" id="addPersonalInformatioinModal" tabindex="-1" aria-labelledby="addPersonalInformatioinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPersonalInformatioinModalLabel">Add Personal Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProfileForm" action="{{ route('profile.store', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                               <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_number" class="form-label">ID Number:</label>
                                <input type="text" class="form-control" id="id_number" name="id_number" value="{{ $user->id_number }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="middle_name" class="form-label">Middle Name:</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="{{$user->gender}}" selected>{{$user->gender}}</option>
                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="civil_status" class="form-label">Civil Status:</label>
                                <select class="form-select" id="civil_status" name="civil_status" required>
                                    <option value="{{$user->civil_status}}" selected>{{$user->civil_status}}</option>
                                    <option value="Single" {{ $user->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Married" {{ $user->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Divorced" {{ $user->civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="Widowed" {{ $user->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_no" class="form-label">Contact No:</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $user->contact_no }}" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="date_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ $user->date_birth ? \Carbon\Carbon::parse($user->date_birth)->format('Y-m-d') : '' }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employment Type:</label>
                                <select class="form-select" name="employment_type" required>
                                    <option value="{{$user->employment_type}}" selected>{{$user->employment_type}}</option>
                                    <option value="Part-Time" {{ $user->employment_type == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                    <option value="Full-Time" {{ $user->employment_type == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                                    <option value="Other" {{ $user->employment_type == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($user)
        <!-- Update Personal Information Modal -->
        <div class="modal fade" id="updatePersonalInformation" tabindex="-1" aria-labelledby="updatePersonalInformationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatePersonalInformationLabel">Update Personal Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateProfileForm" action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id_number" class="form-label">ID Number:</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" value="{{ $user->id_number }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="middle_name" class="form-label">Middle Name:</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender:</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="{{$user->gender}}" selected>{{$user->gender}}</option>
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="civil_status" class="form-label">Civil Status:</label>
                                    <select class="form-select" id="civil_status" name="civil_status" required>
                                        <option value="{{$user->civil_status}}" selected>{{$user->civil_status}}</option>
                                        <option value="Single" {{ $user->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ $user->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ $user->civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ $user->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_no" class="form-label">Contact No:</label>
                                    <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $user->contact_no }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_birth" class="form-label">Date of Birth:</label>
                                    <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ $user->date_birth ? \Carbon\Carbon::parse($user->date_birth)->format('Y-m-d') : '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Employment Type:</label>
                                    <select class="form-select" name="employment_type" required>
                                        <option value="{{$user->employemt_type}}" selected>{{$user->employemt_type}}</option>
                                        <option value="Part-Time" {{ $user->employment_type == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                        <option value="Full-Time" {{ $user->employment_type == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                                        <option value="Other" {{ $user->employment_type == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script>
    $(document).ready(function() {
        // Handle Add Profile Information form submission
        $('#addProfileForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#addPersonalInformatioinModal-' + response.user.id).modal('hide');
                        localStorage.setItem('showToastS', 'true');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.error-message').remove(); // Clear previous errors

                        $.each(errors, function(field, messages) {
                            let input = $('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                        });
                    }
                }
            });
        });

        // Handle Update Profile Information form submission
        $('#updateProfileForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#updatePersonalInformation-' + response.user.id).modal('hide');
                        localStorage.setItem('showToast', 'true');
                        location.reload();

                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.error-message').remove();

                        $.each(errors, function(field, messages) {
                            let input = $('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                        });
                    }
                }
            });
        });

        // Clear validation errors when modal is hidden
        $('.modal').on('hidden.bs.modal', function() {
            $('.is-invalid').removeClass('is-invalid');
            $('.error-message').remove();
        });
    });


    $(document).ready(function() {
    if (localStorage.getItem('showToast') === 'true') {
        // Show the toast notification
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
            icon: 'success',
            title: 'Information updated successfully',
        });

        // Clear the flag
        localStorage.removeItem('showToast');
    }

    if (localStorage.getItem('showToastS') === 'true') {
        // Show the toast notification
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
            icon: 'success',
            title: 'Information added successfully',
        });

        // Clear the flag
        localStorage.removeItem('showToastS');
    }
});

    </script>
</body>
</html>
