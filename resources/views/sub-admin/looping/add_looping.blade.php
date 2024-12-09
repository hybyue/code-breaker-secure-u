<!-- Add New Looping Modal -->
<div class="modal fade" id="addLoopingModal" tabindex="-1" aria-labelledby="addLoopingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLoopingModalLabel">Add Looping Record</h5>
                <button type="button" class="btn-close btn-close-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLoopingForm" action="{{ route('store.looping') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-2 position-relative">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_employee"
                                    placeholder="Search Employee ID or Name"  oninput="searchEmployee()" >
                                <button class="btn btn-primary" type="button" id="clear_search" onclick="clearSearch()">
                                    <span class="spinner-border spinner-border-sm me-2" id="searchSpinner" role="status" style="display: none;"></span>
                                    Clear
                                </button>
                            </div>
                            <div id="employee_results" class="col-md-12 results-container"></div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required readonly>
                            <span class="text-danger error-message" id="name_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="department" class="form-label">Department:</label>
                            <input type="text" class="form-control" id="department" name="department" required readonly>
                            <span class="text-danger error-message" id="department_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="employee_type" class="form-label">Employee Type:</label>
                            <input class="form-control" id="status" name="employee_type" required readonly>
                            <span class="text-danger error-message" id="employee_type_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{  now()->format('Y-m-d')}}" required>
                            <span class="text-danger error-message" id="date_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="time_out" class="form-label">Time Out:</label>
                            <input type="time" class="form-control" id="time_out" name="time_out" required>
                            <span class="text-danger error-message" id="time_out_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="time_in" class="form-label">Time In:</label>
                            <input type="time" class="form-control" id="time_in" name="time_in">
                            <span class="text-danger error-message" id="time_in_error"></span>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                            <span class="text-danger error-message" id="remarks_error"></span>
                        </div>

                        <div class="mt-2 text-center">
                            <button type="submit" class="btn text-white w-50  add_looping" style="background-color: #0B9B19">
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
