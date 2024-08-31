<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
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
                $('.table').load(location.href + ' .table');

                $('body').removeClass('modal-open'); // Removes the extra scrollbar and backdrop from the body
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
});

   </script>


   <script>
    $(document).ready(function () {
       function convertDateFormat(date) {
        const [day, month, year] = date.split('-');
        return `${year}-${month}-${day}`;
    }
//
    //    $(document).on('click', '.update_event_form', function(){
    // let id = $(this).data('id');
    // let title = $(this).data('title');
    // let description = $(this).data('description');
    // let date_start = $(this).data('date_start');
    // let date_end = $(this).data('date_end');
//
    // $('#up_id').val(id);
    // $('#up_title').val(title);
    // $('#up_description').val(description);
    // $('#up_date_start').val(date_start);
    // $('#up_date_end').val(date_end);
//
    // console.log('Date Start:', date_start);
    // console.log('Date End:', date_end);
//
// });
//
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
