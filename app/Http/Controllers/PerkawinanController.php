<?php

namespace App\Http\Controllers;

use App\Models\Perkawinan;
use Illuminate\Http\Request;

class PerkawinanController extends Controller
{
    public function index()
    {
        $perkawinans = Perkawinan::with(['laporan', 'kelurahan'])->get();
        return response()->json($perkawinans);
    }

    public function store(Request $request)
    {
        // Get laporan_id from the request
        $laporan_id = $request->laporan_id;

        // Validate the data
        $validated = $request->validate([
            'perkawinan.*.jumlah_perkawinan' => 'required|integer|min:0',
            'perkawinan.*.kelurahan_id' => 'required|exists:kelurahan,id',
        ]);

        // Loop through the perkawinan data and store them
        foreach ($request->perkawinan as $kelurahanData) {
            Perkawinan::create([
                'laporan_id' => $laporan_id,
                'kelurahan_id' => $kelurahanData['kelurahan_id'],
                'jumlah_perkawinan' => $kelurahanData['jumlah_perkawinan'],
            ]);
        }

        return response()->json(['message' => 'Data perkawinan berhasil ditambahkan'], 201);
    }

    public function show($laporan_id)
    {
        // Fetch perkawinan data based on laporan_id
        $perkawinan = Perkawinan::with(['laporan', 'kelurahan'])
            ->where('laporan_id', $laporan_id)
            ->get();

        return response()->json($perkawinan);
    }


    // Check if laporan_id already exists
    public function check($laporan_id)
    {
        $perkawinan = Perkawinan::where('laporan_id', $laporan_id)->with(['laporan'])->get();

        if ($perkawinan->isNotEmpty()) {
            return response()->json([
                'exists' => true,
                'data' => $perkawinan
            ]);
        }

        return response()->json(['exists' => false]);
    }

    // Update existing perkawinan
    public function update(Request $request, $laporan_id)
    {
        // Validate the data
        $validated = $request->validate([
            'perkawinan.*.jumlah_perkawinan' => 'required|integer|min:0',
            'perkawinan.*.kelurahan_id' => 'required|exists:kelurahan,id',
        ]);

        // Delete old records for the laporan_id

        // Store new records
        foreach ($request->perkawinan as $kelurahanData) {
            Perkawinan::where('laporan_id', $laporan_id)
                ->where('kelurahan_id', $kelurahanData['kelurahan_id'])
                ->update(['jumlah_perkawinan' => $kelurahanData['jumlah_perkawinan']]);
        }

        return response()->json(['message' => 'Data perkawinan berhasil diperbarui']);
    }


    public function destroy($id)
    {
        $perkawinan = Perkawinan::findOrFail($id);
        $perkawinan->delete();
        return response()->json(null, 204);
    }
}