@extends('layouts.index')

@section('content')
<div class="container mx-auto px-4 py-6">
  <h1 class="text-xl font-semibold mb-4">Tambah Data Usia Pengantin</h1>

  <form id="usiaPengantinForm">
    @csrf
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
      <table id="usiaPengantinTable" class="min-w-full table-auto">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 text-left">NO</th>
            <th class="px-4 py-2 text-left">Desa/Kelurahan</th>
            <th class="px-4 py-2 text-left">Jumlah Perkawinan</th>
            <th class="px-4 py-2 text-left">Laki-laki
              < 19</th>
            <th class="px-4 py-2 text-left">Laki-laki 19-21</th>
            <th class="px-4 py-2 text-left">Laki-laki 21-30</th>
            <th class="px-4 py-2 text-left">Laki-laki > 30</th>
            <th class="px-4 py-2 text-left">Wanita < 19</th>
            <th class="px-4 py-2 text-left">Wanita 19-21</th>
            <th class="px-4 py-2 text-left">Wanita 21-30</th>
            <th class="px-4 py-2 text-left">Wanita > 30</th>
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
    let laporan_id = window.location.pathname.split('/').pop(); // Get laporan_id from URL
    let isAdmin = "{{ auth()->user()->role === 'admin' ? 'true' : 'false' }}";
    isAdmin = isAdmin === 'true';

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
              <input type="number"  name="usia_pengantin[${perkawinan.id}][laki_minus_19]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="number"  name="usia_pengantin[${perkawinan.id}][laki_19_21]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="number"  name="usia_pengantin[${perkawinan.id}][laki_21_30]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="number"  name="usia_pengantin[${perkawinan.id}][laki_30_plus]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="number"  name="usia_pengantin[${perkawinan.id}][wanita_minus_19]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="number"  name="usia_pengantin[${perkawinan.id}][wanita_19_21]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="number"  name="usia_pengantin[${perkawinan.id}][wanita_21_30]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="number"  name="usia_pengantin[${perkawinan.id}][wanita_30_plus]" value="0" class="w-20 px-3 py-2 border rounded-md" min="0">
            </td>
            <td class="px-4 py-2 text-left">
              <input type="hidden" name="usia_pengantin[${perkawinan.id}][perkawinan_id]" value="${perkawinan.id}">
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
        $('#usiaPengantinTable tbody').html(rows);

        // Check if laporan_id already has associated usia_pengantin data
        $.ajax({
          url: `/api/usia-pengantin/check/${laporan_id}`,
          method: 'GET',
          success: function(response) {
            if (response.exists) {
              if (response.data[0].perkawinan.laporan.status === 'DIAJUKAN' || response.data[0].perkawinan.laporan.status === 'DIPENDING' || response.data[0].perkawinan
                .laporan
                .status ===
                'DISETUJUI') {
                $('#submitButton').addClass('hidden'); // Change button text to 'Update'
                $('input').prop('disabled', true).prop('readonly', true);
              }
              // If data exists, enable updating the record
              $('#submitButton').text('Update').removeClass('bg-blue-600').addClass('bg-green-600');
              let usiaData = response.data;
              // Pre-fill the form with existing data
              let total = 0;
              usiaData.forEach(function(data) {
                $(`input[name="usia_pengantin[${data.perkawinan_id}][laki_minus_19]"]`).val(data.laki_minus_19);
                $(`input[name="usia_pengantin[${data.perkawinan_id}][laki_19_21]"]`).val(data.laki_19_21);
                $(`input[name="usia_pengantin[${data.perkawinan_id}][laki_21_30]"]`).val(data.laki_21_30);
                $(`input[name="usia_pengantin[${data.perkawinan_id}][laki_30_plus]"]`).val(data.laki_30_plus);
                $(`input[name="usia_pengantin[${data.perkawinan_id}][wanita_minus_19]"]`).val(data.wanita_minus_19);
                $(`input[name="usia_pengantin[${data.perkawinan_id}][wanita_19_21]"]`).val(data.wanita_19_21);
                $(`input[name="usia_pengantin[${data.perkawinan_id}][wanita_21_30]"]`).val(data.wanita_21_30);
                $(`input[name="usia_pengantin[${data.perkawinan_id}][wanita_30_plus]"]`).val(data.wanita_30_plus);
              });

              if (response.data[0].file) {
                let fileUrl = `/storage/${response.data[0].file}`;
                let fileExtension = response.data[0].file.split('.').pop().toLowerCase();
                let filePreview = '';

                if (['jpg', 'jpeg', 'png'].includes(fileExtension)) {
                  filePreview = `<a href="${fileUrl}" target="_blank" class="mt-2 cursor-pointer">
                                  <img src="${fileUrl}" alt="Uploaded File" class="mt-2 w-32 h-auto border rounded">
                                </a>`;
                } else if (fileExtension === 'pdf') {
                  filePreview =
                    `<a href="${fileUrl}" target="_blank" class="mt-2 text-blue-600 underline">Lihat File PDF</a>`;
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
    $('#usiaPengantinForm').submit(function(event) {
      event.preventDefault();
      let formData = new FormData(this);
      formData.append("laporan_id", laporan_id);

      let url = $('#submitButton').text() === 'Update' ?
        `/api/usia-pengantin/update/${laporan_id}?_method=PUT` : '/api/usia-pengantin';
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
            text: 'Data usia pengantin telah berhasil diproses.',
          }).then(() => {
            // Redirect to laporan page
            window.location.href = '/laporan'; // Modify this URL as per your actual laporan page URL

          });
        },
        error: function(response) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat memproses data usia pengantin.',
          });
        }
      });
    });
  });
</script>
@endsection