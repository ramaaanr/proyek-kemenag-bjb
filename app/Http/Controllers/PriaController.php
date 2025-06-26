<?php

namespace App\Http\Controllers;

use App\Models\Pria;
use Illuminate\Http\Request;

class PriaController extends Controller
{
    /**
     * Get all data of Pria.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        // Ambil nilai query parameter 'sertif_sucatin' dari request
        $sertifSucatin = $request->query('sertif_sucatin');

        // Query berdasarkan kondisi sertif_sucatin
        if ($sertifSucatin === 'true') {
            $data = Pria::where('sertif_sucatin', 'true')->get();
        } elseif ($sertifSucatin === 'false') {
            $data = Pria::where('sertif_sucatin', 'false')->get();
        } else {
            // Jika query parameter tidak diberikan atau nilainya tidak sesuai, ambil semua data
            $data = Pria::all();
        }

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }


    /**
     * Get detail of a specific Pria by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $data = Pria::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }

    /**
     * Update a specific Pria's data.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = Pria::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
            ], 404);
        }

        // Validate request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'usia' => 'required|integer|min:0',
            'pendidikan' => 'required|string|max:255',
            'sertif_sucatin' => 'required',
            'kewarganegaraan' => 'required',

        ]);

        // Update data
        $data->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data updated successfully',
            'data' => $data
        ]);
    }


    /**
     * Store a new Pria record.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'usia' => 'required|integer|min:0',
            'pendidikan' => 'required|string|max:255',
            'sertif_sucatin' => 'required',
            'kewarganegaraan' => 'required',
        ]);

        // Create new record
        $data = Pria::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data created successfully',
            'data' => $data
        ], 201);
    }

    /**
     * Delete a specific Pria record by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $data = Pria::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data not found',
            ], 404);
        }

        // Delete the record
        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
        ]);
    }
}
