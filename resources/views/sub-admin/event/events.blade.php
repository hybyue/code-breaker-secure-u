@extends('layouts.sidebar')

@section('title', 'Event List')

<link href='{{ asset('fullcalendar/main.min.css') }}' rel='stylesheet' />

@section('content')
<div class="row" style="padding: 16px;">
    <div class="col-md-6">
        <h4>Announcements</h4>
    </div>
    <div class="col-md-6 text-end">
        <button class="btn text-white mb-3" style="background-color: #0B9B19" data-bs-toggle="modal" data-bs-target="#addNewEventModal">
            <i class="bi bi-plus-circle-fill"></i> Add New
        </button>
    </div>
</div>

<div class="container p-3 mt-4 bg-body-secondary rounded">
    <div class="row mb-3">
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
            <table class="table table-striped table-bordered table-condensed w-100 same-height-table" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 20%;">Event Title</th>
                        <th class="text-center" style="width: 50%;">Description</th>
                        <th class="text-center" style="width: 20%;">Date</th>
                        <th class="text-center" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td class="text-center">{{ $event->title }}</td>
                        <td  style="overflow: hidden; text-overflow: ellipsis;">{{ $event->description }}</td>
                        <td class="text-center">{{ $event->date_start->format('m-d-Y') }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateEvent-{{ $event->id }}"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No Data available in table</td>
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
</div>

@include('sub-admin.event.add_event')
@include('sub-admin.event.update_event')
@include('sub-admin.event.event_js')


<style>
    .same-height-table td {
        vertical-align: middle;
    }
    </style>
@endsection
