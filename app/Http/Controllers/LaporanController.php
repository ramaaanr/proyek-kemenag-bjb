<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pernikahan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pria;
use App\Models\Perempuan;
use App\Models\User;

class LaporanController extends Controller
{
    public function laporanBulanan(Request $request)
    {
        $tahun = $request->tahun ?? Pernikahan::max(DB::raw('YEAR(tanggal_pernikahan)'));


        $data = Pernikahan::selectRaw("DATE_FORMAT(tanggal_pernikahan, '%Y-%m') as bulan, COUNT(*) as jumlah")
            ->whereYear('tanggal_pernikahan', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->toArray();

        $list_tahun = Pernikahan::selectRaw('YEAR(tanggal_pernikahan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun')
            ->toArray();

        return view('laporan.bulanan', compact('data', 'list_tahun'));
    }

    public function exportBulananPDF(Request $request)
    {
        $tahun = $request->tahun ?? Pernikahan::max(DB::raw('YEAR(tanggal_pernikahan)'));

        $data = Pernikahan::selectRaw("DATE_FORMAT(tanggal_pernikahan, '%Y-%m') as bulan, COUNT(*) as jumlah")
            ->whereYear('tanggal_pernikahan', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $pdf = Pdf::loadView('laporan.bulanan_pdf', [
            'data' => $data,
            'tahun' => $tahun
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("laporan-pernikahan-bulanan-$tahun.pdf");
    }


    public function laporanTahunan()
    {
        $data = Pernikahan::selectRaw("YEAR(tanggal_pernikahan) as tahun, COUNT(*) as jumlah")
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        return view('laporan.tahunan', compact('data'));
    }

    public function exportTahunanPDF()
    {
        $data = Pernikahan::selectRaw("YEAR(tanggal_pernikahan) as tahun, COUNT(*) as jumlah")
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        $pdf = Pdf::loadView('laporan.tahunan_pdf', [
            'data' => $data,
            'title' => 'Laporan Tahunan Pernikahan'
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('laporan_tahunan_pernikahan.pdf');
    }



    public function laporanKecamatan(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;
        $tahun = $request->tahun;

        $kecamatan = Kecamatan::all();

        // Ambil list tahun yang tersedia dari data
        $list_tahun = DB::table('pernikahans')
            ->selectRaw('YEAR(tanggal_pernikahan) as tahun')
            ->groupBy('tahun')
            ->orderByDesc('tahun')
            ->pluck('tahun');

        $data = collect();
        $total = 0;

        if ($id_kecamatan && $tahun) {
            $data = DB::table('pernikahans')
                ->join('kelurahan', 'pernikahans.id_kelurahan', '=', 'kelurahan.id')
                ->join('kecamatan', 'kelurahan.id_kecamatan', '=', 'kecamatan.id')
                ->select('kelurahan.nama_kelurahan', DB::raw('COUNT(pernikahans.id) as jumlah'))
                ->where('kecamatan.id', $id_kecamatan)
                ->whereYear('tanggal_pernikahan', $tahun)
                ->groupBy('kelurahan.nama_kelurahan')
                ->orderByDesc('jumlah')
                ->get();

            $total = $data->sum('jumlah');
        }

        return view('laporan.kecamatan', compact('kecamatan', 'data', 'id_kecamatan', 'total', 'list_tahun', 'tahun'));
    }


    public function laporanKecamatanPdf(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;
        $tahun = $request->tahun;

        if (!$id_kecamatan || !$tahun) {
            abort(404, 'Kecamatan atau tahun tidak dipilih');
        }

        $nama_kecamatan = Kecamatan::find($id_kecamatan)->nama_kecamatan ?? '-';

        $data = DB::table('pernikahans')
            ->join('kelurahan', 'pernikahans.id_kelurahan', '=', 'kelurahan.id')
            ->join('kecamatan', 'kelurahan.id_kecamatan', '=', 'kecamatan.id')
            ->select('kelurahan.nama_kelurahan', DB::raw('COUNT(pernikahans.id) as jumlah'))
            ->where('kecamatan.id', $id_kecamatan)
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderByDesc('jumlah')
            ->get();

        $total = $data->sum('jumlah');

        $pdf = Pdf::loadView('laporan.kecamatan_pdf', [
            'data' => $data,
            'total' => $total,
            'kecamatan' => $nama_kecamatan,
            'tahun' => $tahun,
            'tanggal_cetak' => now()->translatedFormat('d F Y'),
        ])->setPaper('A4', 'portrait');

        return $pdf->stream("laporan_kecamatan_{$nama_kecamatan}_{$tahun}.pdf");
    }



    public function laporanUsia(Request $request)
    {
        $latestYear = DB::table('pernikahans')
            ->selectRaw('YEAR(tanggal_pernikahan) as tahun')
            ->orderByDesc('tahun')
            ->limit(1)
            ->value('tahun');

        $tahun = $request->tahun ?? $latestYear;

        $list_tahun = DB::table('pernikahans')
            ->selectRaw('YEAR(tanggal_pernikahan) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun')
            ->toArray();

        $data = DB::table('pernikahans')
            ->join('prias', 'pernikahans.id_pria', '=', 'prias.id')
            ->join('perempuans', 'pernikahans.id_perempuan', '=', 'perempuans.id')
            ->join('kelurahan', 'pernikahans.id_kelurahan', '=', 'kelurahan.id')
            ->selectRaw("
                kelurahan.nama_kelurahan,
                COUNT(pernikahans.id) as total,
                SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) < 19 THEN 1 ELSE 0 END) as laki_u19,
                SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) BETWEEN 19 AND 21 THEN 1 ELSE 0 END) as laki_19_21,
                SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) BETWEEN 22 AND 30 THEN 1 ELSE 0 END) as laki_22_30,
                SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) > 30 THEN 1 ELSE 0 END) as laki_o30,

                SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) < 19 THEN 1 ELSE 0 END) as perempuan_u19,
                SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) BETWEEN 19 AND 21 THEN 1 ELSE 0 END) as perempuan_19_21,
                SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) BETWEEN 22 AND 30 THEN 1 ELSE 0 END) as perempuan_22_30,
                SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) > 30 THEN 1 ELSE 0 END) as perempuan_o30
            ")
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderBy('kelurahan.nama_kelurahan')
            ->get();

        return view('laporan.usia', compact('data', 'list_tahun', 'tahun'));
    }


    public function exportUsiaPDF(Request $request)
    {
        $tahun = $request->tahun;

        $data = DB::table('pernikahans')
            ->join('kelurahan', 'pernikahans.id_kelurahan', '=', 'kelurahan.id')
            ->join('prias', 'pernikahans.id_pria', '=', 'prias.id')
            ->join('perempuans', 'pernikahans.id_perempuan', '=', 'perempuans.id')
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->select(
                'kelurahan.nama_kelurahan',
                DB::raw("SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) < 19 THEN 1 ELSE 0 END) as pria_u19"),
                DB::raw("SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) BETWEEN 19 AND 21 THEN 1 ELSE 0 END) as pria_19_21"),
                DB::raw("SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) BETWEEN 22 AND 30 THEN 1 ELSE 0 END) as pria_21_30"),
                DB::raw("SUM(CASE WHEN CAST(prias.usia AS UNSIGNED) > 30 THEN 1 ELSE 0 END) as pria_o30"),
                DB::raw("SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) < 19 THEN 1 ELSE 0 END) as perempuan_u19"),
                DB::raw("SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) BETWEEN 19 AND 21 THEN 1 ELSE 0 END) as perempuan_19_21"),
                DB::raw("SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) BETWEEN 22 AND 30 THEN 1 ELSE 0 END) as perempuan_21_30"),
                DB::raw("SUM(CASE WHEN CAST(perempuans.usia AS UNSIGNED) > 30 THEN 1 ELSE 0 END) as perempuan_o30"),
                DB::raw("COUNT(*) as total_pernikahan")
            )
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderBy('kelurahan.nama_kelurahan')
            ->get();

        $pdf = PDF::loadView('laporan.usia_pdf', [
            'data' => $data,
            'tahun' => $tahun,
            'title' => 'Laporan Usia Pernikahan',
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-usia-' . $tahun . '.pdf');
    }

    public function laporanTren(Request $request)
    {
        $tahunDipilih = $request->tahun ?? now()->year;

        // Ambil daftar tahun unik
        $list_tahun = DB::table('pernikahans')
            ->selectRaw('YEAR(tanggal_pernikahan) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        // Inisialisasi bulan-bulan Bahasa Indonesia
        $bulan_nama = collect(range(1, 12))->mapWithKeys(function ($bulan) {
            return [
                Carbon::create()->month($bulan)->locale('id')->translatedFormat('F') => 0
            ];
        });

        // Ambil data bulanan dari DB
        $bulananDB = DB::table('pernikahans')
            ->selectRaw("MONTH(tanggal_pernikahan) as bulan, COUNT(*) as jumlah")
            ->whereYear('tanggal_pernikahan', $tahunDipilih)
            ->groupByRaw('MONTH(tanggal_pernikahan)')
            ->orderBy('bulan')
            ->get();

        // Mapping hasil query ke array bulan_nama
        foreach ($bulananDB as $row) {
            $nama_bulan = Carbon::create()->month($row->bulan)->locale('id')->translatedFormat('F');
            $bulan_nama[$nama_bulan] = $row->jumlah;
        }

        // Data bulanan untuk chart
        $bulanan = [
            'labels' => $bulan_nama->keys(),
            'data' => $bulan_nama->values(),
        ];

        // Ambil data tahunan (semua tahun)
        $tahunan = DB::table('pernikahans')
            ->selectRaw("YEAR(tanggal_pernikahan) as tahun, COUNT(*) as jumlah")
            ->groupByRaw('YEAR(tanggal_pernikahan)')
            ->orderBy('tahun')
            ->get();

        return view('laporan.tren', compact('bulanan', 'tahunan', 'tahunDipilih', 'list_tahun'));
    }



    public function laporanPeta()
    {
        // Ambil data jumlah pernikahan per kecamatan beserta geojson-nya


        return view('laporan.peta',);
    }

    public function laporanUser(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;

        $data = DB::table('pernikahans')
            ->join('users', 'users.id', '=', 'pernikahans.id_user')
            ->join('kecamatan', 'users.kecamatan_id', '=', 'kecamatan.id')
            ->select(
                'users.nip',
                'users.nama_pengguna',
                'kecamatan.nama_kecamatan',
                DB::raw('COUNT(pernikahans.id) as jumlah')
            )
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->groupBy('users.id', 'users.nip', 'users.nama_pengguna', 'kecamatan.nama_kecamatan')
            ->orderByDesc('jumlah')
            ->get();

        // Ambil semua tahun unik dari pernikahan untuk dropdown
        $list_tahun = DB::table('pernikahans')
            ->selectRaw('YEAR(tanggal_pernikahan) as tahun')
            ->distinct()
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('laporan.user', compact('data', 'tahun', 'list_tahun'));
    }


    public function exportUserPdf(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;

        $data = DB::table('pernikahans')
            ->join('users', 'users.id', '=', 'pernikahans.id_user')
            ->join('kecamatan', 'users.kecamatan_id', '=', 'kecamatan.id')
            ->select(
                'users.nip',
                'users.nama_pengguna',
                'kecamatan.nama_kecamatan',
                DB::raw('COUNT(pernikahans.id) as jumlah')
            )
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->groupBy('users.id', 'users.nip', 'users.nama_pengguna', 'kecamatan.nama_kecamatan')
            ->orderByDesc('jumlah')
            ->get();

        $pdf = Pdf::loadView('laporan.user_pdf', [
            'data' => $data,
            'tahun' => $tahun,
            'tanggal_cetak' => now()->translatedFormat('d F Y'),
            'title' => 'Laporan Pernikahan per User',
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('laporan_pernikahan_user_' . $tahun . '.pdf');
    }



    public function laporanPendidikan(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;

        $pendidikanLevels = ['SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Magister'];

        $data = DB::table('pernikahans')
            ->join('kelurahan', 'pernikahans.id_kelurahan', '=', 'kelurahan.id')
            ->join('prias', 'pernikahans.id_pria', '=', 'prias.id')
            ->join('perempuans', 'pernikahans.id_perempuan', '=', 'perempuans.id')
            ->select(
                'kelurahan.nama_kelurahan',
                DB::raw('COUNT(pernikahans.id) as jumlah_pernikahan'),
                ...collect($pendidikanLevels)->map(
                    fn($level) =>
                    DB::raw("SUM(CASE WHEN prias.pendidikan = '$level' THEN 1 ELSE 0 END) as pria_$level")
                )->toArray(),
                ...collect($pendidikanLevels)->map(
                    fn($level) =>
                    DB::raw("SUM(CASE WHEN perempuans.pendidikan = '$level' THEN 1 ELSE 0 END) as perempuan_$level")
                )->toArray()
            )
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderBy('kelurahan.nama_kelurahan')
            ->get();

        $list_tahun = DB::table('pernikahans')
            ->selectRaw('YEAR(tanggal_pernikahan) as tahun')
            ->groupByRaw('YEAR(tanggal_pernikahan)')
            ->orderByDesc('tahun')
            ->pluck('tahun');

        return view('laporan.pendidikan', compact('data', 'tahun', 'list_tahun', 'pendidikanLevels'));
    }

    public function exportPendidikanPdf(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;

        // Pastikan ambil level pendidikan unik
        $pendidikanLevels = DB::table('prias')
            ->select('pendidikan')
            ->distinct()
            ->pluck('pendidikan')
            ->merge(DB::table('perempuans')->select('pendidikan')->distinct()->pluck('pendidikan'))
            ->unique()
            ->sort()
            ->values()
            ->all();

        $data = DB::table('pernikahans')
            ->join('kelurahan', 'pernikahans.id_kelurahan', '=', 'kelurahan.id')
            ->join('prias', 'pernikahans.id_pria', '=', 'prias.id')
            ->join('perempuans', 'pernikahans.id_perempuan', '=', 'perempuans.id')
            ->select('kelurahan.nama_kelurahan')
            ->selectRaw('COUNT(*) as jumlah_pernikahan')
            ->when(true, function ($query) use ($pendidikanLevels) {
                foreach ($pendidikanLevels as $level) {
                    $query->selectRaw("
                    SUM(CASE WHEN prias.pendidikan = ? THEN 1 ELSE 0 END) as pria_{$level}", [$level]);
                    $query->selectRaw("
                    SUM(CASE WHEN perempuans.pendidikan = ? THEN 1 ELSE 0 END) as perempuan_{$level}", [$level]);
                }
            })
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->groupBy('kelurahan.nama_kelurahan')
            ->orderBy('kelurahan.nama_kelurahan')
            ->get();

        $pdf = Pdf::loadView('laporan.pendidikan_pdf', [
            'data' => $data,
            'tahun' => $tahun,
            'pendidikanLevels' => $pendidikanLevels,
            'title' => 'Laporan Pendidikan Pasangan per Kelurahan'
        ])->setPaper('A4', 'landscape');

        return $pdf->stream("laporan_pendidikan_{$tahun}.pdf");
    }
}
