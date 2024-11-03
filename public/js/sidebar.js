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

// Handle select elements for "Person to Visit & Company" and "ID Type"
document.addEventListener('DOMContentLoaded', function () {
    const personToVisitSelect = document.getElementById('person_to_visit');
    const idTypeSelect = document.getElementById('id_type');

    if (personToVisitSelect) {
        personToVisitSelect.addEventListener('change', function () {
            handleOtherOption(this, 'personToVisitOtherInput');
        });
    }

    if (idTypeSelect) {
        idTypeSelect.addEventListener('change', function () {
            handleOtherOption(this, 'idTypeOtherInput');
        });
    }
});

function handleOtherOption(selectElement, inputId) {
    const otherInputId = `${inputId}`;
    let otherInput = document.getElementById(otherInputId);

    if (selectElement.value === 'Other') {
        if (!otherInput) {
            const inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.id = otherInputId;
            inputField.name = selectElement.name;
            inputField.className = 'form-control mt-2';
            inputField.placeholder = 'Other Please specify';
            selectElement.parentNode.appendChild(inputField);
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
