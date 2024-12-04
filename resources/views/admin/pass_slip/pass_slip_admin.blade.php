@extends('admin.layouts.sidebar_admin')

@section('title', 'Pass slip')

@section('content')
<div class="container mt-3 pass-slip">
    <div class="row">
        <div class="col-md-6">
            <h4>Pass Slip</h4>
        </div>
        <div class=" col-md-6 text-end">
            <a href="#" class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addPassSlipModal">
                <i class="bi bi-plus-circle-fill text-center"></i> Add New
            </a>
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalAd()">Generate Report</a>


                    </div>

        <div class="container mt-4">
            <form action="/admin/pass_slip" method="GET">
                <div class="row pb-3">
                    <div class="col-md-2">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"  value="{{ session('pass_slip_filter.start_date', request('start_date')) }}">
                    </div>
                    <div class="col-md-2">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ session('pass_slip_filter.end_date', request('end_date')) }}">
                    </div>
                    <div class="col-md-2">
                        <label for="employee_type">Employee Type:</label>
                        <select class="form-select" id="employee_type" name="employee_type">
                            <option value="">All</option>
                            <option value="Teaching" {{ session('pass_slip_filter.employee_type') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                            <option value="Non-Teaching" {{ session('pass_slip_filter.employee_type') == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="violation_filter">Violation Filter:</label>
                        <select class="form-select" id="violation_filter" name="violation_filter">
                            <option value="">All</option>
                            <option value="1" {{ session('pass_slip_filter.violation_filter') == '1' ? 'selected' : '' }}>Exceeded 3 Hours</option>
                            <option value="0" {{ session('pass_slip_filter.violation_filter') == '0' ? 'selected' : '' }}>Not Exceeded</option>
                        </select>
                    </div>

                    <div class="col-md-1 mt-4">
                        <button type="submit" class="btn btn-dark">Filter</button>
                    </div>

                    @if(session()->has('pass_slip_filter'))
                    <div class="col-md-0 mt-4 pt-2">
                        <a href="{{ route('pass_slip.clear-filter-admin') }}" class="btn btn-secondary">Clear Filter</a>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
        <table id="passTable" class="table table-bordered same-height-table">
            <thead>
                <tr>
                    <th>Pass Slip No.</th>
                    <th>Name</th>
                    <th>Office/Dept</th>
                    <th>Date</th>
                    <th>Out</th>
                    <th>In</th>
                    <th class="text-start">Exit Count</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($latestPassSlips as $passSlip)
                <tr id="tr_{{$passSlip->id}}">
                    <td>{{ $passSlip->p_no }}</td>
                    <td>{{ $passSlip->last_name }}, {{ $passSlip->first_name }} @if($passSlip->middle_name) {{ $passSlip->middle_name }}. @endif</td>
                    <td>{{ $passSlip->department }}</td>
                    <td>{{\Carbon\Carbon::parse($passSlip->date)->format('F d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($passSlip->time_out)->format('H:i')}}</td>
                    <td id="time-in-{{ $passSlip->id }}" class="text-center"
                        @if($passSlip->is_exceeded)
                            style="background-color: red; color: white;"
                            title="{{ $passSlip->late_minutes >= 60
                                ? floor($passSlip->late_minutes / 60) . ' hr ' . ($passSlip->late_minutes % 60) . ' min late'
                                : $passSlip->late_minutes . ' min late' }}"
                        @endif>
                        @if(is_null($passSlip->time_in))
                        <div>
                            <span id="time-in-display-{{ $passSlip->id }}"></span>
                            <form action="{{ route('passSlip.checkout_admin', $passSlip->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #069206">Check</button>
                            </form>
                        </div>
                        @else
                            {{ \Carbon\Carbon::parse($passSlip->time_in)->format('H:i') }}
                            @if($passSlip->late_minutes > 0)
                                <br>
                                <small>(
                                    @if($passSlip->late_minutes >= 60)
                                        {{ floor($passSlip->late_minutes / 60) }} hr
                                        @if($passSlip->late_minutes % 60 > 0)
                                           and {{ $passSlip->late_minutes % 60 }} min
                                        @endif
                                    @else
                                        {{ $passSlip->late_minutes }} min
                                    @endif
                                    late)
                                </small>
                            @endif
                        @endif
                    </td>
                    <td class="text-center">{{ $passSlip->exit_count }}</td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="mx-1">
                            <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewPassSlip-{{ $passSlip->id }}"><i class="bi bi-eye"></i></a>
                            </div>
                            <div class="mx-1">
                                <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updatePassSlipAd-{{ $passSlip->id }}"><i class="bi bi-pencil-square"></i></a>
                            </div>
                            {{-- <div class="mx-1">
                                <a href="javascript:void(0)" onclick="deletePassSlip({{$passSlip->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>

                            </div> --}}
                        </div>
                    </td>
                    <p hidden>{{ $passSlip->employee_type }}</p>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>
</div>

@include('admin.pass_slip.add_pass_slip')
@include('admin.pass_slip.update_pass_slip')
@include('admin.pass_slip.pass_slip_js')

<div id="latestPassSlips">
@foreach($latestPassSlips as $passSlip)
<div class="modal fade" id="viewPassSlip-{{ $passSlip->id }}" tabindex="-1" aria-labelledby="viewPassSlipLabel-{{ $passSlip->id }}" aria-hidden="true">
<div class="modal-dialog  w-100 mt-5 pt-4" style="max-width: 95%;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="viewPassSlipLabel-{{ $passSlip->id }}">Pass Slip Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="mb-1 text-primary">
                                    {{$passSlip->last_name}}, {{$passSlip->first_name}}
                                    @if($passSlip->middle_name)
                                        <span class="text-primary">{{$passSlip->middle_name}}.</span>
                                    @endif
                                </h5>
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="badge bg-light text-dark p-2">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($passSlip->date)->format('F d, Y') }}
                                    </div>
                                    <div class="badge bg-light text-dark p-2">
                                        <i class="bi bi-building me-1"></i>
                                        {{$passSlip->department}}
                                    </div>
                                    <div class="badge bg-success text-white p-2">
                                        <i class="bi bi-clock-history me-1"></i>
                                        {{$passSlip->exit_count}} Exit Count
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pass Slip No.</th>
                        <th>Designation</th>
                        <th>Absence Type</th>
                        <th>Driver Name</th>
                        <th>Destination</th>
                        <th>Purpose</th>
                        <th>Time Out</th>
                        <th>Time In</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allPassSlips->where('last_name', $passSlip->last_name)
                            ->where('first_name', $passSlip->first_name)
                            ->where('middle_name', $passSlip->middle_name)
                            ->where('date', $passSlip->date) as $entry)
                    <tr>
                        <td>{{ $entry->p_no }}</td>
                        <td>{{ $entry->designation }}</td>
                        <td>{{ $entry->check_business }}</td>
                        <td>{{ $entry->driver_name }}</td>
                        <td>{{ $entry->destination }}</td>
                        <td>{{ $entry->purpose }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($entry->time_out)->format('H:i') }}
                            <br>
                            <small class="text-muted">by:
                                @if ($entry->time_out_by)
                                    @php
                                        $user = App\Models\User::find($entry->time_out_by);
                                    @endphp
                                    {{ $user->first_name }}
                                    @if($user->middle_name){{ $user->middle_name}}.@endif
                                    {{ $user->last_name }}
                                @endif
                            </small>
                        </td>
                        <td>
                            @if($entry->time_in)
                                {{ \Carbon\Carbon::parse($entry->time_in)->format('H:i') }}
                                <br>
                                <small class="text-muted">by:
                                    @if ($entry->time_in_by)
                                        @php
                                            $user = App\Models\User::find($entry->time_in_by);
                                        @endphp
                                        {{ $user->first_name }}
                                        @if($user->middle_name){{ $user->middle_name}}.@endif
                                        {{ $user->last_name }}
                                    @endif
                                </small>
                            @endif
                        </td>
                        <td>{{ $entry->remarks}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endforeach
</div>


<!-- Modal Structure -->
<div class="modal fade" id="pdfModalAd" tabindex="-1" aria-labelledby="pdfModalAdLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalAdLabel">PDF Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingBar" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                    </div>
                </div>

                <!-- PDF display iframe -->
                <iframe id="pdfIframe" src="" style="width: 100%; height: 500px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="pdfModalLooping" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Preview Looping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingBarLoop" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">

                    </div>
                </div>

                <!-- PDF display iframe -->
                <iframe id="pdfIframeLoop" src="" style="width: 100%; height: 500px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
    function showPdfModalAd() {
    // Display loading bar initially
    document.getElementById('loadingBar').style.display = 'block';
    document.getElementById('pdfIframe').style.display = 'none';

    const url = '/generate-passSlipAdmin?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        employee_type: $('#employee_type').val()
    });

    const iframe = document.getElementById('pdfIframe');

    // Add load event listener to iframe
    iframe.onload = function() {
        document.getElementById('loadingBar').style.display = 'none';
        iframe.style.display = 'block';
    };

    // Set iframe src to trigger loading
    iframe.src = url;

    $('#pdfModalAd').modal({
        backdrop:'static',
        keyboard: false,
        focus: false,
        show: false,
        scrollY: false,
        scrollX: true,
        width: '100%',
        height: 'auto',
        aspectRatio: 1.5,
        responsive: true,
        // Enable zooming
        zoom: {
            enabled: true,
            scroll: true, // Enable scroll zooming
            wheel: false, // Disable wheel zooming
            pinch: false // Disable pinch zooming
        }
    });

    $('#pdfModalAd').modal('show');
}

