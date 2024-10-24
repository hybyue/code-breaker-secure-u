@extends('layouts.sidebar')

@section('title', 'Violation')
<meta name="csrf-token" content="{{ csrf_token() }}">


@section('content')
<div class="container mt-3 pass-slip">

    <div class="row">
        <div class="col-md-6">
            <h4>Violation</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#violationModal"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalViolation()">Generate Report</a>

            {{-- <a href="{{ route('pdf.generate-violation', array_merge(request()->query())) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-violation.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a> --}}
        </div>
    </div>

    <div class="container mt-4">
        <form action="/sub-admin/violation" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>

                @if(request('start_date') || request('end_date'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="/sub-admin/violation" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>


    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
    <table id="violationTable" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th class="text-start">Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th>Violation</th>
                <th class="text-start">Date</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($violations as $violate)
            <tr  id="tr_{{$violate->id}}">
                <td class="text-center">{{$violate->student_no}}</td>
                <td>{{$violate->last_name}}, {{$violate->first_name}}
                    @if($violate->middle_initial)
                     {{$violate->middle_initial}}.
                    @endif
                </td>
                <td>{{$violate->course}}</td>
                <td>{{$violate->violation_type}}</td>
                <td class="text-center">{{$violate->date}}</td>
                <td>{{$violate->violation_count}} violation(s)</td>
                <td>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewEntries-{{ $violate->id }}"><i class="bi bi-eye"></i></a>
                        </div>
                        <divextends class="mx-1">
                        <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateViolationModal-{{ $violate->id }}"><i class="bi bi-pencil-square"></i></a>
                        </divextends(
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
</div>

</div>

@include('sub-admin.violation.add_violation')
@include('sub-admin.violation.update_violation')
@include('sub-admin.violation.violation_js')


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


<script>
document.addEventListener('DOMContentLoaded', function () {
    const startDateViolate = document.getElementById('start_date');
    const endDateViolate = document.getElementById('end_date');

    startDateViolate.addEventListener('change', function () {
        endDateViolate.min = this.value;
        if (!endDateViolate.value) {
            endDateViolate.value = this.value;
        }
    });

    endDateViolate.addEventListener('change', function () {
        startDateViolate.max = this.value;
    });

    if (startDateViolate.value && !endDateViolate.value) {
        endDateViolate.value = startDateViolate.value;
    }
    if (endDateViolate.value && !startDateViolate.value) {
        startDateViolate.value = endDateViolate.value;
    }
});
    </script>

<script>
    function showPdfModalViolation() {
        document.getElementById('loadingBar').style.display = 'block';
        document.getElementById('pdfViolationFrame').style.display = 'none';

        const url = '/generate-pdf/violation?'  + $.param({
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
        });;

     document.getElementById('pdfViolationFrame').src = url;

     $('#pdfModalViolation').modal({
        backdrop: 'static',
        keyboard: false,
        show: false,
        scrollY: false,
        scrollX: true,
    });

     $('#pdfModalViolation').modal('show');

        setTimeout(function() {
            document.getElementById('loadingBar').style.display = 'none';
            document.getElementById('pdfViolationFrame').style.display = 'block';
        }, 1000);
    }


    </script>

<style>
    .same-height-table td {
        vertical-align: middle;
    }

</style>




@endsection
