document.addEventListener('DOMContentLoaded', function() {
    // Initialize all province dropdowns
    document.querySelectorAll('.modal select[name="province"]').forEach(provinceSelect => {
        loadProvinces(provinceSelect);
    });

    async function loadProvinces(provinceSelect) {
        try {
            const response = await fetch('https://psgc.gitlab.io/api/provinces');
            const provinces = await response.json();

            provinceSelect.innerHTML = '<option value="" selected disabled>Select Province</option>';

            // Sort provinces alphabetically
            provinces.sort((a, b) => a.name.localeCompare(b.name));

            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.code;
                option.textContent = province.name;
                provinceSelect.appendChild(option);
            });
            provinceSelect.disabled = false;

            // Add change event listener
            provinceSelect.addEventListener('change', function() {
                const modal = this.closest('.modal');
                const municipalitySelect = modal.querySelector('select[name="municipality"]');
                const barangaySelect = modal.querySelector('select[name="barangay"]');
                handleProvinceChange(this.value, municipalitySelect, barangaySelect);
            });
        } catch (error) {
            console.error('Error loading provinces:', error);
        }
    }

    async function handleProvinceChange(provinceCode, municipalitySelect, barangaySelect) {
        municipalitySelect.innerHTML = '<option value="" selected disabled>Select Municipality/City</option>';
        barangaySelect.innerHTML = '<option value="" selected disabled>Select Barangay</option>';

        if (!provinceCode) {
            municipalitySelect.disabled = true;
            barangaySelect.disabled = true;
            return;
        }

        try {
            municipalitySelect.disabled = false;
            barangaySelect.disabled = true;

            const response = await fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities`);
            const municipalities = await response.json();

            municipalities.sort((a, b) => a.name.localeCompare(b.name));

            municipalities.forEach(municipality => {
                const option = document.createElement('option');
                option.value = municipality.code;
                option.textContent = municipality.name;
                municipalitySelect.appendChild(option);
            });

            municipalitySelect.addEventListener('change', function() {
                handleMunicipalityChange(this.value, barangaySelect);
            });
        } catch (error) {
            console.error('Error loading municipalities:', error);
        }
    }

    async function handleMunicipalityChange(municipalityCode, barangaySelect) {
        barangaySelect.innerHTML = '<option value="" selected disabled>Select Barangay</option>';

        if (!municipalityCode) {
            barangaySelect.disabled = true;
            return;
        }

        try {
            barangaySelect.disabled = false;

            const response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${municipalityCode}/barangays`);
            const barangays = await response.json();

            barangays.sort((a, b) => a.name.localeCompare(b.name));

            barangays.forEach(barangay => {
                const option = document.createElement('option');
                option.value = barangay.code;
                option.textContent = barangay.name;
                barangaySelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error loading barangays:', error);
        }
    }

    // Store the selected text values instead of codes
   // Handle form submissions
   document.querySelectorAll('#addProfileFormAdmin, #updateProfileFormAdmin').forEach(form => {
    form.addEventListener('submit', function(e) {
        const modal = this.closest('.modal');

        // Get the selected text values from each dropdown
        const provinceSelect = modal.querySelector('select[name="province"]');
        const municipalitySelect = modal.querySelector('select[name="municipality"]');
        const barangaySelect = modal.querySelector('select[name="barangay"]');

        // Create hidden inputs for each address component
        if (provinceSelect && provinceSelect.selectedIndex > 0) {
            const provinceInput = document.createElement('input');
            provinceInput.type = 'hidden';
            provinceInput.name = 'province';
            provinceInput.value = provinceSelect.options[provinceSelect.selectedIndex].text;
            this.appendChild(provinceInput);
        }

        if (municipalitySelect && municipalitySelect.selectedIndex > 0) {
            const municipalityInput = document.createElement('input');
            municipalityInput.type = 'hidden';
            municipalityInput.name = 'municipality';
            municipalityInput.value = municipalitySelect.options[municipalitySelect.selectedIndex].text;
            this.appendChild(municipalityInput);
        }

        if (barangaySelect && barangaySelect.selectedIndex > 0) {
            const barangayInput = document.createElement('input');
            barangayInput.type = 'hidden';
            barangayInput.name = 'barangay';
            barangayInput.value = barangaySelect.options[barangaySelect.selectedIndex].text;
            this.appendChild(barangayInput);
        }
    });
});
});

