<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        $('#addPassSlipModal').on('show.bs.modal', function() {
    // Fetch the next pass number from the server when the modal opens
    $.ajax({
        url: "{{ route('pass_slip.next_number_sub') }}", // Your new route for generating the next pass number
        method: 'GET',
        success: function(resp) {
            // Update the pass number field with the next available pass number
            $('#p_no').val(resp.passNumber);
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to generate the next pass number',
            });
        }
    });
});

        let table = new DataTable('#passTable', {
            responsive: true,
            "ordering": false,
        });

        $('#addPassForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('pass_slips.store') }}",
                method: 'POST',
                data: formData,
                success: function(resp) {
                    if (resp.status == 'success') {
                        $.ajax({
                            url: "{{ route('pass_slip.next_number_sub') }}", // Your new route for generating the next pass number
                            method: 'GET',
                            success: function(resp) {
                                // Update the pass number field with the next available pass number
                                $('#p_no').val(resp.passNumber);
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Failed to generate the next pass number',
                                });
                            }
                        });
                        $('#addPassForm')[0].reset();
                        $('#passTable').load(location.href + ' #passTable');
                        $('#latestPassSlips').load(location.href + ' #latestPassSlips');
                        $('#latestUpdatePassSlip').load(location.href + ' #latestUpdatePassSlip');
                        Swal.fire({
                            toast: true,
                            position: 'top-right',
                            iconColor: 'white',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            icon: 'success',
                            title: 'Pass Slip added successfully',
                        });
                    }
                },
                error: function(err) {
                    $('.errorMessage').html('');
                    let errors = err.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        $('.errorMessage').append('<span class="text-danger">' +
                            value + '</span>' + '<br>');
                    });
                }
            });
        });

    });

    function searchEmployee() {
        let searchValue = $('#search_employee').val();

        if (searchValue.length >= 2) {
            let formData = new FormData();
            formData.append('search', searchValue);

            $.ajax({
                url: "{{ route('subadmin.search_employee') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success && data.employees.length > 0) {
                        let resultsContainer = $('#employee_results');
                        resultsContainer.empty(); // Clear previous results

                        // Display the employee suggestions
                        data.employees.forEach(function(employee) {
                            let resultItem = $('<div></div>').addClass('result-item').html(`
                                <a href="#" class="btn btn-primary">${employee.employee_id}, ${employee.first_name} ${employee.last_name} -${employee.designation} -${employee.department}</a>
                            `);

                            resultItem.on('click', function() {
                                // Autofill the form fields when the user clicks an item
                                $('#employee_id').val(employee.employee_id || '');
                                $('#last_name').val(employee.last_name);
                                $('#first_name').val(employee.first_name);
                                $('#middle_name').val(employee.middle_name || '');
                                $('#department').val(employee.department);
                                $('#designation').val(employee.designation);
                                $('#status').val(employee.status);

                                // Clear the results after selection
                                resultsContainer.empty();
                            });

                            resultsContainer.append(resultItem);
                        });
                    } else {
                        clearEmployeeFields();
                        $('#employee_results').html(
                            '<div class="no-results">No matching employees found</div>');
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        } else {
            clearEmployeeFields();
            $('#employee_results').empty();
        }
    }

    function clearEmployeeFields() {
        let fields = ['last_name', 'first_name', 'middle_name', 'department', 'designation', 'status'];

        fields.forEach(field => {
            let element = document.getElementById(field);
            if (element) {
                element.value = '';
            }
        });
    }

</script>
