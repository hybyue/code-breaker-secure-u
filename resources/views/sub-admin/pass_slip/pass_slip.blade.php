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
            <a href="{{ route('pdf.generate-pass', array_merge(request()->query(), ['employee_type' => request('employee_type')])) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-pass-slip.pdf">
                <i class="bi bi-file-earmark-pdf-fill"></i> PDF
            </a>

                    </div>

        <div class="container mt-4">
            <form action="/filter_pass_slip" method="GET">
                <div class="row pb-3">
                    <div class="col-md-3">
                        <label for="start_date"> Start Date: </label>
                        <input type="date" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="end_date"> End Date: </label>
                        <input type="date" name="end_date" id="end_date" class="form-control" required>
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
                        <button type="submit"class="btn btn-dark">Filter</button>
                    </div>

                    @if(request('start_date') || request('end_date'))
                    <div class="col-md-0 mt-4 pt-2">
                        <a href="/filter_pass_slip" class="btn btn-secondary">Clear Filter</a>
                    </div>
                    @endif
                </div>
            </form>
        </div>

    <div class="container p-3 bg-body-secondary rounded">
        <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">

            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <input type="text" id="search" class="form-control" placeholder="Search" style="max-width: 300px;" onkeyup="searchTable()">
            </div>
        </div>
        <table id="passTable" class="table table-bordered same-height-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>College/Department</th>
                    <th>Designation</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Time Out</th>
                    <th>Time In</th>
                    <th>Time Out Count</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestPassSlips as $passSlip)
                    <tr>
                        <td>{{ $passSlip->p_no }}</td>
                        <td>{{ $passSlip->last_name }}, {{ $passSlip->first_name }} {{ $passSlip->middle_name }}.</td>
                        <td>{{ $passSlip->department }}</td>
                        <td>{{ $passSlip->designation }}</td>
                        <td>{{ $passSlip->destination }}</td>
                        <td>{{\Carbon\Carbon::parse($passSlip->date)->format('F d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($passSlip->time_out)->format('g:i A')}}</td>
                        <td>{{ \Carbon\Carbon::parse($passSlip->time_in)->format('g:i A')}}</td>
                        <td>{{ $passSlip->exit_count }}</td>
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
                        <td hidden>{{ $passSlip->employee_type }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Data available in table</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-between">
            <div>Showing {{ $latestPassSlips->count() }} of {{ $latestPassSlips->total() }} entries</div>
            <nav>
                <ul class="pagination">
                    <li class="page-item {{ $latestPassSlips->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $latestPassSlips->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $latestPassSlips->lastPage(); $i++)
                        <li class="page-item {{ $latestPassSlips->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $latestPassSlips->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $latestPassSlips->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $latestPassSlips->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@include('sub-admin.pass_slip.add_pass')
@include('sub-admin.pass_slip.update_pass')
@include('sub-admin.pass_slip.pass_js')



@foreach($latestPassSlips as $passSlip)
<div class="modal fade" id="viewPassSlip-{{ $passSlip->id }}" tabindex="-1" aria-labelledby="viewPassSlipLabel-{{ $passSlip->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPassSlipLabel-{{ $passSlip->id }}">Pass Slip Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach($allPassSlips->where('last_name', $passSlip->last_name)->where('first_name', $passSlip->first_name)->where('middle_name', $passSlip->middle_name)->where('date', $passSlip->date) as $entry)
                <div class="card mt-2 p-2">
                    <div class="card-body p-3">
                        <p><strong>Name:</strong> {{ $entry->last_name }}, {{ $entry->first_name }} {{ $entry->middle_name }}.</p>
                        <p><strong>College/Department:</strong> {{ $entry->department }}</p>
                        <p><strong>Designation:</strong> {{ $entry->designation }}</p>
                        <p><strong>Destination:</strong> {{ $entry->destination }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($entry->date)->format('F d, Y') }}</p>
                        <p><strong>Time Out:</strong> {{ \Carbon\Carbon::parse($entry->time_out)->format('g:i A') }}</p>
                        <p><strong>Time In:</strong> {{ \Carbon\Carbon::parse($entry->time_in)->format('g:i A') }}</p>
                        <p><strong>Time Out Count:</strong> {{ $entry->exit_count }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach



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
</script>


{{-- <script src="{{ asset('js/pass_slip_sub.js') }}"></script> --}}


<style>
    .same-height-table td {
        vertical-align: middle;
    }
</style>
@endsection
