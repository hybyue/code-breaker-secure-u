@extends('admin.layouts.sidebar_admin')

@section('title', 'Security Staff')

@section('content')
            <div class="row" style="padding: 16px;">
                        <div class="col-md-6">
                            <h4>Security Staff</h4>
                        </div>
                    </div>

                    <div class="container p-3" style="background-color:#D9D9D9;">
                        <div class="row mb-3">
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="entries" class="mr-2">Show</label>
                                <select id="entries" class="form-control w-auto m-2">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                    <option>110</option>
                                    <option>125</option>
                                </select>
                                <label for="entries" class="ml-2">entries</label>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end align-items-center">
                                <input type="text" id="search" class="form-control" placeholder="Search" style="max-width: 300px;">
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-bordered table-responsive table-center">
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
                                            @if($user->employ)
                                            <td>
                                                {{ $user->employ->last_name }}, {{$user->employ->first_name}}
                                                @if($user->employ->middle_name)
                                                {{$user->employ->middle_name}}.
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">

                                                {{ $user->employ->employment_type }}

                                            </td>
                                            <td class="text-center">
                                                @if(Cache::has('user-is-online-' . $user->id))
                                                    <span class="text-success text-center">Online</span>
                                                @else
                                                    <span class="text-secondary text-center">Offline</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                        <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewDataInformation-{{ $user->employ->id }}"><i class="bi bi-eye"> View</i></a>
                                                        {{-- <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateEmployee-{{ $user->employ->id }}"><i class="bi bi-pencil-square"></i></a>
                                                        <form action="{{ route('employee.destroy', $user->employ->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Are you sure you want to Archive?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm text-white" style="background-color: #920606"><i class="bi bi-archive-fill"></i></button>
                                                        </form> --}}
                                            </td>

                                            @else
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">No data </td>
                                            <td>
                                                @if(Cache::has('user-is-online-' . $user->id))
                                                    <span class="text-success">Online</span>
                                                @else
                                                    <span class="text-secondary">Offline</span>
                                                @endif
                                            </td>
                                            <td class="text-center"> No Employee Information</td>
                                            @endif

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                        <div class="d-flex justify-content-between">
                            <div>Showing 1 to 2 of 2 entries</div>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

{{--
<!-- Add Employee Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employee.store') }}" method="POST">
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
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email_address" class="form-label">Email Address:</label>
                        <input type="email" class="form-control" id="email_address" name="email_address" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_no" class="form-label">Contact No.:</label>
                        <input type="text" class="form-control" id="contact_no" name="contact_no" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employment_type" class="form-label">Employment Type:</label>
                        <select class="form-select" id="employment_type" name="employment_type" required>
                            <option value="" selected disabled>Select Employment Type</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Full-Time">Full-Time</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="date_birth" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="date_birth" name="date_birth" required>
                    </div>
                    <div class="mt-3 d-flex justify-content-center text-center">
                    <button type="submit" class="btn btn-primary ">Add Employee</button>
                </div>
            </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}


{{-- View Information --}}
@foreach($subAdmins as $employee)
@if($employee->employ)
<div class="modal fade" id="viewDataInformation-{{ $employee->employ->id }}" tabindex="-1" aria-labelledby="viewDataInformationLabel-{{ $employee->employ->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDataInformationLabel">Employee's Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="id_number" class="form-label">ID Number:</label>
                        <input type="text" class="form-control" id="id_number" name="id_number" value="{{ $employee->employ->id_number }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->employ->first_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="middle_name" class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $employee->employ->middle_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->employ->last_name }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <input class="form-control" id="gender" name="gender" value="{{ $employee->employ->gender }}" readonly>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="civil_status" class="form-label">Civil Status:</label>
                        <input class="form-control" id="civil_status" name="civil_status" value="{{ $employee->employ->civil_status }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email_address" class="form-label">Email Address:</label>
                        <input type="email" class="form-control" id="email_address" name="email_address" value="{{ $employee->employ->email_address }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_no" class="form-label">Contact No.:</label>
                        <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $employee->employ->contact_no }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employment_type" class="form-label">Employment Type:</label>
                        <input class="form-control" id="employment_type" name="employment_type" value="{{ $employee->employ->employment_type }}" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="date_birth" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ $employee->employ->date_birth }}" readonly>
                    </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach


{{-- Edit employee Information --}}
@foreach($subAdmins as $employee)
@if($employee->employ)
<div class="modal fade" id="updateEmployee-{{ $employee->employ->id }}" tabindex="-1" aria-labelledby="updateEmployeeModalLabel-{{ $employee->employ->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateEmployeeModalLabel-{{ $employee->employ->id }}">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('employee.update', $employee->employ->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_number" class="form-label">ID Number:</label>
                            <input type="text" class="form-control" name="id_number" value="{{ $employee->employ->id_number }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" class="form-control" name="first_name" value="{{ $employee->employ->first_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Middle Name:</label>
                            <input type="text" class="form-control" name="middle_name" value="{{ $employee->employ->middle_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value="{{ $employee->employ->last_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender:</label>
                            <select class="form-select" name="gender">
                                <option value="" selected disabled>{{ $employee->employ->gender }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Civil Status:</label>
                            <select class="form-select" name="civil_status">
                                <option value="" selected disabled>{{ $employee->employ->civil_status }}</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address:</label>
                            <input type="email" class="form-control" name="email_address" value="{{ $employee->employ->email_address }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact No.:</label>
                            <input type="text" class="form-control" name="contact_no" value="{{ $employee->employ->contact_no }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Employment Type:</label>
                            <select class="form-select" name="employment_type">
                                <option value="" selected disabled>{{ $employee->employ->employment_type }}</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="date_birth" class="form-label">Date of Birth:</label>
                            <input type="date" class="form-control" id="date_birth" name="date_birth" value="{{ \Carbon\Carbon::parse($employee->employ->date_birth)->format('Y-m-d') }}" >
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
@endif
@endforeach


@endsection
