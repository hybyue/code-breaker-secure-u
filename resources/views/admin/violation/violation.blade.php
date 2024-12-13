@extends('admin.layouts.sidebar_admin')

@section('title', 'Violation')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


@section('content')
<div class="container mt-3 pass-slip">

    <div class="row p-2">
        <div class="col-md-6">
            <h4 class="font-weight-bold">Violation</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#addViolationModalAd"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalViolation()">Generate Report</a>
        </div>
    </div>

    <div class="container mt-4">
        <form action="/admin/violation" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('violation_admin_filter.start_date', request('start_date')) }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('violation_admin_filter.end_date', request('end_date')) }}">
                </div>
                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>

                @if(session()->has('violation_admin_filter'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="{{ route('admin.violation.clear-filter') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>


    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
    <table id="violationTableAdmin" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th class="text-start">Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Violation</th>
                <th class="text-start">Date</th>
                <th>Violation Count</th>
                <th></th>
            </tr>

        </thead>
        <tbody>

            @foreach ($violations as $violate)
            <tr  id="tr_{{$violate->id}}">
                <td class="text-center">{{$violate->student_no}}</td>
                <td>{{$violate->last_name}}, {{$violate->first_name}}
                    @if($violate->middle_initial)
                     {{$violate->middle_initial}}.
                    @endif
                </td>
                <td>{{$violate->course}}</td>
                <td>{{$violate->violation_type}}</td>
                <td class="text-center">{{\Carbon\Carbon::parse($violate->date)->format('F d, Y')}}</td>
                <td>
                    @if ($violate->violation_count == 1)
                    {{$violate->violation_count}} violation
                    @elseif($violate->violation_count >=3 )
                    <span class="text-danger">{{$violate->violation_count}} violations</span>
                    @elseif($violate->violation_count == 2)
                    {{$violate->violation_count}} violations
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="javascript:void(0)" class="viewModal btn btn-sm text-white" style="background-color: #1e1f1e" data-id="{{ $violate->id }}"   data-bs-toggle="modal" data-bs-target="#viewViolationAd-{{ $violate->id }}"><i class="bi bi-eye"></i></a>
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
            @endforeach
        </tbody>
    </table>
</div>

</div>




<div id="latestViolationsAdmin">
{{-- Modal for showing all entries of a student --}}
@foreach ($violations as $violation)
<div class="modal fade" id="viewViolationAd-{{ $violation->id }}" tabindex="-1" aria-labelledby="viewViolationAdLabel-{{ $violation->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewViolationAdLabel-{{ $violation->id }}">Student Violations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-1 text-primary">
                                        {{$violation->last_name}}, {{$violation->first_name}}
                                        @if($violation->middle_name)
                                            <span class="text-primary">{{$violation->middle_name}}.</span>
                                        @endif
                                    </h5>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="badge bg-light text-dark p-2">
                                            <i class="bi bi-building me-1"></i>
                                            {{$violation->course}}
                                        </div>
                                        <div class="badge bg-success text-white p-2">
                                            <i class="bi bi-clock-history me-1"></i>
                                            {{$violation->violation_count}} Violation Count
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                <table class="table table-bordered same-height-table">
                    <thead>
                        <tr>
                            <th class="text-center">Violation No.</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Violation Type</th>
                            <th class="text-center">Remarks</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allViolations[$violation->student_no] as $entry)
                        <tr>
                            <td>{{ $entry->violation_count }}</td>
                            <td>{{ \Carbon\Carbon::parse($entry->date)->format('F d, Y') }}</td>
                            <td>{{ $entry->violation_type }}</td>
                            <td>{{ $entry->remarks }}</td>
                            <td>
                                <a href="#" class="editModal btn btn-sm text-white" style="background-color: #063292" data-id="{{ $violation->id }}"   data-bs-toggle="modal" data-bs-target="#updateViolationModalAd-{{ $violation->id }}" onclick="$('#viewViolationAd-{{ $violation->id }}').modal('hide')"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
@include('admin.violation.update_violation')

@include('admin.violation.add_violation')


@include('admin.violation.violation_js')


@endsection
