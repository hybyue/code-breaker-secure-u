    {{-- add visitor --}}
    <div class="modal fade" id="addVisitorModal" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVisitorModalLabel">Add New Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addVisitorForm" action="" method="POST">
                        @csrf
                        <div class="row">
                            {{-- <div class="col-12 form-group">
                                <label for="search_visitor">Search Visitor:</label>
                                <input type="text" class="form-control" id="search_visitor" placeholder="Search by name" onkeyup="searchVisitors()">
                                <div id="visitorSuggestions" class="list-group mt-2"></div>
                            </div> --}}
                        <div class="col-md-4  form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-4  form-group">
                            <label for="middle_name">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group">
                            <label for="person_to_visit">Person to Visit & Company:</label>
                            <input type="text" class="form-control" id="person_to_visit" name="person_to_visit" required>
                        </div>
                        <div class="form-group">
                            <label for="purpose">Purpose:</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" required>
                        </div>
                        <input type="hidden" name="time_in" id="time_in" value="{{ now() }}">
                        <div class="form-group">
                            <label for="id_type">ID Type:</label>
                            <select class="form-select" id="id_type" name="id_type" required>
                                <option value="" selected disabled>Select ID Type</option>
                                <option value="Student ID">Student ID</option>
                                <option value="Driver License ID">Driver License ID</option>
                                <option value="National ID">National ID</option>
                                <option value="Employee ID">Employee ID</option>
                                <option value="PassPort">PassPort</option>
                                <option value="Other">Other</option>
                            </select>
                          </div>
                        <div class="d-grid gap-1 col-2 pt-2 mx-auto">
                            <button type="submit" class="btn text-white" data-bs-dismiss="modal" style="background-color: #0B9B19;">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
