@extends('admin.layouts.sidebar_admin')

@section('title', 'Employees')

@section('content')
<div class="container mt-3 pass-slip">

    <div class="row">
        <div class="col-md-6">
            <h4>Employees</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#addEmployeeModalAd"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <a href="{{ route('pdf.generate-lost', request()->query()) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-losts.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
        </div>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded">
    <table id="studentTable" class="table table-bordered same-height-table">
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

                <td>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="javascript:void(0)" class="viewModal btn btn-sm text-white" style="background-color: #1e1f1e" data-id="{{ $allEmployee->id }}"   data-bs-toggle="modal" data-bs-target="#viewViolationAd-{{ $allEmployee->id }}"><i class="bi bi-eye"></i></a>
                        </div>
                        <div class="mx-1">
                        <a href="javascript:void(0)" class="editModal btn btn-sm text-white" style="background-color: #063292" data-id="{{ $allEmployee->id }}"   data-bs-toggle="modal" data-bs-target="#updateViolationModalAd-{{ $allEmployee->id }}"><i class="bi bi-pencil-square"></i></a>
                        </div>
                        <div class="mx-1">
                            <a href="javascript:void(0)" onclick="deleteEmployee({{$allEmployee->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                    </div>
                    </div>
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
