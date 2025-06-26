<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Laporan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    .kop-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .kop {
      font-weight: bold;
      font-size: 18px;
      text-align: center;
      margin-bottom: 10px;
    }

    .kop-logo {
      width: 80px;
      height: 80px;
    }

    .empty {
      width: 80px;
      height: 80px;
    }

    .kop-logo img {
      width: 80px;
      height: 80px;
    }

    .signature {
      text-align: right;
      margin-top: 50px;
      font-size: 14px;
      margin-bottom: 1400px;
    }

    @media print {
      button {
        display: none;
      }
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <div id="laporan"></div>

  <script>
    $(document).ready(function() {
      const pathSegments = window.location.pathname.split("/");
      const laporanId = pathSegments[pathSegments.length - 1];
      const bulanNama = ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER",
        "OKTOBER", "NOVEMBER", "DESEMBER"
      ];

      $.getJSON(`/api/laporan/${laporanId}`, function(response) {
        const laporan = response;
        const bulan = bulanNama[laporan.bulan - 1];
        const tahun = laporan.tahun;

        let laporanHTML = '';

        laporanHTML += generateTable(
          "LAPORAN PERKAWINAN",
          laporan.perkawinans,
          bulan, tahun,
          ["No", "Kelurahan", "Jumlah Perkawinan"],
          perkawinan => [
            perkawinan.kelurahan.nama_kelurahan,
            perkawinan.jumlah_perkawinan

          ]
        );
        laporanHTML += generateTable(
          "LAPORAN PERISTIWA PERKAWINAN ATAU RUJUK",
          laporan.perkawinans,
          bulan, tahun,
          ["No", "Kelurahan", "Kantor", "Luar Kantor", "Campuran Laki", "Campuran Perempuan", "Rujuk"],
          perkawinan => [
            perkawinan.kelurahan.nama_kelurahan,
            perkawinan.peristiwa_perkawinan.kantor || '-',
            perkawinan.peristiwa_perkawinan.luar_kantor || '-',
            perkawinan.peristiwa_perkawinan.perkawinan_campuran_laki || '-',
            perkawinan.peristiwa_perkawinan.perkawinan_campuran_perempuan || '-',
            perkawinan.peristiwa_perkawinan.rujuk || '-'
          ]
        );

        laporanHTML += generateTable(
          "LAPORAN PENDIDIKAN PENGANTIN",
          laporan.perkawinans,
          bulan, tahun,
          ["No", "Kelurahan", "Laki SD", "Laki SMP", "Laki SMA", "Laki Sarjana", "Wanita SD", "Wanita SMP",
            "Wanita SMA", "Wanita Sarjana"
          ],
          perkawinan => [
            perkawinan.kelurahan.nama_kelurahan,
            perkawinan.pendidikan_perkawinan.laki_sd || '-',
            perkawinan.pendidikan_perkawinan.laki_smp || '-',
            perkawinan.pendidikan_perkawinan.laki_sma || '-',
            perkawinan.pendidikan_perkawinan.laki_sarjana || '-',
            perkawinan.pendidikan_perkawinan.wanita_sd || '-',
            perkawinan.pendidikan_perkawinan.wanita_smp || '-',
            perkawinan.pendidikan_perkawinan.wanita_sma || '-',
            perkawinan.pendidikan_perkawinan.wanita_sarjana || '-'
          ]
        );

        laporanHTML += generateTable(
          "LAPORAN KURSUS CALON PENGANTIN",
          laporan.perkawinans,
          bulan, tahun,
          ["No", "Kelurahan", "Jumlah Laki", "Jumlah Wanita"],
          perkawinan => [
            perkawinan.kelurahan.nama_kelurahan,
            perkawinan.kursus_calon_pengantin.jumlah_laki || '-',
            perkawinan.kursus_calon_pengantin.jumlah_wanita || '-'
          ]
        );

        laporanHTML += generateTable(
          "LAPORAN USIA PENGANTIN",
          laporan.perkawinans,
          bulan, tahun,
          ["No", "Kelurahan", "Laki <19", "Laki 19-21", "Laki 21-30", "Laki >30", "Wanita <19", "Wanita 19-21",
            "Wanita 21-30", "Wanita >30"
          ],
          perkawinan => [
            perkawinan.kelurahan.nama_kelurahan,
            perkawinan.usia_pengantin.laki_minus_19 || '-',
            perkawinan.usia_pengantin.laki_19_21 || '-',
            perkawinan.usia_pengantin.laki_21_30 || '-',
            perkawinan.usia_pengantin.laki_30_plus || '-',
            perkawinan.usia_pengantin.wanita_minus_19 || '-',
            perkawinan.usia_pengantin.wanita_19_21 || '-',
            perkawinan.usia_pengantin.wanita_21_30 || '-',
            perkawinan.usia_pengantin.wanita_30_plus || '-'
          ]
        );

        $('#laporan').html(laporanHTML);

        setTimeout(() => {
          window.print();
        }, 500);
      });
    });

    function generateTable(title, data, bulan, tahun, headers, rowDataFn) {
      let totalColumns = headers.length - 2; // Jumlah kolom yang akan dijumlahkan
      let totals = new Array(totalColumns).fill(0); // Inisialisasi array total

      let tableHTML = `
      <div class="kop-container">
          <div class="kop-logo">
              <img src="/logo.png" width="80" height="80" alt="Logo" class="logo">
          </div>
          <div class="kop">
              ${title}<br>KUA KOTA BANJARBARU<br>BULAN: ${bulan} ${tahun}
          </div>
          <div class="empty"></div>
      </div>
      <table>
        <thead>
          <tr>${headers.map(header => `<th>${header}</th>`).join('')}</tr>
        </thead>
        <tbody>
  `;

      if (data.length === 0) {
        tableHTML += `<tr><td colspan="${headers.length}">Tidak ada data</td></tr>`;
      } else {
        data.forEach((item, index) => {
          let rowData = rowDataFn(item);
          console.log(item);
          console.log(index);
          // Menambahkan nilai ke dalam total jika berupa angka, melewatkan kolom 1 dan 2
          rowData.forEach((value, colIndex) => {
            if (!isNaN(value) && value !== "") { // Lewati kolom 1 dan 2
              totals[colIndex - 1] += parseFloat(value);
            }
          });

          tableHTML += `<tr><td>${index + 1}</td>${rowData.map(value => `<td>${value}</td>`).join('')}</tr>`;
        });

        // Menambahkan baris total
        tableHTML += `
          <tr class="total-row">
              <td colspan="2"><strong>Total</strong></td>
              ${totals.map(total => `<td><strong>${total}</strong></td>`).join('')}
          </tr>
      `;
      }

      tableHTML += `</tbody></table>`;

      tableHTML += `
      <div class="signature">
          Cempaka, ${new Date().toLocaleDateString('id-ID')}<br>
          Kepala Kantor Urusan Agama Kecamatan Cempaka<br><br><br>
          <strong>_________________________</strong>
      </div>
      <hr><br><br>
  `;

      return tableHTML;
    }
  </script>
</body>

</html>