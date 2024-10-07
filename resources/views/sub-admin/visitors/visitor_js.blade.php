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
        let table = new DataTable('#visitorTable', {
            responsive: true,
            "ordering": false,
        });

        $('#visitorForm').on('submit', function(e){
        e.preventDefault();

        $('.errorMessage').html('');
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('sub-admin.store') }}",
            method: 'POST',
            data: formData,
            success:function(resp){
            if(resp.status=='success'){
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


