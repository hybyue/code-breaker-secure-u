
{{-- Edit pass slip Information --}}
@foreach($latestPassSlips as $passSlip)
<div id="latestUpdatePassSlip">
<div class="modal fade" id="updatePassSlip-{{ $passSlip->id }}" tabindex="-1" aria-labelledby="updatePassSlipModalLabel-{{ $passSlip->id }}" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updatePassSlipModalLabel-{{ $passSlip->id }}">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('update.pass_slip_admin', $passSlip->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="p_no" class="form-label">Pass Number:</label>
                        <input type="text" class="form-control" id="p_no" name="p_no" value="{{$passSlip->p_no}}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employee_type" class="form-label">Employee Type:</label>
                        <select class="form-select" id="employee_type" name="employee_type" required>
                            <option value="{{$passSlip->employee_type}}" selected disabled>{{$passSlip->employee_type}}</option>
                            <option value="Teaching">Teaching</option>
                            <option value="Non-Teaching">Non-Teaching</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$passSlip->last_name}}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$passSlip->first_name}}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="middle_name" class="form-label">Middle Initial:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$passSlip->middle_name}}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="department" class="form-label">Department:</label>
                        <input type="text" class="form-control" id="department" name="department" value="{{$passSlip->department}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Designation:</label>
                        <input class="form-control" id="designation" name="designation" value="{{$passSlip->designation}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="destination" class="form-label">Destination:</label>
                        <input class="form-control" id="destination" name="destination" value="{{$passSlip->destination}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="purpose" class="form-label">Purpose:</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="1" required>{{$passSlip->purpose}}</textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" class="form-control" id="date-{{ $passSlip->id }}" name="date" value="{{ \Carbon\Carbon::parse($passSlip->date)->format('Y-m-d') }}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="time_out" class="form-label">Time Out:</label>
                        <input type="time" class="form-control" id="time_out-{{ $passSlip->id }}" name="time_out" value="{{ $passSlip->time_out }}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="time_in" class="form-label">Time In:</label>
                        <input type="time" class="form-control" id="time_in-{{ $passSlip->id }}" name="time_in" value="{{ $passSlip->time_in }}" required>
                    </div>
                    <div class="mt-2 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
