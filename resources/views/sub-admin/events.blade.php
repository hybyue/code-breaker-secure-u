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

<!-- Add New Event Modal -->
<div class="modal fade" id="addNewEventModal" tabindex="-1" aria-labelledby="addNewEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewEventModalLabel">Add New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEventForm" action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date Start</label>
                        <input type="date" class="form-control" id="eventDate" name="date_start"  required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date End</label>
                        <input type="date" class="form-control" id="eventDate" name="date_end" >
                    </div>
                    <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Add Event</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit event Information --}}
@foreach ($events as $event)
<div class="modal fade" id="updateEvent-{{ $event->id }}" tabindex="-1" aria-labelledby="updateEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('update.events', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEventModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="title" value="{{ $event->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="eventDescription" name="description" rows="3" required>{{ $event->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date Start</label>
                        <input type="date" class="form-control" id="eventDate" name="date_start" value="{{ \Carbon\Carbon::parse($event->date_start)->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date End</label>
                        <input type="date" class="form-control" id="eventDate" name="date_end" value="{{ \Carbon\Carbon::parse($event->date_end)->format('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
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
