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
                        <button class="btn btn-sm btn-warning" title="Mark as Claimed" onclick="markAsClaimed({{ $item->id }})">Mark as Claimed</button>
                        <a href="javascript:void(0)" class="btn btn-sm bg-dark text-white" title="Transfer to CSLD" style="background-color: #1be225" onclick="markAsTransfer({{ $item->id }})"><i class="bi bi-share"></i></a>

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
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">


                <div class="modal-header border-0" style="background-color: #f8f9fa;">
                    <h5 class="modal-title" id="viewLostFoundLabel-{{ $item->id }}" style="color: #333;">View Lost Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4" style="color: #555;">
                    <div class="row mb-3">
                          <!-- Image at the top with rounded corners -->
                <div class="modal-image" style="border-top-left-radius: 15px; border-top-right-radius: 15px; overflow: hidden;">
                    @if($item->object_img)
                        <img src="{{ asset($item->object_img) }}" alt="Object Image" class="img-fluid" style="width: 100%; border-radius: 15px 15px 0 0;">
                    @else
                        <div class="text-muted text-center p-5" style="background-color: #f8f9fa; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                            No Image Available
                        </div>
                    @endif
                </div>
                        <div class="col-12">
                            <p><strong>Object Type:</strong> {{ $item->object_type }}</p>
                            <p><strong>Finder's Name:</strong> {{ $item->last_name }}, {{ $item->first_name }} @if($item->middle_name) {{ $item->middle_name }}. @endif</p>
                            <p><strong>Role:</strong> {{ $item->course }}</p>
                            <p><strong>Location:</strong> {{ $item->location }}</p>
                            @if($item->description)<p><strong>Description:</strong> {{ $item->description }}</p>@endif
                            @if($item->remarks)<p><strong>Remarks:</strong> {{ $item->remarks }}</p>@endif
                            <p><strong>Status:</strong>
                                @if($item->is_claimed == 1)
                                    <span class="badge bg-success">Claimed</span>
                                @elseif($item->is_transferred == 1)
                                    <span class="badge bg-danger">Transferred</span>
                                @else
                                    <span class="badge bg-danger">Not Claimed</span>
                                @endif
                            </p>
                            @if ($item->security_staff)
                            <p><strong>Assist by:</strong>
                                    @php
                                        $user = App\Models\User::find($item->security_staff);
                                    @endphp
                                    {{ $user->first_name }} {{ $user->middle_name ? $user->middle_name . ' ' : '' }}{{ $user->last_name }}
                            </p>
                            @endif
                            <div class="modal-proof-image mb-3">
                                @if($item->proof_image)
                                    <p><strong>Proof Claimed: </strong></p>
                                    <img src="{{ asset($item->proof_image) }}" alt="Proof Image" class="img-fluid rounded border">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0" style="background-color: #f8f9fa; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 20px;">Close</button>
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

.modal-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.modal-body p {
    font-size: 1rem;
    line-height: 1.5;
}

.modal-image img {
    width: 100%;
    max-height: 350px;
    object-fit: contain;
}
.badge {
    font-size: 0.9rem;
    padding: 0.5em 0.75em;
}

.btn-close {
    color: #333;
    opacity: 0.7;
}

.btn-close:hover {
    opacity: 1;
}

.modal-proof-image img {
    max-height: 350px;
    object-fit: contain;
    width: 100%;
    border: 1px solid #dee2e6;
    border-radius: 10px;
}
</style>

@endsection
