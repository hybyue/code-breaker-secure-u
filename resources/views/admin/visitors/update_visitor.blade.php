{{-- Batch Edit Visitor Information --}}
<div id="updateDynamicModals">
@foreach ($latestVisitors as $visit)
    <div class="modal fade" id="updateVisitor-{{ $visit->id }}" tabindex="-1"
        aria-labelledby="updateVisitorModalLabel-{{ $visit->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVisitorModalLabel-{{ $visit->id }}">Edit Visitor Entries</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateVisitorForm" action="{{ route('visitor.update', $visit->id) }}" method="POST">
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
                                <label for="person_to_visit">Person to Visit & Company:</label>
                                <select class="form-select" id="person_to_visit" name="person_to_visit" required>
                                    <option value="{{ $visit->person_to_visit }}" selected>{{ $visit->person_to_visit }}</option>
                                        <!-- Colleges -->
                                        <optgroup label="Colleges">
                                            <option value="IGAS">Institute of Graduate and Advanced Studies</option>
                                            <option value="COL">College of Law</option>
                                            <option value="COP">College of Pharmacy</option>
                                            <option value="CHUMS">College of Human Sciences</option>
                                            <option value="CTE">College of Teacher Education</option>
                                            <option value="CBMA">College of Business Management and Accountancy</option>
                                            <option value="CHS">College of Health Sciences</option>
                                            <option value="CHTM">College of Hospitality and Tourism Management</option>
                                            <option value="CEA">College of Engineering and Architecture</option>
                                            <option value="CCJE">College of Criminal Justice Education</option>
                                            <option value="CAS">College of Arts and Sciences</option>
                                            <option value="CITE">College of Information and Technology Education</option>

                                        </optgroup>

                                        <!-- Departments -->
                                        <optgroup label="Departments">
                                            <option value="CSLD">Center for Student Leadership and Development</option>
                                            <option value="CRD">Center for Research and Development</option>
                                            <option value="LINKAGES">Office of the External Affairs and Linkages</option>
                                            <option value="PACC">Psychological Assessment and Counseling Center</option>
                                            <option value="IPD">Institutional Planning and Development</option>
                                            <option value="DRRMO">Disaster Risk Reduction and Management Office</option>
                                            <option value="CCRDES">Center for Community Development and Extension Services</option>
                                            <option value="MIDWIFE">School of Midwifery (CHS)</option>
                                            <option value="CTPD">Center for Training and Professional Development</option>
                                            <option value="ETHICS">Research Ethics Committee</option>
                                            <option value="REGISTRAR">University Registrar</option>
                                            <option value="ACCOUNTING">Accounting Office</option>
                                            <option value="HCMO">Human Capital Management Office</option>
                                            <option value="LIBRARY">University Library</option>
                                            <option value="TECHVOC">Technical Vocational Institute</option>
                                            <option value="SGO">Security Management Office</option>
                                            <option value="EMO">Events Management Office</option>
                                            <option value="RECORDS">Records Management System</option>
                                            <option value="NSTP">NSTP Department</option>
                                            <option value="MIS">Management Information Systems</option>
                                            <option value="GSO">Maintenance and General Services</option>
                                            <option value="CASHIER">University Cashier</option>
                                            <option value="GAD">Gender and Development</option>
                                            <option value="AUDIT">Audit Office</option>
                                            <option value="EMAS">Engineering Management & Auxiliary Services</option>
                                            <option value="CPCA">Committee for Publication and Communication Affairs</option>
                                            <option value="CHAPLAIN">University Chaplain</option>
                                            <option value="CLINIC">University Clinic</option>
                                            <option value="NURSE">University Nurse</option>
                                        </optgroup>


                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="purpose_{{ $visit->id }}">Purpose:</label>
                                <textarea class="form-control" id="purpose_{{ $visit->id }}" name="purpose" required>{{ $visit->purpose }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="entry_count_{{ $visit->id }}">Entry Count:</label>
                                <input type="number" class="form-control" id="entry_count_{{ $visit->id }}" name="entry_count" value="{{ $visit->entry_count }}" required>
                            </div>
                            <div class="form-group">
                                <label for="id_type">ID Type:</label>
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
                        </div>
                        <input type="hidden" name="time_in" id="time_in_{{ $visit->id }}" value="{{ $visit->time_in }}">
                        <input type="hidden" name="time_out" id="time_out_{{ $visit->id }}" value="{{ $visit->time_out }}">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
