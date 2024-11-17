@extends('admin.layouts.sidebar_admin')

@section('title', 'Activity Log')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.min.css">

<div class="container mt-2">
    <div class="row">
        <div class="col-md-6">
            <h4>Activity Log</h4>
        </div>
        <div class="text-center">
            <p class="bordered">Date: {{ now()->format('d, F') }}</p>
        </div>
    </div>

    <div class="container mt-4">
        <form action="{{ route('admin.activity') }}" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ session('activity_filter.start_date', request('start_date')) }}">
                </div>
                <div class="col-md-3">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                        value="{{ session('activity_filter.end_date', request('end_date')) }}">
                </div>
                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>
                @if(session()->has('activity_filter'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="{{ route('activity.clear-filter') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="container p-2 bg-body-secondary rounded mb-3 mt-3" style="overflow-x:auto;">

    <table id="activityTable" class="table table-bordered table-responsive-sm activity-log">
        <thead class="thead-light">
            <tr>
                <th scope="col">User</th>
                <th scope="col">Activity</th>
                <th scope="col">Date & Time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->causer ? $activity->causer->first_name . ' ' . $activity->causer->last_name : 'N/A' }}</td>
                <td>{{ ucfirst($activity->description) }}</td>
                <td>{{ $activity->created_at->format('F d, Y h:i a') }}</td>
                <td>
                    @if($activity->properties->has('old') || $activity->properties->has('attributes'))
                        <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#changeModal-{{ $activity->id }}">
                            <i class="bi bi-eye"></i> View
                        </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add Modals for each activity -->
@foreach($activities as $activity)
    <div class="modal fade" id="changeModal-{{ $activity->id }}" tabindex="-1" aria-labelledby="changeModalLabel-{{ $activity->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeModalLabel-{{ $activity->id }}">Changes Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Old Value</th>
                                    <th>New Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($activity->event === 'created')
                                    @foreach($activity->properties['attributes'] ?? [] as $field => $newValue)
                                        <tr>
                                            <td>{{ ucwords(str_replace('_', ' ', $field)) }}</td>
                                            <td>-</td>
                                            <td>{{ is_array($newValue) ? json_encode($newValue) : $newValue }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($activity->properties['attributes'] ?? [] as $field => $newValue)
                                        @if(isset($activity->properties['old'][$field]) || $newValue)
                                            <tr>
                                                <td>{{ ucwords(str_replace('_', ' ', $field)) }}</td>
                                                <td>{{ $activity->properties['old'][$field] ?? '-' }}</td>
                                                <td>{{ is_array($newValue) ? json_encode($newValue) : $newValue }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
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
<!-- Include jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/2.1.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    new DataTable('#activityTable', {
        responsive: true,
        "ordering": false,
        language: {
                lengthMenu: "_MENU_ entries",
            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
            ],
        });
});
</script>

@endsection

@push('styles')
<style>
.date-box {
    display: inline-block;
    padding: 5px 10px;
    border: 2px solid black;
}

.modal-lg {
    max-width: 800px;
}

.table-responsive {
    max-height: 400px;
    overflow-y: auto;
}

.changes-table th {
    background-color: #f8f9fa;
    position: sticky;
    top: 0;
    z-index: 1;
}
</style>
@endpush
