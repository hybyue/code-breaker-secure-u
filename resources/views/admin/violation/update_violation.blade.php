{{-- update Violation --}}
<div id="latestUpdateViolation">
@foreach ($violations as $violate)
<div class="modal fade" id="updateViolationModalAd-{{$violate->id}}" tabindex="-1" aria-labelledby="updateViolationModalAdLabel-{{$violate->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateViolationModalAdLabel-{{$violate->id}}">Update Violation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="violationForm" action="{{route('violation.update.admin', $violate->id)}}" method="POST">
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
                                <option value="{{$violate->violation_type}}"  selected>{{$violate->violation_type}}</option>
                                <option value="Hanging/CropTop">Hanging/CropTop</option>
                                <option value="Polo Top">Polo Top</option>
                                <option value="Tattere Pants">Tattere Pants</option>
                                <option value="Earings">Earings</option>
                                <option value="Ball Cup">Ball Cup</option>
                                <option value="Slipper/Sandals">Slipper/Sandals</option>
                                <option value="Croca">Croca</option>
                                <option value="Short/Skirt">Short/Skirt</option>
                                <option value="Sleeveless/Shoulder">Sleeveless/Shoulder</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="form-group mt-2" id="otherViolationDiv" style="display: none;">
                                <label for="other_violation">Specify Other Violation:</label>
                                <input type="text" class="form-control" id="other_violation" name="other_violation">
                            </div>
                       </div>

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($violate->date)->format('Y-m-d') }}">
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="remarks" class="form-label">Remarks:</label>
                        <textarea class="form-control" id="remarks-{{ $violate->id }}" name="remarks" rows="2" placeholder="Optional">{{$violate->remarks}}</textarea>
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
</div>


<script>
    document.getElementById('violation_type').addEventListener('change', function() {
        const otherDiv = document.getElementById('otherViolationDiv');
        const otherInput = document.getElementById('other_violation');

        if (this.value === 'Other') {
            otherDiv.style.display = 'block';
            otherInput.required = true;
        } else {
            otherDiv.style.display = 'none';
            otherInput.required = false;
            otherInput.value = '';
        }
    });
</script>
