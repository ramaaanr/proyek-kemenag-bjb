@extends('layouts.index')

@section('content')
<h2 class="text-2xl font-semibold text-gray-700 mb-4">Detail Pernikahan</h2>

<!-- Placeholder untuk Data Pernikahan -->
<h3 class="text-xl font-semibold text-gray-600 mb-2">Informasi Pernikahan</h3>
<ul id="info-pernikahan" class="list-disc ml-5"></ul>

<!-- Placeholder untuk Data Mempelai Pria -->
<h3 class="text-xl font-semibold text-gray-600 mt-6 mb-2">Mempelai Pria</h3>
<ul id="info-pria" class="list-disc ml-5"></ul>

<!-- Placeholder untuk Data Mempelai Perempuan -->
<h3 class="text-xl font-semibold text-gray-600 mt-6 mb-2">Mempelai Perempuan</h3>
<ul id="info-perempuan" class="list-disc ml-5"></ul>

<!-- Tombol Aksi -->


<script>
$(document).ready(function() {
  // Ambil ID Pernikahan dari URL
  const pernikahanId = window.location.pathname.split('/').pop();

  // Panggil API untuk mendapatkan data
  $.ajax({
    url: `/api/pernikahan/${pernikahanId}`, // Endpoint API
    method: 'GET',
    success: function(response) {
      if (response.success) {
        const data = response.data;

        // Tampilkan informasi pernikahan
        $('#info-pernikahan').html(`
                        <li><strong>Tanggal Pernikahan:</strong> ${new Date(data.tanggal_pernikahan).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</li>
                        <li><strong>Kecamatan:</strong> ${data.kecamatan}</li>
                        <li><strong>Tempat Pernikahan:</strong> ${data.tempat_pernikahan}</li>
                    `);

        // Tampilkan informasi mempelai pria
        $('#info-pria').html(`
                        <li><strong>Nama:</strong> ${data.pria.nama}</li>
                        <li><strong>Usia:</strong> ${data.pria.usia} tahun</li>
                        <li><strong>Pendidikan:</strong> ${data.pria.pendidikan}</li>
                        <li><strong>Sertifikasi Sucatin:</strong> ${data.pria.sertif_sucatin ? '<span class="text-green-500">Ya</span>' : '<span class="text-red-500">Tidak</span>'}</li>
                    `);

        // Tampilkan informasi mempelai perempuan
        $('#info-perempuan').html(`
                        <li><strong>Nama:</strong> ${data.perempuan.nama}</li>
                        <li><strong>Usia:</strong> ${data.perempuan.usia} tahun</li>
                        <li><strong>Pendidikan:</strong> ${data.perempuan.pendidikan}</li>
                    `);
      } else {
        alert('Gagal mengambil data!');
      }
    },
    error: function(xhr) {
      alert('Terjadi kesalahan saat mengambil data!');
      console.error(xhr);
    }
  });
});
</script>
@endsection