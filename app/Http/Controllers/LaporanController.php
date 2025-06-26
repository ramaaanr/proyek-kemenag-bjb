<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Models\Pernikahan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Pria;
use App\Models\Perempuan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

    public function laporanKecamatan()
    {
        $data = DB::table('pernikahans')
            ->join('kelurahans', 'pernikahans.id_kelurahan', '=', 'kelurahans.id')
            ->join('kecamatans', 'kelurahans.id_kecamatan', '=', 'kecamatans.id')
            ->select('kecamatans.nama_kecamatan', DB::raw('COUNT(pernikahans.id) as jumlah'))
            ->groupBy('kecamatans.nama_kecamatan')
            ->orderByDesc('jumlah')
            ->get();

        return view('laporan.kecamatan', compact('data'));
    }

    public function laporanUsia()
    {
        $data = DB::table('pernikahans')
            ->join('prias', 'pernikahans.id_pria', '=', 'prias.id')
            ->selectRaw("
CASE
WHEN CAST(prias.usia AS UNSIGNED) < 20 THEN '<20'
    WHEN CAST(prias.usia AS UNSIGNED) BETWEEN 20 AND 30 THEN '20-30'
    ELSE '30+'
    END AS rentang_usia,
    COUNT(*) AS jumlah ")
            ->groupBy('rentang_usia')
            ->get();

        return view('laporan.usia', compact('data'));
    }

    public function laporanTren()
    {
        $data = DB::table(DB::raw(" (
    SELECT
    DATE_FORMAT(tanggal_pernikahan, '%Y-%m' ) AS bulan,
    COUNT(*) AS jumlah
    FROM pernikahans
    GROUP BY bulan
    ) as tren"))
            ->selectRaw("bulan, jumlah, jumlah - LAG(jumlah) OVER (ORDER BY bulan) as selisih")
            ->get();

        return view('laporan.tren', compact('data'));
    }

    public function laporanPeta()
    {
        // Ambil data jumlah pernikahan per kecamatan beserta geojson-nya
        $data = Kecamatan::withCount(['kelurahans as jumlah_pernikahan' => function ($query) {
            $query->join('pernikahans', 'kelurahans.id', '=', 'pernikahans.id_kelurahan');
        }])->get();

        return view('laporan.peta', compact('data'));
    }

    public function laporanUser()
    {
        $data = DB::table('pernikahans')
            ->join('users', 'users.id', '=', 'pernikahans.id_user')
            ->select('users.name as nama_user', DB::raw('COUNT(pernikahans.id) as jumlah'))
            ->groupBy('users.name')
            ->orderByDesc('jumlah')
            ->get();

        return view('laporan.user', compact('data'));
    }

    public function laporanPendidikan()
    {
        $pria = DB::table('pernikahans')
            ->join('prias', 'pernikahans.id_pria', '=', 'prias.id')
            ->select('prias.pendidikan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('prias.pendidikan')->get();

        $perempuan = DB::table('pernikahans')
            ->join('perempuans', 'pernikahans.id_perempuan', '=', 'perempuans.id')
            ->select('perempuans.pendidikan', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('perempuans.pendidikan')->get();

        return view('laporan.pendidikan', compact('pria', 'perempuan'));
    }
}
