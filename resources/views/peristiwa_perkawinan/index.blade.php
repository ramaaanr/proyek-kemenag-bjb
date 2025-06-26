@extends('layouts.index')

@section('content')
<div class="container mx-auto px-4 py-6">
  <h1 class="text-xl font-semibold mb-4">Tambah Data Peristiwa Perkawinan</h1>

  <form id="peristiwaPerkawinanForm">
    @csrf


    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
      <table id="kelurahanTable" class="min-w-full table-auto">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 text-left">NO</th>
            <th class="px-4 py-2 text-left">Desa/Kelurahan</th>
            <th class="px-4 py-2 text-left">Jumlah Perkawinan</th>
            <th class="px-4 py-2 text-left">Kantor</th>
            <th class="px-4 py-2 text-left">Luar Kantor</th>
            <th class="px-4 py-2 text-left">Perkawinan Campuran Laki</th>
            <th class="px-4 py-2 text-left">Perkawinan Campuran Perempuan</th>
            <th class="px-4 py-2 text-left">Rujuk</th>
            <th class="px-4 py-2 text-left"></th> <!-- hidden input for kelurahan_id -->
          </tr>
        </thead>
        <tbody>
          <!-- Dynamic rows will be populated here via AJAX -->
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      <label for="file" class="block text-sm font-medium text-gray-700">Upload File</label>
      <input type="file" id="file" name="file"
        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
    </div>

    <div class="mt-4" id="filePreviewContainer"></div>

    <div class="mt-4">
      <!-- Back Button -->
      <a href="{{ url()->previous() }}" class="bg-gray-600 text-white py-2 px-4 rounded-md hover:opacity-75">Kembali</a>

      <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:opacity-50"
        id="submitButton">Simpan</button>
      <!-- Submit or Update Button -->
    </div>

  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  let isAdmin = "{{ auth()->user()->role === 'admin' ? 'true' : 'false' }}";
  isAdmin = isAdmin === 'true';
  let laporan_id = window.location.pathname.split('/').pop(); // Get laporan_id from URL

  // Fetch kelurahan data
  $.ajax({
    url: `/api/perkawinan/${laporan_id}`,
    method: 'GET',
    success: function(data) {
      let total = 0;
      let rows = '';
      data.forEach((perkawinan, index) => {
        total += perkawinan.jumlah_perkawinan;
        rows += `
          <tr>
            <td class="px-4 py-2 text-left">${index + 1}</td>
            <td class="px-4 py-2 text-left">${perkawinan.kelurahan.nama_kelurahan}</td>
            <td class="px-4 py-2 text-left">${perkawinan.jumlah_perkawinan}</td>
            <td class="px-4 py-2 text-left">
              <input  type="number" name="peristiwa[${perkawinan.id}][kantor]" value="0" class="w-full px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input  type="number" name="peristiwa[${perkawinan.id}][luar_kantor]" value="0" class="w-full px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input  type="number" name="peristiwa[${perkawinan.id}][perkawinan_campuran_laki]" value="0" class="w-full px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input  type="number" name="peristiwa[${perkawinan.id}][perkawinan_campuran_perempuan]" value="0" class="w-full px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input  type="number" name="peristiwa[${perkawinan.id}][rujuk]" value="0" class="w-full px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input  type="hidden" name="peristiwa[${perkawinan.id}][perkawinan_id]" value="${perkawinan.id}">
            </td>
          </tr>
        `;
      });
      rows += `
                    <tr>
                        <td class="px-4 py-2 text-left font-bold" ></td>
                        <td class="px-4 py-2 text-left font-bold" >Total</td>
                        <td class="px-4 py-2 text-left font-bold" colspan=2 >${total}</td>
                    </tr>
                `;

      $('#kelurahanTable tbody').html(rows);

      // Check if laporan_id already has associated peristiwa_perkawinan data
      $.ajax({
        url: `/api/peristiwa-perkawinan/check/${laporan_id}`,
        method: 'GET',
        success: function(response) {
          if (response.exists) {
            if (response.data[0].perkawinan.laporan.status === 'DIAJUKAN' || response.data[0].perkawinan
              .laporan.status === 'DIPENDING' || response.data[0].perkawinan
              .laporan
              .status ===
              'DISETUJUI') {
              $('#submitButton').addClass('hidden'); // Change button text to 'Update'
              $('input').prop('disabled', true).prop('readonly', true);
            }
            // If data exists, enable updating the record
            $('#submitButton').text('Update').removeClass('bg-blue-600').addClass('bg-green-600');
            let peristiwaData = response.data;
            // Pre-fill the form with existing data
            let total = 0;

            peristiwaData.forEach(function(data) {
              total += data.perkawinan.jumlah_perkawinan;

              $(`input[name="peristiwa[${data.perkawinan_id}][kantor]"]`).val(data.kantor);
              $(`input[name="peristiwa[${data.perkawinan_id}][luar_kantor]"]`).val(data
                .luar_kantor);
              $(`input[name="peristiwa[${data.perkawinan_id}][perkawinan_campuran_laki]"]`).val(data
                .perkawinan_campuran_laki);
              $(`input[name="peristiwa[${data.perkawinan_id}][perkawinan_campuran_perempuan]"]`)
                .val(data.perkawinan_campuran_perempuan);
              $(`input[name="peristiwa[${data.perkawinan_id}][rujuk]"]`).val(data.rujuk);
            });

            if (response.data[0].file) {
              let fileUrl = `/storage/${response.data[0].file}`;
              let fileExtension = response.data[0].file.split('.').pop().toLowerCase();

              let filePreview = '';
              if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                filePreview =
                  `<a href="${fileUrl}" target="_blank" class="mt-2 cursor-pointer">
                      <img src = "${fileUrl}" alt = "Uploaded File" class = "mt-2 w-32 h-auto border rounded">
                    </a>`;
              } else if (fileExtension === 'pdf') {
                filePreview =
                  ` <a href="${fileUrl}" target = "_blank" class = "mt-2 text-blue-600 underline"> Lihat File PDF </a>`;
              } else {
                filePreview =
                  `<p class="mt-2 text-gray-600">File tersedia: <a href="${fileUrl}" target="_blank" class="text-blue-600 underline">Download</a></p>`;

              }

              $('#filePreviewContainer').html(filePreview);
            }

          }
        }
      });
    }
  });

  // Handle form submission
  $('#peristiwaPerkawinanForm').submit(function(event) {
    event.preventDefault();
    let formData = new FormData(this);
    formData.append("laporan_id", laporan_id);

    let url = $('#submitButton').text() === 'Update' ?
      `/api/peristiwa-perkawinan/update/${laporan_id}?_method=PUT` :
      '/api/peristiwa-perkawinan';

    $.ajax({
      url: url,
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: 'Data peristiwa perkawinan telah berhasil diproses.',
        }).then(() => {
          // Redirect to laporan page
          window.location.href = '/laporan'; // Modify this URL as per your actual laporan page URL

        });
      },
      error: function({
        responseJSON: res
      }) {
        let errorMessages = Object.values(res.errors).flat().join("\n");

        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: errorMessages,
        });
      }
    });
  });
});
</script>
@endsection