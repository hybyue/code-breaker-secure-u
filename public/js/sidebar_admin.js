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

    // Handling 'Other' Option Logic
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

    const personToVisitSelect = document.getElementById("person_to_visit");
    const idTypeSelect = document.getElementById("id_type");

    if (personToVisitSelect) {
        personToVisitSelect.addEventListener("change", function () {
            handleOtherOption(this, "personToVisitOtherInput");
        });
    }

    if (idTypeSelect) {
        idTypeSelect.addEventListener("change", function () {
            handleOtherOption(this, "idTypeOtherInput");
        });
    }

    // Initialize Bootstrap Tooltips
    const tooltipTriggerList = document.querySelectorAll("[data-bs-toggle='tooltip']");
    [...tooltipTriggerList].forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
});

// Loading Bar Animation
window.addEventListener("load", () => {
    const loading = document.querySelector(".loading");

    loading.classList.add("loading-bar-hidden");

    loading.addEventListener("transitionend", () => {
        loading.parentNode.removeChild(loading);
    });
});
