
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
