<script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>

<script>

    $(document).ready(function() {

        // DataTable initialization
        new DataTable('#loopingTable', {
            responsive: true,
            ordering: false,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            language: {
                lengthMenu: "_MENU_ entries",
                search: "Search:",
            },
            columnDefs: [
                { targets: "_all", defaultContent: "" }
            ]
        });

        // Add Looping Form Submit
        $('#addLoopingForm').on('submit', function(e) {
            e.preventDefault();
            $('.error-message').empty();

            let submitButton = $('.add_looping');
            submitButton.prop('disabled', true);
            $('#loadingSpinner').show();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('store.looping') }}",
                method: 'POST',
                data: formData,
                success: function(resp) {
                    if (resp.status == 'success') {
                        $('#addLoopingForm')[0].reset();
                        $('.error-message').empty();
                        $('#loopingTable').load(location.href + ' #loopingTable');
                        $('#latestLoopings').load(location.href + ' #latestLoopings');
                        $('#latestUpdateLooping').load(location.href + ' #latestUpdateLooping');

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
                            title: 'Looping record added successfully',
                        });
                    }
                },
                error: function(err) {
                    $('.error-message').html('');

                    if (err.responseJSON && err.responseJSON.errors) {
                        let errors = err.responseJSON.errors;
                        Object.keys(errors).forEach(function(field) {
                            let errorMessage = errors[field][0];
                            $(`#${field}_error`).text(errorMessage);
                        });
                    }
                },
                complete: function() {
                    $('#loadingSpinner').hide();
                    submitButton.prop('disabled', false);
                }
            });
        });

        // Update Looping Form Submit
        $(document).on('submit','.updateLoopingForm', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);
            let submitButton = form.find('.update_looping');
            let modalId = form.attr('id').split('-')[1];

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
                        $('#updateLooping-' + modalId).modal('hide');
                        $('.modal-backdrop').remove();
                        $('.error-message').remove();

                        $('#loopingTable').load(location.href + ' #loopingTable');
                        $('#latestLoopings').load(location.href + ' #latestLoopings');

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
                            title: 'Looping record updated successfully',
                        });
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
            $('body').css('overflow', 'auto');

        });

    });

</script>

<script>
    function searchEmployee() {
    let searchValue = $('#search_employee').val();

    if (searchValue.length >= 2) {
        $('#searchSpinner').show();
        $('#clear_search').show();

        let formData = new FormData();
        formData.append('search', searchValue);

        $.ajax({
            url: "{{ route('subadmin.search_looping') }}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#searchSpinner').hide();

                if (data.success && data.employees.length > 0) {
                    let resultsContainer = $('#employee_results');
                    resultsContainer.empty(); // Clear previous results

                    // Display the employee suggestions
                    data.employees.forEach(function(employee) {
                        let resultItem = $('<div></div>').addClass('result-item').html(`
                            <div class="w-100 bg-primary">
                                <a href="#" class="btn w-100 btn-primary text-start">
                                    ${employee.employee_id}, ${employee.first_name} ${employee.last_name} - ${employee.designation} - ${employee.department}
                                </a>
                            </div>
                        `);

                        resultItem.on('click', function() {
                            console.log('Employee Data:', employee);

                            // Get all form fields in #addLoopingForm
                            const nameField = document.querySelector('#addLoopingForm #name');
                            const departmentField = document.querySelector('#addLoopingForm #department');
                            const employeeTypeField = document.querySelector('#addLoopingForm #status');

                            // Log if fields are found
                            console.log('Found fields:', {
                                name: !!nameField,
                                department: !!departmentField,
                                status: !!employeeTypeField,
                            });

                            // Set values if fields exist
                            if (nameField) {
                                let fullName = `${employee.last_name}`;
                                if (employee.middle_name) {
                                    fullName += ` ${employee.middle_name}`;
                                }
                                fullName += ` ${employee.first_name}`;
                                nameField.value = fullName;
                            }
                            if (departmentField) departmentField.value = employee.department || '';
                            if (employeeTypeField) employeeTypeField.value = employee.status || '';

                            // Clear the results after selection
                            resultsContainer.empty();
                        });

                        resultsContainer.append(resultItem);
                    });
                } else {
                    clearEmployeeFields();
                    $('#employee_results').html('<div class="no-results">No matching employees found</div>');
                }
            },
            error: function(error) {
                $('#searchSpinner').hide(); // Hide loading spinner
                console.error('Error:', error);
            }
        });
    } else {
        $('#searchSpinner').hide(); // Hide spinner if input is less than 2 characters
        $('#employee_results').empty(); // Clear results
}

    }
function clearSearch() {
        // Clear only the search input
        $('#search_employee').val('');

        // Clear only the results container
        $('#employee_results').empty();
    }

function clearEmployeeFields() {
    let fields = ['name', 'department', 'status'];

    fields.forEach(field => {
        let element = document.getElementById(field);
        if (element) {
            element.value = '';
        }
    });
}

</script>

