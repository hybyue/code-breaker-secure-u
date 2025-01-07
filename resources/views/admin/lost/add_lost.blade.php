
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
                        <label for="lostType" class="form-label">Lost Item:</label>
                        <input type="text" class="form-control" id="lostType" name="object_type" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Turnover By:</label>
                        <div class="row p-2">
                    <div class="col-md-4 mb-3">
                        <label for="lostName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="lostName" name="first_name" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lostName" class="form-label">Middle Initial:</label>
                        <input type="text" class="form-control" id="lostName" name="middle_name" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lostName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lostName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lostCourse" class="form-label">Role:</label>
                        <select class="form-select" id="course" name="course">
                            <option value="" selected disabled>Choose person's Role</option>
                            <option value="Student">Student</option>
                            <option value="Employee">Employee</option>
                            <option value="Visitor">Visitor</option>
                            <option value="Dean">Dean</option>
                            <option value="Head">Head</option>
                            <option value="President">President</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="lostImage" class="form-label">Upload Item Image:</label>
                            <input type="file" class="form-control" id="cameraInput" name="object_img" accept="image/*" capture="environment">

                        <div id="imagePreview" class="mt-2">
                            <img id="previewImage" class="d-none img-fluid" alt="Preview">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Found at:</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label for="securityStaff" class="form-label">Security Staff:</label>
                        <input type="text" class="form-control" id="securityStaff" name="security_staff" required>
                    </div> --}}

                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description of Item:</label>
                        <textarea class="form-control" placeholder="Optional" id="description" name="description"></textarea>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="remarks" class="form-label">Remarks:</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Optional"></textarea>
                        <span class="text-danger error-message" id="remarks_error"></span>
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
