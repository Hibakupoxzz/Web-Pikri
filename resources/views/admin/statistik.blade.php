@extends('layout')

@section('title', 'Statistik Penjualan Harian - Toko Sparepart Sepeda')

@section('content')

<style>
.statistik-wrapper {
    padding: 60px 20px;
    min-height: 80vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    color: white;
}
.statistik-card {
    width: 90%;
    max-width: 900px;
    background: rgba(30, 30, 30, 0.95);
    backdrop-filter: blur(6px);
    border-radius: 16px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.6);
    padding: 40px;
    margin-bottom: 30px;
    text-align: center;
    animation: fadeIn 0.6s ease;
}
.statistik-card h2 {
    color: #ff6f61;
    font-weight: 700;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
canvas {
    margin-top: 40px;
}
</style>

<div class="statistik-wrapper">
    <div class="statistik-card">
        <h2>Total Pendapatan</h2>
        <h1 style="color:#ff6f61; font-size: 36px;">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </h1>
    </div>

    <div class="statistik-card">
        <h2>Grafik Pendapatan Harian</h2>
        <canvas id="grafikPendapatan" height="130"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('grafikPendapatan');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Pendapatan Harian (Rp)',
            data: {!! json_encode($pendapatanData) !!},
            fill: true,
            borderColor: '#ff6f61',
            backgroundColor: 'rgba(255, 111, 97, 0.15)',
            tension: 0.4,
            borderWidth: 3,
            pointBackgroundColor: '#ff6f61',
            pointBorderColor: '#fff',
            pointHoverRadius: 8,
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 2000,
            easing: 'easeOutQuart'
        },
        scales: {
            x: {
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#ccc' }
            },
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#ccc' }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#1c1c1c',
                titleColor: '#ff6f61',
                bodyColor: '#fff',
                padding: 12
            }
        }
    }
});
</script>

@endsection
