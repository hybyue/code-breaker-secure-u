@extends('layouts.sidebar')

@section('title', 'Pass slip')

@section('content')
<div class="container pass-slip">
    <div class="row">
        <div class="col-md-6">
            <h4>Pass Slip</h4>
        </div>
        <div class=" col-md-6 text-end">
            <a href="#" class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addPassSlipModal">
                <i class="bi bi-plus-circle-fill text-center"></i> Add New
            </a>
            {{-- <a href="{{ route('pdf.generate-passes', array_merge(request()->query(), ['employee_type' => request('employee_type')])) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-pass-slip.pdf">
                <i class="bi bi-file-earmark-pdf-fill"></i> PDF
            </a> --}}
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModal()">Generate Report</a>

                    </div>

                    <div class="container mt-4">
                        <form action="/sub-admin/pass_slip/filter_pass_slip" method="GET">
                            <div class="row pb-3">
                                <div class="col-md-3">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="employee_type">Employee Type:</label>
                                    <select class="form-select" id="employee_type" name="employee_type">
                                        <option value="">All</option>
                                        <option value="Teaching" {{ request('employee_type') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                                        <option value="Non-Teaching" {{ request('employee_type') == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                                    </select>
                                </div>
                                <div class="col-md-1 mt-4 pt-2">
                                    <button type="submit" class="btn btn-dark">Filter</button>
                                </div>

                                @if(request('start_date') || request('end_date') || request('employee_type'))
                                <div class="col-md-0 mt-4 pt-2">
                                    <a href="/sub-admin/pass_slip/filter_pass_slip" class="btn btn-secondary">Clear Filter</a>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>



    <div class="container bg-body-secondary rounded" style="overflow-x:auto; width:100%;">

        <table id="passTable" class="table table-bordered same-height-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Date</th>
                    <th>Time Out</th>
                    <th>Time In</th>
                    <th>Departure Count</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @forelse ($latestPassSlips as $passSlip)
                    <tr>
                    <td>{{ $passSlip->p_no }}</td>
                    <td>{{ $passSlip->last_name }}, {{ $passSlip->first_name }} @if($passSlip->middle_name) {{ $passSlip->middle_name }}. @endif</td>
                    <td>{{ $passSlip->designation}}</td>
                    <td>{{\Carbon\Carbon::parse($passSlip->date)->format('F d, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($passSlip->time_out)->format('g:i A')}}</td>
                    <td id="time-in-{{ $passSlip->id }}" class="text-center">
                        @if(is_null($passSlip->time_in))
                        <div>
                            <span id="time-in-display-{{ $passSlip->id }}"></span>
                            <form action="{{ route('passSlip.checkout', $passSlip->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #069206">Check</button>
                            </form>
                        </div>
                        @else
                        {{ \Carbon\Carbon::parse($passSlip->time_in)->format('g:i A') }}
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
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Data available in table</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

</div>

@include('sub-admin.pass_slip.add_pass')
@include('sub-admin.pass_slip.update_pass')
@include('sub-admin.pass_slip.pass_js')


<div id="latestPassSlips">
@foreach($latestPassSlips as $passSlip)
<div class="modal fade" id="viewPassSlip-{{ $passSlip->id }}" tabindex="-1" aria-labelledby="viewPassSlipLabel-{{ $passSlip->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPassSlipLabel-{{ $passSlip->id }}">Pass Slip Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex align-items-between">
                <div class="col">
                    <h6 class="text-start"><strong>Departure count:</strong>  {{ $passSlip->exit_count }}</h6>
                </div>
                <div class="col">
                    <h6 class="text-end"> <strong>{{ $passSlip->employee_type }}</strong></h6>
                </div>
            </div>
                @foreach($allPassSlips->where('last_name', $passSlip->last_name)->where('first_name', $passSlip->first_name)->where('middle_name', $passSlip->middle_name)->where('date', $passSlip->date) as $entry)
                <div class="card mt-2 p-2">
                    <div class="card-body p-3">
                        <p><strong>Name:</strong> {{ $entry->last_name }}, {{ $entry->first_name }} {{ $entry->middle_name }}.</p>
                        <p><strong>College/Department:</strong> {{ $entry->department }}</p>
                        <p><strong>Designation:</strong> {{ $entry->designation }}</p>
                        <p><strong>Destination:</strong> {{ $entry->destination }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($entry->date)->format('F d, Y') }}</p>
                        <p><strong>Time out by:</strong>
                            @if ($entry->time_out_by)
                            @php
                                $user = App\Models\User::find($entry->time_out_by);
                            @endphp
                            {{ $user->first_name }} {{ $user->middle_name ? $user->middle_name . ' ' : '' }}{{ $user->last_name }}
                        @else
                            N/A
                        @endif
                        </p>


                        <p><strong>Time In:</strong> {{ \Carbon\Carbon::parse($entry->time_in)->format('g:i A') }}</p>
                        <p><strong>Time in by:</strong>
                            @if ($entry->time_in_by)
                            @php
                                $user = App\Models\User::find($entry->time_in_by);
                            @endphp
                            {{ $user->first_name }} {{ $user->middle_name ? $user->middle_name . ' ' : '' }}{{ $user->last_name }}
                        @else
                            N/A
                        @endif
                    </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach
</div>


<script>
    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("passTable");
        tr = table.getElementsByTagName("tr");
        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            tr[i].style.display = "none"; // Hide the row initially
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = ""; // Show the row if any column matches the search
                        break;
                    }
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    startDateInput.addEventListener('change', function () {
        endDateInput.min = this.value; // Set minimum value for end date
    });

    endDateInput.addEventListener('change', function () {
        startDateInput.max = this.value; // Set maximum value for start date
    });

    // Automatically set end date to start date if end date is empty
    if (startDateInput.value && !endDateInput.value) {
        endDateInput.value = startDateInput.value;
    }
});

</script>

<!-- Modal Structure -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Loading spinner -->
                <div id="loadingBar" style="display: none;">Loading...</div>

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

    // You can pass the necessary parameters here if needed
    const url = '/generate-passSlip?' + $.param({
        start_date: $('#start_date').val(), // example of passing data from input fields
        end_date: $('#end_date').val(),
        employee_type: $('#employee_type').val()
    });

    // Set iframe src to generated PDF URL
    document.getElementById('pdfIframe').src = url;

    // Show modal after setting the src
    $('#pdfModal').modal('show');

    // Hide loading bar and show iframe after some delay (can be adjusted)
    setTimeout(function() {
        document.getElementById('loadingBar').style.display = 'none';
        document.getElementById('pdfIframe').style.display = 'block';
    }, 1000); // 1 second delay to simulate loading
}
    </script>

<style>
    .same-height-table td {
        vertical-align: middle;
    }

    .table{
        min-width: 750px;
    }
</style>
@endsection
