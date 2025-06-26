@extends('layouts.index')

@section('content')
<div class="mb-4">
    <h2 class="text-xl font-bold">Laporan Tren Pernikahan</h2>

    <form method="GET" class="mb-4 flex items-center gap-2">
        <label for="tahun" class="text-sm">Pilih Tahun:</label>
        <select name="tahun" id="tahun" onchange="this.form.submit()" class="border px-2 py-1 text-sm rounded">
            @foreach($list_tahun as $thn)
            <option value="{{ $thn }}" {{ $thn == $tahunDipilih ? 'selected' : '' }}>{{ $thn }}</option>
            @endforeach
        </select>
    </form>
</div>

<div class="grid md:grid-cols-2 gap-6">
    <!-- Grafik Bulanan -->
    <div>
        <h3 class="text-sm font-semibold mb-2">Tren Bulanan Tahun {{ $tahunDipilih }}</h3>
        <canvas id="chartBulanan"></canvas>
    </div>

    <!-- Grafik Tahunan -->
    <div>
        <h3 class="text-sm font-semibold mb-2">Tren Tahunan</h3>
        <canvas id="chartTahunan"></canvas>
    </div>
    <div class="flex gap-4">
        <button onclick="downloadPDF('chartBulanan', 'laporan-tren-bulanan-{{ $tahunDipilih }}.pdf')" class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded shadow flex items-center gap-1">
            <span class="material-symbols-outlined text-base">picture_as_pdf</span> Export Grafik Bulanan
        </button>

        <button onclick="downloadPDF('chartTahunan', 'laporan-tren-tahunan.pdf')" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded shadow flex items-center gap-1">
            <span class="material-symbols-outlined text-base">picture_as_pdf</span> Export Grafik Tahunan
        </button>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    function downloadPDF(canvasId, filename) {
        const canvas = document.getElementById(canvasId);
        const chartImage = canvas.toDataURL("image/png", 1.0);

        const {
            jsPDF
        } = window.jspdf;
        const pdf = new jsPDF();

        pdf.text("Laporan Tren Pernikahan", 10, 10);
        pdf.addImage(chartImage, 'PNG', 10, 20, 180, 100);
        pdf.save(filename);
    }
    document.addEventListener('DOMContentLoaded', function() {
        console.log("test");
        const ctxBulanan = document.getElementById('chartBulanan');
        if (ctxBulanan) {
            new Chart(ctxBulanan, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($bulanan['labels']); ?>,
                    datasets: [{
                        label: 'Jumlah Pernikahan',
                        data: <?php echo json_encode($bulanan['data']); ?>,
                        borderColor: 'rgb(75, 192, 192)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    }]
                }
            });
        }

        const ctxTahunan = document.getElementById('chartTahunan');
        if (ctxTahunan) {
            new Chart(ctxTahunan, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($tahunan->pluck('tahun')); ?>,
                    datasets: [{
                        label: 'Jumlah Pernikahan',
                        data: <?php echo json_encode($tahunan->pluck('jumlah')); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                }
            });
        }

    });
</script>
@section('scripts')

@endsection