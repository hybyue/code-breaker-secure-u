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
