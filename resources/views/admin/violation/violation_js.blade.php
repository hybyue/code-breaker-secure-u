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


        new DataTable('#violationTableAdmin', {
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
                        $('#violationTableAdmin').load(location.href + ' #violationTableAdmin');
                        $('#latestViolationsAdmin').load(location.href + ' #latestViolationsAdmin');
                        $('#latestUpdateViolationAdmin').load(location.href + ' #latestUpdateViolationAdmin');

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
                $('#violationTableAdmin').load(location.href + ' #violationTableAdmin');
                $('#latestViolationsAdmin').load(location.href + ' #latestViolationsAdmin');

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

    $('.modal').on('hidden.bs.modal', function() {
        $('.is-invalid').removeClass('is-invalid');
        $('.error-message').text('');
        $('body').css('overflow', 'auto');

    });

    });






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
    function searchStudent() {
        let searchValue = $('#search_student').val(); // Use jQuery for consistency
    let resultsContainer = $('#student_results');

    // Clear results if search is empty or less than 2 characters
    if (!searchValue || searchValue.length < 2) {
        resultsContainer.empty();
        $('#searchSpinner').hide();
        $('#clear_search').hide();
        return;
    }

    $('#searchSpinner').show();
    $('#clear_search').show();

    let formData = new FormData();
    formData.append('search', searchValue);

    $.ajax({
        url: "{{ route('admin.search_student') }}",
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            $('#searchSpinner').hide();

            if (data.success && data.students.length > 0) {
                resultsContainer.empty(); // Clear previous results

                // Display the student suggestions
                data.students.forEach(function(student) {
                    let resultItem = $('<div></div>').addClass('result-item').html(`
                        <div class="w-100 bg-primary">
                            <a href="#" class="btn w-100 btn-primary text-start text-white">
                                ${student.student_no}, ${student.first_name} ${student.last_name} - ${student.course}
                            </a>
                        </div>
                    `);

                    resultItem.on('click', function() {
                        // Autofill the form fields when the user clicks an item
                        $('#violationFormAdmin #student_no').val(student.student_no || '');
                        $('#violationFormAdmin #last_name').val(student.last_name);
                        $('#violationFormAdmin #first_name').val(student.first_name);
                        $('#violationFormAdmin #middle_name').val(student.middle_name || '');
                        $('#violationFormAdmin #course').val(student.course);

                        // Clear the results after selection
                        resultsContainer.empty();
                        $('#search_student').val('');
                    });

                    resultsContainer.append(resultItem);
                });
            } else {
                clearStudentFields();
                resultsContainer.html('<div class="no-results">No matching students found</div>');
            }
        },
        error: function(error) {
            $('#searchSpinner').hide();
            console.error('Error:', error);
            resultsContainer.html('<div class="error">An error occurred while searching</div>');
        }
    });
}


function clearSearch() {
        // Clear only the search input
        $('#search_student').val('');

        // Clear only the results container
        $('#student_results').empty();
    }


function clearStudentFields() {
    let fields = ['student_no', 'last_name', 'first_name', 'middle_name', 'course'];

    fields.forEach(field => {
        let element = document.getElementById(field);
        if (element) {
            element.value = '';
        }
    });
}

    </script>
