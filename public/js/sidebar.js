// Toggle sidebar and hamburger menu
document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector("#toggle-btn");
    const sidebar = document.querySelector("#sidebar");

    if (hamburger && sidebar) {
        hamburger.addEventListener("click", function () {
            sidebar.classList.toggle("expand");
            hamburger.classList.toggle("show");
        });

        function adjustSidebar() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove("expand");
                hamburger.classList.add("show");
            } else {
                sidebar.classList.add("expand");
                hamburger.classList.remove("show");
            }
        }

        adjustSidebar();
        window.addEventListener("resize", adjustSidebar);
    }
});

// Handle loading bar
window.addEventListener("load", () => {
    const loading = document.querySelector(".loading-bar");

    if (loading) {
        loading.classList.add("loading-bar-hidden");
        loading.addEventListener("transitionend", () => {
            if (loading.parentNode) {
                loading.parentNode.removeChild(loading);
            }
        });
    }
});

// Handle select elements with "Other" option
document.addEventListener('DOMContentLoaded', function () {
    // Handle all select elements that need "Other" option functionality
    function initializeSelectElements() {
        // Get all select elements by their name attributes
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

    // Re-initialize when modals are shown (for dynamically loaded content)
    document.addEventListener('shown.bs.modal', function () {
        initializeSelectElements();
    });
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


// Handle date selection
document.addEventListener('DOMContentLoaded', function () {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    if (startDate && endDate) {
        startDate.addEventListener('change', function () {
            endDate.min = this.value;
            if (!endDate.value) {
                endDate.value = this.value;
            }
        });

        endDate.addEventListener('change', function () {
            startDate.max = this.value;
        });

        // Automatically set end date to start date if end date is empty
        if (startDate.value && !endDate.value) {
            endDate.value = startDate.value;
        }
    }
});

