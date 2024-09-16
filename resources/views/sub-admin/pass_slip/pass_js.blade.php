<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {

    $(document).ready(function () {
$('#addPassForm').on('submit', function(e){
    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
        url: "{{ route('pass_slips.store') }}",
        method: 'POST',
        data: formData,
        success: function(resp) {
            if(resp.status == 'success') {
                $('.modal-backdrop').remove();
                $('#addPassSlipModal').modal('hide');
                $('#addPassForm')[0].reset();
                $('#passTable').load(location.href + ' #passTable');
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
                    title: 'Pass Slip added successfully',
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

})
</script>
