{{-- update Violation --}}
@foreach ($violations as $violate)
<div class="modal fade" id="updateViolationModalAd-{{$violate->id}}" tabindex="-1" aria-labelledby="updateViolationModalAdLabel-{{$violate->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateViolationModalAdLabel-{{$violate->id}}">Update Violation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="violationForm" action="{{route('store_violation', $violate->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <label for="student_no">Student Number:</label>
                            <input type="text" class="form-control" id="student_no" name="student_no" value="{{$violate->student_no}}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$violate->last_name}}"  required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$violate->first_name}}"  required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="middle_initial">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_initial" placeholder="Optional" value="{{$violate->middle_initial}}"  name="middle_initial">
                        </div>
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" value="{{$violate->course}}"  required>
                        </div>
                        <div class="form-group">
                            <label for="violation_type">Violation Type:</label>
                            <select class="form-select" id="violation_type" name="violation_type" required>
                                <option value="{{$violate->student_no}}"  selected disabled>{{$violate->student_no}}</option>
                                <option value="No ID">No ID</option>
                                <option value="No Shoes">No Shoes</option>
                                <option value="Inapropriate Cloths">Inapropriate Cloths</option>
                                <option value="Earings">Earings</option>
                                <option value="No Uniform">No Uniform</option>
                                <option value="Other">Other</option>
                            </select>
                       </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($violate->date)->format('Y-m-d') }}">
                    </div>

                    </div>


                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-primary text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
