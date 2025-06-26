<?php

namespace App\Http\Controllers;

use App\Models\KursusCalonPengantin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class KursusCalonPengantinController extends Controller
{
    // Index: Fetch all kursus calon pengantin along with perkawinan data
    public function index()
    {
        $kursusCalonPengantins = KursusCalonPengantin::with('perkawinan')->get();
        return response()->json($kursusCalonPengantins);
    }

    // Store: Save a new kursus calon pengantin
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kursus.*.jumlah_laki' => 'required|integer|min:0',
            'kursus.*.jumlah_wanita' => 'required|integer|min:0',
            'laporan_id' => 'required|integer',
            'file' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.mimes' => 'File harus dalam format PDF, JPG, atau PNG.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.'
        ]);

        // Simpan file
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('kursus_calon_pengantin_files', 'public');
        }

        foreach ($request->input('kursus') as $perkawinan_id => $data) {
            KursusCalonPengantin::updateOrCreate(
                ['perkawinan_id' => $perkawinan_id],
                array_merge($data, ['file' => $filePath])
            );
        }

        return response()->json(['message' => 'Data kursus calon pengantin berhasil disimpan.'], 201);
    }

    // Update: Update an existing kursus calon pengantin record
    public function update(Request $request, $laporan_id)
    {
        $validated = $request->validate([
            'kursus.*.jumlah_laki' => 'required|integer|min:0',
            'kursus.*.jumlah_wanita' => 'required|integer|min:0',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ], [
            'file.mimes' => 'File harus dalam format PDF, JPG, atau PNG.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('kursus_calon_pengantin_files', 'public');
        }

        foreach ($request->input('kursus') as $perkawinan_id => $data) {
            $kursus = KursusCalonPengantin::where('perkawinan_id', $perkawinan_id)
                ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                    $query->where('laporan_id', $laporan_id);
                })
                ->first();

            if ($kursus) {
                if ($filePath) {
                    Storage::disk('public')->delete($kursus->file);
                    $kursus->update(array_merge($data, ['file' => $filePath]));
                } else {
                    $kursus->update($data);
                }
            } else {
                KursusCalonPengantin::create(array_merge($data, ['file' => $filePath, 'perkawinan_id' => $perkawinan_id]));
            }
        }

        return response()->json(['message' => 'Data kursus calon pengantin berhasil diperbarui.']);
    }

    // Destroy: Delete a specific kursus calon pengantin by ID
    public function destroy($laporan_id)
    {
        // Fetch records based on laporan_id
        $kursusCalonPengantins = KursusCalonPengantin::where('laporan_id', $laporan_id)->get();

        if ($kursusCalonPengantins->isEmpty()) {
            return response()->json(['message' => 'Laporan ID not found'], 404);
        }

        // Delete the records
        foreach ($kursusCalonPengantins as $kursus) {
            $kursus->delete();
        }

        return response()->json(['message' => 'Data kursus calon pengantin berhasil dihapus.'], 204);
    }

    // Check existence of laporan_id for kursus calon pengantin
    public function check($laporan_id)
    {
        // Retrieve the KursusCalonPengantin data along with the laporan_id through the related Perkawinan
        $kursusCalonPengantin = KursusCalonPengantin::with('perkawinan.laporan') // Eager load the related Perkawinan and Laporan
            ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                $query->where('laporan_id', $laporan_id);
            })
            ->get();

        // Return the data along with the laporan_id
        return response()->json([
            'exists' => $kursusCalonPengantin->isNotEmpty(), // Check if any data exists
            'data' => $kursusCalonPengantin // Return the KursusCalonPengantin data
        ]);
    }
}
