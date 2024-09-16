
<!-- Add New Event Modal -->
<div class="modal fade" id="addNewEventModal" tabindex="-1" aria-labelledby="addNewEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewEventModalLabel">Add New Announcement</h5>
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
