$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $('form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('login.action') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    window.location.href = response.redirect;
                } else {
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
                        icon: 'error',
                        title: response.message,
                    });
                }
            },
            error: function(xhr) {
        if (xhr.status === 404 || xhr.status === 401) {
            if (xhr.status === 404) {
                $('#emailError').text(xhr.responseJSON.message);
                $('#email').addClass('border-red-500');
            }
            if (xhr.status === 401) {
                $('#passwordError').text(xhr.responseJSON.message);
                $('#password').addClass('border-red-500');
            }
        } else if (xhr.status === 429) {
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
                        icon: 'error',
                        title: "Too many login attempts. Please try again in 10 minutes.",
                    });
                } else if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    const errorMessage = Object.values(errors).flat().join('\n');

                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast',
                        },
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: 'error',
                        title: errorMessage,
                    });
                } else {
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
                        icon: 'error',
                        title: 'An unexpected error occurred',
                    });
                }
            }
        });
    });
});
