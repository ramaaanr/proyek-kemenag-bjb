<?php

namespace App\Http\Controllers;

use App\Models\PendidikanPerkawinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendidikanPerkawinanController extends Controller
{
    // Index: Fetch all pendidikan perkawinan along with perkawinan data
    public function index()
    {
        $pendidikanPerkawinans = PendidikanPerkawinan::with('perkawinan')->get();
        return response()->json($pendidikanPerkawinans);
    }

    // Store: Save a new pendidikan perkawinan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendidikan.*.laki_sd' => 'required|integer|min:0',
            'pendidikan.*.laki_smp' => 'required|integer|min:0',
            'pendidikan.*.laki_sma' => 'required|integer|min:0',
            'pendidikan.*.laki_sarjana' => 'required|integer|min:0',
            'pendidikan.*.wanita_sd' => 'required|integer|min:0',
            'pendidikan.*.wanita_smp' => 'required|integer|min:0',
            'pendidikan.*.wanita_sma' => 'required|integer|min:0',
            'pendidikan.*.wanita_sarjana' => 'required|integer|min:0',
            'laporan_id' => 'required|integer',
            'file' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ], [
            'file.mimes' => 'File harus dalam format PDF, JPG, atau PNG.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pendidikan_perkawinan_files', 'public');
        }

        foreach ($request->input('pendidikan') as $perkawinan_id => $data) {
            PendidikanPerkawinan::updateOrCreate(
                ['perkawinan_id' => $perkawinan_id],
                array_merge($data, ['file' => $filePath])
            );
        }

        return response()->json(['message' => 'Data pendidikan perkawinan berhasil disimpan.'], 201);
    }

    // Show: Get specific pendidikan perkawinan by laporan_id
    public function show($laporan_id)
    {
        $pendidikanPerkawinans = PendidikanPerkawinan::whereHas('perkawinan', function ($query) use ($laporan_id) {
            $query->where('laporan_id', $laporan_id);
        })->with('perkawinan')->get();

        if ($pendidikanPerkawinans->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($pendidikanPerkawinans);
    }

    // Update: Update a pendidikan perkawinan record by laporan_id
    public function update(Request $request, $laporan_id)
    {
        $validated = $request->validate([
            'pendidikan.*.laki_sd' => 'required|integer|min:0',
            'pendidikan.*.laki_smp' => 'required|integer|min:0',
            'pendidikan.*.laki_sma' => 'required|integer|min:0',
            'pendidikan.*.laki_sarjana' => 'required|integer|min:0',
            'pendidikan.*.wanita_sd' => 'required|integer|min:0',
            'pendidikan.*.wanita_smp' => 'required|integer|min:0',
            'pendidikan.*.wanita_sma' => 'required|integer|min:0',
            'pendidikan.*.wanita_sarjana' => 'required|integer|min:0',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pendidikan_perkawinan_files', 'public');
        }

        foreach ($request->input('pendidikan') as $perkawinan_id => $data) {
            $pendidikan = PendidikanPerkawinan::where('perkawinan_id', $perkawinan_id)
                ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                    $query->where('laporan_id', $laporan_id);
                })
                ->first();

            if ($pendidikan) {
                if ($filePath) {
                    Storage::disk('public')->delete($pendidikan->file);
                    $pendidikan->update(array_merge($data, ['file' => $filePath]));
                } else {
                    $pendidikan->update($data);
                }
            } else {
                PendidikanPerkawinan::create(array_merge($data, ['file' => $filePath, 'perkawinan_id' => $perkawinan_id]));
            }
        }

        return response()->json(['message' => 'Data pendidikan perkawinan berhasil diperbarui.']);
    }

    // Destroy: Delete a specific pendidikan perkawinan by laporan_id
    public function destroy($laporan_id)
    {
        $pendidikanPerkawinans = PendidikanPerkawinan::whereHas('perkawinan', function ($query) use ($laporan_id) {
            $query->where('laporan_id', $laporan_id);
        })->get();

        if ($pendidikanPerkawinans->isEmpty()) {
            return response()->json(['message' => 'Laporan ID not found'], 404);
        }

        foreach ($pendidikanPerkawinans as $pendidikan) {
            Storage::disk('public')->delete($pendidikan->file);
            $pendidikan->delete();
        }

        return response()->json(['message' => 'Data pendidikan perkawinan berhasil dihapus.'], 204);
    }

    // Check existence of laporan_id for pendidikan perkawinan
    public function check($laporan_id)
    {
        $pendidikanPerkawinan = PendidikanPerkawinan::with('perkawinan.laporan')
            ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                $query->where('laporan_id', $laporan_id);
            })
            ->get();

        return response()->json([
            'exists' => $pendidikanPerkawinan->isNotEmpty(),
            'data' => $pendidikanPerkawinan
        ]);
    }
}
