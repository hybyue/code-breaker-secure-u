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

    $('#violationForms').on('submit', function(e){
        e.preventDefault();

        $('.errorMessage').html('');
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('sub-admin.store_violate') }}",
            method: 'POST',
            data: formData,
            success: function(resp) {
                if(resp.status == 'success') {
                    $('#violationModal').modal('hide');
                    $('#violationForms')[0].reset();
                    $('#violationTable').load(location.href + ' #violationTable');
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
                    $('.modal-backdrop').remove();

                }
            },
            error: function(err) {
                $('.errorMessage').html('');
                let errors = err.responseJSON.errors;
                $.each(errors, function(index, value) {
                    $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
                });
            }
        })
    });
});
   </script>

-
