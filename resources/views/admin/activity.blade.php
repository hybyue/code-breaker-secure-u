@extends('admin.layouts.sidebar_admin')

@section('title', 'Activity Log')

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

    <table class="table table-bordered table-responsive-sm activity-log mt-3">
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

    <div class="d-flex justify-content-between">
        <div>Showing {{ $activities->count() }} of {{ $activities->total() }} entries</div>
        <nav>
            <ul class="pagination">
                <li class="page-item {{ $activities->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $activities->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>
                @for ($i = 1; $i <= $activities->lastPage(); $i++)
                    <li class="page-item {{ $activities->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $activities->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $activities->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $activities->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</div>

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
