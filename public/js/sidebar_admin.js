const hamburger = document.querySelector("#toggle-btn");

        hamburger.addEventListener("click", function () {
            document.querySelector("#sidebar").classList.toggle("expand");
            hamburger.classList.toggle("show");
        });

        document.addEventListener("DOMContentLoaded", function () {
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

            adjustSidebar()

            window.addEventListener("resize", adjustSidebar);
        })



        window.addEventListener("load", () => {
            const loading = document.querySelector(".loading");

            loading.classList.add("loading-bar-hidden");

            loading.addEventListener("transitionend", () => {
                loading.parentNode.removeChild(loading);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');

            startDate.addEventListener('change', function () {
                endDate.min = this.value;
                if (!endDate.value) {
                    endDate.value = this.value;
                }
            });

            endDate.addEventListener('change', function () {
                startDate.max = this.value;
            });

            if (startDate.value && !endDate.value) {
                endDate.value = startDate.value;
            }
            if (endDate.value && !startDate.value) {
                startDate.value = endDate.value;
            }
        });



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
