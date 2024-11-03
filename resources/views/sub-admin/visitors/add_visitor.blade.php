    {{-- Add Visitor --}}
    <div class="modal fade" id="addVisitorModal" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVisitorModalLabel">Add Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="visitorForm" action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                                <span class="text-danger" id="last_name_error"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                                <span class="text-danger" id="first_name_error"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="middle_name">Middle Initial:</label>
                                <input type="text" class="form-control" id="middle_name" placeholder="Optional"
                                    name="middle_name">
                                    <span class="text-danger" id="middle_name_error"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="person_to_visit">Person to Visit & Company:</label>
                                <select class="form-select" id="person_to_visit" name="person_to_visit" required>
                                    <option value="" selected disabled>Select Department or Office</option>
                                        <!-- Colleges -->
                                        <optgroup label="Colleges">
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
                                <span class="text-danger" id="person_to_visit_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="purpose">Purpose:</label>
                                <textarea class="form-control" id="purpose" name="purpose" required></textarea>
                                <span class="text-danger" id="purpose_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="id_type">ID Type:</label>
                                <select class="form-select" id="id_type" name="id_type" required>
                                    <option value="" selected disabled>Select ID Type</option>
                                    <option value="Student ID">Student ID</option>
                                    <option value="Driver License ID">Driver License ID</option>
                                    <option value="National ID">National ID</option>
                                    <option value="Employee ID">Employee ID</option>
                                    <option value="PassPort">PassPort</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="text-danger" id="id_type_error"></span>
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn text-white add_visitor" style="background-color: #0B9B19">
                                <span class="spinner-border spinner-border-sm me-2" id="loadingSpinner" role="status" style="display: none;"></span>
                                Submit
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModalVisitor" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Visitor Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- PDF Preview will be embedded here -->
                <div id="loadingBar" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <iframe id="pdfVisitorFrame" src="" style="width: 100%; height: 500px; border: none;"></iframe>


            </div>
        </div>
    </div>
</div>
