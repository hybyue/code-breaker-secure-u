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

        let submitButton = $('.add_lost');
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

                    $('.error-message').empty();
                    $('#previewImage').attr('src', '').addClass('d-none');

                    $('#viewModalLostFound').load(location.href + ' #viewModalLostFound');
                    $('#lostTable').load(location.href + ' #lostTable');
                    $('#updateLostFoundsDynamic').load(location.href + ' #updateLostFoundsDynamic');


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


    $(document).on('submit','.updateLostFoundForm', function(e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    let submitButton = form.find('.update_lost');
    let modalId = form.attr('id').split('-')[1];

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
                $('#updateLostFound-' + modalId).modal('hide');
                $('.modal-backdrop').remove();
                $('.error-message').remove();

                $('#lostTable').load(location.href + ' #lostTable');
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
                            title: 'Lost and Found updated successfully',
                        });
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
            $('body').css('overflow', 'auto');

        });

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


document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('bulkTransferBtn').addEventListener('click', function () {
        Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: 'You are about to mark all the lost items as transferred.',
            showCancelButton: true,
            confirmButtonColor: '#0B9B19',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, transfer',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to mark as transferred
                $.ajax({
                    url: '/sub-admin/update_transfer',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.success) {
                            // Generate the report
                            $.ajax({
                                url: '/sub-admin/generate_transfer_report',
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    items: response.transferredItems
                                },
                                success: function (reportResponse) {
                                        const pdfWindow = window.open();
                                        pdfWindow.location = reportResponse.pdf_url;
                                        localStorage.setItem('successMessage', response.message);
                                        location.reload();
                                },
                                error: function (xhr) {
                                    console.error(xhr);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: xhr.responseJSON.message || 'An error occurred while generating the report.',
                                        confirmButtonColor: '#0B9B19'
                                    });
                                }
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message || 'An error occurred while transferring the items.',
                            confirmButtonColor: '#0B9B19'
                        });
                    }
                });
            }
        });
    });
});



function showPdfModalLost() {
        document.getElementById('loadingBar').style.display = 'block';
    document.getElementById('pdfLostFrame').style.display = 'none';

    const url = '/generate-pdf/lost_found?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        status: $('#status').val()
    });

    const iframe = document.getElementById('pdfLostFrame');

    // Add load event listener to iframe
    iframe.onload = function() {
        document.getElementById('loadingBar').style.display = 'none';
        iframe.style.display = 'block';
    };

    // Set iframe src to trigger loading
    iframe.src = url;

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
