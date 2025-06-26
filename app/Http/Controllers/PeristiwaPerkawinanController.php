<?php

namespace App\Http\Controllers;

use App\Models\PeristiwaPerkawinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PeristiwaPerkawinanController extends Controller
{
    // Index: Fetch all peristiwa perkawinan along with perkawinan data
    public function index()
    {
        $peristiwaPerkawinans = PeristiwaPerkawinan::with('perkawinan')->get();
        return response()->json($peristiwaPerkawinans);
    }

    // Store: Save a new peristiwa perkawinan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'peristiwa.*.kantor' => 'required|integer|min:0',
            'peristiwa.*.luar_kantor' => 'required|integer|min:0',
            'peristiwa.*.perkawinan_campuran_laki' => 'required|integer|min:0',
            'peristiwa.*.perkawinan_campuran_perempuan' => 'required|integer|min:0',
            'peristiwa.*.rujuk' => 'required|integer|min:0',
            'laporan_id' => 'required|integer',
            'file' => 'required|nullable|file|mimes:pdf,jpg,png|max:2048'
        ], [
            'peristiwa.*.kantor.required' => 'Jumlah peristiwa di kantor harus diisi.',
            'peristiwa.*.luar_kantor.required' => 'Jumlah peristiwa luar kantor harus diisi.',
            'peristiwa.*.perkawinan_campuran_laki.required' => 'Jumlah perkawinan campuran laki-laki harus diisi.',
            'peristiwa.*.perkawinan_campuran_perempuan.required' => 'Jumlah perkawinan campuran perempuan harus diisi.',
            'peristiwa.*.rujuk.required' => 'Jumlah rujuk harus diisi.',
            'laporan_id.required' => 'Laporan ID harus diisi.',
            'file.mimes' => 'File harus dalam format PDF, JPG, atau PNG.',
            'file.required' => 'File Wajib Diisi',
            'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('peristiwa_perkawinan_files', 'public');
        }

        foreach ($request->input('peristiwa') as $perkawinan_id => $data) {
            PeristiwaPerkawinan::updateOrCreate(
                ['perkawinan_id' => $perkawinan_id],
                array_merge($data, ['file' => $filePath])
            );
        }

        return response()->json(
            ['message' => 'Data berhasil disimpan.'],
            201
        );
    }


    // Show: Get specific peristiwa perkawinan by laporan_id
    public function show($laporan_id)
    {
        $peristiwaPerkawinans = PeristiwaPerkawinan::where('laporan_id', $laporan_id)->with('perkawinan')->get();

        if ($peristiwaPerkawinans->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($peristiwaPerkawinans);
    }

    // Update: Update a peristiwa perkawinan record by ID
    public function update(Request $request, $laporan_id)
    {
        $validated = $request->validate([
            'peristiwa.*.kantor' => 'required|integer|min:0',
            'peristiwa.*.luar_kantor' => 'required|integer|min:0',
            'peristiwa.*.perkawinan_campuran_laki' => 'required|integer|min:0',
            'peristiwa.*.perkawinan_campuran_perempuan' => 'required|integer|min:0',
            'peristiwa.*.rujuk' => 'required|integer|min:0',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('peristiwa_perkawinan_files', 'public');
        }

        foreach ($request->input('peristiwa') as $perkawinan_id => $data) {
            $peristiwa = PeristiwaPerkawinan::where('perkawinan_id', $perkawinan_id)
                ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                    $query->where('laporan_id', $laporan_id);
                })
                ->first();
            if ($peristiwa) {
                if ($filePath) {
                    Storage::disk('public')->delete($peristiwa->file);
                    $peristiwa->update(array_merge($data, ['file' => $filePath]));
                } else {
                    $peristiwa->update($data);
                }
            } else {
                PeristiwaPerkawinan::create(array_merge($data, ['file' => $filePath, 'perkawinan_id' => $perkawinan_id]));
            }
        }

        return response()->json(['message' => 'Data berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $peristiwa = PeristiwaPerkawinan::find($id);
        if (!$peristiwa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        Storage::disk('public')->delete($peristiwa->file);
        $peristiwa->delete();

        return response()->json(['message' => 'Data berhasil dihapus.'], 204);
    }

    // Check existence of laporan_id for peristiwa perkawinan
    public function check($laporan_id)
    {
        // Retrieve the PeristiwaPerkawinan data along with the laporan_id through the related Perkawinan
        $peristiwaPerkawinan = PeristiwaPerkawinan::with('perkawinan.laporan') // Eager load the related Perkawinan and Laporan
            ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                $query->where('laporan_id', $laporan_id);
            })
            ->get();

        // Return the data along with the laporan_id
        return response()->json([
            'exists' => $peristiwaPerkawinan->isNotEmpty(), // Check if any data exists
            'data' => $peristiwaPerkawinan // Return the PeristiwaPerkawinan data
        ]);
    }
}
