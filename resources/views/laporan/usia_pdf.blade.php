<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
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
            padding: 5px;
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

    <h2>Laporan Usia Pernikahan per Kelurahan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kelurahan</th>
                <th>Jml Pernikahan</th>
                <th>Pria &lt;19</th>
                <th>Pria 19–21</th>
                <th>Pria 22–30</th>
                <th>Pria &gt;30</th>
                <th>Perempuan &lt;19</th>
                <th>Perempuan 19–21</th>
                <th>Perempuan 22–30</th>
                <th>Perempuan &gt;30</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total_pernikahan = 0;
            $sum_pria_u19 = 0;
            $sum_pria_19_21 = 0;
            $sum_pria_21_30 = 0;
            $sum_pria_o30 = 0;
            $sum_perempuan_u19 = 0;
            $sum_perempuan_19_21 = 0;
            $sum_perempuan_21_30 = 0;
            $sum_perempuan_o30 = 0;
            @endphp

            @foreach($data as $index => $item)
            @php
            $total_pernikahan += $item->total_pernikahan;
            $sum_pria_u19 += $item->pria_u19;
            $sum_pria_19_21 += $item->pria_19_21;
            $sum_pria_21_30 += $item->pria_21_30;
            $sum_pria_o30 += $item->pria_o30;
            $sum_perempuan_u19 += $item->perempuan_u19;
            $sum_perempuan_19_21 += $item->perempuan_19_21;
            $sum_perempuan_21_30 += $item->perempuan_21_30;
            $sum_perempuan_o30 += $item->perempuan_o30;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_kelurahan }}</td>
                <td>{{ $item->total_pernikahan }}</td>
                <td>{{ $item->pria_u19 }}</td>
                <td>{{ $item->pria_19_21 }}</td>
                <td>{{ $item->pria_21_30 }}</td>
                <td>{{ $item->pria_o30 }}</td>
                <td>{{ $item->perempuan_u19 }}</td>
                <td>{{ $item->perempuan_19_21 }}</td>
                <td>{{ $item->perempuan_21_30 }}</td>
                <td>{{ $item->perempuan_o30 }}</td>
            </tr>
            @endforeach

            <!-- Baris total -->
            <tr>
                <th colspan="2">Total</th>
                <th>{{ $total_pernikahan }}</th>
                <th>{{ $sum_pria_u19 }}</th>
                <th>{{ $sum_pria_19_21 }}</th>
                <th>{{ $sum_pria_21_30 }}</th>
                <th>{{ $sum_pria_o30 }}</th>
                <th>{{ $sum_perempuan_u19 }}</th>
                <th>{{ $sum_perempuan_19_21 }}</th>
                <th>{{ $sum_perempuan_21_30 }}</th>
                <th>{{ $sum_perempuan_o30 }}</th>
            </tr>
        </tbody>
    </table>
</body>

</html>