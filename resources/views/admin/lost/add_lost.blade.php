
{{-- add new lost and found  --}}
<div class="modal fade" id="addNewLostModal" tabindex="-1" aria-labelledby="addNewLostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLostModalLabel">Add New Lost and Found</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLostForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="lostType" class="form-label">Object type:</label>
                        <input type="text" class="form-control" id="lostType" name="object_type" required>
                    </div>
                    <div class="col-md-6  mb-3">
                        <label for="lostName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="lostName" name="first_name" required>
                    </div>
                    <div class="col-md-6  mb-3">
                        <label for="lostName" class="form-label">Middle Initial:</label>
                        <input type="text" class="form-control" id="lostName" name="middle_name" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lostName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lostName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lostCourse" class="form-label">Role:</label>
                        <select class="form-select" id="course" name="course" required>
                            <option value="Student">Student</option>
                            <option value="Employee">Employee</option>
                            <option value="Janitor">Janitor</option>
                            <option value="Visitor">Visitor</option>
                            <option value="Head">Head</option>
                            <option value="President">President</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="lostImage" class="form-label">Image:</label>
                        <input type="file" class="form-control" id="lostImage" name="object_img">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label for="securityStaff" class="form-label">Security Staff:</label>
                        <input type="text" class="form-control" id="securityStaff" name="security_staff" required>
                    </div> --}}

                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" placeholder="Optional" id="description" name="description"></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success add_lost_admin" id="lostSubmmit">
                            <span class="spinner-border spinner-border-sm me-2" id="loadingSpinnerer" role="status" style="display: none;"></span>
                            Save
                        </button>
                    </div>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
