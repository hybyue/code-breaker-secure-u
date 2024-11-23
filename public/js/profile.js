document.addEventListener('DOMContentLoaded', function() {
    // Initialize all province dropdowns
    document.querySelectorAll('.modal select[name="province"]').forEach(provinceSelect => {
        loadProvinces(provinceSelect);
    });

    async function loadProvinces(provinceSelect) {
        try {
            const response = await fetch('https://psgc.gitlab.io/api/provinces/');
            const provinces = await response.json();

            // Store the current selected province name
            const currentProvince = provinceSelect.querySelector('option[selected]')?.textContent;

            provinceSelect.innerHTML = '<option value="" disabled>Select Province</option>';

            // Sort provinces alphabetically
            provinces.sort((a, b) => a.name.localeCompare(b.name));

            provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.name;
                option.textContent = province.name;
                if (province.name === currentProvince) {
                    option.selected = true;
                    // Store the code as a data attribute for API calls
                    option.dataset.code = province.code;
                    // Trigger change event to load municipalities
                    handleProvinceChange(province.code,
                        provinceSelect.closest('.modal').querySelector('select[name="city"]'),
                        provinceSelect.closest('.modal').querySelector('select[name="barangay"]')
                    );
                }
                provinceSelect.appendChild(option);
            });
            provinceSelect.disabled = false;

            // Add change event listener
            provinceSelect.addEventListener('change', function() {
                const modal = this.closest('.modal');
                const citySelect = modal.querySelector('select[name="city"]');
                const barangaySelect = modal.querySelector('select[name="barangay"]');
                // Find the selected option and get its code from the data attribute
                const selectedOption = this.options[this.selectedIndex];
                const provinceCode = provinces.find(p => p.name === selectedOption.value)?.code;
                handleProvinceChange(provinceCode, citySelect, barangaySelect);
            });
        } catch (error) {
            console.error('Error loading provinces:', error);
        }
    }

    async function handleProvinceChange(provinceCode, citySelect, barangaySelect) {
        try {
            citySelect.disabled = false;
            barangaySelect.disabled = true;

            const currentCity = citySelect.querySelector('option[selected]')?.textContent;

            citySelect.innerHTML = '<option value="" disabled>Select Municipality</option>';

            const [citiesResponse, muniResponse] = await Promise.all([
                fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities/`),
                fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/municipalities/`)
            ]);

            const cities = await citiesResponse.json();
            const municipalities = await muniResponse.json();

            const allLocations = [...cities, ...municipalities].sort((a, b) =>
                a.name.localeCompare(b.name)
            );

            allLocations.forEach(location => {
                const option = document.createElement('option');
                option.value = location.name;
                option.textContent = location.name;
                option.dataset.code = location.code;
                if (location.name === currentCity) {
                    option.selected = true;
                    handleMunicipalityChange(location.code, barangaySelect);
                }
                citySelect.appendChild(option);
            });

            // Add change event listener to city select
            citySelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const locationCode = allLocations.find(l => l.name === selectedOption.value)?.code;
                handleMunicipalityChange(locationCode, barangaySelect);
            });
        } catch (error) {
            console.error('Error loading cities/municipalities:', error);
        }
    }

    async function handleMunicipalityChange(municipalityCode, barangaySelect) {
        try {
            barangaySelect.disabled = false;

            const currentBarangay = barangaySelect.querySelector('option[selected]')?.textContent;

            barangaySelect.innerHTML = '<option value="" disabled>Select Barangay</option>';

            const response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${municipalityCode}/barangays`);
            const barangays = await response.json();

            barangays.sort((a, b) => a.name.localeCompare(b.name));

            barangays.forEach(barangay => {
                const option = document.createElement('option');
                option.value = barangay.name;
                option.textContent = barangay.name;
                if (barangay.name === currentBarangay) {
                    option.selected = true;
                }
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

