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
                modal.modal('hide');
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
    $.ajax({
        url: `/sub-admin/update_claimed/${id}`,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            is_claimed: 1
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'The item has been marked as claimed!',
                confirmButtonColor: '#0B9B19'
            }).then(() => {

                const row = document.querySelector(`button[onclick='markAsClaimed(${id})']`).closest('tr');
                if (row) {
                    const statusCell = row.querySelector('td:nth-child(5)');
                    if (statusCell) {
                        statusCell.innerHTML = '<p class="text-success">Claimed</p>';
                    }
                }
            });
        },
        error: function(xhr) {
            console.error(xhr);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was a problem updating the claim status. Please try again.',
                confirmButtonColor: '#920606'
            });
        }
    });
}

function markAsTransfer(id) {
    $.ajax({
        url: `/sub-admin/update_transfer/${id}`,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            is_transferred: 1
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'The item has been marked as Transferred on CSLD!',
                confirmButtonColor: '#0B9B19'
            }).then(() => {

                const row = document.querySelector(`a[onclick='markAsTransfer(${id})']`).closest('tr');
                if (row) {
                    const statusCell = row.querySelector('td:nth-child(5)');
                    if (statusCell) {
                        statusCell.innerHTML = '<p class="text-danger">Transferred</p>';
                    }
                }
            });
        },
        error: function(xhr) {
            console.error(xhr);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was a problem updating the claim status. Please try again.',
                confirmButtonColor: '#920606'
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
