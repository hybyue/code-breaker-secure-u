<script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        new DataTable('#visitorTableSubAdmin', {
            responsive: true,
            "ordering": false,
            language: { lengthMenu: '_MENU_ entries' },
            columnDefs: [ { targets: "_all", defaultContent: "" } ]

        });

        $('#addVisitorModal').on('hidden.bs.modal', function () {
            $('body').css('overflow', 'auto');
        });


        // Visitor form submission
        $('#visitorForm').on('submit', function (e) {
            e.preventDefault();
            $('.errorMessage').html('');

            let submitButton = $('.add_visitor');
            submitButton.prop('disabled', true);
            $('#loadingSpinner').show();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('sub-admin.store') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (resp) {
                    if (resp.status == 'success') {

                        $('#addVisitorModal').modal('hide');
                        $('.modal-backdrop').remove();

                        $('#visitorForm')[0].reset();
                        removeDynamicFields();
                        $('.text-danger').html('');
                        $('#viewDynamicModal').load(location.href + ' #viewDynamicModal'),
                        $('#timeOut_visitor').load(location.href + ' #timeOut_visitor'),
                        $('#visitorTableSubAdmin').load(location.href + ' #visitorTableSubAdmin');
                        $('#updateDynamicModal').load(location.href + ' #updateDynamicModal');

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
                        Object.keys(errors).forEach(function(field) {
                            let errorMessage = errors[field][0];
                            $(`#${field}_error`).text(errorMessage);
                        });
                    }
                },
                complete: function () {
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

        $(document).on('submit', '.visitorFormSub', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);
            let submitButton = form.find('.visitor_update');
            let modalId = form.attr('id').split('-')[1];

            $('.error-message').remove();


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
                    $('#updateVisitorSub-' + modalId).modal('hide');
                    $('.modal-backdrop').remove();

                    $('.error-message').remove();

                    $('#viewDynamicModal').load(location.href + ' #viewDynamicModal'),
                    $('#timeOut_visitor').load(location.href + ' #timeOut_visitor'),
                    $('#visitorTableSubAdmin').load(location.href + ' #visitorTableSubAdmin');
                    $('#updateDynamicModal').load(location.href + ' #updateDynamicModal');

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
                            title: 'Visitor updated successfully',
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
        });


    });

</script>
