@extends('layouts.sidebar')

@section('title', 'Pass slip')

@section('content')
<div class="container pass-slip">
    <div class="row mt-3 p-3">
        <div class="col-md-6">
            <h4 class="font-weight-bold">Pass Slip</h4>
        </div>
        <div class=" col-md-6 text-end">
            <a href="#" class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addPassSlipModal">
                <i class="bi bi-plus-circle-fill text-center"></i> Add New
            </a>
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModal()">Generate Report</a>

            </div>
    </div>
                    <div class="container mt-4">
                        <form action="/sub-admin/pass_slip" method="GET">
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

                                <div class="col-md-1 mt-4 pt-2">
                                    <button type="submit" class="btn btn-dark">Filter</button>
                                </div>

                                @if(session()->has('pass_slip_filter'))
                                <div class="col-md-0 mt-4 pt-2">
                                    <a href="{{ route('pass_slip.clear-filter') }}" class="btn btn-secondary">Clear Filter</a>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>


</div>
    <div class="container table-container bg-body-secondary rounded" >

        <table id="passTable" class="table table-bordered table-rounded p-3 same-height-table" style="min-width: 1100px;">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Office/Dept.</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Time Out</th>
                    <th class="text-center">Time In</th>
                    <th class="text-center">Exit Count</th>
                    <th></th>
                </tr>
            </thead>
            @php
            $abbreviations = [
                    "Institute of Graduate and Advanced Studies" => "IGAS",
                    "College of Law" => "COL",
                    "College of Pharmacy" => "COP",
                    "College of Human Sciences" => "CHS",
                    "College of Teacher Education" => "CTE",
                    "College of Business Management and Accountancy" => "CBMA",
                    "College of Health Sciences" => "CHS",
                    "College of Hospitality and Tourism Management" => "CHTM",
                    "College of Engineering and Architecture" => "CEA",
                    "College of Criminal Justice Education" => "CCJE",
                    "College of Arts and Sciences" => "CAS",
                    "College of Information and Technology Education" => "CITE",
                    "Center for Student Leadership and Development" => "CSLD",
                    "Center for Research and Development" => "CRD",
                    "Office of the External Affairs and Linkages" => "OEAL",
                    "Psychological Assessment and Counseling Center" => "PACC",
                    "Institutional Planning and Development" => "IPD",
                    "Disaster Risk Reduction and Management Office" => "DRRMO",
                    "Center for Community Development and Extension Services" => "CCD",
                    "School of Midwifery (CHS)" => "SOM",
                    "Center for Training and Professional Development" => "CTPD",
                    "Research Ethics Committee" => "REC",
                    "University Registrar" => "Registrar",
                    "Accounting Office" => "Accounting",
                    "Human Capital Management Office" => "HCMO",
                    "University Library" => "Library",
                    "Technical Vocational Institute" => "TVI",
                    "Security Management Office" => "SMO",
                    "Events Management Office" => "EMO",
                    "Records Management System" => "RMS",
                    "NSTP Department" => "NSTP",
                    "Management Information Systems" => "MIS",
                    "Maintenance and General Services" => "MGS",
                    "University Cashier" => "Cashier",
                    "Gender and Development" => "GAD",
                    "Audit Office" => "Audit",
                    "Engineering Management & Auxiliary Services" => "EMAS",
                    "Committee for Publication and Communication Affairs" => "CPCA",
                    "University Chaplain" => "Chaplain",
                    "University Clinic" => "Clinic",
                    "University Nurse" => "Nurse",
                ];
                @endphp
            <tbody>

                    @foreach ($latestPassSlips as $passSlip)
                    @php
                    // Check if the pass slip is late based on the condition
                        $isLate = is_null($passSlip->time_in) &&
                                \Carbon\Carbon::parse($passSlip->time_out)->diffInMinutes(now()) > ($passSlip->validity_hours * 60);
                    @endphp

                        <tr>
                        <td>{{ $passSlip->p_no }}</td>
                        <td>{{ $passSlip->last_name }}, {{ $passSlip->first_name }} @if($passSlip->middle_name) {{ $passSlip->middle_name }}. @endif</td>
                        <td>{{ $abbreviations[$passSlip->department] ?? $passSlip->department }}</td>
                        <td>{{\Carbon\Carbon::parse($passSlip->date)->format('F d, Y') }}</td>
                        <td id="time--{{ $passSlip->id }}" class="text-center" @if($isLate)
                        style="background-color: red; color: white;"
                        title="Already late from the scheduled time."
                        @endif>{{ \Carbon\Carbon::parse($passSlip->time_out)->format('H:i')}}</td>
                        <td id="time-in-{{ $passSlip->id }}" class="text-center"
                            @if($passSlip->is_exceeded)
                            style="background-color: red; color: white;"
                        @endif>
                        @if(is_null($passSlip->time_in))
                        <div>
                            <span id="time-in-display-{{ $passSlip->id }}"></span>
                            <form action="{{ route('passSlip.checkout', $passSlip->id) }}" method="POST" onsubmit="event.preventDefault(); confirmCheck('{{ $passSlip->id }}', this);">
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
                                    <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updatePassSlip-{{ $passSlip->id }}"><i class="bi bi-pencil-square"></i></a>
                                </div>
                            </div>
                        </td>
                        <p hidden>{{ $passSlip->employee_type }}</p>
                    </tr>
                @endforeach
            </tbody>
        </table>

