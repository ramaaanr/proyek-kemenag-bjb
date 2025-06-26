<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
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
            margin-top: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="kop-container">
        <div class="kop-logo">
            <img src="{{ public_path('logo.png') }}" alt="Logo">
        </div>
        <div class="kop">
            {{ $title }}<br>KUA KOTA BANJARBARU<br>TAHUN: {{ $tahun }}
        </div>
        <div class="empty"></div>
    </div>

    <h2>Laporan Pendidikan Pasangan per Kelurahan</h2>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Kelurahan</th>
                <th rowspan="2">Jumlah</th>
                <th colspan="{{ count($pendidikanLevels) }}">Pendidikan Pria</th>
                <th colspan="{{ count($pendidikanLevels) }}">Pendidikan Perempuan</th>
            </tr>
            <tr>
                @foreach ($pendidikanLevels as $level)
                <th>{{ $level }}</th>
                @endforeach
                @foreach ($pendidikanLevels as $level)
                <th>{{ $level }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
            $total = ['jumlah_pernikahan' => 0];
            foreach ($pendidikanLevels as $level) {
            $total["pria_$level"] = 0;
            $total["perempuan_$level"] = 0;
            }
            @endphp

            @foreach ($data as $item)
            @php
            $total['jumlah_pernikahan'] += $item->jumlah_pernikahan;
            foreach ($pendidikanLevels as $level) {
            $total["pria_$level"] += $item->{"pria_$level"};
            $total["perempuan_$level"] += $item->{"perempuan_$level"};
            }
            @endphp
            <tr>
                <td>{{ $item->nama_kelurahan }}</td>
                <td>{{ $item->jumlah_pernikahan }}</td>
                @foreach ($pendidikanLevels as $level)
                <td>{{ $item->{"pria_$level"} }}</td>
                @endforeach
                @foreach ($pendidikanLevels as $level)
                <td>{{ $item->{"perempuan_$level"} }}</td>
                @endforeach
            </tr>
            @endforeach

            <tr style="font-weight: bold;">
                <td>Total</td>
                <td>{{ $total['jumlah_pernikahan'] }}</td>
                @foreach ($pendidikanLevels as $level)
                <td>{{ $total["pria_$level"] }}</td>
                @endforeach
                @foreach ($pendidikanLevels as $level)
                <td>{{ $total["perempuan_$level"] }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</body>

</html>