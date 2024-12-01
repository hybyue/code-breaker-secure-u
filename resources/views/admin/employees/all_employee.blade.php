@extends('admin.layouts.sidebar_admin')

@section('title', 'Employees')

@section('content')
<div class="container">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    icon: 'success',
                    title: "{{ session('success') }}",
                });
            });
        </script>
    @endif
</div>

<div class="container mt-3 pass-slip">

    <div class="row">
        <div class="col-md-6">
            <h4>Employees</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-backdrop="false" data-bs-target="#addEmployeeModalAd"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
                <!-- Import Excel Form -->
                <form action="{{ route('import.employee') }}" method="POST" enctype="multipart/form-data" id="importForm" class="d-inline-flex align-items-center">
                    @csrf
                    <label class="btn btn-outline-primary d-flex align-items-center" style="gap: 5px;" onclick="showWarning()">
                        <i class="bi bi-download"></i> Import Excel
                    </label>
                    <input type="file" class="d-none" id="file" name="excel_file_employees" onchange="document.getElementById('importForm').submit()">
                </form>

        </div>
     </div>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
    <table id="employeeTable" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th>Employee ID </th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Employee Type</th>

                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allEmployees as $allEmployee)
            <tr id="tr_{{$allEmployee->id}}">
            <td>{{$allEmployee->employee_id}}</td>
            <td>{{$allEmployee->last_name}}, {{$allEmployee->first_name}} @if ($allEmployee->middle_name)
                {{$allEmployee->middle_name}}.
            @endif</td>
            <td>{{$allEmployee->designation}}</td>
            <td>{{$allEmployee->department}}</td>
            <td>{{$allEmployee->status}}</td>

                <td class="text-center">
                    <a href="javascript:void(0)" class="editModal btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateEmployeeModalAd-{{$allEmployee->id}}"><i class="bi bi-pencil-square"></i></a>
                </td>
            </tr>

            @endforeach



        </tbody>
    </table>

</div>

</div>

@include('admin.employees.add_employee')
@include('admin.employees.update_employee')

@include('admin.employees.employee_js')

<script>
    function showWarning() {
        Swal.fire({
            title: 'Import Multiple Employee Data',
            html: `
                <p>Please ensure your Excel file follows the correct column order</p>
                <br>
                <br>
                <table style="width: 100%; text-align: left; border-collapse: collapse; border: 1px solid #ddd;">
                <thead>
                    <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">Employee ID</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">First Name</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">Middle Initial</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">Last Name</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">Designation</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">Department</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">Status</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4;">Position</th>
                    </tr>
                </thead>
            </table>
            <br>
            <br>
                <p class='text-danger'>Uploading a file in a different format may result in errors.</p>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Proceed to Upload',
            cancelButtonText: 'Cancel',
            customClass: {
            popup: 'custom-width',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Trigger the hidden file input
                document.getElementById('file').click();
            }
        });
    }
</script>


<style>
    .same-height-table td {
        vertical-align: middle;
    }
    .swal2-popup.custom-width {
        width: 100%;
        max-width: 1000px;
    }
</style>




@endsection
