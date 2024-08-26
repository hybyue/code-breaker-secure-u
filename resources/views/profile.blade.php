<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <nav>@include('user')</nav>
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
                    @if ($employees)
                    <h3 class="card-title">{{ $employees->first_name }} @if($employees->middle_name){{ $employees->middle_name }}. @endif {{ $employees->last_name }}</h3>
                    <p class="card-text">{{ $user->email }} </p>
                    <p class="card-text">ID No. {{ $employees->id_number }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-card card">
                <div class="card-body">
                    @if ($employees)
                        <div class="row personal-info">
                            <h3>Personal Information</h3>
                                <p><span class="info-title">Civil Status:</span> {{ $employees->civil_status }}</p>
                                <p><span class="info-title">Gender:</span> {{ $employees->gender }}</p>
                                <p><span class="info-title">Contact No:</span> {{ $employees->contact_no }}</p>
                                <p><span class="info-title">Date of Birth:</span> {{ \Carbon\Carbon::parse($employees->date_birth)->format('F d, Y') }}</p>
                                <p><span class="info-title">Employment Type:</span> {{ $employees->employment_type }}</p>
                            </div>
                    @else
                        <p>No employee information available.</p>
                    @endif
                </div>
                <div class="text-end">
                    @if ($employees)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePersonalInformation-{{ $employees->id }}">Edit Profile</button>
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
                    <form action="{{ route('profile.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_number" class="form-label">ID Number:</label>
                                <input type="text" class="form-control" id="id_number" name="id_number" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="middle_name" class="form-label">Middle Name:</label>
                                <input type="text" class="form-control" id="middle_name" name="middle_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="civil_status" class="form-label">Civil Status:</label>
                                <select class="form-select" id="civil_status" name="civil_status" required>
                                    <option value="" selected disabled>Select Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_no" class="form-label">Contact No:</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="date_birth" class="form-label">Date of Birth:</label>
                                <input type="date" class="form-control" id="date_birth" name="date_birth" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="employment_type" class="form-label">Employment Type:</label>
                                <select class="form-select" id="employment_type" name="employment_type" required>
                                <option value="" selected disabled>Select Employment Type</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Other">Other</option>
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

    @if ($employees)
        <!-- Update Personal Information Modal -->
        <div class="modal fade" id="updatePersonalInformation-{{ $employees->id }}" tabindex="-1" aria-labelledby="updatePersonalInformationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updatePersonalInformationLabel">Update Personal Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.update', ['id' => $employees->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="id_number" class="form-label">ID Number:</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" value="{{ $employees->id_number }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employees->first_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="middle_name" class="form-label">Middle Name:</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $employees->middle_name }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employees->last_name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender:</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="Male" {{ $employees->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $employees->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ $employees->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="civil_status" class="form-label">Civil Status:</label>
                                    <select class="form-select" id="civil_status" name="civil_status" required>
                                        <option value="" selected disabled>Select Civil Status</option>
                                        <option value="Single" {{ $employees->civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ $employees->civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ $employees->civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ $employees->civil_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="contact_no" class="form-label">Contact No:</label>
                                    <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $employees->contact_no }}" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="date_birth" class="form-label">Date of Birth:</label>
                                    <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ \Carbon\Carbon::parse($employees->date_birth)->format('Y-m-d') }}" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Employment Type:</label>
                                    <select class="form-select" name="employment_type">
                                        <option value="" selected disabled>{{ $employees->employment_type }}</option>
                                        <option value="Part-Time">Part-Time</option>
                                        <option value="Full-Time">Full-Time</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
