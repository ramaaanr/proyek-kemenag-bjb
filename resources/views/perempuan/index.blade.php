@extends('layouts.index')

@section('content')
<div class="flex">
  <h2 class="text-2xl font-semibold ">Data Mempelai Perempuan</h2>

  <a href="/perempuan/tambah"
    class="text-white ml-2 bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Tambah</a>

</div>
<table id="dataTable" class="" style="width:100%">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Usia</th>
      <th>Pendidikan</th>
      <th>Sertifikasi Sucatin</th>
      <th>Kewarganegaraan</th>
      <th>Dibuat</th>
      <th>Diperbarui</th>
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
        url: '/api/perempuans', // Ganti dengan URL API Anda jika menggunakan server (misalnya, /api/perempuan)
        dataSrc: 'data' // Properti 'data' dari JSON Anda
      },
      columns: [{
          data: 'nama'
        },
        {
          data: 'usia'
        },
        {
          data: 'pendidikan'
        },
        {
          data: 'sertif_sucatin',
          render: function(data) {
            // Ubah "Ya" atau "Tidak" menjadi label
            return data === "true" ? '<span style="color: green;">Ya</span>' :
              '<span style="color: red;">Tidak</span>';
          }
        }, {
          data: 'kewarganegaraan',
        },
        {
          data: 'created_at',
          render: function(data) {
            // Konversi tanggal menggunakan Date dan Intl.DateTimeFormat
            const date = new Date(data);
            const options = {
              day: 'numeric',
              month: 'long',
              year: 'numeric',
              hour: '2-digit',
              minute: '2-digit',
              timeZone: 'Asia/Makassar',
              timeZoneName: 'short'
            };
            const formattedDate = new Intl.DateTimeFormat('id-ID', options).format(date);
            return formattedDate.replace('WITA', 'WITA'); // WITA akan tetap WITA
          }
        },
        {
          data: 'updated_at',
          render: function(data) {
            // Konversi tanggal menggunakan metode yang sama
            const date = new Date(data);
            const options = {
              day: 'numeric',
              month: 'long',
              year: 'numeric',
              hour: '2-digit',
              minute: '2-digit',
              timeZone: 'Asia/Makassar',
              timeZoneName: 'short'
            };
            const formattedDate = new Intl.DateTimeFormat('id-ID', options).format(date);
            return formattedDate.replace('WITA', 'WITA'); // WITA tetap WITA
          }
        },
        {
          data: 'id',
          render: function(id) {
            // Tambahkan tombol Edit dan Delete
            return `
            <a href="/perempuan/edit/${id}" class="bg-blue-500 hover:bg-blue-700  block text-center text-white w-full font-bold py-1 px-3 rounded mr-2">Edit</a>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 mt-1 rounded w-full delete-button" data-id="${id}">Delete</button>
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
            url: `/api/perempuans/${id}`, // URL API DELETE
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