<script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>


 $(document).ready(function () {


            $('.error-message').addClass('text-danger');

    $('#addPassSlipModal').on('show.bs.modal', function() {
    // Fetch the next pass number from the server when the modal opens
    $.ajax({
        url: "{{ route('pass_slip.next_number') }}", // Your new route for generating the next pass number
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
        "ordering": false,
        language: {
                lengthMenu: "_MENU_ entries",
            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
            ]
        });

    $('#addPassForm').on('submit', function(e){
        e.preventDefault();

        // Clear all previous error messages
        $('.error-message').empty();

        // Show loading spinner and disable submit button
        let submitButton = $('.add_pass_slip');
        submitButton.prop('disabled', true);
        $('#loadingSpinner').show();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('pass_slip.store') }}",
            method: 'POST',
            data: formData,
            success: function(resp) {
                if(resp.status == 'success') {
                    $.ajax({
                        url: "{{ route('pass_slip.next_number') }}",
                        method: 'GET',
                        success: function(resp) {
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

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast',
                        },
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Pass Slip added successfully'
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
                }else if (err.responseJSON && err.responseJSON.message) {
                        // Handle specific custom errors from the server
                        let errorMessage = err.responseJSON.message;

                        if (errorMessage.includes('pending')) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pending Pass Slip',
                                text: 'The employee still outside the campus.',
                            });
                        } else if (errorMessage.includes('maximum number of pass slips')) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Maximum Reached',
                                text: 'The employee already has reach the maximum number of pass slips for today.',
                            });
                        } else {
                            // General error fallback
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: errorMessage,
                            });
                        }
                    } else {
                        // Fallback for unexpected errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Unexpected Error',
                            text: 'An unknown error occurred. Please try again.',
                        });
                    }
            },
            complete: function() {
                $('#loadingSpinner').hide();
                submitButton.prop('disabled', false);
            }
        });
    });

    $(document).on('submit','.updatePassSlipFormAd', function(e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    let submitButton = form.find('.update_pass');
    let modalId = form.attr('id').split('-')[1];

    submitButton.prop('disabled', true);
    form.find('#loadingSpinnerer').show();

    $('.error-message').remove();

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                $('#updatePassSlipAd-' + modalId).modal('hide');
                $('.modal-backdrop').remove();
                $('.error-message').remove();


                $('#passTable').load(location.href + ' #passTable');
                $('#latestPassSlips').load(location.href + ' #latestPassSlips');

                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-right',
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast',
                        },
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Pass Slip updated successfully'
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

<script type="text/javascript">

	function deletePassSlip(id)
	{
      if(confirm("Are you sure to delete pass slip data"))
		{
			$.ajax({

				url:'/pass_slip/archive/'+id,
				type:'DELETE',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

				success:function(result)
				{
                    $("#"+result['tr']).slideUp("slow");
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-right',
                    iconColor: 'white',
                    customClass: {
                    popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    })

                    Toast.fire({
                        icon:'success',
                        title: 'Pass Slip Deleted Successfully',
                    });
				}
			});
		}

	}


</script>



<script>
    function clearEmployeeFields() {
    let fields = [ 'last_name', 'first_name', 'middle_name', 'department', 'designation', 'status'];

    fields.forEach(field => {
        let element = document.getElementById(field);
        if (element) {
            element.value = '';
        }
    });
}


function searchEmployee() {
    let searchValue = document.getElementById('search_employee').value;

    if (searchValue.length >= 2) {

        $('#searchSpinner').show();
        $('#clear_search').show();

        let formData = new FormData();
        formData.append('search', searchValue);

        $.ajax({
                url: "{{ route('search_employee') }}",
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
                    $('#searchSpinner').hide();
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
        let fields = ['last_name', 'first_name', 'middle_name', 'department', 'designation', 'status'];

        fields.forEach(field => {
            let element = document.getElementById(field);
            if (element) {
                element.value = '';
            }
        });
    }

    </script>