</div>

@include('sub-admin.pass_slip.add_pass')
@include('sub-admin.pass_slip.update_pass')
@include('sub-admin.pass_slip.pass_js')


<div id="latestPassSlips">
@foreach($latestPassSlips as $passSlip)
<div class="modal fade" id="viewPassSlip-{{ $passSlip->id }}" tabindex="-1" aria-labelledby="viewPassSlipLabel-{{ $passSlip->id }}" aria-hidden="true">
    <div class="modal-dialog w-100 mt-5 pt-4" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPassSlipLabel-{{ $passSlip->id }}">Pass Slip Details</h5>
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
                <div class="table-container">
                    <table class="table table-bordered same-height-table">
                    <thead>
                        <tr>
                            <th>Pass Slip No.</th>
                            <th>Designation</th>
                            <th>Driver Name</th>
                            <th>Destination</th>
                            <th>Purpose</th>
                            <th>Time Out</th>
                            <th>Time In</th>
                            <th>Remarks</th>
                            <th></th>
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
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $entry->remarks }}</td>
                            <td>
                            <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updatePassSlip-{{ $passSlip->id }}" onclick="$('#viewPassSlip-{{ $passSlip->id }}').modal('hide')"><i class="bi bi-pencil-square"></i></a>
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



<!-- Modal Structure -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingBar" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <!-- PDF display iframe -->
                <iframe id="pdfIframe" src="" style="width: 100%; height: 500px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>



<script>
    function showPdfModal() {
    // Display loading bar initially
    document.getElementById('loadingBar').style.display = 'block';
    document.getElementById('pdfIframe').style.display = 'none';

    const url = '/generate-passSlip?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        employee_type: $('#employee_type').val()
    });

    // Get iframe element
    const iframe = document.getElementById('pdfIframe');

    // Add load event listener to iframe
    iframe.onload = function() {
        document.getElementById('loadingBar').style.display = 'none';
        iframe.style.display = 'block';
    };

    // Set iframe src to trigger loading
    iframe.src = url;

    $('#pdfModal').modal({
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

    $('#pdfModal').modal('show');
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

    const url = '/sub-admin/generate-pdf/looping?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        employee_type: employeeType,
        violation_filter: violationFilter
    });

    // Get iframe element
    const iframe = document.getElementById('pdfIframeLoop');

    // Add load event listener to iframe
    iframe.onload = function() {
        document.getElementById('loadingBarLoop').style.display = 'none';
        iframe.style.display = 'block';
    };

    // Set iframe src to trigger loading
    iframe.src = url;

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
}
    </script>
<style>
    .same-height-table td {
        vertical-align: middle;
    }

    .table{
        min-width: 750px;
    }

    .modal-backdrop[data-bs-backdrop="static"]{
        display: none;
    }
</style>


<script>
    function confirmCheck(passSlipId, form) {
        Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: 'Do you want to check this pass slip?',
            showCancelButton: true,
            confirmButtonColor: '#069206',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, check it',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

@endsection
