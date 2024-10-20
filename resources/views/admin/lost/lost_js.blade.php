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

    new DataTable('#tableLost', {
        responsive: true,
        ordering: false,
        });


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
                    $('#tableLost').load(location.href + ' #tableLost');
                    $('#latestLostAndFound').load(location.href + ' #latestLostAndFound');
                    $('#latestUpdateLostAndFound').load(location.href + ' #latestUpdateLostAndFound');
                    
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
