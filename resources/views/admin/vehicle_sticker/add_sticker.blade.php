<!-- Add Parking Modal -->
<div class="modal fade" id="addParking" tabindex="-1" role="dialog" aria-labelledby="addParkingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addParkingModalLabel">Add Sticker List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStickerForm" action="" method="POST" enctype="multipart/form-data">
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
