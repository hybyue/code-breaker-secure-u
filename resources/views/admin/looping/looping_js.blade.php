<script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>

<script>

function searchEmployee() {
        let searchValue = $('#search_employee').val();

        if (searchValue.length >= 2) {
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

                                $('#name').val(`${employee.last_name} ${employee.first_name}`);
                                $('#department').val(employee.department);

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

    $(document).ready(function() {

        // DataTable initialization
        new DataTable('#loopingTableAdmin', {
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
        $('#addLoopingFormAdmin').on('submit', function(e) {
            e.preventDefault();
            $('.error-message').empty();

            let submitButton = $('.add_looping');
            submitButton.prop('disabled', true);
            $('#loadingSpinner').show();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('store.looping_admin') }}",
                method: 'POST',
                data: formData,
                success: function(resp) {
                    if (resp.status == 'success') {
                        $('#addLoopingFormAdmin')[0].reset();
                        $('.error-message').empty();
                        $('#loopingTableAdmin').load(location.href + ' #loopingTableAdmin');
                        $('#latestLoopingRecords').load(location.href + ' #latestLoopingRecords');
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
        $('.updateLoopingFormAdmin').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);
            let submitButton = form.find('.update_looping');
            let modalId = form.attr('id').split('-')[1];
            let modal = $('#updateLoopingAdmin-' + modalId);

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

        // Toast notification for updates
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
                title: 'Looping record updated successfully',
            });

            localStorage.removeItem('showToast');
        }
    });

</script>
