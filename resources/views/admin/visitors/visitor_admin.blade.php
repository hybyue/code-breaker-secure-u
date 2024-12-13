@extends('admin.layouts.sidebar_admin')

@section('title', 'Visitors')
@section('content')
<div class="row mt-2 p-4">
    <div class="col-md-6">
        <h4 class="font-weight-bold">Visitor</h4>
    </div>
    <div class="col-md-6 text-end">
        <div class="p-2">
            <a href="javascript:void(0)" id="add-visitor-btn" class="btn text-white" style="background-color: #0B9B19" data-bs-toggle="modal" data-bs-target="#addVisitorModal">
                <i class="bi bi-plus-circle-fill"></i> Add New
            </a>
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalVisitor()">Generate Report</a>
        </div>
    </div>
</div>
<div class="container mt-2">
    <form action="/admin/visitor" method="GET">
        <div class="row pb-3">
            <div class="col-md-3">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control"  value="{{ session('visitor_filter_admin.start_date', request('start_date')) }}">
            </div>
            <div class="col-md-3">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ session('visitor_filter_admin.end_date', request('end_date')) }}">
            </div>

            <div class="col-md-1 mt-4 pt-2">
                <button type="submit" class="btn btn-dark">Filter</button>
            </div>

            @if(session()->has('visitor_filter_admin'))
            <div class="col-md-0 mt-4 pt-2">
                <a href="{{ route('visitors.clear-filter-admin') }}" class="btn btn-secondary">Clear Filter</a>
            </div>
            @endif
        </div>
    </form>
</div>
        <div class="container p-2 bg-body-secondary rounded" style="overflow-x:auto;">
        <div class="row p-4">
            <div class="col-12 p-1">
                <table id="visitorTable" class="table table-light p-3 table-bordered table-striped same-height-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Visitor's Name</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th class="text-start">Entry Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestVisitors as $visit)
                        <tr id="tr_{{$visit->id}}">
                            <td>{{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}</td>
                            <td>{{ $visit->last_name }},  {{$visit->first_name }} @if($visit->middle_name){{ $visit->middle_name }}.@endif </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($visit->time_in)->format('H:i') }}</td>
                            <td id="time-out-{{ $visit->id }}" class="text-center">
                                @if (is_null($visit->time_out))
                                    <div>
                                        <span id="time-out-display-{{ $visit->id }}"></span>
                                        <button type="button" class="btn btn-sm text-white"
                                            style="background-color: #069206"
                                            data-bs-toggle="modal"
                                            data-bs-target="#checkoutModal-{{ $visit->id }}">
                                            Check
                                        </button>
                                    </div>
                                @else
                                    {{ \Carbon\Carbon::parse($visit->time_out)->format('H:i') }}
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-4">
                                        <p></p>
                                    </div>
                                    <div class="col-4 text-center">
                                        {{ $visit->entry_count }}
                                    </div>
                                    <div class="col-4 text-end">
                                        @if (!is_null($visit->time_out) && \Carbon\Carbon::parse($visit->date)->isToday())
                                            <a href="javascript:void(0)"
                                               onclick="duplicateEntry({{$visit->id}})"
                                               class="btn btn-sm text-white"
                                               style="background-color: #0B9B19"
                                               title="Add Entry">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </td>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.visitors.add_visitor')
    @include('admin.visitors.update_visitor')
    @include('admin.visitors.visitor_js')


    <div id="dynamicModals">

      {{-- Modal for showing all entries of a visitor --}}
      @foreach ($latestVisitors as $visit)
      <div class="modal fade" id="viewEntries-{{ $visit->id }}" tabindex="-1" aria-labelledby="viewEntriesLabel-{{ $visit->id }}" aria-hidden="true">
         <div class="modal-dialog w-100 mt-5 pt-4" style="max-width: 95%;">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="viewEntriesLabel-{{ $visit->id }}">Visitor Entries</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                    <div class="container mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="mb-1 text-primary">
                                            {{$visit->last_name}}, {{$visit->first_name}}
                                            @if($visit->middle_name)
                                                <span class="text-primary">{{$visit->middle_name}}.</span>
                                            @endif
                                        </h5>
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="badge bg-light text-dark p-2">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}
                                            </div>
                                            <div class="badge bg-light text-dark p-2">
                                                <i class="bi bi-card-text me-1"></i>
                                                {{$visit->id_type}}: {{$visit->id_number}}
                                            </div>
                                            <div class="badge bg-success text-white p-2">
                                                <i class="bi bi-clock-history me-1"></i>
                                                {{$visit->entry_count}} Entry Count
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
                                    <th>Colleges/Department</th>
                                    <th>Purpose</th>
                                    <th>Time in</th>
                                    <th>Time out</th>
                                    <th>Visited Person Name</th>
                                    <th>Visited Person Position</th>
                                    <th>Remarks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allVisitors->where('last_name', $visit->last_name)->where('first_name', $visit->first_name)->where('middle_name', $visit->middle_name)->where('date', $visit->date)->where('id_type', $visit->id_type)->where('id_number', $visit->id_number) as $entry)
                                <tr>
                                    <td>{{ $entry->person_to_visit }}</td>
                                    <td>{{ $entry->purpose }}</td>
                                    <td>{{ \Carbon\Carbon::parse($entry->time_in)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($entry->time_out)->format('H:i')}}</td>
                                    <td>{{ $entry->visited_person_name}}</td>
                                    <td>{{ $entry->visited_person_position}}</td>
                                    <td>{{ $entry->remarks}}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateVisitor-{{ $visit->id }}" onclick="$('#viewEntries-{{ $visit->id }}').modal('hide')">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
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



    <div id="timeOut_visitor">
        @foreach($latestVisitors as $visit)
            <div class="modal fade" id="checkoutModal-{{ $visit->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Visited Person Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('visitor.checkout_admin', $visit->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="visited_person_name" class="form-label">Person Visited Name</label>
                                    <input type="text" class="form-control" id="visited_person_name" value="{{$visit->visited_person_name}}"
                                        name="visited_person_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="visited_person_position" class="form-label">Person Visited Position</label>
                                    <input type="text" class="form-control" id="visited_person_position" value="{{$visit->visited_person_position}}"
                                        name="visited_person_position" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>

