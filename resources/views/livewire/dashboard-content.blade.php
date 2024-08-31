<div>
    @if($currentView == 'admin.dashboard')
        @include('admin.dashboard')
    @elseif($currentView == 'admin.employee')
        @include('admin.employee')
    @elseif($currentView == 'admin.visitor_admin')
        @include('admin.visitor_admin')
    @elseif($currentView == 'admin.pass_slip_admin')
        @include('admin.pass_slip_admin')
    @elseif($currentView == 'admin.vehicle_sticker')
        @include('admin.vehicle_sticker')
    @elseif($currentView == 'admin.violation')
        @include('admin.violation')
    @elseif($currentView == 'admin.register')
        @include('admin.register')
    @elseif($currentView == 'admin.lost_found_admin')
        @include('admin.lost_found_admin')
    @elseif($currentView == 'admin.event_admin')
        @include('admin.event_admin')
    @elseif($currentView == 'admin.activity')
        @include('admin.activity')
    @endif
</div>

