const combinedChart = new Chart(document.getElementById('combinedChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: [],
        datasets: [
            {
                label: 'New Customers',
                data: [],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: false,
                tension: 0.2
            },
            {
                label: 'Published Projects',
                data: [],
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                fill: false,
                tension: 0.2
            }
        ]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true } } }
});

async function loadCombinedChart(days) {
    const response = await fetch('{{ path("admin_stats_combined", {"days": "{days}"}) }}'.replace('{days}', days));
    const data = await response.json();

    combinedChart.data.labels = data.map(d => d.date);
    combinedChart.data.datasets[0].data = data.map(d => d.customers);
    combinedChart.data.datasets[1].data = data.map(d => d.projects);
    combinedChart.update();
}

function refreshAllCharts(showNotice = false) {
    const days = document.getElementById('periodSelect').value;

    loadChart('{{ path("admin_stats_customers", {"days": "{days}"}) }}', customersChart, days);
    loadChart('{{ path("admin_stats_projects", {"days": "{days}"}) }}', projectsChart, days);
    loadCombinedChart(days);

    if (showNotice) showToast();
}

