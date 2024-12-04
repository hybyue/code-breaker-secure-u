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

        $('#addViolationModalAd').on('hidden.bs.modal', function () {
            $('body').css('overflow', 'auto');
        });


        new DataTable('#violationTable', {
        responsive: true,
        ordering: false,
        language: {
                lengthMenu: "_MENU_ entries",
            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
            ]
        });

        $('#violationFormAdmin').on('submit', function(e){
            e.preventDefault();

            $('.errorMessage').html('');
            let submitButton = $('.add_violation');
            submitButton.prop('disabled', true);
            $('#loadingSpinner').show();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.store_violation') }}",
                method: 'POST',
                data: formData,
                success: function(response) {
                    if(response.status == 'success') {
                        $('#violationFormAdmin')[0].reset();
                        $('.modal-backdrop').hide();
                        $('#addViolationModalAd').modal('hide');
                        $('#violationTable').load(location.href + ' #violationTable');
                        $('#latestViolations').load(location.href + ' #latestViolations');
                        $('#latestUpdateViolation').load(location.href + ' #latestUpdateViolation');

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
                    }
                },
                error: function(err) {
                    $('.errorMessage').html('');
                    let errors = err.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    });
                },
                complete: function () {
                    $('#loadingSpinner').hide();
                    submitButton.prop('disabled', false);
                }
            });
        });

    });

    $(document).on('submit', '.violationFormUpdateAdmin', function(e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    let submitButton = form.find('.update_violate');
    let modalId = form.attr('id').split('-')[1];
    let modal = $('#updateViolationModalAd-' + modalId);

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
                $('#updateViolationModalAd-' + modalId).modal('hide');
                $('.modal-backdrop').remove();

                $('.error-message').remove();
                $('#violationTable').load(location.href + ' #violationTable');
                $('#latestViolations').load(location.href + ' #latestViolations');
                $('#latestUpdateViolation').load(location.href + ' #latestUpdateViolation');

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



    async function searchStudent() {
        const studentNo = $('#student_no').val();
        const formData = new FormData();
        formData.append('student_no', studentNo);

        try {
            const response = await $.ajax({
                url: '{{ route('admin.search_student') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false
            });

            const students = response.data || [];
            // Update the div with the response data
            const resultsDiv = $('#student_results');
            resultsDiv.empty();

            if (students.length > 0) {
                students.forEach(student => {
                    const studentInfo = $('<a></a>')
                        .attr('href', '#')
                        .addClass('btn btn-primary w-100 text-start')
                        .text(`Name: ${student.first_name} ${student.last_name}, Course: ${student.course}`)
                        .on('click', () => populateForm(student));
                    resultsDiv.append(studentInfo);
                });
            } else {
                resultsDiv.text('No results found.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function populateForm(student) {
        $('#student_no').val(student.student_no);
        $('#last_name').val(student.last_name);
        $('#first_name').val(student.first_name);
        $('#middle_initial').val(student.middle_initial || '');
        $('#course').val(student.course);

         // Clear the search results
         $('#student_results').empty();
    }

    // Debounce the searchStudent function
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    const debouncedSearchStudent = debounce(searchStudent, 300);

    // Attach the debounced function to the input event
    $('#student_no').on('input', debouncedSearchStudent);
</script>




<script type="text/javascript">

	function deleteViolation(id)
	{
      if(confirm("Are you sure to delete violation data"))
		{
			$.ajax({

				url:'/violation/archive/'+id,
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
                        title: 'Violation Deleted Successfully',
                    });
				}
			});
		}

	}


</script>



<script>
    function showPdfModalViolation() {
        document.getElementById('loadingBar').style.display = 'block';
        document.getElementById('pdfViolationFrame').style.display = 'none';

        const url = '/admin/generate-pdf/violation?'  + $.param({
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
        });;

        const iframe = document.getElementById('pdfViolationFrame');

        // Add load event listener to iframe
        iframe.onload = function() {
            document.getElementById('loadingBar').style.display = 'none';
            iframe.style.display = 'block';
        };

        // Set iframe src to trigger loading
        iframe.src = url;

     $('#pdfModalViolationAd').modal({
        backdrop: 'static',
        keyboard: false,
        show: false,
        scrollY: false,
        scrollX: true,
    });

     $('#pdfModalViolationAd').modal('show');

    }



</script>


<script>
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
                title: 'Violation updated successfully',
            });

            localStorage.removeItem('showToast');
        }
    });

    </script>
