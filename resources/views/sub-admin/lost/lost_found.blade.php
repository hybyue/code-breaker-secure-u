@extends('layouts.sidebar')

@section('title', 'Lost and Found')

@section('content')
<div class="container mt-3 pass-slip">
    <div class="row">
        <div class="col-md-6">
            <h4>Lost and Found</h4>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn text-white" style="background-color: #0B9B19;" data-bs-toggle="modal" data-bs-target="#addNewLostModal"><i class="bi bi-plus-circle-fill text-center"></i> Add New</button>

            <a href="javascript:void(0)" class="btn text-white" style="background-color: #0B9B19;" onclick="showPdfModalLost()">Generate Report</a>

            {{-- <a href="{{ route('pdf.generate-losts', request()->query()) }}" class="btn text-white" style="background-color: #0B9B19;" download="report-losts.pdf"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</a> --}}
        </div>
    </div>

    <div class="container mt-4">
        <form action="/sub-admin/lost_found" method="GET">
            <div class="row pb-3">
                <div class="col-md-3">
                    <label for="start_date"> Start Date: </label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}" required>
                </div>
                <div class="col-md-3">
                    <label for="end_date"> End Date: </label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}" required>
                </div>
                <div class="col-md-1 mt-4 pt-2">
                    <button type="submit"class="btn btn-dark">Filter</button>
                </div>
                @if(request('start_date') || request('end_date'))
                <div class="col-md-0 mt-4 pt-2">
                    <a href="/sub-admin/lost_found" class="btn btn-secondary">Clear Filter</a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="container p-3 mt-4 bg-body-secondary rounded" style="overflow-x:auto;">
        <table id="lostTable" class="table table-bordered same-height-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type of Object</th>
                    <th>Finder's Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($lost_found as $item)
                <tr class="text-center">
                    <td>{{\Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</td>
                    <td>{{ $item->object_type }}</td>
                    <td>{{ $item->last_name }}, {{ $item->first_name }}
                        @if($item->middle_name) {{ $item->middle_name }}. @endif </td>
                    <td>{{ $item->course }}</td>
                    <td>
                        @if($item->is_claimed == 0)
                            <button class="btn btn-sm btn-warning" onclick="markAsClaimed({{ $item->id }})">Mark as Claimed</button>
                        @else
                            <p class="text-success">Claimed</p>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="mx-1">
                            <a href="#" class="btn btn-sm text-white" style="background-color: #1e1f1e" data-bs-toggle="modal" data-bs-target="#viewLostFound-{{ $item->id }}"><i class="bi bi-eye"></i></a>
                            </div>
                            <div class="mx-1">
                                <a href="#" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateLostFound-{{ $item->id }}"><i class="bi bi-pencil-square"></i></a>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No Data available in table</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<div id="viewModalLostFound"></div>
@foreach($lost_found as $item)
<!-- View Modal -->
<div class="modal fade" id="viewLostFound-{{ $item->id }}" tabindex="-1" aria-labelledby="viewLostFoundLabel-{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLostFoundLabel-{{ $item->id }}">View Lost Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Object Type:</strong> {{ $item->object_type }}</p>
                <p><strong>Finder's Name:</strong> {{ $item->last_name }}, {{ $item->first_name }}
                    @if($item->middle_name) {{ $item->middle_name }}. @endif
                </p>
                <p><strong>Role:</strong> {{ $item->course }}</p>

                <!-- Display Image in Modal -->
                <div class="d-flew justify-content-center align-items-center mb-3">
                    @if($item->object_img)
                        <img src="{{ asset($item->object_img) }}" alt="Object Image" class="img-fluid" style="max-width: 100%;">
                    @else
                        <span class="text-muted">No Image Available</span>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach


@include('sub-admin.lost.add_lost')
@include('sub-admin.lost.update_lost')
@include('sub-admin.lost.lost_js')


<script>
    function markAsClaimed(id) {
    $.ajax({
        url: `/sub-admin/update_claimed/${id}`, // Make sure this route exists
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            is_claimed: 1
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'The item has been marked as claimed!',
                confirmButtonColor: '#0B9B19'
            }).then(() => {
            });
        },
        error: function(xhr) {
            console.error(xhr);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was a problem updating the claim status. Please try again.',
                confirmButtonColor: '#920606'
            });
        }
    });
}


document.addEventListener('DOMContentLoaded', function () {
    const startDateLost = document.getElementById('start_date');
    const endDateLost = document.getElementById('end_date');

    startDateLost.addEventListener('change', function () {
        endDateLost.min = this.value;
        if (!endDateLost.value) {
            endDateLost.value = this.value;
        }
    });

    endDateLost.addEventListener('change', function () {
        startDateLost.max = this.value;
    });

    if (startDateLost.value && !endDateLost.value) {
        endDateLost.value = startDateLost.value;
    }
    if (endDateLost.value && !startDateLost.value) {
        startDateLost.value = endDateLost.value;
    }
});

</script>

<style>
    .same-height-table td {
        vertical-align: middle;
    }
</style>

<script>
    function showPdfModalLost() {
        document.getElementById('loadingBar').style.display = 'block';
    document.getElementById('pdfLostFrame').style.display = 'none';

    const url = '/generate-pdf/lost_found?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val()
    });

    document.getElementById('pdfLostFrame').src = url;

    $('#pdfModalLost').modal({
        backdrop:'static',
        keyboard: false,
        focus: false,
        show: false,
        scrollY: false,
        scrollX: true,
        width: '100%',
        height: 'auto',
        aspectRatio: 1.5,
        responsive: true,
        // Enable zooming
        zoom: {
            enabled: true,
            scroll: true, // Enable scroll zooming
            wheel: false, // Disable wheel zooming
            pinch: false // Disable pinch zooming
        }
    });

    $('#pdfModalLost').modal('show');

    setTimeout(function() {
        document.getElementById('loadingBar').style.display = 'none';
        document.getElementById('pdfLostFrame').style.display = 'block';
    }, 2000);
    }

    </script>

<script>
    function previewImage(event, id) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('newImagePreview-' + id);
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection
