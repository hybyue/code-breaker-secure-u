@extends('layouts.sidebar')

@section('title', 'Visitors')

@section('content')


    <div class="container my-3">
        @if (session('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                })
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                })
            </script>
        @endif
    </div>
    <div class="row p-3 mt-2">
        <div class="col-md-6">
            <h4 class="font-weight-bold">Visitor</h4>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn text-white " style="background-color: #0B9B19" data-bs-toggle="modal"
                data-bs-target="#addVisitorModal">
                <i class="bi bi-plus-circle-fill"></i> Add New
            </button>
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalVisitor()">Generate Report</a>

            {{-- <a href="{{ route('pdf.generate-visitors', request()->query()) }}" class="btn text-white"
                style="background-color: #0B9B19;" download="report-visitors.pdf"><i
                    class="bi bi-file-earmark-pdf-fill"></i> PDF</a> --}}
        </div>
    </div>
    <div class="container mt-2">
        <form action="/sub-admin/visitor" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"  value="{{ session('visitor_filter.start_date', request('start_date')) }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ session('visitor_filter.end_date', request('end_date')) }}">
                </div>

                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>

                @if(session()->has('visitor_filter'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="{{ url('/sub-admin/visitor/clear-filter') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>
    <div class="table-container p-2 bg-body-secondary rounded">
                <table id="visitorTableSubAdmin" class="table table-bordered table-rounded text-center same-height-table ">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Visitor's Name</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th class="text-center">Entry Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($latestVisitors as $visit)
                 <tr>
            <td>{{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}</td>
            <td>{{ ucfirst( $visit->last_name) }}, {{ ucfirst($visit->first_name) }}
                @if ($visit->middle_name)
                    {{ ucfirst($visit->middle_name) }}.
                @endif
            </td>
            <td>{{ \Carbon\Carbon::parse($visit->time_in)->format('H:i') }}</td>
            <td id="time-out-{{ $visit->id }}" class="text-center">
                @if (is_null($visit->time_out))
                    <div>
                        <span id="time-out-display-{{ $visit->id }}"></span>
                        <a href="javascript:void(0)" type="button" class="btn btn-sm text-white"
                            style="background-color: #069206"
                            data-bs-toggle="modal"
                            data-bs-target="#checkoutModal-{{ $visit->id }}">
                            Check
                        </a>
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
                               onclick="duplicateEntrySubAdmin({{$visit->id}})"
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
                        <a href="javascript:void(0)" class="btn btn-sm text-white"
                            style="background-color: #1e1f1e" data-bs-toggle="modal"
                            data-bs-target="#viewEntries-{{ $visit->id }}"><i class="bi bi-eye"></i></a>
                    </div>
                    <div class="mx-1">
                        <a href="javascript:void(0)" class="btn btn-sm text-white"
                            style="background-color: #063292" data-bs-toggle="modal"
                            data-bs-target="#updateVisitorSub-{{ $visit->id }}"><i class="bi bi-pencil-square"></i></a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach

     </tbody>
    </table>
    </div>


    <div id="viewDynamicModal">
        {{-- Modal for showing all entries of a visitor --}}
        @foreach ($latestVisitors as $visit)
            <div class="modal fade" id="viewEntries-{{ $visit->id }}" tabindex="-1"
                aria-labelledby="viewEntriesLabel-{{ $visit->id }}" aria-hidden="true">
                <div class="modal-dialog w-100 mt-5 pt-4" style="max-width: 95%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewEntriesLabel-{{ $visit->id }}">Visitor Information</h5>
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
                                                       Visitor Pass ID: {{$visit->id_number}}
                                                    </div>
                                                    <div class="badge bg-light text-dark p-2">
                                                        <i class="bi bi-calendar me-1"></i>
                                                        {{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}
                                                    </div>
                                                    <div class="badge bg-light text-dark p-2">
                                                        <i class="bi bi-card-text me-1"></i>
                                                        {{$visit->id_type}}
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
                             <table class="table table-bordered same-height-table" style="overflow-x:auto;">
                                 <thead>
                                     <tr>
                                         <th>Colleges/Deparment</th>
                                         <th>Purpose</th>
                                         <th>Time in</th>
                                         <th>Time out</th>
                                         <th>Visited Person's Name</th>
                                         <th>Visited Person's Position</th>
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
                                         <td>{{ \Carbon\Carbon::parse($entry->time_out)->format('H:i') }}</td>
                                         <td>{{ $entry->visited_person_name}}</td>
                                         <td>{{ $entry->visited_person_position}}</td>
                                         <td>{{ $entry->remarks}}</td>
                                         <td>
                                            <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateVisitorSub-{{ $visit->id }}" onclick="$('#viewEntries-{{ $visit->id }}').modal('hide')"><i class="bi bi-pencil-square"></i></a>
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
                        <form action="{{ route('visitor.checkout', $visit->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="visited_person_name" class="form-label">Name:</label>
                                    <input type="text" class="form-control" id="visited_person_name" value="{{$visit->visited_person_name}}"
                                        name="visited_person_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="visited_person_position" class="form-label">Position/Designation:</label>
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


    <script>
        function showPdfModalVisitor() {
            document.getElementById('loadingBar').style.display = 'block';
            document.getElementById('pdfVisitorFrame').style.display = 'none';

            const url = '/sub-admin/generate-pdf/visitor?'  + $.param({
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

         $('#pdfModalVisitor').modal({
            backdrop: 'static',
            keyboard: false,
            show: false,
            scrollY: false,
            scrollX: true,
        });

         $('#pdfModalVisitor').modal('show');

        }



        function duplicateEntrySubAdmin(visitorId) {
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
                    url: `/sub-admin/visitor/${visitorId}/duplicate`,
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

        </script>


@include('sub-admin.visitors.add_visitor')
@include('sub-admin.visitors.update_visitor')
@include('sub-admin.visitors.visitor_sub_js')


    <style>
        .same-height-table td {
            vertical-align: middle;
        }
    </style>



@endsection

