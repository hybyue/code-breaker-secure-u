
    {{-- Edit Visitor --}}
    <div id="updateDynamicModal">
    @foreach ($latestVisitors as $visitor)
    <div class="modal fade" id="updateVisitorSub-{{ $visitor->id }}" tabindex="-1" aria-labelledby="updateVisitorSubLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVisitorSubLabel">Update Visitor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update.visitorSub', $visitor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="last_name_{{ $visitor->id }}">Last Name:</label>
                                <input type="text" class="form-control" id="last_name_{{ $visitor->id }}" name="last_name" value="{{ $visitor->last_name }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="first_name_{{ $visitor->id }}">First Name:</label>
                                <input type="text" class="form-control" id="first_name_{{ $visitor->id }}" name="first_name" value="{{ $visitor->first_name }}" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="middle_name_{{ $visitor->id }}">Middle Initial:</label>
                                <input type="text" class="form-control" id="middle_name_{{ $visitor->id }}" name="middle_name" value="{{ $visitor->middle_name }}">
                            </div>
                            <div class="form-group">
                                <label for="person_to_visit_{{ $visitor->id }}">Person to Visit & Company:</label>
                                <input type="text" class="form-control" id="person_to_visit_{{ $visitor->id }}" name="person_to_visit" value="{{ $visitor->person_to_visit }}" required>
                            </div>
                            <div class="form-group">
                                <label for="purpose_{{ $visitor->id }}">Purpose:</label>
                                <textarea class="form-control" id="purpose_{{ $visitor->id }}" name="purpose" required>{{ $visitor->purpose }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="entry_count_{{ $visitor->id }}">Entry Count:</label>
                                <input type="number" class="form-control" id="entry_count_{{ $visitor->id }}" name="entry_count" value="{{ $visitor->entry_count }}" required>
                            </div>
                            <div class="form-group">
                                <label for="id_type">ID Type:</label>
                                <select class="form-select" id="id_type" name="id_type" required>
                                    <option value="{{$visitor->id_type}}" selected disabled>{{$visitor->id_type}}</option>
                                    <option value="Student ID">Student ID</option>
                                    <option value="Driver License ID">Driver License ID</option>
                                    <option value="National ID">National ID</option>
                                    <option value="Employee ID">Employee ID</option>
                                    <option value="PassPort">PassPort</option>
                                    <option value="Other">Other</option>
                                </select>
                              </div>
                        </div>
                        <input type="hidden" name="time_in" id="time_in_{{ $visitor->id }}" value="{{ $visitor->time_in }}">
                        <input type="hidden" name="time_out" id="time_out_{{ $visitor->id }}" value="{{ $visitor->time_out }}">

                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-primary text-white" data-bs-dismiss="updateVisitorSub-{{ $visitor->id }}">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    </div>