<script src="{{ asset('js/visitor_admin.js') }}"></script>
<script>
    function showPdfModalVisitor() {
        document.getElementById('loadingBar').style.display = 'block';
        document.getElementById('pdfVisitorFrame').style.display = 'none';

        const url = '/admin/generate-pdf/visitor?'  + $.param({
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
        });;

        const iframe = document.getElementById('pdfVisitorFrame');

        // Add load event listener to iframe
        iframe.onload = function() {
            document.getElementById('loadingBar').style.display = 'none';
            iframe.style.display = 'block';
        };

        // Set iframe src to trigger loading
        iframe.src = url;
     $('#pdfModalVisitorAd').modal({
        backdrop: 'static',
        keyboard: false,
        show: false,
        scrollY: false,
        scrollX: true,
    });

     $('#pdfModalVisitorAd').modal('show');


    }

    function duplicateEntry(visitorId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to add another entry for this visitor?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0B9B19',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add entry!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/visitor/${visitorId}/duplicate`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Store success state in session storage
                            sessionStorage.setItem('showSuccessMessage', 'true');
                            location.reload();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to add entry. Please try again.',
                                icon: 'error'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }

    // Add this code to show success message after page reload
    document.addEventListener('DOMContentLoaded', function() {
        if (sessionStorage.getItem('showSuccessMessage')) {
            Swal.fire({
                title: 'Success!',
                text: 'New entry has been added.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
            sessionStorage.removeItem('showSuccessMessage');
        }
    });

    </script>
<style>
    .same-height-table td {
        vertical-align: middle;
    }

    .error{
        color: rgb(209, 20, 20);
    }


</style>


@endsection

