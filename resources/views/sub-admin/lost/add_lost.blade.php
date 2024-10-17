{{-- add new lost and found --}}
<div class="modal fade" id="addNewLostModal" tabindex="-1" aria-labelledby="addNewLostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLostModalLabel">Add New Lost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLostForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lostType" class="form-label">Object type:</label>
                            <input type="text" class="form-control" id="lostType" name="object_type" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="middleName" class="form-label">Middle Initial:</label>
                            <input type="text" class="form-control" id="middleName" placeholder="Optional" name="middle_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lostCourse" class="form-label">Role:</label>
                            <input type="text" class="form-control" id="lostCourse" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label for="lostImage" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="lostImage" name="object_img">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModalLost" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
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
