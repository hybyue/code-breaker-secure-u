document.addEventListener("DOMContentLoaded", function () {
    // Sidebar Toggle Logic
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggle-btn");

    function adjustSidebar() {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove("expand");
            toggleBtn.classList.add("show");
        } else {
            sidebar.classList.add("expand");
            toggleBtn.classList.remove("show");
        }
    }

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("expand");
        toggleBtn.classList.toggle("show");
    });

    adjustSidebar();
    window.addEventListener("resize", adjustSidebar);



     // Dropdown functionality
     const dropdownToggles = document.querySelectorAll('.has-dropdown');

     dropdownToggles.forEach(toggle => {
         toggle.addEventListener('click', function(e) {
             if (sidebar.classList.contains('expand')) {
                 e.preventDefault();
                 e.stopPropagation();

                 const dropdownId = this.getAttribute('data-bs-target');
                 const dropdown = document.querySelector(dropdownId);

                 // Always allow toggle regardless of active state
                 this.classList.toggle('collapsed');
                 dropdown.classList.toggle('show');
             }
         });
     });

     // Set initial state only - don't force it to stay open
     const currentPath = window.location.pathname;
     const dropdownItems = document.querySelectorAll('.sidebar-dropdown .sidebar-link');

     dropdownItems.forEach(item => {
         if (item.getAttribute('href') === currentPath) {
             const parentDropdown = item.closest('.sidebar-dropdown');
             const parentItem = item.closest('.sidebar-item');
             if (parentDropdown && parentItem) {
                 // Set initial state only
                 parentDropdown.classList.add('show');
                 parentItem.classList.add('active');
                 const toggle = parentItem.querySelector('.has-dropdown');
                 if (toggle) {
                     toggle.classList.add('collapsed');
                 }
             }
         }
     });

    // Date Picker Range Logic
    const startDate = document.getElementById("start_date");
    const endDate = document.getElementById("end_date");

    if (startDate && endDate) {
        startDate.addEventListener("change", function () {
            endDate.min = this.value;
            if (!endDate.value) {
                endDate.value = this.value;
            }
        });

        endDate.addEventListener("change", function () {
            startDate.max = this.value;
        });

        if (startDate.value && !endDate.value) {
            endDate.value = startDate.value;
        }
        if (endDate.value && !startDate.value) {
            startDate.value = endDate.value;
        }
    }

    // Move this code outside the nested DOMContentLoaded
    function initializeSelectElements() {
        const selectNames = ['person_to_visit', 'id_type', 'violation_type', 'course'];

        selectNames.forEach(name => {
            document.querySelectorAll(`select[name="${name}"]`).forEach(select => {
                select.addEventListener('change', function() {
                    console.log(`Change detected for ${name}:`, this.value);
                    const parentForm = this.closest('form');
                    const formId = parentForm ? parentForm.id : 'default';
                    const inputId = `${name}OtherInput_${formId}`;
                    handleOtherOption(this, inputId);
                });
            });
        });
    }

    // Initial setup
    initializeSelectElements();

    // Re-initialize when modals are shown
    document.addEventListener('shown.bs.modal', function () {
        initializeSelectElements();
    });

    function handleOtherOption(selectElement, inputId) {
        const parentDiv = selectElement.parentNode;
        let otherInput = parentDiv.querySelector(`#${inputId}`);

        if (selectElement.value === 'Other') {
            if (!otherInput) {
                const inputField = document.createElement('input');
                inputField.type = 'text';
                inputField.id = inputId;
                inputField.name = selectElement.name;
                inputField.className = 'form-control mt-2';
                inputField.placeholder = 'Please specify';
                inputField.required = true;
                parentDiv.appendChild(inputField);
            }
        } else {
            if (otherInput) {
                otherInput.remove();
            }
        }
    }



});

// Loading Bar Animation
window.addEventListener("load", () => {
    const loading = document.querySelector(".loading");

    loading.classList.add("loading-bar-hidden");

    loading.addEventListener("transitionend", () => {
        loading.parentNode.removeChild(loading);
    });
});

