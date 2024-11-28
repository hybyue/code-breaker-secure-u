<!-- Add New Pass Slip Modal -->
<div class="modal fade" id="addPassSlipModal" tabindex="-1" aria-labelledby="addPassSlipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPassSlipModalLabel">Add Pass Slip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPassForm" action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-2 position-relative">
                            <input type="text" class="form-control" id="search_employee"
                                placeholder="Type ID or Name" oninput="searchEmployee()">
                            <span class="text-danger error-message" id="search_employee_error"></span>
                            <div id="employee_results" class="col-md-12 results-container"></div>
                            <!-- This will show suggestions -->
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="p_no" class="form-label">Pass Number:</label>
                            <input type="text" class="form-control bg-body-secondary" name="p_no" id="p_no"
                            value="{{ $passNumber ?? '' }}" readonly>
                            <span class="text-danger error-message" id="p_no_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="employee_type" class="form-label">Employee Type:</label>
                            <input class="form-control bg-body-secondary" id="status" name="employee_type" required readonly>
                            <span class="text-danger error-message" id="employee_type_error"></span>
                        </div>
                        <input hidden type="text" class="form-control " id="employee_id" name="employee_id">
                        <span class="text-danger error-message" id="employee_id_error"></span>
                        <div class="col-md-4 mb-2">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control bg-body-secondary" id="last_name" name="last_name" required readonly>
                            <span class="text-danger error-message" id="last_name_error"></span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control bg-body-secondary" id="first_name" name="first_name" required readonly>
                            <span class="text-danger error-message" id="first_name_error"></span>
                        </div>
                        <div class="col-md-4  mb-2">
                            <label for="middle_name" class="form-label">Middle Initial:</label>
                            <input type="text" class="form-control bg-body-secondary" id="middle_name" name="middle_name" readonly
                                placeholder="Optional">
                            <span class="text-danger error-message" id="middle_name_error"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="department" class="form-label">Office/Dept:</label>
                            <input type="text" class="form-control bg-body-secondary" id="department" name="department" required readonly>
                            <span class="text-danger error-message" id="department_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="designation" class="form-label">Position/Designation:</label>
                            <input class="form-control bg-body-secondary" id="designation" name="designation" required readonly>
                            <span class="text-danger error-message" id="designation_error"></span>
                        </div>
                        <div class="row mb-2 ms-3">
                            <label class="form-label">Check Business:</label>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="commute" name="check_business" value="Commute">
                                <label class="form-check-label" for="commute">Commute</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="own_vehicle" name="check_business" value="Use own vehicle">
                                <label class="form-check-label" for="own_vehicle">Use own vehicle</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="university_vehicle" name="check_business" value="With the use of university vehicle">
                                <label class="form-check-label" for="university_vehicle">With the use of university vehicle</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="official_business" name="check_business" value="Official business">
                                <label class="form-check-label" for="official_business">Official business</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="personal_business" name="check_business" value="Personal business">
                                <label class="form-check-label" for="personal_business">Personal business</label>
                            </div>
                            <span class="text-danger error-message" id="check_business_error"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="driver_name" class="form-label">Driver Name:</label>
                            <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Optional">
                            <span class="text-danger error-message" id="driver_name_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="destination" class="form-label">Destination:</label>
                            <input class="form-control" id="destination" name="destination" required>
                            <span class="text-danger error-message" id="destination_error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="purpose" class="form-label">Purpose:</label>
                            <textarea class="form-control" id="purpose" name="purpose" rows="1" required></textarea>
                            <span class="text-danger error-message" id="purpose_error"></span>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="time_out" class="form-label">Time Out</label>
                            <input type="time" class="form-control" id="time_out" name="time_out" min="06:00" max="15:00" required>
                            <span class="text-danger error-message" id="time_out_error"></span>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Optional"></textarea>
                            <span class="text-danger error-message" id="remarks_error"></span>
                        </div>

                        <div class="mt-2 d-flew justify-content-end align-items-end text-end">
                            <button type="submit" class="btn btn-success add_pass_slip">
                                <span class="spinner-border spinner-border-sm me-2" id="loadingSpinner" role="status" style="display: none;"></span>
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add this in the head section or in your CSS file -->
<style>
    .error-message {
        display: block;
        color: #dc3545;
        font-size: 80%;
        margin-top: 0.25rem;
    }
</style>


