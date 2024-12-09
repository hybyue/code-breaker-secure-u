{{-- Add Violation --}}
<div class="modal fade" id="violationModal" tabindex="-1" aria-labelledby="violationModalLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="violationModalLabel">Add Violation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="violationForms" action="" method="POST">
                    @csrf
                     <div class="row">
                        <div class="mb-2 position-relative">
                            <div class="input-group">
                            <input type="text" class="form-control" id="search_student" name="search_student" placeholder="Type Student Number or Name" oninput="searchStudentSub()">
                            <button class="btn btn-primary" type="button" id="clear_search" onclick="clearSearch()">
                                <span class="spinner-border spinner-border-sm me-2" id="searchSpinner" role="status" style="display: none;"></span>
                                Clear
                            </button>
                            </div>
                            <span class="text-danger error-message" id="search_student_error"></span>
                        <div id="student_results" class="col-md-12 results-container"></div>
                    </div>
                        <div class="mb-1">
                            <label for="student_no">Student Number:</label>
                            <input type="text" class="form-control" id="student_no" name="student_no" required readonly>
                            <span class="text-danger error-message" id="student_no_error"></span>
                        </div>

                        <div class="col-md-4 mb-1">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required readonly>
                            <span class="text-danger error-message" id="last_name_error"></span>

                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required readonly>
                            <span class="text-danger error-message" id="first_name_error"></span>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="middle_initial">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" placeholder="Optional" name="middle_initial" readonly>
                            <span class="text-danger error-message" id="middle_initial_error"></span>

                        </div>
                        <div class="mb-1">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" required readonly>
                            <span class="text-danger error-message" id="course_error"></span>

                        </div>

                        <div class="mb-1">
                            <label for="violation_type">Violation Type:</label>
                            <select class="form-select" id="violation_type" name="violation_type" required>
                                <option value="" selected disabled>Select Violation Type</option>
                                <option value="Hanging/CropTop">Hanging/CropTop</option>
                                <option value="Polo Top">Polo Top</option>
                                <option value="Tattere Pants">Tattere Pants</option>
                                <option value="Earings">Earings</option>
                                <option value="Ball Cup">Ball Cup</option>
                                <option value="Slipper/Sandals">Slipper/Sandals</option>
                                <option value="Croca">Croca</option>
                                <option value="Short/Skirt">Short/Skirt</option>
                                <option value="Sleeveless/Shoulder">Sleeveless/Shoulder</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="text-danger error-message" id="violation_type_error"></span>

                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Optional"></textarea>
                            <span class="text-danger error-message" id="remarks_error"></span>
                        </div>
                    </div>

                    <div class="mb-1 text-center mt-3">
                        <button type="submit" class="btn text-white w-50 add_violation" style="background-color: #0B9B19">
                            <span class="spinner-border spinner-border-sm me-2" id="loadingSpinner" role="status" style="display: none;"></span>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


