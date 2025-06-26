<?php

namespace App\Http\Controllers;

use App\Models\Perempuan;
use Illuminate\Http\Request;

class PerempuanController extends Controller
{
    /**[]
     * Get all data of Perempuan.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $sertifSucatin = $request->query('sertif_sucatin');

        // Query berdasarkan kondisi sertif_sucatin
        if ($sertifSucatin === 'true') {
            $data = Perempuan::where('sertif_sucatin', 'true')->get();
        } elseif ($sertifSucatin === 'false') {
            $data = Perempuan::where('sertif_sucatin', 'false')->get();
        } else {
            // Jika query parameter tidak diberikan atau nilainya tidak sesuai, ambil semua data
            $data = Perempuan::all();
        }

        // Kembalikan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ]);
    }

    /**
     * Get detail of a specific Perempuan by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $data = Perempuan::find($id);

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
     * Update a specific Perempuan's data.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $data = Perempuan::find($id);

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
     * Store a new Perempuan record.
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
        $data = Perempuan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data created successfully',
            'data' => $data
        ], 201);
    }

    /**
     * Delete a specific Perempuan record by ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $data = Perempuan::find($id);

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
