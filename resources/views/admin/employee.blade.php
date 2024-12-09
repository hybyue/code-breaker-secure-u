@extends('admin.layouts.sidebar_admin')

@section('title', 'Security Staff')

@section('content')
            <div class="row mt-4" style="padding: 16px;">
                        <div class="col-md-6">
                            <h4 class="font-weight-bold">Security Staff</h4>
                        </div>
                    </div>

                    <div class="container p-3 bg-body-secondary rounded">
                        <div class="row">
                            <div class="col-12" style="overflow-x:auto;">
                                <table id="securityTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Employee Type</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeTableBody">
                                        @foreach ($subAdmins as $user)
                                        <tr>
                                            @if($user)
                                            <td>
                                                {{ $user->last_name }}, {{$user->first_name}}
                                                @if($user->middle_name)
                                                {{$user->middle_name}}.
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">
                                                @if($user->employment_type)
                                                {{ $user->employment_type }}
                                                @else
                                                    No data
                                                @endif

                                            </td>
                                            <td>
                                                @if(Cache::has('user-is-online-' . $user->id))
                                                    <span class="text-success text-center">Online</span>
                                                @else
                                                    <span class="text-secondary text-center">Offline</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="mx-1">
                                                    <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewDataInformation-{{ $user->id }}"><i class="bi bi-eye"></i></a>
                                                    </div>
                                                    <div class="mx-1">
                                                        <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateEmployee-{{$user->id}}"><i class="bi bi-pencil-square"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            @endif

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                    </div>


{{-- View Information --}}
@foreach($subAdmins as $employee)
<div class="modal fade" id="viewDataInformation-{{ $employee->id }}" tabindex="-1" aria-labelledby="viewDataInformationLabel-{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDataInformationLabel">Security Staff Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="col-12 position-relative d-flex justify-content-center">
                            @if($employee->profile_picture)
                                <img src="{{ asset($employee->profile_picture) }}" alt="Profile Picture" class="profile-picture" id="main-profile-image">
                            @else
                                <div class="profile-picture-placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>


                    <div class="col-md-6 mb-3">
                        <label for="id_number" class="form-label">ID Number:</label>
                        <input type="text" class="form-control" id="id_number" name="id_number" value="{{ $employee->id_number }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="middle_name" class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $employee->middle_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <input class="form-control" id="gender" name="gender" value="{{ $employee->gender }}" readonly>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="civil_status" class="form-label">Civil Status:</label>
                        <input class="form-control" id="civil_status" name="civil_status" value="{{ $employee->civil_status }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email_address" class="form-label">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email_address" value="{{ $employee->email }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_no" class="form-label">Contact No.:</label>
                        <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $employee->contact_no }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employment_type" class="form-label">Employment Type:</label>
                        <input class="form-control" id="employment_type" name="employment_type" value="{{ $employee->employment_type }}" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="date_birth" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ $employee->date_birth }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emergency_contact_name" class="form-label">Emergency Contact Name:</label>
                        <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="{{ $employee->emergency_contact_name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="emergency_contact_number" class="form-label">Emergency Contact Number:</label>
                        <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" value="{{ $employee->emergency_contact_number }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_hired" class="form-label">Date Hired:</label>
                        <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ $employee->date_hired ? \Carbon\Carbon::parse($employee->date_hired)->format('Y-m-d') : '' }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="badge_number" class="form-label">Badge Number:</label>
                        <input type="text" class="form-control" id="badge_number" name="badge_number" value="{{ $employee->badge_number }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $employee->address }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="schedule" class="form-label">Schedule:</label>
                        <input type="text" class="form-control" id="schedule" name="schedule" value="{{ $employee->schedule }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position:</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" readonly>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endforeach


{{-- Edit employee Information --}}
@foreach($subAdmins as $employee)
<div class="modal fade" id="updateEmployee-{{ $employee->id }}" tabindex="-1" aria-labelledby="updateEmployeeModalLabel-{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateEmployeeModalLabel-{{ $employee->id }}">Edit Staff Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_number" class="form-label">ID Number:</label>
                            <input type="text" class="form-control" name="id_number" value="{{ $employee->id_number }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $employee->first_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Middle Name:</label>
                            <input type="text" class="form-control" name="middle_name" value="{{ $employee->middle_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $employee->last_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender:</label>
                            <select class="form-select" name="gender">
                                <option value="" selected disabled>{{ $employee->gender }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Civil Status:</label>
                            <select class="form-select" name="civil_status">
                                <option value="" selected disabled>{{ $employee->civil_status }}</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address:</label>
                            <input type="email" class="form-control" name="email" value="{{ $employee->email }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact No.:</label>
                            <input type="text" class="form-control" name="contact_no" value="{{ $employee->contact_no }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Employment Type:</label>
                            <select class="form-select" name="employment_type">
                                <option value="" selected disabled>{{ $employee->employment_type }}</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="date_birth" class="form-label">Date of Birth:</label>
                            <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ \Carbon\Carbon::parse($employee->date_birth)->format('Y-m-d') }}" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_name" class="form-label">Emergency Contact Name:</label>
                            <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="{{ $employee->emergency_contact_name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_number" class="form-label">Emergency Contact Number:</label>
                            <input type="text" class="form-control" id="emergency_contact_number" name="emergency_contact_number" value="{{ $employee->emergency_contact_number }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="date_hired" class="form-label">Date Hired:</label>
                            <input type="date" class="form-control" id="date_hired" name="date_hired" value="{{ $employee->date_hired ? \Carbon\Carbon::parse($employee->date_hired)->format('Y-m-d') : '' }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="badge_number" class="form-label">Badge Number:</label>
                            <input type="text" class="form-control" id="badge_number" name="badge_number" value="{{ $employee->badge_number }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $employee->address }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="schedule" class="form-label">Schedule:</label>
                            <input type="text" class="form-control" id="schedule" name="schedule" value="{{ $employee->schedule }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">Position:</label>
                            <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" required>
                        </div>
                        <div class="mt-3 d-flex justify-content-center text-center">
                            <button type="submit" class="btn btn-primary">Update Employee</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        new DataTable('#securityTable', {
        responsive: true,
        "ordering": false,
        language: {
                lengthMenu: "_MENU_ entries",
            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
            ],
        });

    });
</script>

<style>
   .profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-picture-placeholder {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0; /* Optional: Add a background color */
    border: 4px solid #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-picture-placeholder i {
    font-size: 80px; /* Adjust if necessary to match the visual size */
    color: #333; /* Customize color if needed */
}

.position-relative.d-flex.justify-content-center {
       display: flex;
       justify-content: center;
       margin-top: 20px;
   }


</style>
@endsection
