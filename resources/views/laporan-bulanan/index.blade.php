@extends('layouts.index')

@section('content')
<div class="container mx-auto px-4 py-6">
  <!-- Button to Add New Report -->


  <!-- Laporan DataTable -->


  <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
    <table id="laporanTable" class="min-w-full table-auto">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2 text-left">Tanggal Akses</th>
          <th class="px-4 py-2 text-left">Tahun</th>
          <th class="px-4 py-2 text-left">Bulan</th>
          <th class="px-4 py-2 text-left">Perkawinan</th>
          <th class="px-4 py-2 text-left">Peristiwa Perkawinan</th>
          <th class="px-4 py-2 text-left">Pendidikan Perkawinan</th>
          <th class="px-4 py-2 text-left">Kursus Calon Pengantin</th>
          <th class="px-4 py-2 text-left">Usia Pengantin</th>
          <th class="px-4 py-2 text-left">Status</th>
          <th class="px-4 py-2 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data rows will be populated by AJAX -->
      </tbody>
    </table>
  </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  let isAdmin = "{{ auth()->user()->role === 'admin' ? 'true' : 'false' }}";
  isAdmin = isAdmin === 'true';

  $(document).ready(function() {

    // Initialize DataTable with AJAX
    function loadTable(status = null) {
      $('#laporanTable').DataTable().destroy(); // Hapus instance DataTable sebelumnya
      $('#laporanTable').DataTable({
        processing: true,
        serverSide: true,
        paging: false, // Tampilkan semua data tanpa pagination
        searching: true,
        ordering: true,
        info: false,
        ajax: {
          url: `/api/laporan${status ? `?status=${status}` : '' }`,
          method: 'GET',
          dataSrc: function(json) {
            return json.map(function(laporan) {
              const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
              ];
              const bulan = monthNames[laporan.bulan - 1]; // Assuming bulan is in numeric format (1-12)

              let statusBadge = '';
              const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZone: 'Asia/Makassar', // WITA
                timeZoneName: 'short' // Menampilkan WITA
              };

              let formattedDate = new Intl.DateTimeFormat('id-ID', options).format(new Date(laporan
                .created_at));
              formattedDate = formattedDate.replace('WITA', 'Pukul').replace(/\./g,
                ':'); // Sesuaikan format

              switch (laporan.status) {
                case 'BELUM':
                  statusBadge = `<span class="px-3 py-1 text-sm font-medium text-gray-700 bg-gray-200 rounded-md">
                            ${laporan.status}
                        </span>`;
                  break;
                case 'DIPENDING':
                  statusBadge = `<span class="px-3 py-1 text-sm font-medium text-purple-700 bg-purple-200 rounded-md">
                            ${laporan.status}
                        </span>`;
                  break;
                case 'DIAJUKAN':
                  statusBadge = `<span class="px-3 py-1 text-sm font-medium text-blue-700 bg-blue-200 rounded-md">
                            ${laporan.status}
                        </span>`;
                  break;
                case 'DITOLAK':
                  statusBadge = `<span class="px-3 py-1 text-sm font-medium text-red-700 bg-red-200 rounded-md">
                            ${laporan.status}
                        </span>`;
                  break;
                case 'DISETUJUI':
                  statusBadge = `<span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-200 rounded-md">
                            ${laporan.status}
                        </span>`;
                  break;
                default:
                  statusBadge = `<span class="px-3 py-1 text-sm font-medium text-gray-700 bg-gray-200 rounded-md">
                            Tidak Diketahui
                        </span>`;
                  break;
              }

              return {
                created_at: formattedDate, // Menggunakan format Indonesia
                tahun: laporan.tahun,
                bulan: bulan,
                perkawinan: laporan.perkawinans.length > 0 ?
                  `<a href="/perkawinan/${laporan.id}" class="font-semibold text-green-600 hover:text-green-800">LIHAT DATA</a>` : `<a href="/perkawinan/${laporan.id}" class="font-semibold text-yellow-600 hover:text-yellow-800">ISI DATA</a>`,

                peristiwa_perkawinan: laporan.perkawinans.length > 0 ?
                  (laporan.perkawinans[0].peristiwa_perkawinan === null ?
                    `<a href="/peristiwa_perkawinan/${laporan.id}" class="font-semibold text-yellow-600 hover:text-yellow-800">ISI DATA</a>` :
                    `<a href="/peristiwa_perkawinan/${laporan.id}" class="font-semibold text-green-600 hover:text-green-800">LIHAT DATA</a>`
                  ) : `<p class="font-semibold text-center text-xs text-red-600 hover:text-red-800">ISI DATA PERKAWINAN TERLEBIH DAHULU</p>`,

                pendidikan_perkawinan: laporan.perkawinans.length > 0 ?
                  (laporan.perkawinans[0].pendidikan_perkawinan === null ?
                    `<a href="/pendidikan_perkawinan/${laporan.id}" class="font-semibold text-yellow-600 hover:text-yellow-800">ISI DATA</a>` :
                    `<a href="/pendidikan_perkawinan/${laporan.id}" class="font-semibold text-green-600 hover:text-green-800">LIHAT DATA</a>`
                  ) : `<p class="font-semibold text-center text-xs text-red-600 hover:text-red-800">ISI DATA PERKAWINAN TERLEBIH DAHULU</p>`,

                kursus_calon_pengantin: laporan.perkawinans.length > 0 ?
                  (laporan.perkawinans[0].kursus_calon_pengantin === null ?
                    `<a href="/kursus_calon_pengantin/${laporan.id}" class="font-semibold text-yellow-600 hover:text-yellow-800">ISI DATA</a>` :
                    `<a href="/kursus_calon_pengantin/${laporan.id}" class="font-semibold text-green-600 hover:text-green-800">LIHAT DATA</a>`
                  ) : `<p class="font-semibold text-center text-xs text-red-600 hover:text-red-800">ISI DATA PERKAWINAN TERLEBIH DAHULU</p>`,

                usia_pengantin: laporan.perkawinans.length > 0 ?
                  (laporan.perkawinans[0].usia_pengantin === null ?
                    `<a href="/usia_pengantin/${laporan.id}" class="font-semibold text-yellow-600 hover:text-yellow-800">ISI DATA</a>` :
                    `<a href="/usia_pengantin/${laporan.id}" class="font-semibold text-green-600 hover:text-green-800">LIHAT DATA</a>`
                  ) : `<p class="font-semibold text-center text-xs text-red-600 hover:text-red-800">ISI DATA PERKAWINAN TERLEBIH DAHULU</p>`,


                status: statusBadge,
                aksi: () => {
                  if (isAdmin) {
                    if (laporan.status === "DIAJUKAN" || laporan.status === "DIPENDING") {
                      return `
  <button class="w-full bg-blue-600 w-full hover:bg-blue-800 mb-2 cursor-pointer font-semibold text-sm text-white p-2 rounded-md shadow-md pending-btn" data-id="${laporan.id}">
    PENDING
</button><button class="w-full mb-2 bg-red-600 hover:bg-red-800 text-white font-semibold text-sm p-2 rounded-md shadow-md delete-laporan" 
        data-id="${laporan.id}">
        HAPUS
      </button><button class="w-full bg-green-600 w-full hover:bg-green-800 mb-2 cursor-pointer font-semibold text-sm text-white p-2 rounded-md shadow-md setujui-btn" data-id="${laporan.id}">
    SETUJUI
</button>
<button class="w-full bg-red-600 w-full hover:bg-red-800 cursor-pointer font-semibold text-sm text-white p-2 rounded-md shadow-md tolak-btn" data-id="${laporan.id}">
    TOLAK
</button>

  `
                    } else {
                      return ''
                    }
                  } else {
                    let button = `<button class="w-full mb-2 bg-red-600 hover:bg-red-800 text-white font-semibold text-sm p-2 rounded-md shadow-md delete-laporan" 
        data-id="${laporan.id}">
        HAPUS
      </button>`
                    if (laporan.status === 'DISETUJUI') {
                      button += `
        <a href="/laporan/cetak/${laporan.id}" class="w-full text-center block mb-2 bg-green-600 hover:bg-green-800 text-white font-semibold text-sm p-2 rounded-md shadow-md " target="_blank" 
        data-id="${laporan.id}">
        CETAK
      </a>
        `;
                    }
                    let buttonAjukan = '';
                    if (laporan.perkawinans.length > 0 && (laporan.status ===
                        'BELUM' || laporan.status ===
                        'DITOLAK')) {
                      if (laporan.perkawinans[0].usia_pengantin === null || laporan.perkawinans[0]
                        .kursus_calon_pengantin === null || laporan.perkawinans[0]
                        .pendidikan_perkawinan ===
                        null || laporan.perkawinans[0].peristiwa_perkawinan === null) {
                        buttonAjukan =
                          '<p class="w-full bg-blue-100 cursor-warning font-semibold text-sm text-white text-white p-2 rounded-md shadow-md">AJUKAN</p>'
                      } else {
                        buttonAjukan =
                          `<button class="w-full bg-blue-600 hover:bg-blue-800 cursor-pointer font-semibold text-sm text-white p-2 rounded-md shadow-md ajukan-btn" data-id="${laporan.id}">AJUKAN</button>`
                      }
                    }
                    return button + buttonAjukan;
                  }
                }
              };
            });
          }
        },
        columns: [{
            data: 'created_at',
            name: 'created_at'
          },
          {
            data: 'tahun',
            name: 'tahun'
          },
          {
            data: 'bulan',
            name: 'bulan'
          },
          {
            data: 'perkawinan',
            name: 'perkawinan'
          },
          {
            data: 'peristiwa_perkawinan',
            name: 'peristiwa_perkawinan'
          },
          {
            data: 'pendidikan_perkawinan',
            name: 'pendidikan_perkawinan'
          },
          {
            data: 'kursus_calon_pengantin',
            name: 'kursus_calon_pengantin'
          },
          {
            data: 'usia_pengantin',
            name: 'usia_pengantin'
          },
          {
            data: 'status',
            name: 'status',
            orderable: false,
            searchable: true,
            render: function(data, type, row) {
              return $(data).attr('data-filter') || data;
            }
          },
          {
            data: 'aksi',
            name: 'aksi',
            orderable: false,
            searchable: true
          }
        ]
      });
    }
    $('.filter-btn').click(function() {
      let status = $(this).data('status');
      loadTable(status);
    });
    if (isAdmin) {
      loadTable('DIAJUKAN');
    } else {
      loadTable();
    }
    $(document).on('click', '.setujui-btn', function() {

      var laporanId = $(this).data('id');

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Laporan akan disetujui!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Setujui!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/api/laporan/' + laporanId + '/setujui',
            type: 'POST',
            data: {
              _token: "{{ csrf_token() }}"
            },
            success: function(response) {
              Swal.fire(
                'Berhasil!',
                response.message,
                'success'
              ).then(() => {
                location.reload();
              });
            },
            error: function(xhr) {
              Swal.fire(
                'Gagal!',
                xhr.responseJSON.message,
                'error'
              );
            }
          });
        }
      });
    });
    $(document).on('click', '.tolak-btn', function() {

      // AJAX untuk Tolak
      var laporanId = $(this).data('id');

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Laporan akan ditolak!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Tolak!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/api/laporan/' + laporanId + '/tolak',
            type: 'POST',
            data: {
              _token: "{{ csrf_token() }}"
            },
            success: function(response) {
              Swal.fire(
                'Berhasil!',
                response.message,
                'success'
              ).then(() => {
                location.reload();
              });
            },
            error: function(xhr) {
              Swal.fire(
                'Gagal!',
                xhr.responseJSON.message,
                'error'
              );
            }
          });
        }
      });
    });

    $(document).on('click', '.pending-btn', function() {

      // AJAX untuk Tolak
      var laporanId = $(this).data('id');

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Laporan akan dipending!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Pending!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/api/laporan/' + laporanId + '/pending',
            type: 'POST',
            data: {
              _token: "{{ csrf_token() }}"
            },
            success: function(response) {
              Swal.fire(
                'Berhasil!',
                response.message,
                'success'
              ).then(() => {
                location.reload();
              });
            },
            error: function(xhr) {
              Swal.fire(
                'Gagal!',
                xhr.responseJSON.message,
                'error'
              );
            }
          });
        }
      });
    });
    // Function to handle "Ajukan" button click
    $(document).on('click', '.ajukan-btn', function() {
      let laporanId = $(this).data('id');

      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin mengajukan laporan ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ajukan'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/api/laporan/${laporanId}/ajukan`,
            method: 'POST',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              Swal.fire({
                title: 'Sukses!',
                text: 'Laporan berhasil diajukan.',
                icon: 'success'
              }).then(() => {
                $('#laporanTable').DataTable().ajax.reload();
              });
            },
            error: function(xhr) {
              Swal.fire({
                title: 'Gagal!',
                text: xhr.responseJSON.message || 'Terjadi kesalahan.',
                icon: 'error'
              });
            }
          });
        }
      });
    });


    $(document).on('click', '.delete-laporan', function() {
      let laporanId = $(this).data('id');
      Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus laporan ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/api/laporan/${laporanId}`,
            method: 'DELETE',
            data: {
              _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              Swal.fire({
                title: 'Terhapus!',
                text: 'Laporan berhasil dihapus.',
                icon: 'success'
              }).then(() => {
                $('#laporanTable').DataTable().ajax.reload();
              });
            },
            error: function() {
              Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menghapus laporan.',
                icon: 'error'
              });
            }
          });
        }
      });
    });

  });
</script>



@endsection