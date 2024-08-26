@extends('admin.layouts.sidebar_admin')

@section('title', 'Attendance')

@section('content')
    <div class="container mt-2">
        <div class="row mb-4">
            <div class="col-12">
                <h4>Attendance</h4>
            </div>
        </div>


        <div class="conatiner p-3">
        <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">
                <label for="entries" class="mr-2">Show</label>
                <select id="entries" class="form-control w-auto m-2">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                    <option>110</option>
                    <option>125</option>
                </select>
                <label for="entries" class="ml-2">entries</label>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <input type="text" id="search" class="form-control" placeholder="Search" style="max-width: 300px;">
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-12">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Total Hours</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>

                        <tr>
                            <td>06-12-2023</td>
                            <td>Dela Cruz, Juan S.</td>
                            <td>8:00AM</td>
                            <td>6:00PM</td>
                            <td>8 Hours 0 mins</td>
                            <td>In time/On time</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-end">
                <button class="btn btn-secondary">Previous</button>
                <button class="btn btn-secondary">Next</button>
            </div>
        </div>
    </div>
</div>

    <script>
        function goToAddNew() {
            window.location.href = '{{ url('add-new') }}';
        }
    </script>
@endsection
