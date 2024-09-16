@extends('admin.layouts.sidebar_admin')

@section('title', 'Announcements')

@section('content')
<meta name="csrf-token" content="{{ csrf_token()}}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="container my-3">
<div class="row" style="padding: 16px;">
    <div class="col-md-6">
        <h4>Announcements</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="" class="btn text-white mb-3" style="background-color: #0B9B19" data-bs-toggle="modal" data-bs-target="#addNewEventModal">
            <i class="bi bi-plus-circle-fill"></i> Add New
        </a>
    </div>
</div>

<div class="container mt-1 bg-body-secondary rounded">
    <div class="row">
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
            <table class=" table table-striped table-bordered table-condensed same-height-table">
                <thead>
                    <tr>
                        <th class="text-center" >Title</th>
                        <th class="text-center">Description</th>
                        <th class="text-center" >Date</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr id="tr_{{$event->id}}">
                        <td class="text-center">{{ $event->title }}</td>
                        <td  style="overflow: hidden; text-overflow: ellipsis;">{{ $event->description }}</td>
                        <td class="text-center">{{ $event->date_start->format('m-d-Y') }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div class="mx-1">
                                    <a href="#"
                                        class="btn btn-sm text-white update_event_form"
                                        style="background-color: #063292"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateEvent-{{$event->id}}"
                                        >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                                <div class="mx-1">
                                        <a href="javascript:void(0)" onclick="deletepost({{$event->id}})" class="btn btn-sm text-white" style="background-color: #920606">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No Data available</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div>Showing {{ $events->count() }} of {{ $events->total() }} entries</div>
        <nav>
            <ul class="pagination">
                <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $events->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>
                @for ($i = 1; $i <= $events->lastPage(); $i++)
                    <li class="page-item {{ $events->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $events->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $events->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $events->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>



@include('admin.events.add_event_admin')
@include('admin.events.update_event_admin')
@include('admin.events.event_adminjs')


<style>
    .same-height-table td {
        vertical-align: middle;
    }

    .colored-toast.swal2-icon-success {
  background-color: #3c9b05 !important;
}

.colored-toast.swal2-icon-error {
  background-color: #f27474 !important;
}

.colored-toast.swal2-icon-warning {
  background-color: #f8bb86 !important;
}

.colored-toast.swal2-icon-info {
  background-color: #3fc3ee !important;
}

.colored-toast.swal2-icon-question {
  background-color: #87adbd !important;
}

.colored-toast .swal2-title {
  color: white;
}

.colored-toast .swal2-close {
  color: white;
}

.colored-toast .swal2-html-container {
  color: white;
}
</style>

@endsection
