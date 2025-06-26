<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kecamatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .kop-container {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .kop-logo,
        .empty {
            width: 80px;
            display: table-cell;
            text-align: center;
            vertical-align: top;
        }

        .kop-logo img {
            width: 80px;
            height: 80px;
        }

        .kop {
            display: table-cell;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            line-height: 1.4;
        }

        h2 {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .signature {
            text-align: right;
            margin-top: 60px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="kop-container">
        <div class="kop-logo">
            <img src="{{ public_path('logo.png') }}" alt="Logo">
        </div>
        <div class="kop">
            LAPORAN PERNIKAHAN PER KELURAHAN<br>
            KUA KECAMATAN {{ strtoupper($kecamatan) }}<br>
            TAHUN: {{ $tahun }}
        </div>
        <div class="empty"></div>
    </div>

    <h2>Distribusi Jumlah Pernikahan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kelurahan</th>
                <th>Jumlah Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_kelurahan }}</td>
                <td>{{ $item->jumlah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">Tidak ada data</td>
            </tr>
            @endforelse
            <tr style="font-weight: bold;">
                <td colspan="2">Total</td>
                <td>{{ $total }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p>Banjarbaru, {{ $tanggal_cetak }}</p>
        <br><br><br>
        <p><strong>Petugas KUA</strong></p>
    </div>
</body>

</html>