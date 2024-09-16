<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    $('#addLostForm').on('submit', function(e){
        e.preventDefault();

        let formData = new FormData(this);

        // Remove this click handler since the button click is not needed here
        // $("#lostSubmmit").click(function () {
        //     $("#addNewLostModal").modal("toggle");
        // });

        $.ajax({
            url: "{{ route('admin.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                if(resp.status == 'success') {
                    $('.modal-backdrop').remove();
                    $('#addNewLostModal').modal('hide');
                    $('#addLostForm')[0].reset();
                    $('body').removeClass('modal-open');

                    // Append the new entry to the table
                    $('#tableLost').append(
                        `<tr class="text-center" id="tr_${resp.data.id}">
                            <td>${resp.data.object_type}</td>
                            <td>${resp.data.first_name} ${resp.data.middle_name}. ${resp.data.last_name}</td>
                            <td>${resp.data.course}</td>
                            <td>
                                ${resp.data.object_img ? `<img src="${resp.data.object_img}" alt="Object Image" width="100">` : 'No Image'}
                            </td>
                            <td>
                            <div class="d-flex justify-content-center">
                                <div class="mx-1">
                                    <a href="javascript:void(0)" class="btn btn-sm text-white" style="background-color: #063292" data-bs-toggle="modal" data-bs-target="#updateLostFound-${resp.data.id}">
                                    <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                                <div class="mx-1">
                                    <a href="javascript:void(0)" onclick="deleteLostFound(${resp.data.id})" class="btn btn-sm text-white" style="background-color: #920606">
                                    <i class="bi bi-trash3-fill"></i>
                                    </a>
                                </div>
                            </div>
                            </td>
                        </tr>`
                    );


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
                        title: 'Sticker List added successfully',
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

	function deleteLostFound(id)
	{
      if(confirm("Are you sure to delete lost and found data?"))
		{
			$.ajax({
				url:'/lost_found/archive/'+id,
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
                        title: 'Deleted Successfully',
                    });
				},
                error: function(xhr, status, error) {
                   alert('An error occurred: ' + xhr.responseText);
                },
			});
		}

	}


</script>
