@extends('layouts.index')

@section('content')

<form id="form-pernikahan">
  <input type="hidden" name="id_user" id="id_user" value="1">
  <h2 class="text-2xl font-semibold mb-6 text-center">Data Pernikahan</h2>

  <p class="text-zinc-800 text-lg font-semibold">Data Laki-laki</p>
  <table id="dataTablePria" class="" style="width:100%">
    <thead>
      <tr>
        <th>Pilih</th>
        <th>Nama</th>
        <th>Usia</th>
        <th>Pendidikan</th>
      </tr>
    </thead>
    <tbody>
      <!-- Data akan diisi oleh DataTables -->
    </tbody>
  </table>


  <p class="text-zinc-800 text-lg font-semibold">Data Perempuan</p>
  <table id="dataTablePerempuan" class="" style="width:100%">
    <thead>
      <tr>
        <th>Pilih</th>
        <th>Nama</th>
        <th>Usia</th>
        <th>Pendidikan</th>
      </tr>
    </thead>
    <tbody>
      <!-- Data akan diisi oleh DataTables -->
    </tbody>
  </table>
  <div class="container mx-auto   ">

    <div class="mb-4 mt-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="tempat_bikah">Tempat Nikah</label>
      <select id="tempat_pernikahan" name="tempat_pernikahan" required
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="" disabled selected>Pilih Tempat Nikah</option>
        <option value="Didalam KUA">Didalam KUA</option>
        <option value="Diluat KUA">Diluar KUA</option>
      </select>
    </div>

    <div class="mb-4 mt-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="kecamatan">Kelurahan</label>
      <select id="kelurahan" name="id_kelurahan" required
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

        @foreach($kelurahans as $kelurahan)
        <option value="{{ $kelurahan->id }}">
          {{ strtoupper($kelurahan->nama_kelurahan) }}
        </option>
        @endforeach
      </select>

    </div>



    <div class="mb-4">
      <label for="" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Nikah</label>
      <input type="date" id="tanggal-rujuk" name="tanggal_pernikahan"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
        required>
    </div>

    <div class="mb-4">
      <label for="hasil_rujukan" class="block text-gray-700 text-sm font-bold mb-2">Hasil Rujukan</label>
      <select id="hasil_rujukan" name="hasil_rujukan" required
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="" disabled selected>Pilih Status</option>
        <option value="ya">Ya</option>
        <option value="tidak">Tidak</option>
      </select>
    </div>





  </div>


  <div class="items-center flex justify-between mt-8 gap-8 ">
    <button type="button"
      class=" bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Kembali
    </button>

    <button type="submit"
      class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      Simpan
    </button>

  </div>
</form>


<script>
  $(document).ready(function() {
    $('#dataTablePerempuan').DataTable({
      ajax: {
        url: '/api/perempuans?sertif_sucatin=false', // Ganti dengan URL API Anda jika menggunakan server (misalnya, /api/pria)
        dataSrc: 'data' // Properti 'data' dari JSON Anda
      },
      columns: [{
          data: 'id',
          render: function(data) {
            return `<div class="w-full text-center"><input type="radio"  id="pilih-perempuan-${data}" name="id_perempuan" value=${data} /></div>`;
          }
        }, {
          data: 'nama'
        },
        {
          data: 'usia'
        },
        {
          data: 'pendidikan'
        },

      ]
    });
    $('#dataTablePria').DataTable({
      ajax: {
        url: '/api/prias?sertif_sucatin=false', // Ganti dengan URL API Anda jika menggunakan server (misalnya, /api/pria)
        dataSrc: 'data' // Properti 'data' dari JSON Anda
      },
      columns: [{
          data: 'id',
          render: function(data) {
            return `<div class="w-full text-center"> <input type="radio" id="pilih-pria-${data}" name="id_pria" value=${data} /> </div>`;

          }
        }, {
          data: 'nama'
        },
        {
          data: 'usia'
        },
        {
          data: 'pendidikan'
        },

      ]
    });

    $('#form-pernikahan').on('submit', function(event) {
      event.preventDefault(); //mencegah form dari pengiriman langsung 
      console.log("test")

      //Mengambil semua nilai dari input dengan nama dalam bentuk array
      let formData = $("#form-pernikahan").serialize();
      $.ajax({
        url: '/api/pernikahan', // Ganti dengan URL endpoint server Anda
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
            window.location.href = '/pernikahan';
          });
        },
        error: function(xhr, status, error) {
          // Jika terjadi error, tampilkan SweetAlert
          Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan: Pilih Data Perempuan atau Pria terlebih dahulus',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      });
    });
  });
</script>
@endsection