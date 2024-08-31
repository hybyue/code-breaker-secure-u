{{-- Edit event Information --}}
@foreach ($events as $event)
<div class="modal fade updateEvent" id="updateEvent-{{$event->id}}" tabindex="-1" aria-labelledby="updateEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="updateEventForm" action="" method="POST">
                @csrf
                <input type="hidden" id="up_id" value="{{$event->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEventModalLabel">Edit Event:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="eventTitle" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="up_title" name="up_title" value="{{$event->title}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDescription" class="form-label">Description:</label>
                        <textarea class="form-control" id="up_description" name="up_description" rows="3" required>{{$event->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date Start:</label>
                        <input type="date" class="form-control" id="up_date_start" name="up_date_start" value="{{ \Carbon\Carbon::parse($event->date_start)->format('Y-m-d') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Date End:</label>
                        <input type="date" class="form-control" id="up_date_end" name="up_date_end" value="{{ \Carbon\Carbon::parse($event->date_end)->format('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary update_event">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach
