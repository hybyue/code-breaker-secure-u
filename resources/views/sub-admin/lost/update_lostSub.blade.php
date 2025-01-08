
{{-- edit lost and found details --}}
<div id="updateLostFoundsDynamic">
    @foreach($regular_items as $item)
    <div class="modal fade" id="updateLostFound-{{ $item->id }}" tabindex="-1" aria-labelledby="updateLostFoundModalLabel-{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateLostFoundModalLabel-{{ $item->id }}">Edit Lost Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="updateLostFoundForm" id="updateLostFoundForm-{{ $item->id }}" action="{{route('update.lost_found', $item->id)}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                <label for="lostType-{{ $item->id }}" class="form-label">Lost Item:</label>
                                <input type="text" class="form-control" id="lostType-{{ $item->id }}" name="object_type" value="{{ $item->object_type }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Turnover By:</label>
                                <div class="row p-2">
                            <div class="col-md-4 mb-3">
                                <label for="firstName-{{ $item->id }}" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="firstName-{{ $item->id }}" name="first_name" value="{{ $item->first_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middleName-{{ $item->id }}" class="form-label">Middle Initial:</label>
                                <input type="text" class="form-control" id="middleName-{{ $item->id }}" name="middle_name" value="{{ $item->middle_name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName-{{ $item->id }}" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lastName-{{ $item->id }}" name="last_name" value="{{ $item->last_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="lostCourse-{{ $item->id }}" class="form-label">Role:</label>
                                <select class="form-select" id="course" name="course">
                                    <option value="Student" {{ $item->course == 'Student' ? 'selected' : '' }}>Student</option>
                                    <option value="UCU Employee" {{ $item->course == 'UCU Employee' ? 'selected' : '' }}>UCU Employee</option>
                                    <option value="Visitor" {{ $item->course == 'Visitor' ? 'selected' : '' }}>Visitor</option>
                                    <option value="Other" {{ $item->course == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="lostImage-{{ $item->id }}" class="form-label">Image:</label>
                                <input type="file" class="form-control" id="lostImage-{{ $item->id }}" name="object_img" onchange="previewImage(event, {{ $item->id }})">
                                {{-- <div class="d-flex justify-content-center">
                                    <div class="container p-1">
                                        <p>Current Image:</p>
                                        @if($item->object_img)
                                        <img id="currentImage-{{ $item->id }}" src="{{ asset($item->object_img) }}"  alt="Current Image" class="img-fluid mt-2" style="max-width: 100px;">
                                        @else
                                        <span class="text-muted">No Image</span>
                                        @endif
                                    </div>
                                    <div class="container p-1">
                                        <p>Updated Image:</p>
                                        <img id="newImagePreview-{{ $item->id }}" class="img-fluid mt-2" style="max-width: 100px; display: none;">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6 mb-3">
                                <label for="location-{{ $item->id }}" class="form-label">Found at:</label>
                                <input type="text" class="form-control" id="location-{{ $item->id }}" name="location" value="{{ $item->location }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="description-{{ $item->id }}" class="form-label">Description of item:</label>
                                <textarea class="form-control" id="description-{{ $item->id }}" name="description">{{ $item->description }}</textarea>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="remarks" class="form-label">Remarks:</label>
                                <textarea class="form-control" id="remarks-{{ $item->id }}" name="remarks" rows="2" placeholder="Optional">{{$item->remarks}}</textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary update_lost w-50">
                                    <span class="spinner-border spinner-border-sm me-2" id="loadingSpinnerer" role="status" style="display: none;"></span>
                                    update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>





    @if($seven_days_old)
<div class="modal fade" id="sevenDaysOldModal" tabindex="-1" aria-labelledby="sevenDaysOldModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sevenDaysOldModalLabel">Transfer to CSLD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-container">
                <table class="table table-bordered same-height-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Finder's Name</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($seven_days_old as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
                            <td>{{ $item->object_type }}</td>
                            <td>{{ $item->last_name }}, {{ $item->first_name }}</td>
                            <td>{{ $item->course }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" id="bulkTransferBtn">Transfer</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
