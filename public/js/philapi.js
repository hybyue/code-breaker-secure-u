document.addEventListener('DOMContentLoaded', function() {
    // Initialize all province dropdowns
    document.querySelectorAll('.modal select[name="province"]').forEach(provinceSelect => {
        loadProvinces(provinceSelect);
    });

    async function loadProvinces(provinceSelect) {
        try {
            const response = await fetch('https://psgc.gitlab.io/api/provinces/');
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
                const citySelect = modal.querySelector('select[name="city"]');
                const barangaySelect = modal.querySelector('select[name="barangay"]');
                handleProvinceChange(this.value, citySelect, barangaySelect);
            });
        } catch (error) {
            console.error('Error loading provinces:', error);
        }
    }

    async function handleProvinceChange(provinceCode, citySelect, barangaySelect) {
        citySelect.innerHTML = '<option value="" selected disabled>Select Municipality</option>';
        barangaySelect.innerHTML = '<option value="" selected disabled>Select Barangay</option>';

        if (!provinceCode) {
            citySelect.disabled = true;
            barangaySelect.disabled = true;
            return;
        }

        try {
            citySelect.disabled = false;
            barangaySelect.disabled = true;

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
                option.value = location.code;
                option.textContent = location.name;
                citySelect.appendChild(option);
            });

            // Add change event listener to city select
            citySelect.addEventListener('change', function() {
                handleCityChange(this.value, barangaySelect);
            });
        } catch (error) {
            console.error('Error loading cities/municipalities:', error);
        }
    }

    async function handleCityChange(cityCode, barangaySelect) {
        barangaySelect.innerHTML = '<option value="" selected disabled>Select Barangay</option>';

        if (!cityCode) {
            barangaySelect.disabled = true;
            return;
        }

        try {
            barangaySelect.disabled = false;

            const response = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`);
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

    // Handle form submissions
    document.querySelectorAll('#addProfileForm, #updateProfileForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            const modal = this.closest('.modal');
            const province = modal.querySelector('select[name="province"]').options[modal.querySelector('select[name="province"]').selectedIndex].text;
            const city = modal.querySelector('select[name="city"]').options[modal.querySelector('select[name="city"]').selectedIndex].text;
            const barangay = modal.querySelector('select[name="barangay"]').options[modal.querySelector('select[name="barangay"]').selectedIndex].text;

            const addressInput = document.createElement('input');
            addressInput.type = 'hidden';
            addressInput.name = 'address';
            addressInput.value = `${barangay}, ${city}, ${province}`;
            this.appendChild(addressInput);
        });
    });
});
