@extends('admin.layouts.sidebar_admin')

@section('title', 'Lost and Found')

@section('content')
<div class="container mt-3 pass-slip">

    <div class="row">
        <div class="col-md-6">
            <h4>Lost and Found</h4>
        </div>
        <div class=" col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addNewLostModal"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <a href="{{ route('pdf.generate-lost', request()->query()) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-losts.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a>
        </div>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded">
        <div class="row mb-3">
            <div class="col-md-6 d-flex align-items-center">

            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center">
                <input type="text" id="search" class="form-control" placeholder="Search" style="max-width: 300px;">
            </div>
        </div>
    <table class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th>Types of Object</th>
                <th>Name</th>
                <th>Course</th>
                <th>Image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                @forelse($lost_found as $item)
                <tr class="text-center">
                    <td>{{ $item->object_type }}</td>
                    <td>{{ $item->first_name }} {{ $item->middle_name }}. {{ $item->last_name }} </td>
                    <td>{{ $item->course }}</td>
                    <td>
                        @if($item->object_img)
                            <img src="{{ asset($item->object_img) }}" alt="Object Image" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <div class="mx-1">
                                <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateLostFound-{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>
                            <div class="mx-1">
                                <form action="{{route('archive.lost_found', $item->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to Archive?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm text-white" style="background-color: #920606">
                                        <i class="bi bi-archive-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Data available in table</td>
                </tr>
            @endforelse            </tr>
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

{{-- add new lost and found  --}}
<div class="modal fade" id="addNewLostModal" tabindex="-1" aria-labelledby="addNewLostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewLostModalLabel">Add New Lost</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLostForm" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="lostType" class="form-label">Object type:</label>
                        <input type="text" class="form-control" id="lostType" name="object_type" required>
                    </div>
                    <div class="col-md-6  mb-3">
                        <label for="lostName" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="lostName" name="first_name" required>
                    </div>
                    <div class="col-md-6  mb-3">
                        <label for="lostName" class="form-label">Middle Initial:</label>
                        <input type="text" class="form-control" id="lostName" name="middle_name" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lostName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lostName" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="lostCourse" class="form-label">Course:</label>
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

{{-- edit lost and found details --}}
@foreach($lost_found as $item)
<div class="modal fade" id="updateLostFound-{{ $item->id }}" tabindex="-1" aria-labelledby="updateLostFoundModalLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateLostFoundModalLabel-{{ $item->id }}">Edit Lost Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('update.lost_found_admin', $item->id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="lostType-{{ $item->id }}" class="form-label">Object type:</label>
                            <input type="text" class="form-control" id="lostType-{{ $item->id }}" name="object_type" value="{{ $item->object_type }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName-{{ $item->id }}" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="firstName-{{ $item->id }}" name="first_name" value="{{ $item->first_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="middleName-{{ $item->id }}" class="form-label">Middle Initial:</label>
                            <input type="text" class="form-control" id="middleName-{{ $item->id }}" name="middle_name" value="{{ $item->middle_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName-{{ $item->id }}" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lastName-{{ $item->id }}" name="last_name" value="{{ $item->last_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="lostCourse-{{ $item->id }}" class="form-label">Course:</label>
                            <input type="text" class="form-control" id="lostCourse-{{ $item->id }}" name="course" value="{{ $item->course }}">
                        </div>
                        <div class="mb-3">
                            <label for="lostImage-{{ $item->id }}" class="form-label">Image:</label>
                            <input type="file" class="form-control" id="lostImage-{{ $item->id }}" name="object_img" onchange="previewImage(event, {{ $item->id }})">
                            <div class="d-flex justify-content-center">
                                <div class="container p-1">
                                    <p>Current Image:</p>
                                    @if($item->object_img)
                                    <img id="currentImage-{{ $item->id }}" src="{{ asset($item->object_img) }}"  alt="Current Image" class="img-fluid mt-2" style="max-width: 100px;">
                                    @else
                                    <span class="text-muted">No Image</span>
                                    @endif
                                </div>
                                <div class="container p-1">
                                    <p>Updated Image:</p>
                                    <img id="newImagePreview-{{ $item->id }}" class="img-fluid mt-2" style="max-width: 100px; display: none;">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .same-height-table td {
        vertical-align: middle;
    }
</style>

@endsection
