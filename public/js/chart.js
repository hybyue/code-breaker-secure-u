const ctx = document.getElementById('visitorChart').getContext('2d');
let visitorChart;

function fetchData(timePeriod) {
    // Update the time label
    const timeLabel = document.getElementById('timeLabel');
    timeLabel.textContent = `${capitalizeFirstLetter(timePeriod)} Statistics`;

    // Update button colors
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.classList.remove('bg-blue-700', 'bg-blue-500');
        button.classList.add('bg-blue-500');
    });

    document.getElementById(`${timePeriod}Btn`).classList.remove('bg-blue-500');
    document.getElementById(`${timePeriod}Btn`).classList.add('bg-blue-700');

    // Fetch data based on the time period (weekly, monthly, yearly)
    fetch(`/visitor-data?timePeriod=${timePeriod}`)
        .then(response => response.json())
        .then(data => {
            updateChart(timePeriod, data.labels, data.visitor, data.passSlip, data.lost, data.violation);
        })
        .catch(error => console.error('Error fetching data:', error));
}

function updateChart(timePeriod, labels, visitors, pass_slips, lost_found, violations) {
    // Format labels for months if 'monthly' is selected
    if (timePeriod === 'monthly') {
        labels = labels.map(monthNum => {
            return new Date(0, monthNum - 1).toLocaleString('en-US', { month: 'long' });
        });
    }

    // Destroy the previous chart instance if it exists
    if (visitorChart) {
        visitorChart.destroy();
    }

    // Create a new chart instance
    visitorChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
            {
                label: 'Visitor',
                data: visitors,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            },
            {
                label: 'Pass Slips',
                data: pass_slips,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            },
            {
                label: 'Lost and Found',
                data: lost_found,
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 2
            },
            {
                label: 'Violations',
                data: violations,
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2
            }
        ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// Initial load with monthly data
fetchData('monthly');















const ctxPie = document.getElementById('visitorPieChart').getContext('2d');
let visitorPieChart;

function fetchTotalData() {
    fetch('/visitor-total-data')
        .then(response => response.json())
        .then(data => {
            updatePieChart(data.visitor, data.passSlip, data.lost, data.violation);
        })
        .catch(error => console.error('Error fetching total data:', error));
}

function updatePieChart(visitors, pass_slips, lost_found, violations) {
    // Calculate the total sum
    const totalSum = visitors + pass_slips + lost_found + violations;

    // Destroy the previous pie chart instance if it exists
    if (visitorPieChart) {
        visitorPieChart.destroy();
    }

    // Create a new pie chart instance
    visitorPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Visitors', 'Pass Slips', 'Lost and Found', 'Violations'],
            datasets: [{
                data: [visitors, pass_slips, lost_found, violations],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const value = tooltipItem.raw;
                            const percentage = ((value / totalSum) * 100).toFixed(2);
                            return `${tooltipItem.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

// Load total data for the pie chart on page load
fetchTotalData();
