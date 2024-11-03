@extends('admin.layouts.sidebar_admin')

@section('title', 'Employees')

@section('content')
<div class="container">
    @if(session('success'))
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

<div class="container mt-3 pass-slip">

    <div class="row">
        <div class="col-md-6">
            <h4>Employees</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#addEmployeeModalAd"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <form action="{{route('import.employee')}}" method="POST" enctype="multipart/form-data" class="d-inline-flex align-items-center">
                @csrf
                <label for="file" class="btn btn-outline-primary d-flex align-items-center" style="gap: 5px;">
                    <i class="bi bi-download"></i> Import Excel
                    <input type="file" class="d-none" id="file" name="excel_file_employees" onchange="this.form.submit()">
                </label>
            </form>
        </div>
     </div>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
    <table id="employeeTable" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th>Employee ID </th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Employee Type</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allEmployees as $allEmployee)
            <tr id="tr_{{$allEmployee->id}}">
            <td>{{$allEmployee->employee_id}}</td>
            <td>{{$allEmployee->last_name}}, {{$allEmployee->first_name}} @if ($allEmployee->middle_name)
                {{$allEmployee->middle_name}}.
            @endif</td>
            <td>{{$allEmployee->designation}}</td>
            <td>{{$allEmployee->department}}</td>
            <td>{{$allEmployee->status}}</td>

                <td class="text-center">
                    <a href="javascript:void(0)" class="editModal btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateEmployeeModalAd-{{$allEmployee->id}}"><i class="bi bi-pencil-square"></i></a>

                    {{-- <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="javascript:void(0)" class="viewModal btn btn-sm text-white" style="background-color: #1e1f1e" data-id="{{ $allEmployee->id }}"   data-bs-toggle="modal" data-bs-target="#viewViolationAd-{{ $allEmployee->id }}"><i class="bi bi-eye"></i></a>
                        </div>
                        <div class="mx-1">
                        </div>
                        <div class="mx-1">
                            <a href="javascript:void(0)" onclick="deleteEmployee({{$allEmployee->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                    </div>
                    </div> --}}
                </td>
            </tr>
            @empty

        <tr>
            <td colspan="6" class="text-center">No Data available in table</td>
        </tr>
            @endforelse



        </tbody>
    </table>

</div>

</div>

@include('admin.employees.add_employee')
@include('admin.employees.update_employee')

@include('admin.employees.employee_js')




{{-- Modal for showing all entries of a student
@foreach ($violations as $violation)
<div class="modal fade" id="viewViolationAd-{{ $violation->id }}" tabindex="-1" aria-labelledby="viewViolationAdLabel-{{ $violation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewViolationAdLabel-{{ $violation->id }}">Student Violations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Violation No.</th>
                            <th>Date</th>
                            <th>Violation Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allViolations[$violation->student_no] as $entry)
                        <tr>
                            <td>{{ $entry->violation_count }}</td>
                            <td>{{ \Carbon\Carbon::parse($entry->created_at)->format('F d, Y') }}</td>
                            <td>{{ $entry->violation_type }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach --}}


<style>
    .same-height-table td {
        vertical-align: middle;
    }
</style>




@endsection
