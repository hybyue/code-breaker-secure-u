const ctx = document.getElementById('visitorChart').getContext('2d');
let visitorChart;

function showLoader(chartType) {
    const loader = document.getElementById(chartType === 'bar' ? 'barChartLoader' : 'pieChartLoader');
    loader.classList.remove('d-none');
}

function hideLoader(chartType) {
    const loader = document.getElementById(chartType === 'bar' ? 'barChartLoader' : 'pieChartLoader');
    loader.classList.add('d-none');
}

function fetchData(timePeriod) {
    const timeLabel = document.getElementById('timeLabel');
    timeLabel.textContent = `${capitalizeFirstLetter(timePeriod)} Statistics`;

    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.classList.remove('btn-dark');
        button.classList.add('btn-secondary');
    });

    document.getElementById(`${timePeriod}Btn`).classList.remove('btn-secondary');
    document.getElementById(`${timePeriod}Btn`).classList.add('btn-dark');

    showLoader('bar');
    fetch(`/admin/visitor-data?timePeriod=${timePeriod}`)
        .then(response => response.json())
        .then(data => {
            updateChart(timePeriod, data.labels, data.visitor, data.passSlip, data.lost, data.violation);
        })
        .catch(error => console.error('Error fetching data:', error))
        .finally(() => hideLoader('bar'));
}

function updateChart(timePeriod, labels, visitors, pass_slips, lost_found, violations) {
    if (visitorChart) {
        visitorChart.destroy();
    }

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
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            const value = tooltipItem.raw;
                            return `${tooltipItem.dataset.label}: ${value}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
}

const ctxPie = document.getElementById('visitorPieChart').getContext('2d');
let visitorPieChart;

function fetchTotalData() {
    showLoader('pie');
    fetch('/admin/visitor-total-data')
        .then(response => response.json())
        .then(data => {
            updatePieChart(data.visitor, data.passSlip, data.lost, data.violation);
        })
        .catch(error => console.error('Error fetching total data:', error))
        .finally(() => hideLoader('pie'));
}

function updatePieChart(visitors, pass_slips, lost_found, violations) {
    const totalSum = visitors + pass_slips + lost_found + violations;

    if (visitorPieChart) {
        visitorPieChart.destroy();
    }

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
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14
                        }
                    }
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

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

document.addEventListener('DOMContentLoaded', function () {
    fetchData('monthly');
    fetchTotalData();
});

