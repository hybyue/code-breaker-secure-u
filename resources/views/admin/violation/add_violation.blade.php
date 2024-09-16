
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
                        <div class="form-group">
                            <label for="student_no">Student Number:</label>
                            <input type="text" class="form-control" id="student_no" name="student_no" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="middle_initial">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_initial" placeholder="Optional" name="middle_initial">
                        </div>
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" required>
                        </div>
                        <div class="form-group">
                            <label for="violation_type">Violation Type:</label>
                            <select class="form-select" id="violation_type" name="violation_type" required>
                                <option value="" selected disabled>Select ID Type</option>
                                <option value="No ID">No ID</option>
                                <option value="No Shoes">No Shoes</option>
                                <option value="Inapropriate Cloths">Inapropriate Cloths</option>
                                <option value="Earings">Earings</option>
                                <option value="No Uniform">No Uniform</option>
                                <option value="Other">Other</option>
                            </select>
                       </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" >
                    </div>

                    </div>


                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn text-white" style="background-color: #0B9B19">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
