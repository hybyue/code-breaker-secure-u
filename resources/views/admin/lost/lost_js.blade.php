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
    new DataTable('#tableLostAdmin', {
        responsive: true,
        "ordering": false,
        language: {
            lengthMenu: "_MENU_ entries",
        },
        columnDefs: [
            { targets: "_all", defaultContent: "" }
        ]
    });

    $('#addLostForm').on('submit', function(e){
        e.preventDefault();

        let formData = new FormData(this);
        let submitButton = $('#addLostForm').find('.add_lost_admin');

        submitButton.prop('disabled', true);
        $('#addLostForm').find('#loadingSpinnerer').show();

        $.ajax({
            url: "{{ route('admin.store_lost') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                if(resp.status == 'success') {
                    $('#addLostForm')[0].reset();


                    $('.error-message').remove();
                    $('#previewImage').attr('src', '').addClass('d-none');

                    $('#tableLostAdmin').load(location.href + ' #tableLostAdmin');
                    $('#lostFoundUpdateAd').load(location.href + ' #lostFoundUpdateAd');
                    $('#viewLostFoundAd').load(location.href + ' #viewLostFoundAd');

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
                        title: 'Lost and Found added successfully',
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $('#addLostForm').find('.error-message').remove();

                    $.each(errors, function(field, messages) {
                        let input = $('#addLostForm').find('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                    });
                }
            },
            complete: function() {
                $('#addLostForm').find('#loadingSpinnerer').hide()
                submitButton.prop('disabled', false);
            }
        });
    });


    $(document).on('submit', '.lostFoundUpdateForm', function(e) {
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
                $('#lostFoundUpdateForm-' + modalId).modal('hide');
                $('.modal-backdrop').remove();
                $('.error-message').remove();

                $('#tableLostAdmin').load(location.href + ' #tableLostAdmin');
                $('#lostFoundUpdateAd').load(location.href + ' #lostFoundUpdateAd');
                $('#viewLostFoundAd').load(location.href + ' #viewLostFoundAd');

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
    });
});


</script>

<script type="text/javascript">

	function deleteLostFound(id)
	{
      if(confirm("Are you sure to delete lost and found data?"))
		{
			$.ajax({
				url:'/lost_found/archive/'+id,
				type:'DELETE',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
				success:function(result)
				{
                    $("#"+result['tr']).slideUp("slow");

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-right',
                    iconColor: 'white',
                    customClass: {
                    popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    })

                    Toast.fire({
                        icon:'success',
                        title: 'Deleted Successfully',
                    });
				},
                error: function(xhr, status, error) {
                   alert('An error occurred: ' + xhr.responseText);
                },
			});
		}

	}


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
                url: `/admin/update_claimed/${id}`,
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
                url: `/admin/update_transfer/${id}`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_transferred: 1
                },
                success: function(response) {
                    localStorage.setItem('successMessage', 'Item has been mark as transferred(CSLD)');
                    location.reload();
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
    });
}

function showPdfModalLost() {
        document.getElementById('loadingBar').style.display = 'block';
    document.getElementById('pdfLostFrame').style.display = 'none';

    const url = '/admin/generate-pdf/lost_found?' + $.param({
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val()
    });

    const iframe = document.getElementById('pdfLostFrame');

        // Add load event listener to iframe
        iframe.onload = function() {
            document.getElementById('loadingBar').style.display = 'none';
            iframe.style.display = 'block';
        };

        // Set iframe src to trigger loading
        iframe.src = url;

    $('#pdfModalLostAd').modal({
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

    $('#pdfModalLostAd').modal('show');
    }


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


<script>
    function previewImage(event, id) {
        const file = event.target.files[0];
        const preview = document.getElementById(`previewImage-${id}`);

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.classList.add('d-none');
        }
    }
</script>
