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


        $('#violationModal').on('hidden.bs.modal', function () {
            $('body').css('overflow', 'auto');
        });

        $('#updateViolationDynamic').on('hidden.bs.modal', function () {
            $('body').css('overflow', 'auto');
        });

        new DataTable('#violationTableUser', {
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
                    $('.modal-backdrop').remove();


                    $('#violationForms')[0].reset();
                    $('.text-danger').html('');
                    $('#violationTableUser').load(location.href + ' #violationTableUser');
                    $('#showViolationDynamic').load(location.href + ' #showViolationDynamic');

                    $('#updateViolationDynamic').load(location.href + ' #updateViolationDynamic');


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
        })
    });

 // Update Violation Form
 $(document).on('submit', '.violationFormUpdate', function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);
        let submitButton = form.find('.update_violate');
        let modalId = form.attr('id').split('-')[1];
        $('.error-message').remove();

        submitButton.prop('disabled', true);
        form.find('#loadingSpinnerer').show();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#updateViolationModal-' + modalId).modal('hide');
                    $('.modal-backdrop').remove();
                    $('.error-message').remove();

                    // Dynamically reload sections
                    $('#violationTableUser').load(location.href + ' #violationTableUser');
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
                        title: 'Violation updated successfully',
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    form.find('.error-message').remove();

                    $.each(errors, function (field, messages) {
                        let input = form.find('[name="' + field + '"]');
                        input.addClass('is-invalid');
                        input.after('<div class="invalid-feedback error-message">' + messages[0] + '</div>');
                    });
                }
            },
            complete: function () {
                form.find('#loadingSpinnerer').hide();
                submitButton.prop('disabled', false);
            }
        });
    });


    $('.modal').on('hidden.bs.modal', function() {
        $('.is-invalid').removeClass('is-invalid');
        $('.error-message').text('');
    });


    document.getElementById('loadingSpinner').style.display = 'none';


});
</script>


<script>


function searchStudentSub() {
    let searchValue = document.getElementById('search_student').value;
    let resultsContainer = document.getElementById('student_results');

    // Clear results if search is empty or less than 2 characters
    if (!searchValue || searchValue.length < 2) {
        resultsContainer.innerHTML = '';
        $('#searchSpinner').hide();
        $('#clear_search').hide();
        return;
    }

    $('#searchSpinner').show();
    $('#clear_search').show();

    let formData = new FormData();
    formData.append('search', searchValue);

    fetch('{{ route('sub-admin.search_student') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.students.length > 0) {
            $('#searchSpinner').hide();
            resultsContainer.innerHTML = '';
            data.students.forEach(student => {
                let resultItem = document.createElement('div');
                resultItem.classList.add('result-item');
                resultItem.innerHTML = `
                <div class="w-100 bg-primary">
                    <a href="#" class="btn w-100 text-start text-white">
                        ${student.student_no}, ${student.first_name} ${student.last_name} - ${student.course}
                    </a>
                </div>
                `;
                resultItem.onclick = function() {
                    // Debugging: Log the student data
                    console.log('Student Data:', student);

                    // Get all form fields first
                    const studentNoField = document.querySelector('#violationForms #student_no');
                    const lastNameField = document.querySelector('#violationForms #last_name');
                    const firstNameField = document.querySelector('#violationForms #first_name');
                    const middleInitialField = document.querySelector('#violationForms #middle_name');
                    const courseField = document.querySelector('#violationForms #course');

                    // Log if fields are found
                    console.log('Found fields:', {
                        studentNo: !!studentNoField,
                        lastName: !!lastNameField,
                        firstName: !!firstNameField,
                        middleInitial: !!middleInitialField,
                        course: !!courseField
                    });

                    // Set values if fields exist
                    if (studentNoField) studentNoField.value = student.student_no || '';
                    if (lastNameField) lastNameField.value = student.last_name || '';
                    if (firstNameField) firstNameField.value = student.first_name || '';
                    if (middleInitialField) middleInitialField.value = student.middle_name || '';
                    if (courseField) courseField.value = student.course || '';

                    // Log the values after setting
                    console.log('Set values:', {
                        studentNo: studentNoField?.value,
                        lastName: lastNameField?.value,
                        firstName: firstNameField?.value,
                        middleInitial: middleInitialField?.value,
                        course: courseField?.value
                    });

                    // Clear search input and results
                    document.getElementById('search_student').value = '';
                    document.getElementById('student_results').innerHTML = '';
                };

                resultsContainer.appendChild(resultItem);
            });
        } else {
            clearStudentFields();
            resultsContainer.innerHTML = '<div class="no-results">No matching students found</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        resultsContainer.innerHTML = '<div class="error">An error occurred while searching</div>';
    });
}

function clearSearch() {
    $('#search_student').val('');
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
