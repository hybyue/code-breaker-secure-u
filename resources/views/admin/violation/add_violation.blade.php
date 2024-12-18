{{-- Add Violation --}}
<div class="modal fade" id="addViolationModalAd" tabindex="-1" aria-labelledby="addViolationModalAdLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addViolationModalAdLabel">Add Violation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="violationFormAdmin" action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-2 position-relative">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_student" name="search_student" placeholder="Type Student Number or Name" oninput="searchStudent()">

                                <button class="btn btn-primary" type="button" id="clear_search" onclick="clearSearch()">
                                    <span class="spinner-border spinner-border-sm me-2" id="searchSpinner" role="status" style="display: none;"></span>
                                    Clear
                                </button>
                            </div>
                        <div id="student_results" class="col-md-12 results-container"></div>
                    </div>
                        <div class="form-group">
                        <label for="student_no">Student Number:</label>
                        <input type="text" class="form-control bg-body-secondary" id="student_no" name="student_no" required readonly>
                        <span class="text-danger error-message" id="student_no_error"></span>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control bg-body-secondary " id="last_name" name="last_name" required readonly>
                            <span class="text-danger error-message" id="last_name_error"></span>

                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control bg-body-secondary" id="first_name" name="first_name" required readonly>
                            <span class="text-danger error-message" id="first_name_error"></span>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="middle_initial">Middle Initial:</label>
                            <input type="text" class="form-control bg-body-secondary" id="middle_name" placeholder="Optional" name="middle_initial" readonly>
                            <span class="text-danger error-message" id="middle_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control bg-body-secondary" id="course" name="course" required readonly>
                            <span class="text-danger error-message" id="course_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="violation_type">Violation Type:</label>
                            <select class="form-select" id="violation_type" name="violation_type" required>
                                <option value="" selected disabled>Select violation Type</option>
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
                       </div>
                       <div class="col-md-12 mb-2">
                        <label for="remarks" class="form-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Optional"></textarea>
                        <span class="text-danger error-message" id="remarks_error"></span>
                    </div>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn text-white add_violation" data-bs-dismiss="addViolationModalAd" style="background-color: #0B9B19">
                            <span class="spinner-border spinner-border-sm me-2" id="loadingSpinner" role="status" style="display: none;"></span>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModalViolationAd" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Violation Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- PDF Preview will be embedded here -->
                <div id="loadingBar" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                    </div>
                </div>
                <iframe id="pdfViolationFrame" src="" style="width: 100%; height: 500px; border: none;"></iframe>

        </div>
    </div>
</div>


