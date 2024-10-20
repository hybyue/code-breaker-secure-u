<div id="latestUpdateLostAndFound">
{{-- edit lost and found details --}}
@foreach($lost_found as $item)
<div class="modal fade" id="updateLostFound-{{ $item->id }}" tabindex="-1" aria-labelledby="updateLostFoundModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLostFoundModalLabel-{{ $item->id }}">Edit Lost Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.lost_found', $item->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lostType-{{ $item->id }}" class="form-label">Object type:</label>
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
                            <input type="text" class="form-control" id="lostCourse-{{ $item->id }}" name="course" value="{{ $item->course }}">
                        </div>
                        <div class="mb-3">
                            <label for="lostImage-{{ $item->id }}" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="lostImage-{{ $item->id }}" name="object_img" >
                            {{-- <div class="d-flex justify-content-center">
                                <div class="container p-1">
                                    <p>Current Image:</p>
                                    @if($item->object_img)
                                    <img id="currentImage-{{ $item->id }}" src="{{ asset($item->object_img) }}" alt="Current Image" class="img-fluid mt-2" style="max-width: 100px;">
                                    @else
                                    <span class="text-muted">No Image</span>
                                    @endif
                                </div>
                                <div class="container p-1">
                                    <p>Updated Image:</p>
                                    <img id="newImagePreview-{{ $item->id }}" class="img-fluid mt-2" style="max-width: 100px; display: none;">
                                </div>
                            </div> --}}
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>