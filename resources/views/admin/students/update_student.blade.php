{{-- Add Students --}}
<div id="updatesStudentAdmin">
@foreach ($students as $student)
<div class="modal fade" id="updateStudentModalAd-{{$student->id}}" tabindex="-1" aria-labelledby="updateStudentModalAdLabel-{{$student->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateStudentModalAdLabel-{{$student->id}}">Update Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="studentForm" action="{{ route('update_admin.student', $student->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <label for="student_no">Student Number:</label>
                            <input type="text" class="form-control" id="student_no" name="student_no" value="{{$student->student_no}}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$student->last_name}}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$student->first_name}}" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="middle_initial">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" value="{{$student->middle_name}}" name="middle_name">
                        </div>
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <input type="text" class="form-control" id="course" name="course" value="{{$student->course}}" required>
                        </div>
                        <div class="form-group">
                            <label for="year">Year:</label>
                            <input type="text" class="form-control" id="year_level" name="year_level" value="{{$student->year_level}}" required>
                        </div>
                        <div class="form-group">
                            <label for="section">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$student->email}}" required>
                        </div>

                        <div class="form-group">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{$student->contact_number}}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$student->address}}" required>
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
