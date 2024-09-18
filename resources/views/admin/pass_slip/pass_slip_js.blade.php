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

        $(document).ready(function () {
    $('#addPassForm').on('submit', function(e){
        e.preventDefault();

        $('.errorMessage').html('');
        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('pass_slip.store') }}",
            method: 'POST',
            data: formData,
            success: function(resp) {
                if(resp.status == 'success') {
                    $('.modal-backdrop').remove();
                    $('#addPassSlipModal').modal('hide');
                    $('#addPassForm')[0].reset();
                    $('#passTable').load(location.href + ' #passTable');
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
                        title: 'Pass Slip added successfully',
                    });
                }
            },
            error: function(err) {
                $('.errorMessage').html('');
                let errors = err.responseJSON.errors;
                $.each(errors, function(index, value) {
                    $('.errorMessage').append('<span class="text-danger">'+value+'</span>'+'<br>');
                });
            }
        });
    });
});


});

   </script>

<script type="text/javascript">

	function deletePassSlip(id)
	{
      if(confirm("Are you sure to delete pass slip data"))
		{
			$.ajax({

				url:'/pass_slip/archive/'+id,
				type:'DELETE',

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
                        title: 'Pass Slip Deleted Successfully',
                    });
				}
			});
		}

	}


</script>



<script>
    function clearEmployeeFields() {
    let fields = [ 'last_name', 'first_name', 'middle_name', 'department', 'designation', 'status'];

    fields.forEach(field => {
        let element = document.getElementById(field);
        if (element) {
            element.value = '';
        }
    });
}


function searchEmployee() {
    let searchValue = document.getElementById('search_employee').value;

    if (searchValue.length >= 2) {
        let formData = new FormData();
        formData.append('search', searchValue);

        fetch('{{ route('search_employee') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.employees.length > 0) {
                let resultsContainer = document.getElementById('employee_results');
                resultsContainer.innerHTML = ''; // Clear previous results

                // Display the employee suggestions
                data.employees.forEach(employee => {
                    let resultItem = document.createElement('div');
                    resultItem.classList.add('result-item');
                    resultItem.innerHTML = `
                        <a href="#" class="btn btn-primary">${employee.employee_id}, ${employee.first_name} ${employee.last_name} -${employee.designation} -${employee.department}</a>
                    `;

                    resultItem.onclick = function() {
                        // Autofill the form fields when the user clicks an item
                        document.getElementById('last_name').value = employee.last_name;
                        document.getElementById('first_name').value = employee.first_name;
                        document.getElementById('middle_name').value = employee.middle_name || '';
                        document.getElementById('department').value = employee.department;
                        document.getElementById('designation').value = employee.designation;
                        document.getElementById('status').value = employee.status;

                        // Clear the results after selection
                        resultsContainer.innerHTML = '';
                    };

                    resultsContainer.appendChild(resultItem);
                });
            } else {
                clearEmployeeFields();
                document.getElementById('employee_results').innerHTML = '<div class="no-results">No matching employees found</div>';
            }
        })
        .catch(error => console.error('Error:', error));
    } else {
        clearEmployeeFields();
        document.getElementById('employee_results').innerHTML = '';
    }
}

    </script>
