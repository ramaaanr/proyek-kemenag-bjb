<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Laporan Bulanan Pernikahan</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    margin: 20px;
  }

  .kop-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    background-color: #4648CFFF;
  }

  .kop-logo img {
    width: 80px;
    height: 80px;
    object-fit: contain;
  }

  .kop {
    width: 500px;
    text-align: center;
    font-weight: bold;
    font-size: 14px;
    line-height: 1.4;
    background-color: #91C21EFF;
  }

  .empty {
    width: 80px;
    height: 80px;
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
  <table style="width: 100%; margin-bottom: 20px; border-collapse: collapse;" border="0">
    <tr>
      <td style="width: 80px; text-align: center; border: none;">
        <img src="{{ public_path('logo.png') }}" width="80" height="80" alt="Logo">
      </td>
      <td style="text-align: center; border: none;">
        <div style="font-weight: bold; font-size: 14px;">
          {{ $title ?? 'Laporan Bulanan' }}<br>
          KUA KECAMATAN CEMPAKA KOTA BANJARBARU<br>
          BULAN: {{ strtoupper($bulan ?? '-') }} {{ $tahun ?? '-' }}
        </div>
      </td>
      <td style="width: 80px; border: none;"></td>
    </tr>
  </table>



  <h2>Laporan Jumlah Pernikahan Bulanan</h2>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Jumlah Pernikahan</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($data as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ \Carbon\Carbon::parse($item->bulan)->translatedFormat('F Y') }}</td>
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