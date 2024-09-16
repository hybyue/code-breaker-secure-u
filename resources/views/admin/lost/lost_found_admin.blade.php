@extends('admin.layouts.sidebar_admin')

@section('title', 'Lost and Found')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{  asset('bootstrap-5.3.3-dist/css/bootstrap.css')}}" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <table id="tableLost" class="table table-bordered same-height-table">
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

                <tr id="tr_{{$item->id}}" class="text-center">

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
                                <a href="javascript:void(0)" class="btn btn-sm text-white" data-id="{{$item->id}}" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateLostFound-{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>
                            <div class="mx-1">
                                <a href="javascript:void(0)" onclick="deleteLostFound({{$item->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
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

@include('admin.lost.add_lost')
@include('admin.lost.update_lost')
@include('admin.lost.lost_js')


<style>
    .same-height-table td {
        vertical-align: middle;
    }

</style>

@endsection
