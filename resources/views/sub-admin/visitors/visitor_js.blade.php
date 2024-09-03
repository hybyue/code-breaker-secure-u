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

    $('#visitorForm').on('submit', function(e) {
        e.preventDefault();

        let first_name = $('#first_name').val();
           let middle_name = $('#middle_name').val();
           let last_name = $('#last_name').val();
           let person_to_visit = $('#person_to_visit').val();
           let purpose = $('#purpose').val();
           let id_type = $('#id_type').val();

          console.log(first_name+middle_name+last_name+person_to_visit+purpose+id_type);
        $.ajax({
            url: "{{ route('sub-admin.store') }}",
            method: 'POST',
            data:{
                last_name: last_name,
                first_name: first_name,
                middle_name: middle_name,
                person_to_visit: person_to_visit,
                purpose: purpose,
                id_type: id_type,
            },
            success:function(resp){
              if(resp.status=='success'){
                $('.modal-backdrop').remove();
                $('#visitorForm')[0].reset();
                $('#visitorTable').load(location.href + ' #visitorTable');

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
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Visitor added successfully',
                    })
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
