@extends('admin.layouts.sidebar_admin')

@section('title', 'Visitors')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="row mt-4 p-2">
    <div class="col-md-6">
        <h4>Visitor</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="javascript:void(0)" id="add-visitor-btn" class="btn text-white " style="background-color: #0B9B19" data-bs-toggle="modal" data-bs-target="#addVisitorModal">
            <i class="bi bi-plus-circle-fill"></i> Add New
        </a>
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
            <div class="col-md-1 mt-4">
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
        <div class="row p-4">
            <div class="col-12 p-1">
                <table id="visitorTable" class="table table-light p-3 table-bordered table-responsive table-rounded table-striped same-height-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Visitor's Name</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th class="text-start">Entry Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestVisitors as $visit)
                        <tr id="tr_{{$visit->id}}">
                            <td>{{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}</td>
                            <td>{{ $visit->last_name }},  {{$visit->first_name }} @if($visit->middle_name){{ $visit->middle_name }}.@endif </td>
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
                            <td class="text-center">{{ $visit->entry_count }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="mx-1">
                                        <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewEntries-{{ $visit->id }}"><i class="bi bi-eye"></i></a>
                                    </div>
                                    <div class="mx-1">
                                    <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateVisitor-{{ $visit->id }}"><i class="bi bi-pencil-square"></i></a>
                                    </div>
                                    {{-- <div class="mx-1">
                                        <a href="javascript:void(0)" onclick="deleteVisitor({{$visit->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    </div> --}}
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
    </div>

    @include('admin.visitors.add_visitor')
    @include('admin.visitors.update_visitor')
    @include('admin.visitors.visitor_js')


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



<script src="{{ asset('js/visitor_admin.js') }}"></script>

<style>
    .same-height-table td {
        vertical-align: middle;
    }

    .error{
        color: rgb(209, 20, 20);
    }
</style>

@endsection
