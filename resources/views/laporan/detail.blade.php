@extends('layouts.index')

@section('content')
<div class="flex">
  <h2 class="text-2xl font-semibold ">Data Laporan Pernikahan</h2>

</div>
<table id="pernikahanTable">
  <thead>
    <tr>
      <th>Nama Pria</th>
      <th>Tanggal Pernikahan</th>
      <th>Kecamatan</th>
      <th>Tempat Pernikahan</th>
      <th>Lihat</th>
    </tr>
  </thead>
  <tbody>
    <!-- Data akan dimuat oleh DataTable -->
  </tbody>
</table>
<script>
$(document).ready(function() {
  const urlPath = window.location.pathname; // Menangkap path URL
  const urlSegments = urlPath.split('/'); // Memecah path menjadi array berdasarkan '/'
  const id = urlSegments[urlSegments.length - 1];

  // Initialize DataTable with AJAX
  $('#pernikahanTable').DataTable({
    ajax: {
      url: `/api/laporan/${id}`,
      dataSrc: 'data' // Field data yang dikembalikan oleh JSON response
    },
    columns: [{
        data: 'nama_pria',
        name: 'nama_pria'
      },
      {
        data: 'tanggal_pernikahan',
        name: 'tanggal_pernikahan'
      },
      {
        data: 'kecamatan',
        name: 'kecamatan'
      },
      {
        data: 'tempat_pernikahan',
        name: 'tempat_pernikahan'
      },
      {
        // Kolom Aksi dengan tombol "Lihat"
        data: 'id', // ID dari data pernikahan yang dikembalikan oleh API
        render: function(data, type, row) {
          // Tombol "Lihat" yang mengarahkan ke URL berdasarkan ID
          return `<a href="/pernikahan/lihat/${data}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Lihat</a>`;
        }
      }
    ]
  });
});
</script>

@endsection