<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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

     document.getElementById('pdfViolationFrame').src = url;

     $('#pdfModalViolationAd').modal({
        backdrop: 'static',
        keyboard: false,
        show: false,
        scrollY: false,
        scrollX: true,
    });

     $('#pdfModalViolationAd').modal('show');

        setTimeout(function() {
            document.getElementById('loadingBar').style.display = 'none';
            document.getElementById('pdfViolationFrame').style.display = 'block';
        }, 1000);
    }



</script>
