@extends('admin.layouts.sidebar_admin')

@section('title', 'Activity Log')


<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@section('content')

<div class="container mt-2">
    <div class="row">
        <div class="col-md-6">
            <h4>Activity Log</h4>
        </div>
        <div class="text-center">
            <p class="bordered">Date: {{ now()->format('d, F') }}</p>
        </div>
    </div>

    <table id="activity-log" class="table table-bordered table-responsive-sm activity-log mt-3">
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
                <td>{{ $activity->causer ? $activity->causer->name : 'N/A' }}</td>
                <td>{{ ucfirst($activity->description) }}</td>
                <td>{{ $activity->created_at->format('F d, Y h:i a') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

<script>
   $(document).ready(function() {
    // Check if the table data is loaded
    $('#activity-log').DataTable();
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
