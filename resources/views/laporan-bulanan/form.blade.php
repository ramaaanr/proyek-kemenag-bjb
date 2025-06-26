@extends('layouts.index')

@section('content')
@extends('layouts.index')

@section('content')
<form id="laporanForm" class="">
  <div class="mb-4">
    <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
    <select id="tahun" name="tahun"
      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      <!-- Tahun will be populated with JavaScript -->
    </select>
  </div>

  <div class="mb-4">
    <label for="bulan" class="block text-sm font-medium text-gray-700">Bulan</label>
    <select id="bulan" name="bulan"
      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      <option value="1">Januari</option>
      <option value="2">Februari</option>
      <option value="3">Maret</option>
      <option value="4">April</option>
      <option value="5">Mei</option>
      <option value="6">Juni</option>
      <option value="7">Juli</option>
      <option value="8">Agustus</option>
      <option value="9">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">Desember</option>
    </select>
  </div>

  <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md">
    Cek Laporan
  </button>
</form>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Generate years 10 years back and 10 years forward
const currentYear = new Date().getFullYear();
const currentMonth = new Date().getMonth() + 1; // Get the current month (1-12)

const tahunSelect = document.getElementById('tahun');
const bulanSelect = document.getElementById('bulan');

// Generate year options (10 years before and 10 years after the current year)
for (let i = currentYear - 5; i <= currentYear + 5; i++) {
  const option = document.createElement('option');
  option.value = i;
  option.textContent = i;

  // Set the current year as selected
  if (i === currentYear) {
    option.selected = true; // Mark the current year as selected
  }

  tahunSelect.appendChild(option);
}

// Set the current month as selected in the month dropdown
bulanSelect.value = currentMonth; // Set current month as selected

// Handle form submission
document.getElementById('laporanForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const tahun = document.getElementById('tahun').value;
  const bulan = document.getElementById('bulan').value;

  if (!tahun || !bulan) {
    Swal.fire({
      title: 'Peringatan!',
      text: 'Tahun dan Bulan harus dipilih!',
      icon: 'warning',
      confirmButtonText: 'OK'
    });
    return;
  }

  // Cek ke API untuk melihat apakah data sudah ada
  fetch(`/api/laporan/check/${tahun}/${bulan}`)
    .then(response => response.json())
    .then(data => {
      if (data.exists) {
        // Jika sudah ada, tampilkan status false
        Swal.fire({
          title: 'Data Sudah Ada!',
          text: 'Laporan dengan tahun dan bulan ini sudah ada. Silakan coba dengan data yang berbeda.',
          icon: 'warning',
          confirmButtonText: 'Coba Lagi'
        });
      } else {
        // Jika tidak ada, tampilkan status true dan simpan data
        fetch('/api/laporan', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({
              tahun: tahun,
              bulan: bulan,
            }),
          })
          .then(response => response.json())
          .then(result => {
            if (result.success) {
              Swal.fire({
                title: 'Sukses!',
                text: 'Laporan berhasil disimpan.',
                icon: 'success',
                confirmButtonText: 'OK'
              }).then(() => {
                // Redirect to laporan page
                window.location.href = '/laporan'; // Modify this URL as per your actual laporan page URL

              });;
            } else {
              Swal.fire({
                title: 'Terjadi Kesalahan!',
                text: 'Ada kesalahan saat menyimpan data. Silakan coba lagi.',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
              });
            }
          })
          .catch(error => {
            Swal.fire({
              title: 'Kesalahan Server!',
              text: 'Terjadi kesalahan saat menghubungi server. Silakan coba lagi nanti.',
              icon: 'error',
              confirmButtonText: 'OK'
            });
          });
      }
    })
    .catch(error => {
      Swal.fire({
        title: 'Kesalahan!',
        text: 'Terjadi kesalahan saat memeriksa data laporan. Coba lagi nanti.',
        icon: 'error',
        confirmButtonText: 'OK'
      });
    });
});
</script>

@endsection



@endsection