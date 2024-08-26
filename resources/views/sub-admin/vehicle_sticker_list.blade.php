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


<!-- Add Parking Modal -->
<div class="modal fade" id="addParking" tabindex="-1" role="dialog" aria-labelledby="addParkingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addParkingModalLabel">Add Sticker List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store_parkings') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 form-group">
                        <label for="sticker_id">Vehicle Sticker ID:</label>
                        <input type="text" class="form-control" id="sticker_id" name="sticker_id" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="middle_name">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" placeholder="Optional" name="middle_name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" required>
                        </div>
                        <div class="form-group">
                            <label for="date_registered">Date Registered:</label>
                            <input type="date" class="form-control" id="date_registered" name="date_registered" required>
                        </div>
                        <div class="col-md-4 form-group" hidden>
                            <label for="expiration_date">Expiration Date:</label>
                            <input type="text" class="form-control" id="expiration_date" name="expiration_date" readonly>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                        <hr class=" text-center" style="width: 500px">
                    </div>
                        <h5 class="text-start">License</h5>
                        <div class="col-md-6 form-group">
                            <label for="license_no">License No.:</label>
                            <input type="text" class="form-control" id="license_no" name="license_no" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dl_codes">DL Codes:</label>
                            <input type="text" class="form-control" id="dl_codes" name="dl_codes" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="license_exp_date">License Expiration Date:</label>
                            <input type="date" class="form-control" id="license_exp_date" name="license_exp_date" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="license_photo">License Image:</label>
                            <input type="file" class="form-control" id="license_photo" name="license_photo">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <hr class=" text-center" style="width: 500px">
                        </div>
                        <h5 class="text-start">Vehicle</h5>
                        <div class="col-md-4 form-group">
                            <label for="plate_no">Plate No.:</label>
                            <input type="text" class="form-control" id="plate_no" name="plate_no" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="vehicle_type">Vehicle Type:</label>
                            <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="cr_no">CR No.:</label>
                            <input type="text" class="form-control" id="cr_no" name="cr_no" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="cr_date_register">CR Date Registered:</label>
                            <input type="date" class="form-control" id="cr_date_register" name="cr_date_register" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="vehicle_image">Vehicle Image:</label>
                            <input type="file" class="form-control" id="vehicle_image" name="vehicle_image">
                        </div>
                        <div class="d-flex justify-content-end align-items-center p-2">
                            <button type="submit" class="btn m-2 text-white" style="background-color: #0B9B19">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Edit vehicle sticker list Information --}}
@foreach($parkings as $parking)
<div class="modal fade" id="updateParking-{{ $parking->id }}" tabindex="-1" aria-labelledby="updateParkingModalLabel-{{ $parking->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateParkingModalLabel-{{ $parking->id }}">Edit Sticker List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.vehicle_sticker', $parking->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="sticker_id">Vehicle Sticker ID:</label>
                            <input type="text" class="form-control" id="sticker_id" name="sticker_id" value="{{$parking->sticker_id}}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$parking->last_name}}">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$parking->first_name}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="middle_name">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$parking->middle_name}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" value="{{$parking->course}}">
                        </div>
                        <div class="form-group">
                            <label for="date_registered">Date Registered:</label>
                            <input type="date" class="form-control" id="date_registered" name="date_registered" value="{{$parking->date_registered}}">
                        </div>
                        <div class="col-md-6 form-group" hidden>
                            <label for="expiration_date">Expiration Date:</label>
                            <input type="text" class="form-control" id="expiration_date" name="expiration_date" value="{{$parking->expiration_date}}">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <hr class=" text-center" style="width: 500px">
                        </div>
                        <h5 class="text-start">License</h5>
                        <div class="col-md-6 form-group">
                            <label for="license_no">License No.:</label>
                            <input type="text" class="form-control" id="license_no" name="license_no" value="{{$parking->license_no}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dl_codes">DL Codes:</label>
                            <input type="text" class="form-control" id="dl_codes" name="dl_codes" value="{{$parking->dl_codes}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="license_exp_date">License Expiration Date:</label>
                            <input type="date" class="form-control" id="license_exp_date" name="license_exp_date" value="{{$parking->license_exp_date}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="licensePhoto-{{$parking->id}}">License Image:</label>
                            <input type="file" class="form-control" id="licensePhoto-{{$parking->id}}" name="license_photo">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <hr class=" text-center" style="width: 500px">
                        </div>
                        <h5 class="text-start">Vehicle</h5>
                        <div class="col-md-6 form-group">
                            <label for="plate_no">Plate No.:</label>
                            <input type="text" class="form-control" id="plate_no" name="plate_no" value="{{$parking->plate_no}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="cr_no">CR No.:</label>
                            <input type="text" class="form-control" id="cr_no" name="cr_no" value="{{$parking->cr_no}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="cr_date_register">CR Date Registered:</label>
                            <input type="date" class="form-control" id="cr_date_register" name="cr_date_register" value="{{$parking->cr_date_register}}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="vehicle_type">Vehicle Type:</label>
                            <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" value="{{$parking->vehicle_type}}">
                        </div>
                        <div class="form-group">
                            <label for="vehicleImage-{{$parking->id}}">Vehicle Image:</label>
                            <input type="file" class="form-control" id="vehicleImage-{{$parking->id}}" name="vehicle_image" value="{{$parking->vehicle_image}}">
                        </div>
                        <div class="d-flex justify-content-end align-items-center p-2">
                            <button type="submit" class="btn btn-primary m-2 text-white">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
    .same-height-table td{
        vertical-align: middle;
    }
</style>
@endsection
