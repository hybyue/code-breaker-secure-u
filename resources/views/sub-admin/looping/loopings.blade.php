@extends('layouts.sidebar')

@section('title', 'Looping')

@section('content')
<div class="container mt-3 pass-slip">
    <div class="row">
        <div class="col-md-6">
            <h4>Looping</h4>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addLoopingModal"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>
            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalLooping()">Looping Report</a>


        </div>
    </div>

    <div class="container mt-4">
        <form action="/sub-admin/looping" method="GET">
            <div class="row pb-3">
                <div class="col-md-2">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"  value="{{ session('looping_filter.start_date', request('start_date')) }}">
                </div>
                <div class="col-md-2">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ session('looping_filter.end_date', request('end_date')) }}">
                </div>

                <div class="col-md-2">
                    <label for="employee_type">Employee Type:</label>
                    <select class="form-select" id="employee_type" name="employee_type">
                        <option value="">All</option>
                        <option value="Teaching" {{ session('looping_filter.employee_type') == 'Teaching' ? 'selected' : '' }}>Teaching</option>
                        <option value="Non-Teaching" {{ session('looping_filter.employee_type') == 'Non-Teaching' ? 'selected' : '' }}>Non-Teaching</option>
                    </select>
                </div>

                <div class="col-md-1 mt-4">
                    <button type="submit" class="btn btn-dark">Filter</button>
                </div>

                @if(session()->has('looping_filter'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="{{ url('/sub-admin/looping/clear-filter') }}" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
        <table id="loopingTable" class="table table-bordered same-height-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Date</th>
                    <th>Time Out</th>
                    <th>Time In</th>
                    <th>Remarks</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($loopingRecords as $item)
                <tr class="text-center">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->department }}</td>
                    <td>{{\Carbon\Carbon::parse($item->date)->format('F d, Y') }}</td>
                    <td>{{\Carbon\Carbon::parse($item->time_out)->format('h:i') }}</td>
                    <td>{{ $item->time_in ? \Carbon\Carbon::parse($item->time_in)->format('h:i') : ' ' }}</td>

                    <td>{{ $item->remarks }}</td>

                    <td>
                        <div class="d-flex justify-content-center align-items-center">

                            <div class="mx-1">
                                <a href="javascript:void(0)" class="btn btn-sm text-white" style="background-color: #063292" data-id="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#updateLooping-{{ $item->id }}"><i class="bi bi-pencil-square"></i></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('sub-admin.looping.update_looping')

@include('sub-admin.looping.add_looping')

@include('sub-admin.looping.looping_js')



<!-- Modal Structure -->
<div class="modal fade" id="pdfModalLooping" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Preview Looping</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="loadingBarLoop" style="display:none; text-align: center;">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>

                    </div>
                </div>

                <!-- PDF display iframe -->
                <iframe id="pdfIframeLoop" src="" style="width: 100%; height: 500px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>


<script>

function showPdfModalLooping() {
    const employeeType = $('#employee_type').val();

    if (!employeeType) {
        Swal.fire({
            icon: 'warning',
            title: 'Required Filters',
            text: 'Please select Employee Type before generating the Looping Report.',
            confirmButtonColor: '#0B9B19'
        });
        return;
    }

    document.getElementById('loadingBarLoop').style.display = 'block';
    document.getElementById('pdfIframeLoop').style.display = 'none';

    const url = '/sub-admin/generate-pdf/looping?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        employee_type: employeeType,
    });

    const iframe = document.getElementById('pdfIframeLoop');

        // Add load event listener to iframe
        iframe.onload = function() {
            document.getElementById('loadingBarLoop').style.display = 'none';
            iframe.style.display = 'block';
        };

        // Set iframe src to trigger loading
        iframe.src = url;

        $('#pdfModalLooping').modal({
            backdrop: 'static',
            keyboard: false,
            show: false,
            scrollY: false,
            scrollX: true,
        });

    $('#pdfModalLooping').modal('show');


}
</script>
@endsection
