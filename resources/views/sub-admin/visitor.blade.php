@extends('layouts.sidebar')

@section('title', 'Visitors')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h4>Visitor</h4>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn text-white " style="background-color: #0B9B19" data-bs-toggle="modal" data-bs-target="#addVisitorModal">
                <i class="bi bi-plus-circle-fill"></i> Add New
            </button>
            <a href="{{ route('pdf.generate-visitor', request()->query()) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-visitors.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
        </div>
    </div>
    <div class="container mt-2">
        <form action="/filter_visitor" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date"> Start Date: </label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="end_date"> End Date: </label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>
                @if(request('start_date') || request('end_date'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="/filter_visitor" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>
    <div class="container p-2 bg-body-secondary rounded">
        <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
                <label for="entries" class="mr-2">Show</label>
                <select id="entries" class="form-control w-auto m-2" onchange="changeEntries()">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="110">110</option>
                    <option value="125">125</option>
                </select>
                <label for="entries" class="ml-2">entries</label>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <input type="text" id="search" class="form-control" placeholder="Search" style="max-width: 300px;" onkeyup="searchTable()">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table id="visitorTable" class="same-height-table table table-bordered table-rounded table-striped text-center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Visitor's Name</th>
                            <th>Person to visit & Company</th>
                            <th>Purpose</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Entry Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestVisitors as $visit)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}</td>
                            <td>{{ $visit->last_name }},  {{$visit->first_name }}
                                @if($visit->middle_name)
                                {{ $visit->middle_name }}.
                                @endif
                            </td>
                            <td>{{ $visit->person_to_visit }}</td>
                            <td>{{ $visit->purpose }}</td>
                            <td>{{ \Carbon\Carbon::parse($visit->time_in)->format('g:i A') }}</td>
                            <td id="time-out-{{ $visit->id }}" class="text-center">
                                @if(is_null($visit->time_out))
                                <div>
                                    <span id="time-out-display-{{ $visit->id }}"></span>
                                    <form action="{{ route('visitor.checkout', $visit->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm text-white" style="background-color: #069206">Check</button>
                                    </form>
                                </div>
                                @else
                                {{ \Carbon\Carbon::parse($visit->time_out)->format('g:i A') }}
                                @endif
                            </td>
                            <td>{{ $visit->entry_count }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="mx-1">
                                        <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewEntries-{{ $visit->id }}"><i class="bi bi-eye"></i></a>
                                    </div>
                                    <div class="mx-1">
                                        <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateVisitorSub-{{ $visit->id }}"><i class="bi bi-pencil-square"></i></a>
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
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div>Showing {{ $latestVisitors->count() }} of {{ $latestVisitors->total() }} entries</div>
            <nav>
                <ul class="pagination">
                    <li class="page-item {{ $latestVisitors->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $latestVisitors->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $latestVisitors->lastPage(); $i++)
                        <li class="page-item {{ $latestVisitors->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $latestVisitors->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $latestVisitors->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $latestVisitors->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

     {{-- Modal for showing all entries of a visitor --}}
     @foreach ($latestVisitors as $visit)
     <div class="modal fade" id="viewEntries-{{ $visit->id }}" tabindex="-1" aria-labelledby="viewEntriesLabel-{{ $visit->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewEntriesLabel-{{ $visit->id }}">Visitor Entries</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Person to visit & Company</th>
                                <th>Purpose</th>
                                <th>ID Type</th>
                                <th>Time in</th>
                                <th>Time out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allVisitors->where('last_name', $visit->last_name)->where('first_name', $visit->first_name)->where('middle_name', $visit->middle_name)->where('date', $visit->date) as $entry)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($entry->date)->format('F d, Y') }}</td>
                                <td>{{ $entry->person_to_visit }}</td>
                                <td>{{ $entry->purpose }}</td>
                                <td>{{ $entry->id_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($entry->time_in)->format('g:i A') }}</td>
                                <td>{{ $entry->time_out ? \Carbon\Carbon::parse($entry->time_out)->format('g:i A') : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    {{-- Add Visitor --}}
    <div class="modal fade" id="addVisitorModal" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVisitorModalLabel">Add Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="visitorForm" action="{{ route('sub-admin.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="search_visitor">Search Visitor:</label>
                                <input type="text" class="form-control" id="search_visitor" placeholder="Search by name" onkeyup="searchVisitor()">
                                <div id="visitorSuggestions" class="list-group mt-2"></div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="middle_name">Middle Initial:</label>
                                <input type="text" class="form-control" id="middle_name" placeholder="Optional" name="middle_name">
                            </div>
                            <div class="form-group">
                                <label for="person_to_visit">Person to Visit & Company:</label>
                                <input type="text" class="form-control" id="person_to_visit" name="person_to_visit" required>
                            </div>
                            <div class="form-group">
                                <label for="purpose">Purpose:</label>
                                <textarea class="form-control" id="purpose" name="purpose" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="id_type">ID Type:</label>
                                <select class="form-select" id="id_type" name="id_type" required>
                                    <option value="" selected disabled>Select ID Type</option>
                                    <option value="Student ID">Student ID</option>
                                    <option value="Driver License ID">Driver License ID</option>
                                    <option value="National ID">National ID</option>
                                    <option value="Employee ID">Employee ID</option>
                                    <option value="PassPort">PassPort</option>
                                    <option value="Other">Other</option>
                                </select>                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn text-white" style="background-color: #0B9B19">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Visitor --}}
    @foreach ($latestVisitors as $visitor)
    <div class="modal fade" id="updateVisitorSub-{{ $visitor->id }}" tabindex="-1" aria-labelledby="updateVisitorSubLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVisitorSubLabel">Update Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.visitorSub', $visitor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="last_name_{{ $visitor->id }}">Last Name:</label>
                                <input type="text" class="form-control" id="last_name_{{ $visitor->id }}" name="last_name" value="{{ $visitor->last_name }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="first_name_{{ $visitor->id }}">First Name:</label>
                                <input type="text" class="form-control" id="first_name_{{ $visitor->id }}" name="first_name" value="{{ $visitor->first_name }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="middle_name_{{ $visitor->id }}">Middle Initial:</label>
                                <input type="text" class="form-control" id="middle_name_{{ $visitor->id }}" name="middle_name" value="{{ $visitor->middle_name }}">
                            </div>
                            <div class="form-group">
                                <label for="person_to_visit_{{ $visitor->id }}">Person to Visit & Company:</label>
                                <input type="text" class="form-control" id="person_to_visit_{{ $visitor->id }}" name="person_to_visit" value="{{ $visitor->person_to_visit }}" required>
                            </div>
                            <div class="form-group">
                                <label for="purpose_{{ $visitor->id }}">Purpose:</label>
                                <textarea class="form-control" id="purpose_{{ $visitor->id }}" name="purpose" required>{{ $visitor->purpose }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="id_type">ID Type:</label>
                                <select class="form-select" id="id_type" name="id_type" required>
                                    <option value="{{$visitor->id_type}}" selected disabled>{{$visitor->id_type}}</option>
                                    <option value="Student ID">Student ID</option>
                                    <option value="Driver License ID">Driver License ID</option>
                                    <option value="National ID">National ID</option>
                                    <option value="Employee ID">Employee ID</option>
                                    <option value="PassPort">PassPort</option>
                                    <option value="Other">Other</option>
                                </select>
                              </div>
                        </div>
                        <input type="hidden" name="time_in" id="time_in_{{ $visitor->id }}" value="{{ $visitor->time_in }}">
                        <input type="hidden" name="time_in" id="time_in_{{ $visitor->id }}" value="{{ $visitor->time_out }}">

                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-primary text-white" ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

<script src="{{ asset('js/visitor_sub.js') }}"></script>

<style>
    .same-height-table td{
        vertical-align: middle;
    }
</style>
@endsection
