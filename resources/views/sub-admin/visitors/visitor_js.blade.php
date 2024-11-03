<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        new DataTable('#visitorTable', {
            responsive: true,
            "ordering": false,
            language: { lengthMenu: '_MENU_ entries' },
            columnDefs: [ { targets: "_all", defaultContent: "" } ]

        });
        // Submit form and prevent multiple submissions
        $('#visitorForm').on('submit', function (e) {
            e.preventDefault();
            $('.errorMessage').html('');

            // Show loading spinner and disable submit button
            let submitButton = $('.add_visitor');
            submitButton.prop('disabled', true);
            $('#loadingSpinner').show();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('sub-admin.store') }}",
                method: 'POST',
                data: formData,
                success: function (resp) {
                    if (resp.status == 'success') {
                        // Reset form and reload sections
                        $('#visitorForm')[0].reset();
                        removeDynamicFields();
                        $('#visitorTable').load(location.href + ' #visitorTable');
                        $('#viewDynamicModal').load(location.href + ' #viewDynamicModal');
                        $('#updateDynamicModal').load(location.href + ' #updateDynamicModal');

                        // Clear validation errors
                        $('.text-danger').html('');

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: 'white',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Visitor added successfully',
                        });
                    }
                },
                error: function (err) {
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
                complete: function () {
                    // Hide loading spinner and enable submit button
                    $('#loadingSpinner').hide();
                    submitButton.prop('disabled', false);
                }
            });
        });

        // Function to remove dynamically added fields
        function removeDynamicFields() {
            $('#personToVisitOtherInput').remove();
            $('#idTypeOtherInput').remove();
        }

        $('#visitorFormSub').on('submit', function(e) {
        e.preventDefault();

        $('.error-message').text('');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#updateVisitorSub').modal('hide');
                        localStorage.setItem('showToast', 'true');
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.error-message').remove();

                        $.each(errors, function(field, messages) {
                            let input = $('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                        });
                    }
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
            title: 'Visitor updated successfully',
        });

        localStorage.removeItem('showToast');
    }
});
</script>
