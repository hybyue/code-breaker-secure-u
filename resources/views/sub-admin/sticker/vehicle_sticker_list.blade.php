@extends('layouts.sidebar')

@section('title', 'Sticker List')

@section('content')
<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-6">
            <h4>Vehicle Sticker List</h4>
        </div>
        <div class="col-md-6 text-end">
            <button type="button" class="btn text-white" style="background-color: #0B9B19" data-toggle="modal" data-target="#addParking">
                <i class="bi bi-plus-circle-fill"></i> Add New
            </button>
            <button class="btn text-white " style="background-color: #0B9B19;"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</button>
        </div>
    </div>

    <div class="container mt-4">
        <form action="/filter_vehicle" method="GET">
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
                    <button type="submit"class="btn btn-dark">Filter</button>
                </div>
                @if(request('start_date') || request('end_date'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="/filter_vehicle" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="container-fluid p-3 bg-body-secondary rounded">
        <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
                <label for="entries" class="mr-2">Show</label>
                <select id="entries" class="form-control w-auto m-2">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                    <option>110</option>
                    <option>125</option>
                </select>
                <label for="entries" class="ml-2">entries</label>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <input type="text" id="search" class="form-control" placeholder="Search" style="max-width: 300px;" onkeyup="searchTable()">
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <table id="parkingTable" class="same-height-table table table-hover table-striped table-bordered table-condensed w-100">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 20%;">Vehicle No.</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 20%;">Date Register</th>
                            <th style="width: 20%;">Expiration Date</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($parkings as $parking)
                        <tr class="text-center">
                            <td>{{ $parking->sticker_id }}</td>
                            <td>{{ $parking->last_name }}, {{ $parking->first_name }} {{ $parking->middle_name }}.</td>
                            <td>{{ $parking->date_registered }}</td>
                            <td>{{ $parking->expiration_date }}</td>
                            <td> </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="mx-1">
                                        <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-toggle="modal" data-target="#detailsModal-{{ $parking->id }}"><i class="bi bi-eye"></i></a>                                    </div>
                                    <div class="mx-1">
                                        <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateParking-{{ $parking->id }}"><i class="bi bi-pencil-square"></i></a>
                                    </div>
                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No Data available in table</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div>Showing {{ $parkings->count() }} of {{ $parkings->total() }} entries</div>
            <nav>
                <ul class="pagination">
                    <li class="page-item {{ $parkings->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $parkings->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $parkings->lastPage(); $i++)
                        <li class="page-item {{ $parkings->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $parkings->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $parkings->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $parkings->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>


<!-- Vehicle Details Modal -->
@foreach($parkings as $parking)
<div class="modal fade" id="detailsModal-{{ $parking->id }}" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-{{ $parking->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel-{{ $parking->id }}">Vehicle Details - {{ $parking->license_no }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container row">
                    <div class="col-md-6">
                        <h5>Personal Information</h5>
                        <p><strong>Sticker ID:</strong> {{ $parking->sticker_id }}</p>
                        <p><strong>Name:</strong> {{ $parking->last_name }}, {{ $parking->first_name }} {{ $parking->middle_name }}</p>
                        <p><strong>Course:</strong> {{ $parking->course }}</p>
                        <p><strong>Date Registered:</strong> {{ $parking->date_registered }}</p>
                        <p><strong>Expiration Date:</strong> {{ $parking->expiration_date }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>License Information</h5>
                        <p><strong>License No.:</strong> {{ $parking->license_no }}</p>
                        <p><strong>DL Codes:</strong> {{ $parking->dl_codes }}</p>
                        <p><strong>License Expiration Date:</strong> {{ $parking->license_exp_date }}</p>
                        @if($parking->license_photo)
                            <p><strong>License Photo:</strong></p>
                            <img src="{{ asset($parking->license_photo) }}" alt="Object Image" class="img-fluid" style="max-width: 100px;">
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5>Vehicle Information</h5>
                        <p><strong>Plate No.:</strong> {{ $parking->plate_no }}</p>
                        <p><strong>Vehicle Type:</strong> {{ $parking->vehicle_type }}</p>
                        <p><strong>CR No.:</strong> {{ $parking->cr_no }}</p>
                        <p><strong>CR Date Registered:</strong> {{ $parking->cr_date_register }}</p>
                        <p><strong>Vehicle Image:</strong></p>
                            <img src="{{ asset($parking->vehicle_image) }}" alt="Object Image" class="img-fluid" style="max-width: 100px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@include('sub-admin.sticker.add_sticker')
@include('sub-admin.sticker.update_sticker')
@include('sub-admin.sticker.sticker_js')



<script>
    document.getElementById('date_registered').addEventListener('change', function() {
        var dateRegistered = new Date(this.value);
        var expirationDate = new Date(dateRegistered.setFullYear(dateRegistered.getFullYear() + 1));
        var formattedDate = expirationDate.toISOString().split('T')[0];
        document.getElementById('expiration_date').value = formattedDate;
    });

    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("parkingTable");
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

<script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.js') }}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
    .same-height-table td{
        vertical-align: middle;
    }
</style>
@endsection
