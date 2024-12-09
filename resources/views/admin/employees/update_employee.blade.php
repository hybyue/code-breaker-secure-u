<!-- update Employee Modal -->
<div id="updateEmployeesAdmin">
@foreach ($allEmployees as $employee)
<div class="modal fade" id="updateEmployeeModalAd-{{$employee->id}}" tabindex="-1" aria-labelledby="updateEmployeeModalAdLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateEmployeeModalAdLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeForm" action="{{route('update_admin.employee', $employee->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="employee_id" class="form-label">ID Number:</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{$employee->employee_id}}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{$employee->last_name}}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->first_name}}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="middle_name" class="form-label">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$employee->middle_name}}" placeholder="Optional" >
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="department" class="form-label">Department/Office:</label>
                            <input type="text" class="form-control" id="department" name="department" value="{{$employee->department}}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="designation" class="form-label">Designation:</label>
                            <input class="form-control" id="designation" name="designation" rows="3" value="{{$employee->designation}}" required></input>
                        </div>
                        <div class=" mb-3">
                            <label for="status" class="form-label">Employee Type:</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" selected disabled>Select Employee Type</option>
                                <option value="Teaching" {{ $employee->status == 'Teaching' ? 'selected' : ''}}>Teaching</option>
                                <option value="Non-Teaching" {{ $employee->status == 'Non-Teaching' ? 'selected' : ''}}>Non-Teaching</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="position" class="form-label">Position:</label>
                            <select type="text" class="form-select" id="position" name="position" required>
                                <option value="" selected disabled>Select Employee's Position</option>
                                <option value="Part-Time" {{ $employee->position == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                <option value="Full-time" {{ $employee->position == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="mt-2 d-flew justify-content-end align-items-end text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" wire:click="mount">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    @endforeach
</div>
