@extends('admin.layouts.sidebar_admin')

@section('title', 'Schedule')

@section('content')

<div class="contaiiner p-3">
    <div class="row p-2">
        <div class="col-md-6">
            <h4>Schedule</h4>
        </div>
       <div class="col-md-6 text-end">
        <button class="btn text-white " style="background-color: #0B9B19;"><i class="bi bi-plus-circle-fill"></i> Add New</button>
    </div>
    </div>

    <div class="container mt-5 p-2">
        <div class="row no-gutters m-2">
            <div class="col-md-4">
                <input type="date" class="form-control" placeholder="Start Date">
            </div>
            <div class="col-md-4">
                <input type="date" class="form-control" placeholder="End Date">
            </div>
            <div class="col-md-4">
                <button class="btn btn-sm text-white" style="background-color: #0B9B19;"><i class="bi bi-plus-circle-fill"></i> Filter</button>
            </div>
        </div>
    </div>
    <div class="container p-3 mt-4 " style="background-color: #D9D9D9">
    <table class="table table-bordered mt-4">
        <thead>
            <tr class="bg-body-secondary" style="background-color: #D9D9D9">
                <th>Security Staff</th>
                <th>Start Time</th>
                <th>Time Out</th>
                <th>Day</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Juan D. Dela Cruz</td>
                <td>07:00 AM</td>
                <td>05:30 PM</td>
                <td>Monday to Friday</td>
            </tr>


            <tr>
                <td>Juana D. Dela Cruza</td>
                <td>07:00 AM</td>
                <td>05:30 PM</td>
                <td>Monday, Wednesday, Friday</td>
            </tr>



        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <div>Showing 1 to 2 of 2 entries</div>
        <nav>
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>


</div>
</div>

<footer class="text-start mt-5">
    <p>Copyright © 2024-2025 SecureU. All right reserved</p>
</footer>
@endsection
