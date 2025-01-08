{{-- Batch Edit Visitor Information --}}
<div id="updateDynamicModals">
@foreach ($latestVisitors as $visit)
    <div class="modal fade" id="updateVisitor-{{ $visit->id }}" tabindex="-1"
        aria-labelledby="updateVisitorModalLabel-{{ $visit->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVisitorModalLabel-{{ $visit->id }}">Edit Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="updateVisitorForm" id="updateVisitorForm-{{ $visit->id }}" action="{{ route('visitor.update', $visit->id) }}" method="POST">
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
                            <div class="col-md-4 form-group">
                                <label for="last_name_{{ $visit->id }}">Last Name:</label>
                                <input type="text" class="form-control" id="last_name_{{ $visit->id }}" name="last_name" value="{{ $visit->last_name }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="first_name_{{ $visit->id }}">First Name:</label>
                                <input type="text" class="form-control" id="first_name_{{ $visit->id }}" name="first_name" value="{{ $visit->first_name }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="middle_name_{{ $visit->id }}">Middle Initial:</label>
                                <input type="text" class="form-control" id="middle_name_{{ $visit->id }}" name="middle_name" value="{{ $visit->middle_name }}">
                            </div>
                            <div class="form-group">
                                <label for="person_to_visit">Office/Deparment:</label>
                                <select class="form-select" id="person_to_visit" name="person_to_visit" required>
                                    <option value="{{ $visit->person_to_visit }}" selected>{{ $visit->person_to_visit }}</option>
                                        <!-- Colleges -->
                                        <optgroup label="Offices">
                                            <option value="Institute of Graduate and Advanced Studies">Institute of Graduate and Advanced Studies</option>
                                            <option value="College of Law">College of Law</option>
                                            <option value="College of Pharmacy">College of Pharmacy</option>
                                            <option value="College of Human Sciences">College of Human Sciences</option>
                                            <option value="College of Teacher Education">College of Teacher Education</option>
                                            <option value="College of Business Management and Accountancy">College of Business Management and Accountancy</option>
                                            <option value="College of Health Sciences">College of Health Sciences</option>
                                            <option value="College of Hospitality and Tourism Management">College of Hospitality and Tourism Management</option>
                                            <option value="College of Engineering and Architecture">College of Engineering and Architecture</option>
                                            <option value="College of Criminal Justice Education">College of Criminal Justice Education</option>
                                            <option value="College of Arts and Sciences">College of Arts and Sciences</option>
                                            <option value="College of Information and Technology Education">College of Information and Technology Education</option>
                                        </optgroup>

                                        <!-- Departments -->
                                        <optgroup label="Departments">
                                            <option value="Center for Student Leadership and Development">Center for Student Leadership and Development</option>
                                            <option value="Center for Research and Development">Center for Research and Development</option>
                                            <option value="Office of the External Affairs and Linkages">Office of the External Affairs and Linkages</option>
                                            <option value="Psychological Assessment and Counseling Center">Psychological Assessment and Counseling Center</option>
                                            <option value="Institutional Planning and Development">Institutional Planning and Development</option>
                                            <option value="Disaster Risk Reduction and Management Office">Disaster Risk Reduction and Management Office</option>
                                            <option value="Center for Community Development and Extension Services">Center for Community Development and Extension Services</option>
                                            <option value="School of Midwifery (CHS)">School of Midwifery (CHS)</option>
                                            <option value="Center for Training and Professional Development">Center for Training and Professional Development</option>
                                            <option value="Research Ethics Committee">Research Ethics Committee</option>
                                            <option value="University Registrar">University Registrar</option>
                                            <option value="Accounting Office">Accounting Office</option>
                                            <option value="Human Capital Management Office">Human Capital Management Office</option>
                                            <option value="University Library">University Library</option>
                                            <option value="Technical Vocational Institute">Technical Vocational Institute</option>
                                            <option value="Security Management Office">Security Management Office</option>
                                            <option value="Events Management Office">Events Management Office</option>
                                            <option value="Records Management System">Records Management System</option>
                                            <option value="NSTP Department">NSTP Department</option>
                                            <option value="Management Information Systems">Management Information Systems</option>
                                            <option value="Maintenance and General Services">Maintenance and General Services</option>
                                            <option value="University Cashier">University Cashier</option>
                                            <option value="Gender and Development">Gender and Development</option>
                                            <option value="Audit Office">Audit Office</option>
                                            <option value="Engineering Management & Auxiliary Services">Engineering Management & Auxiliary Services</option>
                                            <option value="Committee for Publication and Communication Affairs">Committee for Publication and Communication Affairs</option>
                                            <option value="University Chaplain">University Chaplain</option>
                                            <option value="University Clinic">University Clinic</option>
                                            <option value="University Nurse">University Nurse</option>
                                        </optgroup>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="purpose_{{ $visit->id }}">Purpose:</label>
                                <textarea class="form-control" id="purpose_{{ $visit->id }}" name="purpose" required>{{ $visit->purpose }}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="id_type">Type of ID Surrendered:</label>
                                <select class="form-select" id="id_type" name="id_type" required>
                                    <option value="{{$visit->id_type}}" selected>{{$visit->id_type}}</option>
                                    <option value="Student ID">Student ID</option>
                                    <option value="Driver License ID">Driver License ID</option>
                                    <option value="National ID">National ID</option>
                                    <option value="Employee ID">Employee ID</option>
                                    <option value="PassPort">PassPort</option>
                                    <option value="Other">Other</option>
                                </select>
                              </div>

                        <input type="hidden" name="time_in" id="time_in_{{ $visit->id }}" value="{{ $visit->time_in }}">
                        <input type="hidden" name="time_out" id="time_out_{{ $visit->id }}" value="{{ $visit->time_out }}">

                        <div class="form-group">
                            <label for="id_number_{{ $visit->id }}">ID Number:</label>
                            <input type="text" class="form-control" id="id_number_{{ $visit->id }}" name="id_number" value="{{ $visit->id_number }}" required>
                        </div>

                        <div class="row mt-2">
                            @if($visit->visited_person_name && $visit->visited_person_position)
                            <div class="col-12">
                                <p>Visited Person Details:</p>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="visited_person_name_{{ $visit->id }}" class="form-label">Name:</label>
                                <input type="text"
                                       class="form-control"
                                       id="visited_person_name_{{ $visit->id }}"
                                       name="visited_person_name"
                                       value="{{ $visit->visited_person_name }}"
                                       required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="visited_person_position_{{ $visit->id }}" class="form-label">Position/Designation:</label>
                                <input type="text"
                                       class="form-control"
                                       id="visited_person_position_{{ $visit->id }}"
                                       name="visited_person_position"
                                       value="{{ $visit->visited_person_position }}"
                                       required>
                            </div>
                            @endif
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="remarks" class="form-label">Remarks:</label>
                            <textarea class="form-control" id="remarks-{{ $visit->id }}" name="remarks" rows="2" placeholder="Optional">{{$visit->remarks}}</textarea>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn w-50 btn-primary update_visitor">
                                <span class="spinner-border spinner-border-sm me-2" id="loadingSpinnerer" role="status" style="display: none;"></span>
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
