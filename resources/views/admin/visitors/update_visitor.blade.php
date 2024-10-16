

{{-- Batch Edit Visitor Information --}}
<div id="updateDynamicModals">
@foreach ($latestVisitors as $visit)
    <div class="modal fade" id="updateVisitor-{{ $visit->id }}" tabindex="-1"
        aria-labelledby="updateVisitorModalLabel-{{ $visit->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVisitorModalLabel-{{ $visit->id }}">Edit Visitor Entries</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('visitor.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Initial</th>
                                    <th>Last Name</th>
                                    <th>Person to Visit & Company</th>
                                    <th>Purpose</th>
                                    <th>ID Type</th>
                                    <th>Entry Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allVisitors->where('last_name', $visit->last_name)->where('first_name', $visit->first_name)->where('middle_name', $visit->middle_name)->where('date', $visit->date) as $entry)
                                    <tr>
                                        <input type="hidden" name="entries[{{ $entry->id }}][id]"
                                            value="{{ $entry->id }}">
                                        <td>
                                            <input type="text" class="form-control"
                                                name="entries[{{ $entry->id }}][first_name]"
                                                value="{{ $entry->first_name }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="entries[{{ $entry->id }}][middle_name]"
                                                value="{{ $entry->middle_name }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="entries[{{ $entry->id }}][last_name]"
                                                value="{{ $entry->last_name }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="entries[{{ $entry->id }}][person_to_visit]"
                                                value="{{ $entry->person_to_visit }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="entries[{{ $entry->id }}][purpose]"
                                                value="{{ $entry->purpose }}">
                                        </td>
                                        <td>
                                            <select class="form-select" name="entries[{{ $entry->id }}][id_type]"
                                                required>
                                                <option value="{{ $entry->id_type }}" selected>{{ $entry->id_type }}
                                                </option>
                                                <option value="Student ID">Student ID</option>
                                                <option value="Driver License ID">Driver License ID</option>
                                                <option value="National ID">National ID</option>
                                                <option value="Employee ID">Employee ID</option>
                                                <option value="PassPort">PassPort</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" name="entry_count" value="{{ $entry->entry_count }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>