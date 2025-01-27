{{-- add new lost and found --}}
<div class="modal fade" id="addNewLostModalSub" tabindex="-1" aria-labelledby="addNewLostModalSubLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLostModalSubLabel">Add New Lost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLostFoundForm" action="" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-12 mb-3">
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
                                <option value="UCU Employee">UCU Employee</option>
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
                            <button type="submit" class="btn btn-success add_lost w-50">
                                <span class="spinner-border spinner-border-sm me-2" id="loadingSpinner" role="status" style="display: none;"></span>
                                Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModalLost" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Lost and Found Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- PDF Preview will be embedded here -->
                <div id="loadingBar" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <iframe id="pdfLostFrame" src="" style="width: 100%; height: 500px; border: none;"></iframe>

        </div>
    </div>
</div>

