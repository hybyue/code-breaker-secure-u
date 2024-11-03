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

    <div class="container p-2 bg-body-secondary rounded mb-3 mt-3" style="overflow-x:auto;">

    <table id="activityTable" class="table table-bordered table-responsive-sm activity-log">
        <thead class="thead-light">
            <tr>
                <th scope="col">User</th>
                <th scope="col">Activity</th>
                <th scope="col">Date & Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->causer ? $activity->causer->first_name . ' ' . $activity->causer->last_name : 'N/A' }}</td>
                <td>{{ ucfirst($activity->description) }} @if( $activity->properties['ip'] ?? '')
                    IP Address {{ $activity->properties['ip'] ?? '' }} @endif
                </td>
                <td>{{ $activity->created_at->format('F d, Y h:i a') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
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
</style>
@endpush
