@extends('layouts.index')

@section('content')
<div class="flex">
  <h2 class="text-2xl font-semibold ">Review Laporan Bidang</h2>
</div>

<table id="laporanReviewTable" class="table table-bordered">
  <thead>
    <tr>
      <th>Status</th>
      <th>Nama</th>
      <th>Jumlah</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <!-- Data akan dimuat menggunakan AJAX -->
  </tbody>
</table>

<script>
$(document).ready(function() {
  // Inisialisasi DataTable dengan AJAX
  $('#laporanReviewTable').DataTable({
    ajax: {
      url: `/api/laporan`, // URL API untuk mengambil data laporan
      dataSrc: 'data' // Menggunakan "data" dari respons JSON
    },
    columns: [{
        data: 'status',
        render: function(data, type, row) {
          // Menggunakan badge dengan warna berdasarkan status
          var badgeClass = '';
          var statusText = '';

          switch (data) {
            case 'belum_dikirim':
              badgeClass = 'bg-gray-500'; // Abu
              statusText = 'Belum Dikirim';
              break;
            case 'dikirim':
              badgeClass = 'bg-blue-500'; // Biru
              statusText = 'Dikirim';
              break;
            case 'ditolak':
              badgeClass = 'bg-red-500'; // Merah
              statusText = 'Ditolak';
              break;
            case 'disetujui':
              badgeClass = 'bg-green-500'; // Hijau
              statusText = 'Disetujui';
              break;
            default:
              badgeClass = 'bg-gray-300'; // Default warna
              statusText = 'Tidak Diketahui';
          }

          // Mengembalikan badge dengan class warna dan status
          return '<span class="inline-block py-1 px-3 text-white rounded-full ' + badgeClass + '">' +
            statusText + '</span>';
        }
      },
      {
        data: 'nama'
      },
      {
        data: 'jumlah'
      },
      {
        data: 'id',
        render: function(data, type, row) {
          var disetujuiButton =
            '<button class="approve-button focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" ' +
            (row.status === 'belum_dikirim' || row.status === 'disetujui' || row.status === 'ditolak' ?
              'disabled' : '') + ' data-id="' + data + '">Disetujui</button>';

          var ditolakButton =
            '<button class="reject-button focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" ' +
            (row.status === 'belum_dikirim' || row.status === 'disetujui' || row.status === 'ditolak' ?
              'disabled' : '') + ' data-id="' + data + '">Ditolak</button>';

          var lihatButton =
            '<a href="/laporan-bulanan/lihat/' + data +
            '" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Lihat</a>';

          // Jika sudah disetujui atau ditolak, hanya tombol Lihat yang aktif
          if (row.status === 'disetujui' || row.status === 'ditolak') {
            return lihatButton;
          }
          return disetujuiButton + ' ' + ditolakButton + ' ' + lihatButton;
        }
      }
    ]
  });

  // Event untuk menandai laporan sebagai Disetujui
  $('#laporanReviewTable').on('click', '.approve-button', function() {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: 'Anda akan menyetujui laporan ini!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, setujui!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/api/laporan/${id}?_method=PUT`, // URL API untuk update data
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            status: 'disetujui' // Ubah status menjadi disetujui
          }),
          success: function(response) {
            Swal.fire(
              'Disetujui!',
              'Laporan telah disetujui.',
              'success'
            );
            $('#laporanReviewTable').DataTable().ajax.reload();
          },
          error: function(xhr, status, error) {
            Swal.fire(
              'Gagal!',
              'Terjadi kesalahan saat menyetujui laporan.',
              'error'
            );
          }
        });
      }
    });
  });

  // Event untuk menandai laporan sebagai Ditolak
  $('#laporanReviewTable').on('click', '.reject-button', function() {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Apakah Anda yakin?',
      text: 'Anda akan menolak laporan ini!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, tolak!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `/api/laporan/${id}?_method=PUT`,
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            status: 'ditolak' // Ubah status menjadi ditolak
          }),
          success: function(response) {
            Swal.fire(
              'Ditolak!',
              'Laporan telah ditolak.',
              'success'
            );
            $('#laporanReviewTable').DataTable().ajax.reload();
          },
          error: function(xhr, status, error) {
            Swal.fire(
              'Gagal!',
              'Terjadi kesalahan saat menolak laporan.',
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