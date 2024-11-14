@extends('admin.layouts.sidebar_admin')

@section('title', 'Students')

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
                <h4>Students</h4>
            </div>

            <div class="col-md-6 text-end">
                <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addStudentModalAd">
                    <i class="bi bi-plus-circle-fill text-center"></i> Add New
                </button>
                <form action="{{ route('import.student') }}" method="POST" enctype="multipart/form-data" class="d-inline-flex align-items-center">
                    @csrf
                    <label for="file" class="btn btn-outline-primary d-flex align-items-center" style="gap: 5px;">
                        <i class="bi bi-download"></i> Import Excel
                        <input type="file" class="d-none" id="file" name="excel_file_students" onchange="this.form.submit()">
                    </label>
                </form>
            </div>
        </div>


    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
    <table id="studentTable" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Name</th>
                <th>Course</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr id="tr_{{$student->id}}">
            <td>{{$student->student_no}}</td>
            <td>{{$student->last_name}}, {{$student->first_name}} @if ($student->middle_name)
                {{$student->middle_name}}.
            @endif</td>
            <td>{{$student->course}}</td>

                <td class="text-center">
                    <a href="" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateStudentModalAd-{{ $student->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                     {{--
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="javascript:void(0)" class="btn btn-sm text-white" style="background-color: #1e1f1e"  data-bs-toggle="modal" data-bs-target="#viewStudentAd-{{ $student->id }}"><i class="bi bi-eye"></i></a>
                        </div>
                        <div class="mx-1">
                                              </div>
                        <div class="mx-1">
                            <a href="javascript:void(0)" onclick="deleteStudent({{$student->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div> --}}
                    </div>
                </td>
            </tr>

            @endforeach



        </tbody>
    </table>

</div>

</div>

@include('admin.students.add_student')
@include('admin.students.update_student')
@include('admin.students.student_js')

{{--
Modal for showing all entries of a student
@foreach ($students as $student)
<div class="modal fade" id="viewStudentAd-{{ $student->id }}" tabindex="-1" aria-labelledby="viewStudentAdLabel-{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewStudentAdLabel-{{ $student->id }}">Student Violations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="studentTable" class="table table-bordered same-height-table">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>Name</th>
                            <th>Course</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="tr_{{$student->id}}">
                        <td>{{$student->student_no}}</td>
                        <td>{{$student->last_name}}, {{$student->first_name}} @if ($student->middle_name)
                            {{$student->middle_name}}.
                        @endif</td>
                        <td>{{$student->course}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach --}}




@endsection
