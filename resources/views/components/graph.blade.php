<div class="box graph-section">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-chart-simple fa-2x" style="color: white;"></i>
            <h2 class="ms-2 fw-bold">GRAPH</h2>
        </div>
        <a href="{{ route('feedbackhistory') }}" class="btn btn-sm btn-info fw-bold btn-history"
            style="color: white; border-radius: 15px; background-color: #1D80E7;">
            HISTORY
        </a>
    </div>
    <canvas id="myChart" style="height: 460px !important; width: 100% !important;"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['S', 'W', 'L', 'R', 'G'],
            datasets: [{
                label: 'Score',
                data: [
                    {{ $speakingAvg }}, // S
                    {{ $writingAvg }}, // W
                    {{ $listeningAvg }}, // L
                    {{ $readingAvg }}, // R
                    {{ $grammarAvg }}, // G
                ],
                backgroundColor: [
                    '#72ADF5',
                    '#CEEA87',
                    '#D98AD9',
                    '#E59494',
                    '#93ECE1'
                ],
                borderSkipped: false,

                barThickness: 40,
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        color: '#fff'
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.1)'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#fff'
                    },
                    grid: {
                        color: 'rgba(255,255,255,0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
        }
    });
</script>
