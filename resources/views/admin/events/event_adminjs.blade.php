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
        new DataTable('#announceTable', {
        responsive: true,
        ordering: false,
        });
       $(document).on('click', '.add_event', function(e){
           e.preventDefault();

           $('.errorMessage').html('');

           let title = $('#title').val();
           let description = $('#description').val();
           let date_start = $('#date_start').val();
           let date_end = $('#date_end').val();
            //    console.log(title+description+date_start+date_end);
        $.ajax({
            url: "{{ route('event.store_admin') }}",
            method: 'POST',
            data:{
                title: title,
                description: description,
                date_start: date_start,
                date_end: date_end},
            success:function(resp){
              if(resp.status=='success'){
                $('#addNewEventModal').modal('hide');
                $('#addEventForm')[0].reset();
                $('#announceTable').load(location.href + ' #announceTable');
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
                        icon: 'success',
                        title: "Event Added",
                    })


                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
              }
            },error:function(err){
                $('.errorMessage').html('');
                let error = err.responseJSON;
                $.each(error.errors,function(index, value){
                    $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
                });
            }
           })

       });


       $(document).on('click', '.update_event', function(e){
    e.preventDefault();
    $('.errorMessage').html('');

    let up_id = $('#up_id').val();
    let up_title = $('#up_title').val();
    let up_description = $('#up_description').val();
    let up_date_start = $('#up_date_start').val();
    let up_date_end = $('#up_date_end').val();

    $.ajax({
    url: "{{ route('update.events_admin', '') }}/" + up_id,
    method: 'PUT',
    data: {
        up_id: up_id,
        up_title: up_title,
        up_description: up_description,
        up_date_start: up_date_start,
        up_date_end: up_date_end
    },
    success: function(resp){
        if(resp.status == 'success'){
            console.log('Update Success:', resp);
            $('.updateEvent').modal('hide');
            $('#updateEventForm')[0].reset();
            $('.table').load(location.href + ' .table');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();

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
                    icon: 'success',
                    title: "Event Updated",
                })

        }
    },
    error: function(err){
        console.error('Update Failed:', err);
        let error = err.responseJSON;
        $.each(error.errors, function(index, value){
            $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
        });
    }
});

});

});

   </script>

<script type="text/javascript">

	function deletepost(id)
	{
      if(confirm("Are you sure to delete this event"))
		{
			$.ajax({

				url:'/admin/archive_events/'+id,
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
                        title: 'Event Deleted',
                    });
				}
			});
		}

	}


</script>
