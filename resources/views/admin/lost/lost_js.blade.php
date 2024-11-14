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

                    $('#addLostForm').find('.is-invalid').removeClass('is-invalid');
                    $('#addLostForm').find('.error-message').remove();

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
                        title: 'Sticker List added successfully',
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
            title: 'Visitor updated successfully',
        });

        localStorage.removeItem('showToast');
    }
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
        icon: 'question',
        title: 'Are you sure?',
        text: 'Do you want to mark this item as claimed?',
        showCancelButton: true,
        confirmButtonColor: '#0B9B19',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, mark as claimed',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/update_claimed/${id}`,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_claimed: 1
                },
                success: function(response) {
                    localStorage.setItem('successMessage', 'Item has been mark as Claimed');
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

    document.getElementById('pdfLostFrame').src = url;

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

    setTimeout(function() {
        document.getElementById('loadingBar').style.display = 'none';
        document.getElementById('pdfLostFrame').style.display = 'block';
    }, 2000);
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
