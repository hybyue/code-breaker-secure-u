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

        // let lastOpenedViewModalId = null;
//TODO: awit gagawin ko na to next time
// $('.edit-button').on('click', function() {
//     var id = $(this).data('id');
//     lastOpenedViewModalId = id; // Store the current view modal's ID
//     $('#viewEntries-' + id).addClass('view-modal');
//     $('#updateViolationModal-' + id).addClass('edit-modal');
// });

// $('.edit-modal').on('hidden.bs.modal', function () {
//     if (lastOpenedViewModalId) {
//         $('#viewEntries-' + lastOpenedViewModalId).modal('show');
//     }
//     $('.view-modal').removeClass('view-modal');
// });

// // Remove backdrop on both modals close
// $('.modal').on('hidden.bs.modal', function () {
//     if (!$('.modal.show').length) {
//         $('body').removeClass('modal-open');
//         $('.modal-backdrop').remove();
//     }
// });

        new DataTable('#violationTable', {
            responsive: true,
            ordering: false,
        language: {
                lengthMenu: '_MENU_ entries'
            },
            columnDefs: [
        { targets: "_all", defaultContent: "" }
    ]
        });


    $('#violationForms').on('submit', function(e){
        e.preventDefault();

        $('.errorMessage').html('');
        let submitButton = $('.add_violation');
            submitButton.prop('disabled', true);
            $('#loadingSpinner').show();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('sub-admin.store_violate') }}",
            method: 'POST',
            data: formData,
            success: function(resp) {
                if(resp.status == 'success') {
                    $('#violationModal').modal('hide');
                    $('#violationForms')[0].reset();
                    $('#violationTable').load(location.href + ' #violationTable');
                    $('#updateViolationDynamic').load(location.href + ' #updateViolationDynamic');
                    $('#showViolationDynamic').load(location.href + ' #showViolationDynamic');

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
                    $('.modal-backdrop').remove();

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
        })
    });

    async function searchStudent() {
        const studentNo = $('#student_no').val();
        const formData = new FormData();
        formData.append('student_no', studentNo);

        try {
            const response = await $.ajax({
                url: '{{ route('sub-admin.search_student') }}',
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
});



   </script>
