<?php

namespace App\Http\Controllers;

use App\Models\UsiaPengantin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UsiaPengantinController extends Controller
{
    // Index: Fetch all usia pengantin data along with perkawinan data
    public function index()
    {
        $usiaPengantins = UsiaPengantin::with('perkawinan')->get();
        return response()->json($usiaPengantins);
    }

    // Store: Save a new usia pengantin

    public function store(Request $request)
    {
        $validated = $request->validate([
            'usia_pengantin.*.laki_minus_19' => 'required|integer|min:0',
            'usia_pengantin.*.laki_19_21' => 'required|integer|min:0',
            'usia_pengantin.*.laki_21_30' => 'required|integer|min:0',
            'usia_pengantin.*.laki_30_plus' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_minus_19' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_19_21' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_21_30' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_30_plus' => 'required|integer|min:0',
            'laporan_id' => 'required|integer',
            'file' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('usia_pengantin_files', 'public');
        }

        foreach ($request->input('usia_pengantin') as $perkawinan_id => $data) {
            UsiaPengantin::updateOrCreate(
                ['perkawinan_id' => $perkawinan_id],
                array_merge($data, ['file' => $filePath])
            );
        }

        return response()->json(['message' => 'Data usia pengantin berhasil disimpan.'], 201);
    }


    // Show: Get specific usia pengantin by laporan_id
    public function show($laporan_id)
    {
        $usiaPengantins = UsiaPengantin::where('laporan_id', $laporan_id)->with('perkawinan')->get();

        if ($usiaPengantins->isEmpty()) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json($usiaPengantins);
    }

    // Update: Update usia pengantin record by ID
    public function update(Request $request, $laporan_id)
    {
        $validated = $request->validate([
            'usia_pengantin.*.laki_minus_19' => 'required|integer|min:0',
            'usia_pengantin.*.laki_19_21' => 'required|integer|min:0',
            'usia_pengantin.*.laki_21_30' => 'required|integer|min:0',
            'usia_pengantin.*.laki_30_plus' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_minus_19' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_19_21' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_21_30' => 'required|integer|min:0',
            'usia_pengantin.*.wanita_30_plus' => 'required|integer|min:0',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('usia_pengantin_files', 'public');
        }

        foreach ($request->input('usia_pengantin') as $perkawinan_id => $data) {
            $usiaPengantin = UsiaPengantin::where('perkawinan_id', $perkawinan_id)
                ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                    $query->where('laporan_id', $laporan_id);
                })
                ->first();

            if ($usiaPengantin) {
                if ($filePath) {
                    Storage::disk('public')->delete($usiaPengantin->file);
                    $usiaPengantin->update(array_merge($data, ['file' => $filePath]));
                } else {
                    $usiaPengantin->update($data);
                }
            } else {
                UsiaPengantin::create(array_merge($data, ['file' => $filePath, 'perkawinan_id' => $perkawinan_id]));
            }
        }

        return response()->json(['message' => 'Data usia pengantin berhasil diperbarui.']);
    }


    // Destroy: Delete a specific usia pengantin by ID
    public function destroy($laporan_id)
    {
        // Fetch records based on laporan_id
        $usiaPengantins = UsiaPengantin::where('laporan_id', $laporan_id)->get();

        if ($usiaPengantins->isEmpty()) {
            return response()->json(['message' => 'Laporan ID not found'], 404);
        }

        // Delete the records
        foreach ($usiaPengantins as $usiaPengantin) {
            $usiaPengantin->delete();
        }

        return response()->json(['message' => 'Data usia pengantin berhasil dihapus.'], 204);
    }

    // Check existence of laporan_id for usia pengantin
    public function check($laporan_id)
    {
        // Retrieve the UsiaPengantin data along with the laporan_id through the related Perkawinan
        $usiaPengantin = UsiaPengantin::with('perkawinan.laporan') // Eager load the related Perkawinan and Laporan
            ->whereHas('perkawinan', function ($query) use ($laporan_id) {
                $query->where('laporan_id', $laporan_id);
            })
            ->get();

        // Return the data along with the laporan_id
        return response()->json([
            'exists' => $usiaPengantin->isNotEmpty(), // Check if any data exists
            'data' => $usiaPengantin // Return the UsiaPengantin data
        ]);
    }
}
