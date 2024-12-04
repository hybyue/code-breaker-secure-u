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
    new DataTable('#visitorTable', {
        responsive: true,
        "ordering": false,
        language: {
                lengthMenu: "_MENU_ entries",
            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
            ],
        });

        $('#addVisitorForm').on('submit', function(e){
        e.preventDefault();

        $('.error-message').empty();
        // Show loading spinner and disable submit button
        const submitButton = $(this).find('button[type="submit"]');
        const loadingSpinner = $('#loadingSpinner');

        submitButton.prop('disabled', true);
        loadingSpinner.show();


        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('visitor.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success:function(resp){
                if(resp.status == 'success'){
                    $('#addVisitorForm')[0].reset();
                    $('#visitorTable').load(location.href + ' #visitorTable');
                    $('#dynamicModals').load(location.href + ' #dynamicModals');
                    $('#updateDynamicModals').load(location.href + ' #updateDynamicModals');
                    $('#timeOut_visitor').load(location.href + ' #timeOut_visitor');

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
                else {
                    console.log("Failed to create");
                }
            },
            error: function(err){
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
                // Hide loading spinner and enable submit button
                loadingSpinner.hide();
                submitButton.prop('disabled', false);
            }

        });
    });


    $(document).on('submit', '.updateVisitorForm', function(e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    let submitButton = form.find('.update_visitor');
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
                $('#updateVisitor-' + modalId).modal('hide');
                $('.modal-backdrop').remove();


                $('#visitorTable').load(location.href + ' #visitorTable');
                $('#dynamicModals').load(location.href + ' #dynamicModals');
                $('#updateDynamicModals').load(location.href + ' #updateDynamicModals');
                $('#timeOut_visitor').load(location.href + ' #timeOut_visitor');

                $('.error-message').remove();
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
                        title: 'Visitor updated successfully'
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

<script type="text/javascript">

	function deleteVisitor(id)
	{
      if(confirm("Are you sure to delete visitor's data"))
		{
			$.ajax({

				url:'/admin/delete_visitor/'+id,
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
                        title: 'Visitor Deleted Successfully',
                    });
				}
			});
		}

	}


</script>
