
{{-- edit lost and found details --}}
<div id="lostFoundUpdateAd">
@foreach($lost_found as $item)
<div class="modal fade" id="updateLostFoundAdmin-{{ $item->id }}" tabindex="-1" aria-labelledby="updateLostFoundAdminModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLostFoundAdminModalLabel-{{ $item->id }}">Edit Lost Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="lostFoundUpdateForm-{{ $item->id }}" class="lostFoundUpdateForm" action="{{route('update.lost_found_admin', $item->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lostType-{{ $item->id }}" class="form-label">Lost Item:</label>
                            <input type="text" class="form-control" id="lostType-{{ $item->id }}" name="object_type" value="{{ $item->object_type }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName-{{ $item->id }}" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstName-{{ $item->id }}" name="first_name" value="{{ $item->first_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="middleName-{{ $item->id }}" class="form-label">Middle Initial:</label>
                            <input type="text" class="form-control" id="middleName-{{ $item->id }}" name="middle_name" value="{{ $item->middle_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName-{{ $item->id }}" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastName-{{ $item->id }}" name="last_name" value="{{ $item->last_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="lostCourse-{{ $item->id }}" class="form-label">Role:</label>
                            <select class="form-select" id="course" name="course">
                                <option value="Student" {{ $item->course == 'Student' ? 'selected' : '' }}>Student</option>
                                <option value="Employee" {{ $item->course == 'Employee' ? 'selected' : '' }}>Employee</option>
                                <option value="Dean" {{ $item->course == 'Dean' ? 'selected' : '' }}>Dean</option>
                                <option value="Visitor" {{ $item->course == 'Visitor' ? 'selected' : '' }}>Visitor</option>
                                <option value="Head" {{ $item->course == 'Head' ? 'selected' : '' }}>Head</option>
                                <option value="President" {{ $item->course == 'President' ? 'selected' : '' }}>President</option>
                                <option value="Other" {{ $item->course == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lostImage-{{ $item->id }}" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="cameraInput-{{ $item->id }}" name="object_img" accept="image/*" onchange="previewImage(event, {{ $item->id }})">

                            {{-- <div class="d-flex justify-content-center">
                                <div class="container p-1">
                                    <p>Current Image:</p>
                                    @if($item->object_img)
                                        <img id="currentImage-{{ $item->id }}" src="{{ asset($item->object_img) }}" alt="Current Image" class="img-fluid mt-2" style="max-width: 100px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </div>
                                <div id="imagePreview-{{ $item->id }}" class="container p-1">
                                    <p>Updated Image:</p>
                                    <img id="previewImage-{{ $item->id }}" class="d-none img-fluid" alt="Preview" style="max-width: 100px;">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                        <div class="col-md-6 mb-3">
                            <label for="location-{{ $item->id }}" class="form-label">Location Found:</label>
                            <input type="text" class="form-control" id="location-{{ $item->id }}" name="location" value="{{ $item->location }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="securityStaff-{{ $item->id }}" class="form-label">Security Staff:</label>
                            <input type="text" class="form-control" id="securityStaff-{{ $item->id }}" name="security_staff" value="{{ $item->security_staff }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="isClaimed-{{ $item->id }}" class="form-label">Is Claimed:</label>
                            <select class="form-select" id="isClaimed-{{ $item->id }}" name="is_claimed">
                                <option value="1" {{ $item->is_claimed ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$item->is_claimed ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="isTransferred-{{ $item->id }}" class="form-label">Is Transferred:</label>
                            <select class="form-select" id="isTransferred-{{ $item->id }}" name="is_transferred">
                                <option value="1" {{ $item->is_transferred ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$item->is_transferred ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description-{{ $item->id }}" class="form-label">Object Description:</label>
                            <textarea class="form-control" id="description-{{ $item->id }}" name="description">{{ $item->description }}</textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea class="form-control" id="remarks-{{ $item->id }}" name="remarks" rows="2" placeholder="Optional">{{$item->remarks}}</textarea>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary update_lost  w-50">
                            <span class="spinner-border spinner-border-sm me-2" id="loadingSpinnerer" role="status" style="display: none;"></span>
                            update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
