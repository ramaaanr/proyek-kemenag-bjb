@extends('layouts.index')

@section('content')
<div class="flex">
  <h2 class="text-2xl font-semibold ">Data Pernikahan</h2>

  <a href="/pernikahan/tambah"
    class="text-white ml-2 bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Tambah</a>
</div>
<table id="dataTable" class="" style="width:100%">
  <thead>
    <tr>
      <th>Nama Pria</th>
      <th>Tanggal Pernikahan</th>
      <th>Kelurahan</th>
      <th>Kecamatan</th>
      <th>Rujukan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <!-- Data akan diisi oleh DataTables -->
  </tbody>
</table>
<script>
$(document).ready(function() {
  // Inisialisasi DataTable dengan AJAX
  const table = $('#dataTable').DataTable({
    ajax: {
      url: '/api/pernikahan', // Ganti dengan URL API Anda
      dataSrc: 'data' // Properti 'data' dari JSON Anda
    },
    columns: [{
        data: 'pria.nama', // Menampilkan nama pria dari relasi
      },
      {
        data: 'tanggal_pernikahan',
        render: function(data) {
          // Konversi tanggal menggunakan Date dan Intl.DateTimeFormat
          const date = new Date(data);
          const options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
          };
          return new Intl.DateTimeFormat('id-ID', options).format(date);
        }
      },
      {
        data: 'nama_kelurahan'
      }, {
        data: 'nama_kecamatan'
      }, {
        data: 'hasil_rujukan'
      },

      {
        data: 'id',
        render: function(id) {
          // Tambahkan tombol Lihat, Edit, dan Hapus
          return `
            <a href="/pernikahan/lihat/${id}" class=" w-full block bg-blue-500 hover:bg-blue-700 block text-center text-white font-bold py-1 px-3 rounded mr-2">Lihat</a>
            <a href="/pernikahan/edit/${id}" class=" w-full block bg-yellow-300 mt-1 hover:bg-yellow-700 block text-center text-white font-bold py-1 px-3 rounded mr-2">Edit</a>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 mt-1 rounded w-full delete-button" data-id="${id}">Hapus</button>
          `;
        }
      }
    ]
  });

  $('#dataTable').on('click', '.delete-button', function() {
    const id = $(this).data('id'); // Ambil ID dari atribut data-id
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: 'Data ini akan dihapus secara permanen!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/api/pernikahan/${id}`, // URL API DELETE
          type: 'DELETE',
          success: function(response) {
            Swal.fire(
              'Berhasil!',
              'Data berhasil dihapus.',
              'success'
            );
            table.ajax.reload(); // Reload DataTable
          },
          error: function(xhr, status, error) {
            Swal.fire(
              'Gagal!',
              'Terjadi kesalahan saat menghapus data.',
              'error'
            );
          }
        });
      }
    });
  });
});
</script>

@endsection