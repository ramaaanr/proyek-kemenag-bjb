<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
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
            vertical-align: top;
            text-align: center;
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
        }

        h2 {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
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
            {{ $title }}<br>
            KUA KOTA BANJARBARU<br>
            Tahun: {{ $tahun }}
        </div>
        <div class="empty"></div>
    </div>

    <h2>Laporan Jumlah Pernikahan per User</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Operator</th>
                <th>Kecamatan</th>
                <th>Jumlah Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->nama_pengguna }}</td>
                <td>{{ $item->nama_kecamatan }}</td>
                <td>{{ $item->jumlah }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature">
        <p>Banjarbaru, {{ $tanggal_cetak }}</p>
        <br><br><br>
        <p><strong>Petugas KUA</strong></p>
    </div>
</body>

</html>