function showPdfModalLooping() {
    const employeeType = $('#employee_type').val();
    const violationFilter = $('#violation_filter').val();

    if (!employeeType || !violationFilter) {
        Swal.fire({
            icon: 'warning',
            title: 'Required Filters',
            text: 'Please select both Employee Type and Violation Filter before generating the Looping Report.',
            confirmButtonColor: '#0B9B19'
        });
        return;
    }

    document.getElementById('loadingBarLoop').style.display = 'block';
    document.getElementById('pdfIframeLoop').style.display = 'none';

    const url = '/admin/generate-pdf/looping?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        employee_type: employeeType,
        violation_filter: violationFilter
    });

    document.getElementById('pdfIframeLoop').src = url;

    $('#pdfModalLooping').modal({
        backdrop:'static',
        keyboard: false,
        focus: false,
        show: false,
        scrollY: false,
        scrollX: true,
        width: '100%',
        height: 'auto',
        aspectRatio: 1.5,
        responsive: true,
        zoom: {
            enabled: true,
            scroll: true,
            wheel: false,
            pinch: false,
        }
    });

    $('#pdfModalLooping').modal('show');

    setTimeout(function() {
        document.getElementById('loadingBarLoop').style.display = 'none';
        document.getElementById('pdfIframeLoop').style.display = 'block';
    }, 2000);
}
    </script>
@endsection
