@extends('admin.layouts.sidebar_admin')

@section('title', 'Violation')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


@section('content')
<div class="container mt-3 pass-slip">

    <div class="row">
        <div class="col-md-6">
            <h4>Violation</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#addViolationModalAd"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <a href="{{ route('pdf.generate-lost', request()->query()) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-losts.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
        </div>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded">
    <table id="violationTable" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th class="text-center">Student Number</th>
                <th class="text-center">Name</th>
                <th class="text-center">Course</th>
                <th class="text-center">Violation</th>
                <th class="text-center">Date</th>
                <th class="text-center">Status</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($violations as $violate)
            <tr class="text-center" id="tr_{{$violate->id}}">
                <td class="text-center">{{$violate->student_no}}</td>
                <td>{{$violate->last_name}}, {{$violate->first_name}}
                    @if($violate->middle_initial)
                     {{$violate->middle_initial}}.
                    @endif
                </td>
                <td>{{$violate->course}}</td>
                <td>{{$violate->violation_type}}</td>
                <td>{{$violate->date}}</td>
                <td>
                    @if ($violate->violation_count > 1)
                    {{$violate->violation_count}} violations
                    @else
                    {{$violate->violation_count}} violation
                    @endif
                    </td>
                <td>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="javascript:void(0)" class="viewModal btn btn-sm text-white" style="background-color: #1e1f1e" data-id="{{ $violate->id }}"   data-bs-toggle="modal" data-bs-target="#viewViolationTest"><i class="bi bi-eye"></i></a>
                        </div>
                        <div class="mx-1">
                        <a href="#" class="editModal btn btn-sm text-white" style="background-color: #063292" data-id="{{ $violate->id }}"   data-bs-toggle="modal" data-bs-target="#updateViolationModalAd-{{ $violate->id }}"><i class="bi bi-pencil-square"></i></a>
                        </div>
                        {{-- <div class="mx-1">
                            <a href="javascript:void(0)" onclick="deleteViolation({{$violate->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div> --}}
                    </div>
                    {{-- <div><button onclick="testFunction()">test</button></div> --}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No Data available in table</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

</div>

@include('admin.violation.add_violation')
@include('admin.violation.update_violation')
@include('admin.violation.violation_js')


{{-- Modal for showing all entries of a student --}}
@foreach ($violations as $violation)
{{-- <div class="modal fade" id="viewViolationAd-{{ $violation->id }}" tabindex="-1" aria-labelledby="viewViolationAdLabel-{{ $violation->id }}" aria-hidden="true">
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
</div> --}}
<div class="modal" tabindex="-1" id="viewViolationTest">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endforeach


<style>
    .same-height-table td {
        vertical-align: middle;
    }


</style>




@endsection
