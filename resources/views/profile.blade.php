<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">

    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.13.2/dist/sweetalert2.min.css">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">


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
            <div class="profile-card card text-center text-white" style="background: linear-gradient(145deg, #2C3539, #3a4449);">
                <div class="card-body">
                    <div class="position-relative">
                        <form id="profilePictureForm" action="{{ route('profile.updatePicture', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="position-relative">
                                @if($user->profile_picture)
                                    <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="profile-picture" id="main-profile-image">
                                @else
                                    <i class="bi bi-person-circle profile-picture-placeholder" id="main-profile-icon"></i>
                                @endif
                                <label for="profile-picture-input" class="edit-overlay">
                                    <i class="bi bi-pencil-fill"></i>
                                    <input type="file"
                                           id="profile-picture-input"
                                           class="d-none"
                                           name="profile_picture"
                                           accept="image/*"
                                           data-has-profile="{{ $user->profile_picture ? 'true' : 'false' }}">
                                </label>
                            </div>
                        </form>
                    </div>
                    @if ($user)
                        <h3 class="card-title mb-3">{{ $user->first_name }} @if($user->middle_name){{ $user->middle_name }}. @endif {{ $user->last_name }}</h3>
                        <p class="card-text mb-2"><i class="bi bi-envelope"></i> {{ $user->email }}</p>
                        @if($user->id_number)<p class="card-text"><i class="bi bi-person-badge"></i> ID No. {{ $user->id_number }}</p>@endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-card card">
                <div class="card-body">
                    @if ($user->civil_status && $user->gender && $user->contact_no && $user->date_birth && $user->employment_type)
                        <div class="info-section">
                            <h3 class="section-title">Personal Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    @if($user->id_number)
                                        <p><span class="info-title">ID Number:</span> <span class="info-value">{{ $user->id_number }}</span></p>
                                    @endif
                                    @if($user->gender)
                                        <p><span class="info-title">Gender:</span> <span class="info-value">{{ $user->gender }}</span></p>
                                    @endif
                                    @if($user->civil_status)
                                        <p><span class="info-title">Civil Status:</span> <span class="info-value">{{ $user->civil_status }}</span></p>
                                    @endif
                                    @if($user->date_birth)
                                        <p><span class="info-title">Date of Birth:</span> <span class="info-value">{{ \Carbon\Carbon::parse($user->date_birth)->format('F d, Y')}}</span></p>
                                    @endif
                                    @if($user->street || $user->barangay || $user->municipality || $user->province )
                                        <p><span class="info-title">Address:</span> <span class="info-value">{{ $user->street }}, {{ $user->barangay }} {{ $user->municipality }}, {{ $user->province }}</span></p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if($user->contact_no)
                                        <p><span class="info-title">Contact No:</span> <span class="info-value">{{ $user->contact_no }}</span></p>
                                    @endif
                                    @if($user->emergency_contact_name)
                                        <p><span class="info-title">Emergency Contact:</span> <span class="info-value">{{ $user->emergency_contact_name }}</span></p>
                                    @endif
                                    @if($user->emergency_contact_number)
                                        <p><span class="info-title">Emergency No:</span> <span class="info-value">{{ $user->emergency_contact_number }}</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <h3 class="section-title">Employment Information</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    @if($user->employment_type)
                                        <p><span class="info-title">Employment Type:</span> <span class="info-value">{{ $user->employment_type }}</span></p>
                                    @endif
                                    @if($user->position)
                                        <p><span class="info-title">Position:</span> <span class="info-value">{{ $user->position }}</span></p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if($user->date_hired)
                                        <p><span class="info-title">Date Hired:</span> <span class="info-value">{{ \Carbon\Carbon::parse($user->date_hired)->format('F d, Y') }}</span></p>
                                    @endif
                                    @if($user->badge_number)
                                        <p><span class="info-title">Badge Number:</span> <span class="info-value">{{ $user->badge_number }}</span></p>
                                    @endif
                                    @if($user->schedule)
                                        <p><span class="info-title">Schedule:</span> <span class="info-value">{{ $user->schedule }}</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-muted">No employee information available.</p>
                    @endif
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                    @if($user->civil_status && $user->gender && $user->contact_no && $user->date_birth && $user->employment_type)
                        <button type="button" class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#updatePersonalInformation">
                            <i class="bi bi-pencil-square"></i> Edit Profile
                        </button>
                    @else
                        <button type="button" class="btn btn-success btn-edit" data-bs-toggle="modal" data-bs-target="#addPersonalInformatioinModal">
                            <i class="bi bi-plus-circle"></i> Add Profile Information
                        </button>
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
                    <form id="addProfileForm" action="{{ route('profile.store', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
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
                            <div class="mb-3">
                                <label for="id_number" class="form-label">ID Number:</label>
                                <input type="text" class="form-control" id="id_number" name="id_number" value="{{ $user->id_number }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="first_name" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middle_name" class="form-label">Middle Name:</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="last_name" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="civil_status" class="form-label">Civil Status:</label>
                                <select class="form-select" id="civil_status" name="civil_status" required>
                                    <option value="" selected disabled>Select Civil Status</option>
                                    <option value="Single" {{ $user->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                    <option value="Married" {{ $user->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                    <option value="Divorced" {{ $user->civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="Widowed" {{ $user->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_no" class="form-label">Contact No:</label>
                                <input type="text" class="form-control" id="contact_no"  placeholder="09*********" minlength="11" maxlength="11" name="contact_no" value="{{ $user->contact_no }}" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="date_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_birth" name="date_birth" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employment Type:</label>
                                <select class="form-select" name="employment_type" required>
                                    <option value="" selected disabled>Select a Employment Type</option>
                                    <option value="Teaching" {{ $user->employment_type == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                                    <option value="Non-Teaching" {{ $user->employment_type == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                                    <option value="Other" {{ $user->employment_type == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_name" class="form-label">Emergency Contact Name:</label>
                                <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="{{ $user->emergency_contact_name }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_number" class="form-label">Emergency Contact Number:</label>
                                <input type="text" class="form-control" id="emergency_contact_number"  placeholder="09*********" name="emergency_contact_number" minlength="11" maxlength="11" value="{{ $user->emergency_contact_number }}" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="date_hired" class="form-label">Date Hired:</label>
                                <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ $user->date_hired ? \Carbon\Carbon::parse($user->date_hired)->format('Y-m-d') : '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="badge_number" class="form-label">Badge Number:</label>
                                <input type="text" class="form-control" id="badge_number" name="badge_number" value="{{ $user->badge_number }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Address Information:</label>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Street Address:</label>
                                        <input type="text" class="form-control" name="street" value="{{ $user->street }}" placeholder="Street Address" required>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Province:</label>
                                        <select class="form-select" name="province" required>
                                            <option value="" disabled>Select Province</option>
                                            @if($user->province)
                                                <option value="{{ $user->province }}" selected>{{ $user->province }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Municipality:</label>
                                        <select class="form-select" name="city" required disabled>
                                            <option value="" disabled>Select Municipality/City</option>
                                            @if($user->municipality)
                                                <option value="{{ $user->municipality }}" selected>{{ $user->municipality }}</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Barangay:</label>
                                        <select class="form-select" name="barangay" required disabled>
                                            <option value="" disabled>Select Barangay</option>
                                            @if($user->barangay)
                                                <option value="{{ $user->barangay }}" selected>{{ $user->barangay }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="schedule" class="form-label">Schedule:</label>
                                <input type="text" class="form-control" id="schedule" name="schedule" value="{{ $user->schedule }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="position" class="form-label">Position:</label>
                                <select class="form-select" id="position" name="position" required>
                                    <option value="" selected disabled>Select Position</option>
                                    <option value="Security l" {{ $user->position == 'Security l' ? 'selected' : '' }}>Security l</option>
                                    <option value="Security ll" {{ $user->position == 'Security ll' ? 'selected' : '' }}>Security ll</option>
                                    <option value="Security lll" {{ $user->position == 'Security lll' ? 'selected' : '' }}>Security lll</option>
                                    <option value="Security Guard l" {{ $user->position == 'Security Guard l' ? 'selected' : '' }}>Security Guard l</option>
                                    <option value="Security Guard ll" {{ $user->position == 'Security Guard ll' ? 'selected' : '' }}>Security Guard ll</option>
                                    <option value="Security Guard lll" {{ $user->position == 'Security Guard lll' ? 'selected' : '' }}>Security Guard lll</option>
                                    <option value="Casual, Security" {{ $user->position == 'Casual, Security' ? 'selected' : '' }}>Casual, Security</option>
                                    <option value="Part-time Security" {{ $user->position == 'Part-time Security' ? 'selected' : '' }}>Part-time Security</option>
                                    <option value="Support Staff" {{ $user->position == 'Support Staff' ? 'selected' : '' }}>Support Staff</option>
                                    <option value="Secretary" {{ $user->position == 'Secretary' ? 'selected' : '' }}>Secretary</option>
                                    <option value="Head" {{ $user->position == 'Head' ? 'selected' : '' }}>Head</option>
                                    <option value="Other" {{ $user->position == 'Other' ? 'selected' : '' }}>Other</option>
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
                        <form id="updateProfileForm" action="{{ route('profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
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
                                <div class="mb-3">
                                    <label for="id_number" class="form-label">ID Number:</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" value="{{ $user->id_number }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="first_name" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="middle_name" class="form-label">Middle Name:</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="last_name" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender:</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="civil_status" class="form-label">Civil Status:</label>
                                    <select class="form-select" id="civil_status" name="civil_status" required>
                                        <option value="Single" {{ $user->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ $user->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ $user->civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ $user->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_no" class="form-label">Contact No:</label>
                                    <input type="text" class="form-control" id="contact_no" name="contact_no"  placeholder="09*********" value="{{ $user->contact_no }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_birth" class="form-label">Date of Birth:</label>
                                    <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ $user->date_birth ? \Carbon\Carbon::parse($user->date_birth)->format('Y-m-d') : '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Employment Type:</label>
                                    <select class="form-select" name="employment_type" required>
                                        <option value="" selected disabled>Select a Employment Type</option>
                                        <option value="Teaching" {{ $user->employment_type == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                                        <option value="Non-Teaching" {{ $user->employment_type == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                                        <option value="Other" {{ $user->employment_type == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="emergency_contact_name" class="form-label">Emergency Contact Name:</label>
                                    <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="{{ $user->emergency_contact_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="emergency_contact_number" class="form-label">Emergency Contact Number:</label>
                                    <input type="text" class="form-control" id="emergency_contact_number" placeholder="09*********" minlength="11" maxlength="11" name="emergency_contact_number" value="{{ $user->emergency_contact_number }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_hired" class="form-label">Date Hired:</label>
                                    <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ $user->date_hired ? \Carbon\Carbon::parse($user->date_hired)->format('Y-m-d') : '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="badge_number" class="form-label">Badge Number:</label>
                                    <input type="text" class="form-control" id="badge_number" name="badge_number" value="{{ $user->badge_number }}" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Information:</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Street Address:</label>
                                            <input type="text" class="form-control" name="street" value="{{ $user->street }}" placeholder="Street Address" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Province:</label>
                                            <select class="form-select" name="province" required>
                                                <option value="" disabled>Select Province</option>
                                                @if($user->province)
                                                    <option value="{{ $user->province }}" selected>{{ $user->province }}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Municipality:</label>
                                            <select class="form-select" name="city" required disabled>
                                                <option value="" disabled>Select Municipality/City</option>
                                                @if($user->municipality)
                                                    <option value="{{ $user->municipality }}" selected>{{ $user->municipality }}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Barangay:</label>
                                            <select class="form-select" name="barangay" required disabled>
                                                <option value="" disabled>Select Barangay</option>
                                                @if($user->barangay)
                                                    <option value="{{ $user->barangay }}" selected>{{ $user->barangay }}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="schedule" class="form-label">Schedule:</label>
                                    <input type="text" class="form-control" id="schedule" name="schedule" value="{{ $user->schedule }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="position" class="form-label">Position:</label>
                                    <select class="form-select" id="position" name="position" required>
                                        <option value="Security l" {{ $user->position == 'Security l' ? 'selected' : '' }}>Security l</option>
                                        <option value="Security ll" {{ $user->position == 'Security ll' ? 'selected' : '' }}>Security ll</option>
                                        <option value="Security lll" {{ $user->position == 'Security lll' ? 'selected' : '' }}>Security lll</option>
                                        <option value="Security Guard l" {{ $user->position == 'Security Guard l' ? 'selected' : '' }}>Security Guard l</option>
                                        <option value="Security Guard ll" {{ $user->position == 'Security Guard ll' ? 'selected' : '' }}>Security Guard ll</option>
                                        <option value="Security Guard lll" {{ $user->position == 'Security Guard lll' ? 'selected' : '' }}>Security Guard lll</option>
                                        <option value="Casual, Security" {{ $user->position == 'Casual, Security' ? 'selected' : '' }}>Casual, Security</option>
                                        <option value="Part-time Security" {{ $user->position == 'Part-time Security' ? 'selected' : '' }}>Part-time Security</option>
                                        <option value="Support Staff" {{ $user->position == 'Support Staff' ? 'selected' : '' }}>Support Staff</option>
                                        <option value="Secretary" {{ $user->position == 'Secretary' ? 'selected' : '' }}>Secretary</option>
                                        <option value="Head" {{ $user->position == 'Head' ? 'selected' : '' }}>Head</option>
                                        <option value="Other" {{ $user->position == 'Other' ? 'selected' : '' }}>Other</option>
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
    <script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
    <script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>
    <script src="{{ asset('js/philapi.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script>
    $(document).ready(function() {
        // Handle Add Profile Information form submission
        $('#addProfileForm').on('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
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

            const formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                success: function(response) {
                    if (response.success) {
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

    <script>
function previewImage(input, imageId, iconId) {
    const file = input.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const imageElement = document.getElementById(imageId);
        const iconElement = document.getElementById(iconId);

        if (iconElement) {
            iconElement.style.display = 'none';
        }

        if (imageElement) {
            imageElement.src = e.target.result;
            imageElement.style.display = 'block';
        }
    };

    if (file) {
        reader.readAsDataURL(file);
    }
}

    // Handle profile picture change
    document.getElementById('profile-picture-input').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const hasProfile = this.getAttribute('data-has-profile') === 'true';

            Swal.fire({
                title: 'Profile Picture',
                text: hasProfile ? "Do you want to change your profile picture?" : "Do you want to add a profile picture?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: hasProfile ? 'Yes, change it!' : 'Yes, add it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    previewImage(this, 'main-profile-image', 'main-profile-icon');
                    document.getElementById('profilePictureForm').submit();
                } else {
                    this.value = '';
                }
            });
        }
    });

    </script>


</body>
</html>
