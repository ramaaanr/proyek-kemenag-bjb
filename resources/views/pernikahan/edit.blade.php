@extends('layouts.index')

@section('content')
<h2 class="text-2xl font-semibold text-gray-700 mb-4">Edit Data Pernikahan</h2>

<!-- Informasi Pria dan Perempuan -->
<div class="mb-6">
  <p><strong>Nama Pria:</strong> <span id="nama-pria" class="text-gray-700"></span></p>
  <p><strong>Nama Perempuan:</strong> <span id="nama-perempuan" class="text-gray-700"></span></p>
</div>

<!-- Form Edit Pernikahan -->
<form id="edit-pernikahan-form">
  <div class="mb-4">
    <label for="tanggal_pernikahan" class="block text-gray-600 font-medium">Tanggal Pernikahan</label>
    <input type="date" id="tanggal_pernikahan" name="tanggal_pernikahan"
      class="w-full border-gray-300 rounded-md shadow-sm">
  </div>

  <div class="mb-4 mt-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="tempat_bikah">Tempat Nikah</label>
    <select id="tempat_pernikahan" name="tempat_pernikahan" required
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      <option value="" disabled selected>Pilih Tempat Nikah</option>
      <option value="Didalam KUA">Didalam KUA</option>
      <option value="Diluar KUA">Diluar KUA</option>
    </select>
  </div>

  <div class="mb-4 mt-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="kecamatan">Kelurahan</label>
    <select id="id_kelurahan" name="id_kelurahan" required
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

      @foreach($kelurahans as $kelurahan)
      <option value="{{ $kelurahan->id }}">
        {{ strtoupper($kelurahan->nama_kelurahan) }}
      </option>
      @endforeach
    </select>

  </div>

  <div class="flex justify-end">
    <button type="button" id="save-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Simpan
    </button>
  </div>
</form>

<script>
$(document).ready(function() {
  // Ambil ID Pernikahan dari URL
  const pernikahanId = window.location.pathname.split('/').pop();

  // Fetch data awal untuk diisi dalam form
  $.ajax({
    url: `/api/pernikahan/${pernikahanId}`, // Endpoint API untuk mendapatkan data
    method: 'GET',
    success: function(response) {
      if (response.success) {
        const data = response.data;
        $('#nama-pria').text(data.pria.nama);
        $('#nama-perempuan').text(data.perempuan.nama);
        $('#tanggal_pernikahan').val(data.tanggal_pernikahan);
        $('#id_kelurahan').val(data.id_kelurahan);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Gagal Memuat Data!',
          text: 'Terjadi kesalahan saat memuat data pernikahan.',
        });
      }
    },
    error: function() {
      Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan!',
        text: 'Terjadi kesalahan saat memuat data!',
      });
    }
  });

  // Submit form menggunakan AJAX
  $('#save-btn').on('click', function() {
    const formData = {
      tanggal_pernikahan: $('#tanggal_pernikahan').val(),
      id_kelurahan: $('#id_kelurahan').val(),
    };

    $.ajax({
      url: `/api/pernikahan/${pernikahanId}?_method=PATCH`, // Endpoint API untuk update data
      method: 'POST',
      data: formData,
      success: function(response) {
        if (response.success) {
          Swal.fire({
            icon: 'success',
            title: 'Data Berhasil Diperbarui!',
            text: response.message,
          }).then(function() {
            window.location.href = `/pernikahan`; // Redirect ke halaman detail
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Gagal Memperbarui Data!',
            text: 'Gagal memperbarui data pernikahan.',
          });
        }
      },
      error: function(xhr) {
        if (xhr.status === 422) {
          // Tampilkan pesan error validasi
          const errors = xhr.responseJSON.errors;
          let errorMessage = 'Kesalahan Validasi:\n';
          for (const field in errors) {
            errorMessage += `${errors[field][0]}\n`;
          }
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan Validasi!',
            text: errorMessage,
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            text: 'Terjadi kesalahan saat menyimpan data!',
          });
        }
      }
    });
  });
});
</script>
@endsection