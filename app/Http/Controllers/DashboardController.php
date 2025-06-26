<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = 2025;

        // Hitung jumlah pria dan wanita
        $pria = DB::table('prias')->whereYear('created_at', $tahun)->count();
        $wanita = DB::table('perempuans')->whereYear('created_at', $tahun)->count();
        $total = $pria + $wanita;

        // Hitung total pernikahan
        $pernikahan = DB::table('pernikahans')->whereYear('tanggal_pernikahan', $tahun)->count();

        // Pendidikan pria
        $pendidikanPria = DB::table('prias')
            ->select('pendidikan', DB::raw('COUNT(*) as jumlah'))
            ->whereYear('created_at', $tahun)
            ->groupBy('pendidikan')
            ->get();

        // Pendidikan wanita
        $pendidikanWanita = DB::table('perempuans')
            ->select('pendidikan', DB::raw('COUNT(*) as jumlah'))
            ->whereYear('created_at', $tahun)
            ->groupBy('pendidikan')
            ->get();

        // Gabungkan pendidikan pria dan wanita
        $pendidikan = collect();

        foreach ($pendidikanPria as $item) {
            $pendidikan[$item->pendidikan] = ($pendidikan[$item->pendidikan] ?? 0) + $item->jumlah;
        }

        foreach ($pendidikanWanita as $item) {
            $pendidikan[$item->pendidikan] = ($pendidikan[$item->pendidikan] ?? 0) + $item->jumlah;
        }

        // Hitung jumlah pernikahan per kelurahan
        $per_kelurahan = DB::table('kelurahan')
            ->join('pernikahans', 'kelurahan.id', '=', 'pernikahans.id_kelurahan')
            ->select('kelurahan.nama_kelurahan', DB::raw('COUNT(*) as jumlah'))
            ->whereYear('pernikahans.tanggal_pernikahan', $tahun)
            ->groupBy('kelurahan.nama_kelurahan')
            ->get();
        return view('dashboard.index', compact(
            'pria',
            'wanita',
            'total',
            'pernikahan',
            'pendidikan',
            'per_kelurahan'
        ));
    }
}
