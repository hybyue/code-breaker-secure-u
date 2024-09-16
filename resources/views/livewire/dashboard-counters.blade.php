<div class="row mb-3 m-3 d-flex flex-wrap">
<div class="col-md-4 col-sm-6 mb-4">
    <div class="card text-white" style="flex: 1 1 calc(25% - 1rem); background-color: #D9D9D9;" onclick="location.href='{{ route('admin.employee') }}'">
        <div class="card-body d-flex  align-items-center">
            <img src="images/person.png" alt="Person Image" style="width: 80px; height: 80px;">
            <div>
                <div class="container">
                <h5 class="card-title text-black">EMPLOYEE</h5>
                <p class="text-black">Regular: <small>{{$totalRegular}}</small></p>
                <p class="text-black">Trainee: <small>{{$totalTrainee}}</small></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-6 mb-4">
    <div class="card text-white" style="flex: 1 1 calc(25% - 1rem); background-color: #D9D9D9;" onclick="location.href='{{ route('admin.events.event_admin') }}'">
        <div class="card-body d-flex align-items-center">
            <img src="images/clock.png" alt="Clock Image" style="width: 80px; height: 80px;">
            <div>
                <div class="container">
                <h5 class="card-title text-black">Events</h5>
                <p class="text-black">Today: <small>
                    @if($todaysEvents > 0)
                     {{$todaysEvents}}
                    @else 0
                    @endif</small></p>
                <p class="text-black">Upcoming: 2</p>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="col-md-4 col-sm-6 mb-4">
    <div class="card text-white" style="flex: 1 1 calc(25% - 1rem); background-color: #D9D9D9;" onclick="location.href='{{ route('admin.pass_slip.pass_slip_admin') }}'">
        <div class="card-body d-flex align-items-center">
            <img src="images/person.png" alt="Person Image" style="width: 80px; height: 80px;">
            <div>
                <div class="container">
                <h5 class="card-title text-black">Pass Slip</h5>
                <p class="text-black">Teaching: <small>{{$totalTeaching}}</small></p>
                <p class="text-black">Non-Teaching: <small>{{$totalNon}}</small></p>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
