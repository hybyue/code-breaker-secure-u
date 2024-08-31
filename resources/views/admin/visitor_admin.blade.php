@extends('admin.layouts.sidebar_admin')

@section('title', 'Visitors')

@section('content')

<div class="row mt-4 p-2">
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
    <form action="/filter_visitor_admin" method="GET">
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
                <a href="/filter_visitor_admin" class="btn btn-secondary">Clear Filter</a>
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
                <table id="visitorTable" class="table table-light table-bordered table-responsive table-rounded table-striped">
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
                            <td>{{ $visit->last_name }},  {{$visit->first_name }} {{ $visit->middle_name }}. </td>
                            <td>{{ $visit->person_to_visit }}</td>
                            <td>{{ $visit->purpose }}</td>
                            <td>{{ \Carbon\Carbon::parse($visit->time_in)->format('g:i A') }}</td>
                            <td id="time-out-{{ $visit->id }}" class="text-center">
                                @if(is_null($visit->time_out))
                                <div>
                                    <span id="time-out-display-{{ $visit->id }}"></span>
                                    <form action="{{ route('visitor.checkout_admin', $visit->id) }}" method="POST">
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
                                    <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateVisitor-{{ $visit->id }}"><i class="bi bi-pencil-square"></i></a>
                                    </div>
                                    <div class="mx-1">
                                    <form action="{{ route('visitor.destroy', $visit->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Are you sure you want to Archive?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm text-white" style="background-color: #920606"><i class="bi bi-archive-fill"></i></button>
                                    </form>
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
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="viewEntriesLabel-{{ $visit->id }}">Visitor Entries</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <table class="table table-bordered ">
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


    {{-- add visitor --}}
    <div class="modal fade" id="addVisitorModal" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVisitorModalLabel">Add New Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('visitor.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="search_visitor">Search Visitor:</label>
                                <input type="text" class="form-control" id="search_visitor" placeholder="Search by name" onkeyup="searchVisitors()">
                                <div id="visitorSuggestions" class="list-group mt-2"></div>
                            </div>
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="person_to_visit">Person to Visit & Company:</label>
                            <input type="text" class="form-control" id="person_to_visit" name="person_to_visit" required>
                        </div>
                        <div class="form-group">
                            <label for="purpose">Purpose:</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" required>
                        </div>
                        <input type="hidden" name="time_in" id="time_in" value="{{ now() }}">
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
                            </select>
                          </div>
                        {{-- <div class="form-group">
                            <label for="remarks">Remarks:</label>
                            <input type="text" class="form-control" id="remarks" name="remarks">
                        </div> --}}
                        <div class="d-grid gap-1 col-2 pt-2 mx-auto">
                            <button type="submit" class="btn text-white" style="background-color: #0B9B19;">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



{{-- Edit visitor Information --}}
{{-- Batch Edit Visitor Information --}}
@foreach($latestVisitors as $visit)
<div class="modal fade" id="updateVisitor-{{ $visit->id }}" tabindex="-1" aria-labelledby="updateVisitorModalLabel-{{ $visit->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateVisitorModalLabel-{{ $visit->id }}">Edit Visitor Entries</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('visitor.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Initial</th>
                                <th>Last Name</th>
                                <th>Person to Visit & Company</th>
                                <th>Purpose</th>
                                <th>ID Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allVisitors->where('last_name', $visit->last_name)->where('first_name', $visit->first_name)->where('middle_name', $visit->middle_name)->where('date', $visit->date) as $entry)
                            <tr>
                                <input type="hidden" name="entries[{{ $entry->id }}][id]" value="{{ $entry->id }}">
                                <td>
                                    <input type="text" class="form-control" name="entries[{{ $entry->id }}][first_name]" value="{{ $entry->first_name }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="entries[{{ $entry->id }}][middle_name]" value="{{ $entry->middle_name }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="entries[{{ $entry->id }}][last_name]" value="{{ $entry->last_name }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="entries[{{ $entry->id }}][person_to_visit]" value="{{ $entry->person_to_visit }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="entries[{{ $entry->id }}][purpose]" value="{{ $entry->purpose }}">
                                </td>
                                <td>
                                    <select class="form-select" name="entries[{{ $entry->id }}][id_type]" required>
                                        <option value="{{ $entry->id_type }}" selected>{{ $entry->id_type }}</option>
                                        <option value="Student ID">Student ID</option>
                                        <option value="Driver License ID">Driver License ID</option>
                                        <option value="National ID">National ID</option>
                                        <option value="Employee ID">Employee ID</option>
                                        <option value="PassPort">PassPort</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<script src="{{ asset('js/visitor_admin.js') }}"></script>

@endsection
