@extends('layouts.index')

@section('content')
<form id="form-pria" class="flex-grow items-center justify-center ">
  <h2 class="text-2xl font-semibold mb-6 text-center">Data Mempelai Laki-laki</h2>
  <div class="container mx-auto   ">
    <div class="mx-auto ">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">Nama Mempelai Laki-laki</label>
      <input id="nama" type="text" name="nama" placeholder="Masukkan Nama" required
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
    </div>

    <div class="mb-4 mt-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="umur">Umur Laki-laki</label>
      <input name="usia" id="usia" type="number" placeholder="Masukkan Umur" required
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="pendidikan">Pendidikan Laki-laki</label>
      <select name="pendidikan" id="pendidikan" required
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="" disabled selected>Pilih Pendidikan</option>
        <option value="SD">SD</option>
        <option value="SMP">SMP</option>
        <option value="SMA">SMA</option>
        <option value="Diploma">Diploma</option>
        <option value="Sarjana">Sarjana</option>
        <option value="Magister">Magister</option>
      </select>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2">Punya Sertifikat Citin?</label>
      <div class="flex items-center">
        <input type="radio" id="sertif_sucatin_ya" name="sertif_sucatin" value=true class="mr-2">
        <label for="ya" class="mr-4">Ya</label>
        <input type="radio" id="sertif_sucatin_tidak" name="sertif_sucatin" value=false class="mr-2">
        <label for="tidak">Tidak</label>
      </div>
    </div>
  </div>


  <div class="items-center flex justify-between mt-8 gap-8 ">
    <a href="/pria" id="kembali_laki_laki" type="button"
      class=" bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Kembali
    </a>

    <button id="simpan_laki_laki" type="submit"
      class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Simpan
    </button>
  </div>
</form>

<script>
$(document).ready(function() {
  const urlPath = window.location.pathname; // Menangkap path URL
  const urlSegments = urlPath.split('/'); // Memecah path menjadi array berdasarkan '/'
  const id = urlSegments[urlSegments.length - 1];
  $.ajax({
    url: `/api/prias/${id}`, // Ganti dengan URL endpoint server Anda
    type: 'GET', // Metode pengiriman data (POST biasanya digunakan)
    success: function({
      data: {
        id,
        nama,
        pendidikan,
        sertif_sucatin,
        usia
      }
    }) {
      $('#nama').val(nama);
      $('#pendidikan').val(pendidikan);
      $('#usia').val(usia);
      console.log(sertif_sucatin);
      if (sertif_sucatin === "true") {
        $('#sertif_sucatin_ya').prop('checked', true);
        console.log('benar');
      } else {
        $('#sertif_sucatin_tidak').prop('checked', true);
        console.log('tidak');
      }
    },
    error: function(xhr, status, error) {
      // Jika terjadi error, tampilkan SweetAlert
      Swal.fire({
        title: 'Error!',
        text: 'Terjadi kesalahan: ' + xhr.responseJSON.message,
        icon: 'error',
        confirmButtonText: 'OK'
      });
    }
  });
  $('#form-pria').on('submit', function(event) {
    event.preventDefault(); //mencegah form dari pengiriman langsung 

    //Mengambil semua nilapi dari input dengan nama dalam bentuk array
    let formData = $("#form-pria").serialize();
    $.ajax({
      url: `/api/prias/${id}?_method=PUT`, // Ganti dengan URL endpoint server Anda
      type: 'POST', // Metode pengiriman data (POST biasanya digunakan)
      data: formData, // Data yang dikirim (serialized form)
      success: function(response) {
        // Jika pengiriman sukses, tampilkan SweetAlert
        Swal.fire({
          title: 'Berhasil!',
          text: 'Data berhasil disimpan!',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => {
          // Redirect atau tindakan lainnya setelah success
          window.location.href = '/pria';
        });
      },
      error: function(xhr, status, error) {
        // Jika terjadi error, tampilkan SweetAlert
        Swal.fire({
          title: 'Error!',
          text: 'Terjadi kesalahan: ' + xhr.responseJSON.message,
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    });
  });
});
</script>
@endsection