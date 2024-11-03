<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" integrity="sha384-4M7GcTbZBdHj1XOpjLci8tUZzJOTiFS7pkXeGguH4d9hZhg7Z7IHu/hgRo6eo35c" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        $('.errorMessage').html('');

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('visitor.store') }}",
            method: 'POST',
            data: formData,
            success:function(resp){
                if(resp.status == 'success'){
                    $('#addVisitorForm')[0].reset();
                    $('#visitorTable').load(location.href + ' #visitorTable');
                    $('#dynamicModals').load(location.href + ' #dynamicModals');
                    $('#updateDynamicModals').load(location.href + ' #updateDynamicModals');
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


    $('#updateVisitorForm').on('submit', function(e) {
    e.preventDefault();

    $('.error-message').text('');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
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
