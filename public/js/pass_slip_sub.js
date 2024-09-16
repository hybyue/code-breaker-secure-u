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
