$(document).ready(function() {
    // API URLs for Philippine addresses
    const BASE_URL = 'https://ph-locations-api.buonzz.com/v1';
    let provinces = [];
    let cities = [];
    let barangays = [];

    // Function to load provinces
    function loadProvinces() {
        $.ajax({
            url: `${BASE_URL}/provinces`,
            method: 'GET',
            success: function(response) {
                provinces = response.data;
                $('#province').empty().append('<option value="">Select Province</option>');
                provinces.sort((a, b) => a.name.localeCompare(b.name)).forEach(function(province) {
                    $('#province').append(`<option value="${province.name}">${province.name}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading provinces:', error);
            }
        });
    }

    // Function to load cities
    function loadCities(province) {
        $.ajax({
            url: `${BASE_URL}/cities`,
            method: 'GET',
            success: function(response) {
                cities = response.data.filter(city => city.province === province);
                $('#city').empty().append('<option value="">Select City/Municipality</option>');
                cities.sort((a, b) => a.name.localeCompare(b.name)).forEach(function(city) {
                    $('#city').append(`<option value="${city.name}">${city.name}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading cities:', error);
            }
        });
    }

    // Function to load barangays
    function loadBarangays(city) {
        $.ajax({
            url: `${BASE_URL}/barangays`,
            method: 'GET',
            success: function(response) {
                barangays = response.data.filter(barangay => barangay.city === city);
                $('#barangay').empty().append('<option value="">Select Barangay</option>');
                barangays.sort((a, b) => a.name.localeCompare(b.name)).forEach(function(barangay) {
                    $('#barangay').append(`<option value="${barangay.name}">${barangay.name}</option>`);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading barangays:', error);
            }
        });
    }

    // Event listeners
    $('#province').on('change', function() {
        const selectedProvince = $(this).val();
        if (selectedProvince) {
            loadCities(selectedProvince);
            $('#city').val('');
            $('#barangay').empty().append('<option value="">Select Barangay</option>');
        }
        updateFullAddress();
    });

    $('#city').on('change', function() {
        const selectedCity = $(this).val();
        if (selectedCity) {
            loadBarangays(selectedCity);
            $('#barangay').val('');
        }
        updateFullAddress();
    });

    $('#barangay').on('change', function() {
        updateFullAddress();
    });

    // Function to update full address
    function updateFullAddress() {
        const streetAddress = $('#street_address').val();
        const barangay = $('#barangay').val();
        const city = $('#city').val();
        const province = $('#province').val();

        let addressParts = [];
        if (streetAddress) addressParts.push(streetAddress);
        if (barangay) addressParts.push('Barangay ' + barangay);
        if (city) addressParts.push(city);
        if (province) addressParts.push(province);

        const fullAddress = addressParts.join(', ');
        $('#address').val(fullAddress);
    }

    // Load provinces on page load
    loadProvinces();

    // If there are existing values, set them
    if ($('#province').data('value')) {
        $('#province').val($('#province').data('value')).trigger('change');
    }
});
