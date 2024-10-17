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

    <table id="tableLost" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th>Types of Object</th>
                <th>Finder's Name</th>
                <th>Role</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                @forelse($lost_found as $item)

                <tr id="tr_{{$item->id}}" class="text-center">

                    <td>{{ $item->object_type }}</td>
                    <td>{{ $item->last_name }}, {{ $item->first_name }}  @if($item->middle_name) {{ $item->middle_name }}. @endif
                     </td>
                    <td>{{ $item->course }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <div class="mx-1">
                                <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewLostFoundAdmin-{{ $item->id }}"><i class="bi bi-eye"></i></a>
                                </div>
                            <div class="mx-1">
                                <a href="javascript:void(0)" class="btn btn-sm text-white" data-id="{{$item->id}}" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateLostFound-{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>
                            {{-- <div class="mx-1">
                                <a href="javascript:void(0)" onclick="deleteLostFound({{$item->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </div> --}}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Data available in table</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>

@foreach($lost_found as $item)
<!-- View Modal -->
<div class="modal fade" id="viewLostFoundAdmin-{{ $item->id }}" tabindex="-1" aria-labelledby="viewLostFoundLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLostFoundLabel-{{ $item->id }}">View Lost Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Object Type:</strong> {{ $item->object_type }}</p>
                <p><strong>Finder's Name:</strong> {{ $item->last_name }}, {{ $item->first_name }}
                    @if($item->middle_name) {{ $item->middle_name }}. @endif
                </p>
                <p><strong>Role:</strong> {{ $item->course }}</p>

                <!-- Display Image in Modal -->
                <div class="d-flew justify-content-center align-items-center mb-3">
                    @if($item->object_img)
                        <img src="{{ asset($item->object_img) }}" alt="Object Image" class="img-fluid" style="max-width: 100%;">
                    @else
                        <span class="text-muted">No Image Available</span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@include('admin.lost.add_lost')
@include('admin.lost.update_lost')
@include('admin.lost.lost_js')


<style>
    .same-height-table td {
        vertical-align: middle;
    }

</style>

@endsection
