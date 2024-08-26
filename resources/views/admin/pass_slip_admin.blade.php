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
            <a href="{{ route('pdf.generate-pass', array_merge(request()->query(), ['employee_type' => request('employee_type')])) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-pass-slip.pdf">
                <i class="bi bi-file-earmark-pdf-fill"></i> PDF
            </a>

                    </div>

        <div class="container mt-4">
            <form action="/admin/filter_pass_slip_admin" method="GET">
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
                    <div class="col-md-1 mt-3 pt-2">
                        <button type="submit"class="btn btn-dark">Filter</button>
                    </div>

                    @if(request('start_date') || request('end_date'))
                    <div class="col-md-0 mt-4 pt-2">
                        <a href="/admin/filter_pass_slip_admin" class="btn btn-secondary">Clear Filter</a>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    <div class="container p-3 mt-4 bg-body-secondary rounded">
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
                    <th>Pass Slip No.</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Out</th>
                    <th>In</th>
                    <th>Time Out Count</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestPassSlips as $passSlip)
                <tr>
                    <td>{{ $passSlip->p_no }}</td>
                    <td>{{ $passSlip->last_name }}, {{ $passSlip->first_name }} {{ $passSlip->middle_name }}.</td>
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
                            <div class="mx-1">
                                <form action="{{ route('archive.pass_slip', $passSlip->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Are you sure you want to Archive?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm text-white" style="background-color: #920606"><i class="bi bi-archive-fill"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td hidden>{{ $passSlip->employee_type }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No Data available in table</td>
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
                    <p><strong>Pass Slip No.:</strong> {{ $entry->p_no }}</p>
                    <p><strong>Name:</strong> {{ $entry->last_name }}, {{ $entry->first_name }} {{ $entry->middle_name }}.</p>
                    <p><strong>College/Department:</strong> {{ $entry->department }}</p>
                    <p><strong>Designation:</strong> {{ $entry->designation }}</p>
                    <p><strong>Destination:</strong> {{ $entry->destination }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($entry->date)->format('F d, Y') }}</p>
                    <p><strong>Time Out:</strong> {{ \Carbon\Carbon::parse($entry->time_out)->format('g:i A') }}</p>
                    <p><strong>Time In:</strong> {{ \Carbon\Carbon::parse($entry->time_in)->format('g:i A') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endforeach

<!-- Add New Pass Slip Modal -->
<div class="modal fade" id="addPassSlipModal" tabindex="-1" aria-labelledby="addPassSlipModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPassSlipModalLabel">Add Pass Slip</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('pass_slip.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="p_no" class="form-label">Pass Number:</label>
                        <input type="text" class="form-control" name="p_no" id="p_no" value="{{ 'P-' . now()->format('Ymd') . '-' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employee_type" class="form-label">Employee Type:</label>
                        <select class="form-select" id="employee_type" name="employee_type" required>
                            <option value="" selected disabled>Select Employee Type</option>
                            <option value="Teaching">Teaching</option>
                            <option value="Non-Teaching">Non-Teaching</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="middle_name" class="form-label">Middle Initial:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Optional" >
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="department" class="form-label">Department:</label>
                        <input type="text" class="form-control" id="department" name="department" required>
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation:</label>
                        <input class="form-control" id="designation" name="designation" rows="3" required></input>
                    </div>
                    <div class="col-md-6">
                        <label for="destination" class="form-label">Destination:</label>
                        <input class="form-control" id="destination" name="destination" required></input>
                    </div>
                    <div class="col-md-6">
                        <label for="purpose" class="form-label">Purpose:</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="1" required></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="time_out" class="form-label">Time Out</label>
                        <input type="time" class="form-control" id="time_out" name="time_out" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="time_in" class="form-label">Time In</label>
                        <input type="time" class="form-control" id="time_in" name="time_in" >
                    </div>
                    <div class="mt-2 d-flew justify-content-end align-items-end text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


{{-- Edit pass slip Information --}}
@foreach($latestPassSlips as $passSlip)
<div class="modal fade" id="updatePassSlip-{{ $passSlip->id }}" tabindex="-1" aria-labelledby="updatePassSlipModalLabel-{{ $passSlip->id }}" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updatePassSlipModalLabel-{{ $passSlip->id }}">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('update.pass_slip_admin', $passSlip->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="p_no" class="form-label">Pass Number:</label>
                        <input type="text" class="form-control" id="p_no" name="p_no" value="{{$passSlip->p_no}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employee_type" class="form-label">Employee Type:</label>
                        <select class="form-select" id="employee_type" name="employee_type" required>
                            <option value="{{$passSlip->employee_type}}" selected disabled>{{$passSlip->employee_type}}</option>
                            <option value="Teaching">Teaching</option>
                            <option value="Non-Teaching">Non-Teaching</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$passSlip->last_name}}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$passSlip->first_name}}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="middle_name" class="form-label">Middle Initial:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$passSlip->middle_name}}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="department" class="form-label">Department:</label>
                        <input type="text" class="form-control" id="department" name="department" value="{{$passSlip->department}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation:</label>
                        <input class="form-control" id="designation" name="designation" value="{{$passSlip->designation}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="destination" class="form-label">Destination:</label>
                        <input class="form-control" id="destination" name="destination" value="{{$passSlip->destination}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="purpose" class="form-label">Purpose:</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="1" required>{{$passSlip->purpose}}</textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" class="form-control" id="date-{{ $passSlip->id }}" name="date" value="{{ \Carbon\Carbon::parse($passSlip->date)->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="time_out" class="form-label">Time Out:</label>
                        <input type="time" class="form-control" id="time_out-{{ $passSlip->id }}" name="time_out" value="{{ $passSlip->time_out }}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="time_in" class="form-label">Time In:</label>
                        <input type="time" class="form-control" id="time_in-{{ $passSlip->id }}" name="time_in" value="{{ $passSlip->time_in }}" required>
                    </div>
                    <div class="mt-2 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>
                </div>
            </form>
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

<style>
    .same-height-table td {
        vertical-align: middle;
    }
    </style>
@endsection
