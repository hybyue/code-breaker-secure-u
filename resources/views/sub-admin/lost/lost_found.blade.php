@extends('layouts.sidebar')

@section('title', 'Lost and Found')

@section('content')
<div class="container mt-3 pass-slip">
    <div class="row p-3">
        <div class="col-md-6">
            <h4 class="font-weight-bold">Lost and Found</h4>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addNewLostModalSub"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>

            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalLost()">Generate Report</a>

        </div>
    </div>

    @if($seven_days_old->count() > 0)
        <div class="text-start p-3">
            <a href="javascript:void(0)" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sevenDaysOldModal">
                <i class="bi bi-truck"></i> Transfer to CSLD!
            </a>
        </div>
    @endif


    <div class="container mt-4">
        <form action="/sub-admin/lost_found" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"  value="{{ session('lost_found_filter.start_date', request('start_date')) }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ session('lost_found_filter.end_date', request('end_date')) }}">
                </div>

                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>

                @if(session()->has('lost_found_filter'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="{{ url('/sub-admin/lost_found/clear-filter') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>


<div class="container mt-4 mb-3 bg-body-secondary rounded mb-3" style="overflow-x:auto;">
    <table id="lostTable" class="table table-bordered same-height-table">
        <thead>
            <tr>
                {{-- @if($hasSevenDaysOldUnclaimed)
                    <th class="text-center">
                        <input type="checkbox" title="Select all" id="selectAll" style="transform: scale(1.2); cursor: pointer;">
                    </th>
                @endif --}}
                <th>Date</th>
                <th>Items</th>
                <th>Finder's Name</th>
                <th>Role</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($regular_items as $item)
            <tr class="text-center">
                {{-- @if($hasSevenDaysOldUnclaimed)
                    <td class="@if($isSevenDaysOld && $isUnclaimedUntransferred) seven-days-old @endif">
                        @if($isSevenDaysOld && !$item->is_claimed && !$item->is_transferred)
                            <input type="checkbox" class="selectItem" value="{{ $item->id }}" style="transform: scale(1.2); cursor: pointer;">
                        @endif
                    </td>
                @endif --}}
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
                <td>{{ $item->object_type }}</td>
                <td>{{ $item->last_name }}, {{ $item->first_name }} @if($item->middle_name) {{ $item->middle_name }}. @endif</td>
                <td>{{ $item->course }}</td>
                <td>
                    @if($item->is_claimed == 1)
                        <p class="text-success">Claimed</p>
                    @elseif($item->is_transferred == 1)
                        <p class="text-danger">Transferred</p>
                    @else
                        <button class="btn btn-sm btn-warning" onclick="markAsClaimed({{ $item->id }})">Mark as Claimed</button>
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="mx-1">
                            <a href="javascript:void(0)" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewLostFound-{{ $item->id }}"><i class="bi bi-eye"></i></a>
                        </div>
                        <div class="mx-1">
                            <a href="javascript:void(0)" class="btn btn-sm text-white" style="background-color: #063292" data-id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#updateLostFound-{{ $item->id }}"><i class="bi bi-pencil-square"></i></a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- @if($hasSevenDaysOldUnclaimed)
        <div class="mt-1 mb-4">
            <a href="javascript:void(0)"  class="btn btn-dark" id="bulkTransferBtn"><i class="bi bi-truck"></i> Transfer</a>
        </div>
    @endif --}}
</div>


@include('sub-admin.lost.update_lostSub')

<div id="viewModalLostFound">
@foreach($regular_items as $item)
<!-- View Modal -->
<div class="modal fade" id="viewLostFound-{{ $item->id }}" tabindex="-1" aria-labelledby="viewLostFoundLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLostFoundLabel-{{ $item->id }}">View Lost Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                      <p><strong>Lost Item:</strong> {{ $item->object_type }}</p>
                      <p><strong>Finder's Name:</strong> {{ $item->last_name }}, {{ $item->first_name }} @if($item->middle_name) {{ $item->middle_name }}. @endif</p>
                      <p><strong>Role:</strong> {{ $item->course }}</p>
                      <p><strong>Location:</strong> {{ $item->location }}</p>
                      @if($item->description)<p><strong>Description:</strong> {{ $item->description }}</p>@endif
                      @if($item->remarks)<p><strong>Remarks:</strong> {{ $item->remarks}}</p>@endif
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>


@include('sub-admin.lost.add_lost')
@include('sub-admin.lost.lost_js')





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

    .seven-days-old {
        background-color: #f7e5e5 !important;
        z-index: 10000;
    }
</style>
@endsection
