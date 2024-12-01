
{{-- Edit pass slip Information --}}
@foreach($latestPassSlips as $passSlip)
<div id="latestUpdatePassSlip">
<div class="modal fade" id="updatePassSlipAd-{{ $passSlip->id }}" tabindex="-1" aria-labelledby="updatePassSlipAdModalLabel-{{ $passSlip->id }}" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="updatePassSlipAdModalLabel-{{ $passSlip->id }}">Edit Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form class="updatePassSlipFormAd" id="updatePassSlipFormAd-{{ $passSlip->id }}" action="{{ route('update.pass_slip_admin', $passSlip->id)}}" method="POST">
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
                    <div class="col-md-6 mb-2">
                        <label for="p_no" class="form-label">Pass Number:</label>
                        <input type="text" class="form-control" id="p_no" name="p_no" value="{{$passSlip->p_no}}" required readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="employee_type" class="form-label">Employee Type:</label>
                        <input class="form-control" id="employee_type" name="employee_type" required value="{{$passSlip->employee_type}}" readonly>

                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$passSlip->last_name}}" required readonly>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$passSlip->first_name}}" required readonly>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="middle_name" class="form-label">Middle Initial:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$passSlip->middle_name}}" readonly>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="department" class="form-label">Office/Dept:</label>
                        <input type="text" class="form-control" id="department" name="department" value="{{$passSlip->department}}" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="designation" class="form-label">Position/Designation:</label>
                        <input class="form-control" id="designation" name="designation" value="{{$passSlip->designation}}" required readonly>
                    </div>
                    <div class="row mb-2 ms-3">
                        <label class="form-label">Check Business:</label>
                        <div class="col-md-6 form-check">
                            <input class="form-check-input" type="radio" id="commute-{{ $passSlip->id }}" name="check_business" value="Commute"
                                   {{ $passSlip->check_business == 'Commute' ? 'checked' : '' }}>
                            <label class="form-check-label" for="commute-{{ $passSlip->id }}">Commute</label>
                        </div>
                        <div class="col-md-6 form-check">
                            <input class="form-check-input" type="radio" id="own_vehicle-{{ $passSlip->id }}" name="check_business" value="Use own vehicle"
                                   {{ $passSlip->check_business == 'Use own vehicle' ? 'checked' : '' }}>
                            <label class="form-check-label" for="own_vehicle-{{ $passSlip->id }}">Use own vehicle</label>
                        </div>
                        <div class="col-md-6 form-check">
                            <input class="form-check-input" type="radio" id="university_vehicle-{{ $passSlip->id }}" name="check_business" value="With the use of university vehicle"
                                   {{ $passSlip->check_business == 'With the use of university vehicle' ? 'checked' : '' }}>
                            <label class="form-check-label" for="university_vehicle-{{ $passSlip->id }}">With the use of university vehicle</label>
                        </div>
                        <div class="col-md-6 form-check">
                            <input class="form-check-input" type="radio" id="official_business-{{ $passSlip->id }}" name="check_business" value="Official business"
                                   {{ $passSlip->check_business == 'Official business' ? 'checked' : '' }}>
                            <label class="form-check-label" for="official_business-{{ $passSlip->id }}">Official business</label>
                        </div>
                        <div class="col-md-6 form-check">
                            <input class="form-check-input" type="radio" id="personal_business-{{ $passSlip->id }}" name="check_business" value="Personal business"
                                   {{ $passSlip->check_business == 'Personal business' ? 'checked' : '' }}>
                            <label class="form-check-label" for="personal_business-{{ $passSlip->id }}">Personal business</label>
                        </div>
                        <span class="text-danger error-message" id="check_business_error"></span>
                    </div>

                    <div class="col-md-6">
                        <label for="driver_name" class="form-label">Driver Name:</label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" value="{{$passSlip->driver_name}}">

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
                        <input type="time" class="form-control" id="time_out-{{ $passSlip->id }}" name="time_out" min="06:00" max="15:00" value="{{ $passSlip->time_out }}" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="time_in" class="form-label">Time In:</label>
                        <input type="time" class="form-control" id="time_in-{{ $passSlip->id }}" name="time_in" value="{{ $passSlip->time_in }}">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="validity_hours" class="form-label">Pass Slip Validity:</label>
                        <select class="form-select" id="validity_hours" name="validity_hours" required>
                            <option value="{{ $passSlip->validity_hours }}" selected>{{ $passSlip->validity_hours }} Hours</option>
                            <option value="0.5">30 Minutes</option>
                            <option value="1">1 Hour</option>
                            <option value="1.5">1 Hour and 30 Minutes</option>
                            <option value="2">2 Hours</option>
                            <option value="2.5">2 Hours and 30 Minutes</option>
                            <option value="3">3 Hours</option>
                            <option value="3.5">3 Hours and 30 Minutes</option>
                            <option value="4">4 Hours</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="remarks" class="form-label">Remarks:</label>
                        <textarea class="form-control" id="remarks-{{ $passSlip->id }}" name="remarks" rows="2" placeholder="Optional">{{$passSlip->remarks}}</textarea>
                    </div>
                    <div class="mt-2 text-center">
                        <button type="submit" class="btn btn-primary w-50 update_pass">
                            <span class="spinner-border spinner-border-sm me-2" id="loadingSpinnerer" role="status" style="display: none;"></span>
                            update
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
