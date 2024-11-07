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
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalLost()">Generate Report</a>
        </div>
    </div>

    <div class="container mt-4">
        <form action="/admin/lost_found" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('lost_found_admin_filter.start_date', request('start_date')) }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('lost_found_admin_filter.end_date', request('end_date')) }}">
                </div>
                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>
                @if(session()->has('lost_found_admin_filter'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="{{ route('admin.lost.clear-filter') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">

    <table id="tableLostAdmin" class="table table-bordered same-height-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Types of Object</th>
                <th>Finder's Name</th>
                <th>Role</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                @foreach($lost_found as $item)

                <tr id="tr_{{$item->id}}" class="text-center">
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
                    <td>{{ $item->object_type }}</td>
                    <td>{{ $item->last_name }}, {{ $item->first_name }}  @if($item->middle_name) {{ $item->middle_name }}. @endif
                     </td>
                    <td>{{ $item->course }}</td>
                    <td>
                        @if($item->is_claimed == 1)
                            <p class="text-success">Claimed</p>
                        @elseif($item->is_transferred == 1)
                        <p class="text-danger">Transferred</p>
                        @else
                        <button class="btn btn-sm btn-warning" onclick="markAsClaimed({{ $item->id }})">Mark as Claimed</button>
                        <a href="javascript:void(0)" class="btn btn-sm text-white" style="background-color: #1be225" onclick="markAsTransfer({{ $item->id }})"><i class="bi bi-share"></i></a>

                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <div class="mx-1">
                                <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewLostFoundAdmin-{{ $item->id }}"><i class="bi bi-eye"></i></a>
                                </div>
                            <div class="mx-1">
                                <a href="javascript:void(0)" class="btn btn-sm text-white" data-id="{{$item->id}}" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateLostFoundAdmin-{{ $item->id }}">
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
            @endforeach
        </tbody>
    </table>
</div>

</div>
<div id="viewLostFoundAd">
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
                <p><strong>Status:</strong>
                    @if($item->is_claimed == 1)
                        <span class="text-success">Claimed</span>
                    @else
                        <span class="text-danger">Not Claimed</span>
                    @endif
                </p>
                <p><strong>Assist by:</strong>
                    @if ($item->user_id)
                    @php
                        $user = App\Models\User::find($item->user_id);
                    @endphp
                    {{ $user->first_name }} {{ $user->middle_name ? $user->middle_name . ' ' : '' }}{{ $user->last_name }}
                    @else
                    N/A
                @endif
            </p>

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
</div>

@include('admin.lost.add_lost')
@include('admin.lost.update_lost')
@include('admin.lost.lost_js')



<!-- TODO::Modal PDF Preview -->
<div class="modal fade" id="pdfModalLostAd" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">Lost and Found Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- PDF Preview will be embedded here -->
                <div id="loadingBar" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                    </div>
                </div>

                <iframe id="pdfLostFrame" src="" style="width: 100%; height: 500px; border: none;"></iframe>

        </div>
    </div>
</div>




<style>
    .same-height-table td {
        vertical-align: middle;
    }

</style>

@endsection
