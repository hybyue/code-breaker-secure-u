<div id="latestUpdateLooping">
@foreach($allLoopings as $record)
<div class="modal fade" id="updateLooping-{{ $record->id }}" tabindex="-1" aria-labelledby="updateLoopingModalLabel-{{ $record->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLoopingModalLabel-{{ $record->id }}">Edit Loafing Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="updateLoopingForm" id="updateLoopingForm-{{ $record->id }}" action="{{ route('update.looping', $record->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $record->name }}" required readonly>
                            <span class="text-danger error-message" id="name_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="department" class="form-label">Department:</label>
                            <input type="text" class="form-control" id="department" name="department" value="{{ $record->department }}" required readonly>
                            <span class="text-danger error-message" id="department_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="employee_type" class="form-label">Employee Type:</label>
                            <select class="form-select" id="employee_type" name="employee_type" required>
                                <option value="{{ $record->employee_type }}" selected>{{ $record->employee_type }}</option>
                                <option value="Teaching">Teaching</option>
                                <option value="Non-Teaching">Non-Teaching</option>
                            </select>
                            <span class="text-danger error-message" id="employee_type_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $record->date }}" required>
                            <span class="text-danger error-message" id="date_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="time_out" class="form-label">Time Out:</label>
                            <input type="time" class="form-control" id="time_out" name="time_out" value="{{ $record->time_out }}" required>
                            <span class="text-danger error-message" id="time_out_error"></span>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="time_in" class="form-label">Time In:</label>
                            <input type="time" class="form-control" id="time_in" name="time_in" value="{{ $record->time_in }}" >
                            <span class="text-danger error-message" id="time_in_error"></span>
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea class="form-control" id="remarks" name="remarks" rows="3">{{ $record->remarks }}</textarea>
                            <span class="text-danger error-message" id="remarks_error"></span>
                        </div>

                        <div class="mt-2 text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary update_looping">
                                <span class="spinner-border spinner-border-sm me-2" id="loadingSpinnerer" role="status" style="display: none;"></span>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
