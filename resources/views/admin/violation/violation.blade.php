@extends('admin.layouts.sidebar_admin')

@section('title', 'Violation')
<meta name="csrf-token" content="{{ csrf_token() }}">


@section('content')
<div class="container mt-3 pass-slip">

    <div class="row">
        <div class="col-md-6">
            <h4>Violation</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addViolationModal"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <a href="{{ route('pdf.generate-lost', request()->query()) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-losts.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
        </div>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded">
        <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">

            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <input type="text" id="search" class="form-control" placeholder="Search" style="max-width: 300px;">
            </div>
        </div>
    <table id="violationTable" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Violation</th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($violations as $violate)
            <tr  id="tr_{{$violate->id}}">
                <td>{{$violate->student_no}}</td>
                <td>{{$violate->last_name}}, {{$violate->first_name}}
                    @if($violate->middle_initial)
                     {{$violate->middle_initial}}.
                    @endif
                </td>
                <td>{{$violate->course}}</td>
                <td>{{$violate->violation_type}}</td>
                <td>{{$violate->date}}</td>
                <td>{{$violate->violation_count}} violation(s)</td>
                <td>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewEntries-{{ $violate->id }}"><i class="bi bi-eye"></i></a>
                        </div>
                        <div class="mx-1">
                        <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateVisitor   "><i class="bi bi-pencil-square"></i></a>
                        </div>
                        <div class="mx-1">
                            <a href="javascript:void(0)" onclick="deleteViolation({{$violate->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                    </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No Data available in table</td>
            </tr>
            @endforelse
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

</div>

@include('admin.violation.add_violation')
@include('admin.violation.update_violation')
@include('admin.violation.violation_js')


{{-- Modal for showing all entries of a student --}}
@foreach ($violations as $violation)
<div class="modal fade" id="viewEntries-{{ $violation->id }}" tabindex="-1" aria-labelledby="viewEntriesLabel-{{ $violation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEntriesLabel-{{ $violation->id }}">Student Violations</h5>
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
@endforeach


<style>
    .same-height-table td {
        vertical-align: middle;
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




@endsection
