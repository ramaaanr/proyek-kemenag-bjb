@extends('layouts.index')

@section('content')
<div class="container mx-auto px-4 py-6">
  <h1 class="text-xl font-semibold mb-4">Tambah Data Perkawinan</h1>

  <form id="perkawinanForm">
    @csrf
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
      <table id="kelurahanTable" class="min-w-full table-auto">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 text-left">NO</th>
            <th class="px-4 py-2 text-left">Desa/Kelurahan</th>
            <th class="px-4 py-2 text-left">Jumlah Perkawinan</th>
            <th class="px-4 py-2 text-left"></th> <!-- hidden input for kelurahan_id -->
          </tr>
        </thead>
        <tbody>
          <!-- Dynamic rows will be populated here via AJAX -->
        </tbody>
      </table>
    </div>

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
  // Get laporan_id from the URL (from the route parameter)
  let laporan_id = window.location.pathname.split('/').pop();

  // Check if user is an admin (replace with your actual admin check)
  let isAdmin = "{{ auth()->user()->role === 'admin' ? 'true' : 'false' }}";
  isAdmin = isAdmin === 'true';


  // Fetch kelurahan data via AJAX
  $.ajax({
    url: '/api/kelurahan', // API route for kelurahan
    method: 'GET',
    success: function(data) {
      let rows = '';
      // Loop through each kelurahan and create a row in the table
      data.forEach((kelurahan, index) => {
        rows += `
                    <tr>
                        <td class="px-4 py-2 text-left">${index + 1}</td>
                        <td class="px-4 py-2 text-left">${kelurahan.nama_kelurahan}</td>
                        <td class="px-4 py-2 text-left">
                            <input type="number" name="perkawinan[${kelurahan.id}][jumlah_perkawinan]" value="0" class="w-full px-3 py-2 border rounded-md" min="0" >
                        </td>
                        <td class="px-4 py-2 text-left">
                            <input type="hidden" name="perkawinan[${kelurahan.id}][kelurahan_id]" value="${kelurahan.id}">
                        </td>
                    </tr>
                `;
      });
      $('#kelurahanTable tbody').html(rows);

      // Check if this laporan_id already exists for perkawinan
      $.ajax({
        url: `/api/perkawinan/check/${laporan_id}`, // Custom endpoint to check if laporan_id exists
        method: 'GET',
        success: function(response) {
          console.log(response);
          if (isAdmin) {
            if (response.data[0].laporan.status === 'DITOLAK' || response.data[0].laporan.status ===
              'DIPENDING' || response.data[0].laporan.status ===
              'DISETUJUI') {
              $('#submitButton').addClass('hidden'); // Change button text to 'Update'
              $('input').prop('disabled', true).prop('readonly', true);
            }
          } else {
            if (response.data[0].laporan.status === 'DIAJUKAN' || response.data[0].laporan.status ===
              'DIPENDING' || response.data[0].laporan.status ===
              'DISETUJUI') {
              $('#submitButton').addClass('hidden'); // Change button text to 'Update'
              $('input').prop('disabled', true).prop('readonly', true);
            }
          }

          if (response.exists) {
            // Laporan ID exists, so fill the form for editing
            $('#submitButton').text(
              'Update'); // Change button text to 'Update'
            $('#submitButton').removeClass(
              'bg-blue-600'); // Change button text to 'Update'
            $('#submitButton').addClass(
              'bg-green-600'); // Change button text to 'Update'
            let perkawinanData = response.data;
            // Populate form fields with existing data
            let total = 0;
            perkawinanData.forEach(function(data) {
              total += data.jumlah_perkawinan;
              $(`input[name="perkawinan[${data.kelurahan_id}][jumlah_perkawinan]"]`)
                .val(data
                  .jumlah_perkawinan);
            });
            const totalRow = `
                    <tr>
                        <td class="px-4 py-2 text-left font-bold" ></td>
                        <td class="px-4 py-2 text-left font-bold" >Total</td>
                        <td class="px-4 py-2 text-left font-bold" colspan=2 >${total}</td>
                    </tr>
                `;
            $('#kelurahanTable tbody').append(totalRow);
          }

        }
      });
    }
  });

  // Handle form submission
  $('#perkawinanForm').submit(function(event) {
    event.preventDefault();
    let formData = $(this).serialize();

    // Append laporan_id to the form data
    formData += `&laporan_id=${laporan_id}`;

    // Determine if we are updating or creating new data
    let url = $('#submitButton').text() === 'Update' ? `/api/perkawinan/update/${laporan_id}` :
      '/api/perkawinan';
    let method = $('#submitButton').text() === 'Update' ? 'PUT' : 'POST';

    // Submit the form data via AJAX
    $.ajax({
      url: url, // Post or update data to API
      method: method,
      data: formData,
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: 'Data perkawinan telah berhasil diproses.',
        }).then(() => {
          // Redirect to laporan page
          window.location.href =
            '/laporan'; // Modify this URL as per your actual laporan page URL
        });
      },
      error: function(response) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: 'Terjadi kesalahan saat memproses data perkawinan.',
        });
      }
    });
  });
});
</script>
@endsection