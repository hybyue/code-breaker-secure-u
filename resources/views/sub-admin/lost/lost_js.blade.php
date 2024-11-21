<script src="{{ asset('offline_extender/js/jquery-3.7.1.js')}}"></script>
<script src="{{ asset('offline_extender/js/sweetalert.js')}}"></script>



<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
$(document).ready(function () {
    new DataTable('#lostTable', {
        responsive: true,
        "ordering": false,
        language: {
            lengthMenu: "_MENU_ entries",
        },
        columnDefs: [
            { targets: "_all", defaultContent: "" }
        ]
    });

    $('#addLostFoundForm').on('submit', function(e){
        e.preventDefault();

        let formData = new FormData(this);
        let submitButton = $('#addLostFoundForm').find('.add_lost_admin');

        submitButton.prop('disabled', true);
        $('#addLostFoundForm').find('#loadingSpinner').show();

        $.ajax({
            url: "{{ route('sub-admin.store_losts') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                if(resp.status == 'success') {
                    $('#addLostFoundForm')[0].reset();

                    $('#addLostFoundForm').find('.is-invalid').removeClass('is-invalid');
                    $('#addLostFoundForm').find('.error-message').remove();

                    $('#lostTable').load(location.href + ' #lostTable');
                    $('#updateLostFoundsDynamic').load(location.href + ' #updateLostFoundsDynamic');
                    $('#viewModalLostFound').load(location.href + ' #viewModalLostFound');

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
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $('#addLostFoundForm').find('.error-message').remove();

                    $.each(errors, function(field, messages) {
                        let input = $('#addLostFoundForm').find('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                    });
                }
            },
            complete: function() {
                $('#addLostFoundForm').find('#loadingSpinner').hide()
                submitButton.prop('disabled', false);
            }
        });
    });


    $('.updateLostFoundForm').on('submit', function(e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    let submitButton = form.find('.update_lost');
    let modalId = form.attr('id').split('-')[1];
    let modal = $('#updateLostFound-' + modalId);

    submitButton.prop('disabled', true);
    form.find('#loadingSpinnerer').show();

    $.ajax({
        url: form.attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                localStorage.setItem('showToast', 'true');
                location.reload();
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                form.find('.error-message').remove();

                $.each(errors, function(field, messages) {
                    let input = form.find('[name="' + field + '"]');
                    input.addClass('is-invalid');
                    input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                });
            }
        },
        complete: function() {
            form.find('#loadingSpinnerer').hide();
            submitButton.prop('disabled', false);
        }
    });
});



        $('.modal').on('hidden.bs.modal', function() {
            $('.is-invalid').removeClass('is-invalid');
            $('.error-message').text('');
        });

});

$(document).ready(function() {

    if (localStorage.getItem('showToast') === 'true') {
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
            title: 'Lost and Found updated successfully',
        });

        localStorage.removeItem('showToast');
    }
});

</script>

<script>
 function markAsClaimed(id) {
    Swal.fire({
        title: 'Upload Proof of Claim',
        html: `
            <input type="file" id="proof_image" name="proof_image" class="form-control mb-3">
            <small class="text-muted">Upload an image as proof of claim (JPEG, PNG, JPG only).</small>
        `,
        showCancelButton: true,
        confirmButtonText: 'Mark as Claimed',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            const fileInput = document.getElementById('proof_image');
            if (!fileInput.files.length) {
                Swal.showValidationMessage('Please upload an image');
            }
            return fileInput.files[0];
        },
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('proof_image', result.value); // Add the file
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            // Show loading spinner
            Swal.fire({
                title: 'Processing...',
                html: '<div class="spinner-border text-primary" role="status"></div>',
                showConfirmButton: false,
                allowOutsideClick: false,
                backdrop: true
            });

            // Send the request via AJAX
            $.ajax({
                url: `/sub-admin/update_claimed/${id}`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        // Save success message to localStorage
                        localStorage.setItem('successMessage', response.message);
                        location.reload(); // Reload the page
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                },
            });
        }
    });
}




function markAsTransfer(id) {
    Swal.fire({
        icon: 'question',
        title: 'Are you sure?',
        text: 'Do you want to mark this item as transferred (CSLD)?',
        showCancelButton: true,
        confirmButtonColor: '#0B9B19',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, mark as transferred',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/sub-admin/update_transfer/${id}`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_transferred: 1
                },
                success: function(response) {
                    localStorage.setItem('successMessage', 'Item has been marked as transferred (CSLD)');
                    location.reload();
                },
                error: function(xhr) {
                    console.error(xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was a problem updating the transfer status. Please try again.',
                        confirmButtonColor: '#0B9B19'
                    });
                }
            });
        }
    });
}


function showPdfModalLost() {
        document.getElementById('loadingBar').style.display = 'block';
    document.getElementById('pdfLostFrame').style.display = 'none';

    const url = '/generate-pdf/lost_found?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val()
    });

    document.getElementById('pdfLostFrame').src = url;

    $('#pdfModalLost').modal({
        backdrop:'static',
        keyboard: false,
        focus: false,
        show: false,
        scrollY: false,
        scrollX: true,
        width: '100%',
        height: 'auto',
        aspectRatio: 1.5,
        responsive: true,
        zoom: {
            enabled: true,
            scroll: true,
            wheel: false,
            pinch: false
        }
    });

    $('#pdfModalLost').modal('show');

    setTimeout(function() {
        document.getElementById('loadingBar').style.display = 'none';
        document.getElementById('pdfLostFrame').style.display = 'block';
    }, 2000);
    }

//     function previewImage(event, id) {
//     var reader = new FileReader();
//     reader.onload = function() {
//         var output = document.getElementById('newImagePreview-' + id);
//         output.src = reader.result;
//         output.style.display = 'block';
//     };
//     reader.readAsDataURL(event.target.files[0]);
// }

$(document).ready(function() {
    const successMessage = localStorage.getItem('successMessage');
    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: successMessage,
            confirmButtonColor: '#0B9B19'
        });
        localStorage.removeItem('successMessage');
    }
});
</script>


<script>
    // Handle camera input
    document.getElementById('cameraInput').addEventListener('change', function(e) {
        handleImageSelect(e);
    });

    // Handle file input
    document.getElementById('fileInput').addEventListener('change', function(e) {
        handleImageSelect(e);
    });

    function handleImageSelect(e) {
        const preview = document.getElementById('previewImage');
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(e.target.files[0]);
        }
    }
</script>
