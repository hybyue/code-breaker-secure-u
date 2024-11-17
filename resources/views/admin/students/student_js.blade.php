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
        new DataTable('#studentTable', {
        responsive: true,
        "ordering": false,
        language: {
                lengthMenu: "_MENU_ entries",
            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
            ]
        });

        $('#studentFormAdmin').on('submit', function(e){
            e.preventDefault();

            $('.errorMessage').html('');
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('store_admin.student') }}",
                method: 'POST',
                data: formData,
                success: function(resp) {
                    if(resp.status == 'success') {
                        $('#studentFormAdmin')[0].reset();

                        $('#studentTable').load(location.href + ' #studentTable');
                        $('#updatesStudentAdmin').load(location.href + ' #updatesStudentAdmin');


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
                            title: 'Student added successfully',
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

	function deleteStudent(id)
	{
      if(confirm("Are you sure to delete student data"))
		{
			$.ajax({

				url:'/admin/student/delete/'+id,
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
                        title: 'Violation Deleted Successfully',
                    });
				}
			});
		}

	}


</script>
