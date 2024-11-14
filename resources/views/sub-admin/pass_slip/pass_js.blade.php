<script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>

<script>
    $(document).ready(function() {

        $('.error-message').addClass('text-danger');
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

         new DataTable('#passTable', {
            responsive: true,
            ordering: false,

            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]], // Add length menu options
            language: {
                lengthMenu: "_MENU_ entries",
                search: "Search:",

            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
    ]
        });

        $('#addPassForm').on('submit', function(e) {
            e.preventDefault();

            $('.error-message').empty();

            // Show loading spinner and disable submit button
            let submitButton = $('.add_pass_slip');
            submitButton.prop('disabled', true);
            $('#loadingSpinner').show();
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
                        $('.error-message').empty();
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
                // Clear all error messages first
                $('.error-message').html('');

                if (err.responseJSON && err.responseJSON.errors) {
                    let errors = err.responseJSON.errors;

                    // Loop through each error and display it
                    Object.keys(errors).forEach(function(field) {
                        let errorMessage = errors[field][0]; // Get first error message
                        $(`#${field}_error`).text(errorMessage); // Set the error message text
                    });
                }
            },
            complete: function() {
                // Hide loading spinner and enable submit button
                $('#loadingSpinner').hide();
                submitButton.prop('disabled', false);
            }
            });
        });


        $('.updatePassSlipFormSub').on('submit', function(e) {
        e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    let submitButton = form.find('.update_pass');
    let modalId = form.attr('id').split('-')[1];
    let modal = $('#updatePassSlip-' + modalId);

    submitButton.prop('disabled', true);
    form.find('#loadingSpinnerer').show();

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                modal.modal('hide');
                localStorage.setItem('showToast', 'true');
                setTimeout(() => {
                    location.reload();
                }, 500);
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                form.find('.error-message').remove();

                $.each(errors, function(field, messages) {
                    let input = form.find('[name="' + field + '"]');
                    input.addClass('is-invalid');
                    input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                });
            }
        },
        complete: function() {
            form.find('#loadingSpinnerer').hide();
            submitButton.prop('disabled', false);
        }
    });
});

        $('.modal').on('hidden.bs.modal', function() {
            $('.is-invalid').removeClass('is-invalid');
            $('.error-message').text('');
        });
});

$(document).ready(function() {
    if (localStorage.getItem('showToast') === 'true') {
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
            title: 'Pass Slip updated successfully',
        });

        localStorage.removeItem('showToast');
    }
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
                                <div class="w-100 bg-primary">
                                    <a href="#" class="btn w-100 btn-primary text-start">${employee.employee_id}, ${employee.first_name} ${employee.last_name} -${employee.designation} -${employee.department}</a>
                                </div>
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
