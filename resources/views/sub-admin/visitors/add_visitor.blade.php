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
                            {{-- <div class="col-12 form-group">
                                <label for="search_visitor">Search Visitor:</label>
                                <input type="text" class="form-control" id="search_visitor" placeholder="Search by name" onkeyup="searchVisitor()">
                                <div id="visitorSuggestions" class="list-group mt-2"></div>
                            </div> --}}
                            <div class="col-md-4 form-group">
                                <label for="last_name">Last Name:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="first_name">First Name:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="middle_name">Middle Initial:</label>
                                <input type="text" class="form-control" id="middle_name" placeholder="Optional"
                                    name="middle_name">
                            </div>
                            <div class="form-group">
                                <label for="person_to_visit">Person to Visit & Company:</label>
                                <input type="text" class="form-control" id="person_to_visit" name="person_to_visit"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="purpose">Purpose:</label>
                                <textarea class="form-control" id="purpose" name="purpose" required></textarea>
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
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn text-white add_visitor" data-bs-dismiss="modal"
                                style="background-color: #0B9B19">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModalVisitor" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                                    <th>Date</th>
                                    <th>Visitor's Name</th>
                                    <th>Person to visit & Company</th>
                                    <th>Purpose</th>
                                    <th>Time in</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allVisitors as $visit)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($visit->date)->format('F d, Y') }}</td>
                                    <td>{{ $visit->first_name }} {{ $visit->middle_name }}. {{ $visit->last_name }}</td>
                                    <td>{{ $visit->person_to_visit }}</td>
                                    <td>{{ $visit->purpose }}</td>
                                    <td>{{ \Carbon\Carbon::parse($visit->time_in)->format('g:i A') }}</td>
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
                <a href="{{ route('pdf.generate-visitors', request()->query()) }}" class="btn text-white"
                    style="background-color: #0B9B19;" download="report-visitors.pdf"><i
                        class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
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

