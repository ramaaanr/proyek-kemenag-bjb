@extends('layouts.index')

@section('content')
<h2 class="text-xl font-bold mb-4">📊 Dashboard Pernikahan 2025</h2>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <x-card icon="👨" label="Jumlah Pria" :value="$pria" :percent="($pria / $total * 100)" />
    <x-card icon="👩" label="Jumlah Wanita" :value="$wanita" :percent="($wanita / $total * 100)" />
    <x-card icon="👥" label="Total Pernikahan" :value="$pernikahan" />
    <x-card icon="🎓" label="Pendidikan" :value="array_sum($pendidikan->pluck('jumlah')->toArray())" />
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div>
        <h3 class="font-semibold text-sm mb-2">Komposisi Pernikahan per Kelurahan</h3>
        <canvas id="chartKelurahan"></canvas>
    </div>
    <div>
        <h3 class="font-semibold text-sm mb-2">Laporan Lengkap</h3>
        <ul class="list-disc ml-5 text-sm">
            <li><a href="{{ route('laporan.tren') }}" class="text-blue-600 hover:underline">📈 Tren Pernikahan</a></li>
            <li><a href="{{ route('laporan.peta') }}" class="text-blue-600 hover:underline">🗺️ Peta Pernikahan</a></li>
            <li><a href="{{ route('laporan.pendidikan') }}" class="text-blue-600 hover:underline">🎓 Pendidikan per Kelurahan</a></li>
        </ul>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    console.log(<?php echo json_encode($per_kelurahan); ?>, )
    const ctx = document.getElementById('chartKelurahan');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($per_kelurahan->pluck("nama_kelurahan")); ?>,
            datasets: [{
                data: <?php echo json_encode($per_kelurahan->pluck('jumlah')); ?>,
                backgroundColor: ['#f87171', '#60a5fa', '#34d399', '#facc15', '#c084fc', '#f472b6'],
            }]
        },
    });
</script>

@endsection
@section('scripts')