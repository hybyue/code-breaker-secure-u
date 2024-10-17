
{{-- Add Violation --}}
<div class="modal fade" id="violationModal" tabindex="-1" aria-labelledby="violationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="violationModalLabel">Add Violation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="violationForms" action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <label for="student_no">Student Number:</label>
                            <input type="text" class="form-control" id="student_no" name="student_no" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="middle_initial">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_initial" placeholder="Optional" name="middle_initial">
                        </div>
                        <div class="form-group">
                            <label for="course">Course:</label>
                            <select class="form-select" id="course" name="course" required>
                                <option value="" selected disabled>Select course</option>

                                <!-- Bachelor's Programs -->
                                <option value="BSA">Bachelor of Science in Accountancy (BSA)</option>
                                <option value="BSBA-FM">Bachelor of Science in Business Administration Major in Financial Management (BSBA-FM)</option>
                                <option value="BSBA-HRM">Bachelor of Science in Business Administration Major in Human Resource Management (BSBA-HRM)</option>
                                <option value="BSBA-MM">Bachelor of Science in Business Administration Major in Marketing Management (BSBA-MM)</option>
                                <option value="BSBA-MA">Bachelor of Science in Business Administration Major in Management Accounting (BSBA-MA)</option>
                                <option value="BSOA">Bachelor of Science in Office Administration (BSOA)</option>
                                <option value="BACOMM">Bachelor of Arts in Communication (BACOMM)</option>
                                <option value="BEE">Bachelor of Elementary Education (BEE)</option>
                                <option value="BECEd">Bachelor of Early Childhood Education (BECEd)</option>
                                <option value="BSNEd">Bachelor of Special Needs Education (BSNEd)</option>
                                <option value="BSED-EN">Bachelor of Secondary Education Major in English (BSED-EN)</option>
                                <option value="BSED-FL">Bachelor of Secondary Education Major in Filipino (BSED-FL)</option>
                                <option value="BSED-MTH">Bachelor of Secondary Education Major in Mathematics (BSED-MTH)</option>
                                <option value="BSED-SC">Bachelor of Secondary Education Major in Science (BSED-SC)</option>
                                <option value="BSED-SS">Bachelor of Secondary Education Major in Social Studies (BSED-SS)</option>
                                <option value="BPE">Bachelor of Physical Education (BPE)</option>
                                <option value="BCAE">Bachelor of Culture & Arts Education (BCAE)</option>
                                <option value="BSPsych">Bachelor of Science in Psychology (BSPsych)</option>
                                <option value="BSSW">Bachelor of Science in Social Work (BSSW)</option>
                                <option value="BSMW">Bachelor of Science in Midwifery (BSMW)</option>
                                <option value="BSPH">Bachelor of Science in Pharmacy (BSPH)</option>
                                <option value="BSHM">Bachelor of Science in Hotel Management (BSHM)</option>
                                <option value="BSTM">Bachelor of Science in Tourism Management (BSTM)</option>
                                <option value="BSArch">Bachelor of Science in Architecture (BSArch)</option>
                                <option value="BSCivEng">Bachelor of Science in Civil Engineering (BSCivEng)</option>
                                <option value="BSEE">Bachelor of Science in Electrical Engineering (BSEE)</option>
                                <option value="BSCpE">Bachelor of Science in Computer Engineering (BSCpE)</option>
                                <option value="BSECE">Bachelor of Science in Electronics Engineering (BSECE)</option>
                                <option value="BSIT">Bachelor of Science in Information Technology (BSIT)</option>
                                <option value="BLIS">Bachelor in Library & Information Science (BLIS)</option>
                                <option value="BSCrim">Bachelor of Science in Criminology (BSCrim)</option>
                                 <!-- Graduate & Post Graduate Programs -->
                                 <option value="DED-EM">Doctor of Education Major in Educational Management (DED-EM)</option>
                                 <option value="MAED-EM">Master of Arts in Education Major in Educational Management (MAED-EM)</option>
                                 <option value="MAECE">Master of Arts Early Childhood Education (MAECE)</option>
                                 <option value="MASPED">Master of Arts in Special Education (MASPED)</option>
                                 <option value="MBA">Master in Business Administration (MBA)</option>
                                 <option value="MPA">Master in Public Administration (MPA)</option>
                                 <option value="MAN">Master of Arts in Nursing (MAN)</option>
                                 <option value="JD">Juris Doctor (JD)</option>

                                <!-- Short Term Courses -->
                                <option value="CG-NCII">Caregiving NC II (CG-NCII)</option>
                                <option value="HK-NCII">Housekeeping NC II (HK-NCII)</option>
                                <option value="BK-NCIII">Bookkeeping NC III (BK-NCIII)</option>
                                <option value="FBS-NCII">Food and Beverage Services NC II (FBS-NCII)</option>
                                <option value="BP-NCII">Bread and Pastry Production NC II (BP-NCII)</option>
                                <option value="CSS-NCII">Computer Systems Servicing NC II (CSS-NCII)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="violation_type">Violation Type:</label>
                            <select class="form-select" id="violation_type" name="violation_type" required>
                                <option value="" selected disabled>Select ID Type</option>
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
                        <input type="date" class="form-control" id="date" name="date">
                    </div>

                    </div>


                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn text-white" style="background-color: #0B9B19">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModalViolation" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Pass Slip Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- PDF Preview will be embedded here -->
                <div id="loadingBar" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div id="pdfPreviewContent">
                    <div class="container-header">
                        <div class="header">
                            <img src="{{ asset('images/UCU-logo.png') }}" alt="UCU Logo">
                            <p class="university">Urdaneta City University</p>
                            <p class="report-title">Reports list of Visitor</p>
                            <p class="department">Security Management Office Report</p>
                        </div>
                    </div>
                    <div>


                        <!-- Show date range if provided -->
                        @if(!empty($request->start_date) && !empty($request->end_date))
                            <p class="text-start">Date Range: {{ $request->start_date }} - {{ $request->end_date }}</p>
                        @else
                            <p class="text-start">Date: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
                        @endif
                    </div>
                    <div class="container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Destination</th>
                                    <th>Date</th>
                                    <th>Time Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @forelse ($allPassSlips as $passSlip)
                                    <tr>
                                        <td>{{ $passSlip->p_no }}</td>
                                        <td>{{ $passSlip->first_name }} {{ $passSlip->middle_name }}. {{ $passSlip->last_name }}</td>
                                        <td>{{ $passSlip->department }}</td>
                                        <td>{{ $passSlip->designation }}</td>
                                        <td>{{ $passSlip->destination }}</td>
                                        <td>{{ \Carbon\Carbon::parse($passSlip->date)->format('F d, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($passSlip->time_out)->format('g:i A') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Data available in table</td>
                                    </tr>
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="text-start mt-4">
                        <!-- Displaying authenticated user's name -->
                        {{-- <p>Generated by: {{ $user->name }}</p> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('pdf.generate-passes', array_merge(request()->query(), ['employee_type' => request('employee_type')])) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-pass-slip.pdf">
                    <i class="bi bi-file-earmark-pdf-fill"></i> PDF
                </a>
            </div>
        </div>
    </div>
</div>


<style>
    .container-header{
        margin-top: 10px;
        text-align: center;
        margin: 0;
        padding: 0;
    }
    .header {
        text-align: center;
        margin: 0;
        padding: 0;
    }
    .header img {
        display: block;
        margin: 0 auto;
        width: 100px;
    }
    .university {
        font-size: 20px;
        font-weight: bolder;
    }
    .report-title {
        font-size: 14px;
        font-weight: bold;
    }

    .department{
        font-size: 14px;
        font-weight: bold;
    }
</style>
