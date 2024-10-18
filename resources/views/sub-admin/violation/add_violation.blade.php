
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
                            <div class="form-group">
                                <label for="student_no">Student Number:</label>
                                <input type="text" class="form-control" id="student_no" name="student_no" required>
                            </div>
                            <div id="student_results" class="col-md-12 results-container"></div>
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
                            <input type="text" class="form-control" id="course" name="course" required>
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
                        <input type="date" class="form-control" id="date" name="date" >
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
                <h5 class="modal-title" id="pdfModalLabel">Violation Report</h5>
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
                            <p class="report-title">Reports list of Violation</p>
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
                                    <th>Student Number</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Violation</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($violations as $violate)
                                <tr>
                                    <td>{{$violate->student_no}}</td>
                                    <td>{{$violate->last_name}}, {{$violate->first_name}} @if($violate->middle_initial){{$violate->middle_initial}}.@endif
                                    </td>
                                    <td>{{$violate->course}}</td>
                                    <td>{{$violate->violation_type}}</td>
                                    <td>{{$violate->date}}</td>
                                    <td>{{$violate->violation_count}} violation(s)</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-start mt-4">
                        <p>Generated by: {{ $user->name }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('pdf.generate-violation', array_merge(request()->query())) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-violation.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
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
