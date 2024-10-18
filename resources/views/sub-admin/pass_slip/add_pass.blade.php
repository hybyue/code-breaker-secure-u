<!-- Add New Pass Slip Modal -->
<div class="modal fade" id="addPassSlipModal" tabindex="-1" aria-labelledby="addPassSlipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPassSlipModalLabel">Add Pass Slip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPassForm" action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-2 position-relative">
                            <input type="text" class="form-control" id="search_employee"
                                placeholder="Type ID or Name" oninput="searchEmployee()">
                            <div id="employee_results" class="col-md-12 results-container"></div>
                            <!-- This will show suggestions -->
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="p_no" class="form-label">Pass Number:</label>
                            <input type="text" class="form-control" name="p_no" id="p_no"
                            value="{{ $passNumber ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="employee_type" class="form-label">Employee Type:</label>
                            <select class="form-select" id="status" name="employee_type" required readonly>
                                <option value="" selected disabled>Select Employee Type</option>
                                <option value="Teaching">Teaching</option>
                                <option value="Non-Teaching">Non-Teaching</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <input hidden type="text" class="form-control" id="employee_id" name="employee_id">
                        <div class="col-md-4 mb-2">
                            <label for="last_name" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required readonly>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="first_name" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required readonly>
                        </div>
                        <div class="col-md-4  mb-2">
                            <label for="middle_name" class="form-label">Middle Initial:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" readonly
                                placeholder="Optional">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="department" class="form-label">Department:</label>
                            <input type="text" class="form-control" id="department" name="department" required readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="designation" class="form-label">Designation:</label>
                            <input class="form-control" id="designation" name="designation" rows="3"
                                required readonly></input>
                        </div>
                        <div class="row mb-2 ms-3">
                            <label class="form-label">Check Business:</label>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="commute" name="check_business" value="Commute">
                                <label class="form-check-label" for="commute">Commute</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="own_vehicle" name="check_business" value="Use own vehicle">
                                <label class="form-check-label" for="own_vehicle">Use own vehicle</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="university_vehicle" name="check_business" value="With the use of university vehicle">
                                <label class="form-check-label" for="university_vehicle">With the use of university vehicle</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="official_business" name="check_business" value="Official business">
                                <label class="form-check-label" for="official_business">Official business</label>
                            </div>
                            <div class="col-md-6 form-check">
                                <input class="form-check-input" type="radio" id="personal_business" name="check_business" value="Personal business">
                                <label class="form-check-label" for="personal_business">Personal business</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="driver_name" class="form-label">Driver Name:</label>
                            <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label for="destination" class="form-label">Destination:</label>
                            <input class="form-control" id="destination" name="destination" required></input>
                        </div>
                        <div class="col-md-6">
                            <label for="purpose" class="form-label">Purpose:</label>
                            <textarea class="form-control" id="purpose" name="purpose" rows="1" required></textarea>
                        </div>
                        {{-- <div class="col-md-6 mb-2">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div> --}}
                        <div class="col-md-6 mb-2">
                            <label for="time_out" class="form-label">Time Out</label>
                            <input type="time" class="form-control" id="time_out" name="time_out" required>
                        </div>
                        <div class="mt-2 d-flew justify-content-end align-items-end text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




{{--
<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
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
                            <p class="report-title">Reports list of Pass Slip @if(!empty($request->employee_type))
                              ({{ $request->employee_type }})
                            @endif</p>
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
                                @forelse ($allPassSlips as $passSlip)
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
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-start mt-4">
                        <!-- Displaying authenticated user's name -->
                        <p>Generated by: {{ $user->name }}</p>
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
</style> --}}
