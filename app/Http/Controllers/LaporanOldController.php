<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap query parameter status
        $status = $request->query('status');

        // Query dasar dengan eager loading
        $query = Laporan::with([
            'perkawinans',
            'perkawinans.peristiwaPerkawinan',
            'perkawinans.pendidikanPerkawinan',
            'perkawinans.kursusCalonPengantin',
            'perkawinans.usiaPengantin'
        ]);

        // Jika status diberikan, tambahkan filter
        if ($status) {
            $query->where('status', $status);
        }

        // Ambil hasil query
        $laporans = $query->get();

        // Kembalikan sebagai JSON
        return response()->json($laporans);
    }
    public function setujuiLaporan($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
            $laporan->status = 'DISETUJUI';
            $laporan->save();

            return response()->json(['message' => 'Laporan berhasil disetujui.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Fungsi untuk menolak laporan
    public function tolakLaporan($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
            $laporan->status = 'DITOLAK';
            $laporan->save();

            return response()->json(['message' => 'Laporan berhasil ditolak.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    public function pendingLaporan($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
            $laporan->status = 'DIPENDING';
            $laporan->save();

            return response()->json(['message' => 'Laporan berhasil dipending.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }



    public function checkLaporan($tahun, $bulan)
    {
        // Cek apakah ada laporan dengan tahun dan bulan tersebut
        $laporan = Laporan::where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->exists();

        // Return response berupa JSON
        return response()->json([
            'exists' => $laporan
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data sebelum disimpan
        $request->validate([
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
        ]);

        // Cek apakah laporan sudah ada
        $laporanExists = Laporan::where('tahun', $request->tahun)
            ->where('bulan', $request->bulan)
            ->exists();

        if ($laporanExists) {
            return response()->json(['success' => false, 'message' => 'Laporan sudah ada'], 400);
        }

        // Menambahkan user_id berdasarkan session pengguna yang sedang login
        $data = $request->all();
        $data['user_id'] = 1;  // Mendapatkan user_id dari session

        // Simpan laporan baru
        $laporan = Laporan::create($data);

        return response()->json(['success' => true, 'laporan' => $laporan], 201);
    }


    public function show($id)
    {
        $laporan = Laporan::with([
            'perkawinans',
            'perkawinans.kelurahan',
            'perkawinans.peristiwaPerkawinan',
            'perkawinans.pendidikanPerkawinan',
            'perkawinans.usiaPengantin',
            'perkawinans.kursusCalonPengantin',
        ])->findOrFail($id);
        return response()->json($laporan);
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->all());
        return response()->json($laporan);
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();
        return response()->json(null, 204);
    }
    public function ajukanLaporan($id)
    {
        try {
            $laporan = Laporan::findOrFail($id);

            // Cek apakah laporan sudah bisa diajukan
            if (!$laporan->perkawinans || count($laporan->perkawinans) == 0) {
                return response()->json(['message' => 'Silakan isi data perkawinan terlebih dahulu.'], 400);
            }

            // Cek apakah semua data perkawinan sudah diisi


            // Update status laporan menjadi "DIAJUKAN"
            $laporan->status = 'DIAJUKAN';
            $laporan->save();

            return response()->json(['message' => 'Laporan berhasil diajukan.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}