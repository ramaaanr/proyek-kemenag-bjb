<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Tahunan Pernikahan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
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

        .kop-container {
            width: 100%;
            margin-bottom: 20px;
        }

        .kop-table {
            width: 100%;
        }

        .kop-table td {
            vertical-align: middle;
        }

        .kop-logo img {
            width: 80px;
            height: 80px;
        }

        .kop-title {
            font-weight: bold;
            font-size: 14px;
            text-align: center;
            line-height: 1.5;
        }

        h2 {
            text-align: center;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .signature {
            text-align: right;
            margin-top: 60px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <table style="width: 100%; margin-bottom: 20px; border-collapse: collapse;" border="0">
        <tr>
            <td style="width: 80px; text-align: center; border: none;">
                <img src="{{ public_path('logo.png') }}" width="80" height="80" alt="Logo">
            </td>
            <td style="text-align: center; border: none;">
                <div style="font-weight: bold; font-size: 14px;">
                    {{ $title ?? 'Laporan Bulanan' }}<br>
                    KUA KOTA BANJARBARU<br>
                </div>
            </td>
            <td style="width: 80px; border: none;"></td>
        </tr>
    </table>

    <h2>Laporan Jumlah Pernikahan Tahunan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Jumlah Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->tahun }}</td>
                <td>{{ $item->jumlah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature">
        <p>Banjarbaru, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p><strong>Petugas KUA</strong></p>
    </div>

</body>

</html>