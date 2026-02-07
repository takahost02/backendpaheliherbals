<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Earnings Chart -->
<div class="col-12 col-md-6 mt-4">
    <div class="card shadow-sm border-0 p-4">
        <h5 class="mb-3">@lang('Earnings Distribution')</h5>
        <canvas id="earningsChart" height="200"></canvas>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('earningsChart').getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Binary', 'Direct', 'Matching', 'Rewards'],
            datasets: [{
                data: [
                    {{ $binaryIncome }},
                    {{ $directIncome }},
                    {{ $matchingBonus }},
                    {{ $rewardIncome }}
                ],
                backgroundColor: [
                    '#0d6efd',
                    '#198754',
                    '#ffc107',
                    '#0dcaf0'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
<script>
let earningsChart;

function updateChart(data) {
    if (!earningsChart) return;

    earningsChart.data.datasets[0].data = [
        data.binary,
        data.direct,
        data.matching,
        data.reward
    ];
    earningsChart.update();
}
</script>

