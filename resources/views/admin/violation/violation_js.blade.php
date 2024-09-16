<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
        const dataTable = $("#violationTable").DataTable();

        $('#violationFormAdmin').on('submit', function(e){
            e.preventDefault();

            $('.errorMessage').html('');
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.store_violation') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.status == 'success') {
                        $('#violationFormAdmin')[0].reset();

                        $('#violationTable').load(location.href + ' #violationTable', function() {

                            $('.modal').modal({
                                backdrop: 'static',
                                keyboard: true
                            });

                            $('.viewModal').on('click', function() {
                                let id = $(this).data('id');  // Get the violation ID from the data attribute
                                let targetModal = $(this).data('bs-target');  // Get the target modal ID

                                $(targetModal).find('.modal-body').html('Violation ID: ' + id);

                                // Check if modal instance exists and dispose of it
                                let modalInstance = bootstrap.Modal.getInstance(document.querySelector(targetModal));
                                if (modalInstance) {
                                    modalInstance.dispose();
                                }


                                $(targetModal).modal('show');
                                console.log("View violation with ID: " + id);
                            });

                            $('.editModal').on('click', function() {
                                let id = $(this).data('id');
                                let targetModal = $(this).data('bs-target');

                                $(targetModal).find('.modal-body').html('Edit Violation ID: ' + id);

                                // Check if modal instance exists and dispose of it
                                let modalInstance = bootstrap.Modal.getInstance(document.querySelector(targetModal));
                                if (modalInstance) {
                                    modalInstance.dispose();
                                }
                                $(targetModal).modal('show');

                                console.log("Edit violation with ID: " + id);  // This log shows the violation ID
                            });


                        });

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
                            title: 'Violation added successfully',
                        });
                    }
                },
                error: function(err) {
                    $('.errorMessage').html('');
                    let errors = err.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                }
            });
        });

    });
</script>




<script type="text/javascript">

	function deleteViolation(id)
	{
      if(confirm("Are you sure to delete violation data"))
		{
			$.ajax({

				url:'/violation/archive/'+id,
				type:'DELETE',

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
                        title: 'Violation Deleted Successfully',
                    });
				}
			});
		}

	}


</script>
