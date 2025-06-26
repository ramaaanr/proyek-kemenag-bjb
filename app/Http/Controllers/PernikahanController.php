<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\StatusPernikahanServices;
use App\Services\PerempuanServices;
use App\Services\PernikahanServices;
use App\Services\PriaServices;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use App\Models\Pria;
use App\Models\Perempuan;
use App\Models\Pernikahan;


class PernikahanController extends Controller
{
    protected $pernikahanServices;
    protected $priaServices;
    protected $perempuanServices;
    protected $statusPernikahanServices;
    function __construct()
    {
        $this->pernikahanServices = new PernikahanServices;
        $this->priaServices = new PriaServices;
        $this->perempuanServices = new PerempuanServices;
        $this->statusPernikahanServices = new StatusPernikahanServices;
    }


    public function showViewForm()
    {
        $kelurahans = Kelurahan::all();
        return view('pernikahan.form', [
            'kelurahans' => $kelurahans
        ]);
    }
    public function showViewEdit()
    {
        $kelurahans = Kelurahan::all();
        return view('pernikahan.edit', [
            'kelurahans' => $kelurahans
        ]);
    }
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Pernikahan::with(['pria', 'perempuan']); // Tambahkan relasi pria dan perempuan

        $results = $query->get();
        return response()->json([
            'status' => 'success',
            'data' => $results,
        ]);
    }


    public function show($id)
    {
        $pernikahan = Pernikahan::with(['pria', 'perempuan'])
            ->findOrFail($id); // Temukan data berdasarkan ID, jika tidak ada akan memberikan 404

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $pernikahan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pria' => 'required',
            'id_perempuan' => 'required',
            'id_user' => 'required',
            'id_kelurahan' => 'required',
            'tempat_pernikahan' => 'required',
            'tanggal_pernikahan' => 'required',
            'hasil_rujukan' => 'required',

        ]);

        // Simpan data pernikahan
        $pernikahan = $this->pernikahanServices->doStore($request->all());

        if ($pernikahan) {
            // Update sertif_sucatin untuk Pria
            Pria::where('id', $request->id_pria)->update(['sertif_sucatin' => 'true']);

            // Update sertif_sucatin untuk Perempuan
            Perempuan::where('id', $request->id_perempuan)->update(['sertif_sucatin' => 'true']);

            // Simpan status pernikahan
            $statusPernikahan = $this->statusPernikahanServices->doStore($pernikahan->id);

            return $statusPernikahan;
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tanggal_pernikahan' => 'required|date',
                'id_kelurahan' => 'required',
                'hasil_rujukan' => 'required',
            ]);

            $pernikahan = Pernikahan::findOrFail($id);

            $pernikahan->tanggal_pernikahan = $validated['tanggal_pernikahan'];
            $pernikahan->id_kelurahan = $validated['id_kelurahan'];
            $pernikahan->hasil_rujukan = $validated['hasil_rujukan'];

            $pernikahan->save();

            return response()->json([
                'success' => true,
                'message' => 'Data pernikahan berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        // Ambil data pernikahan berdasarkan ID
        $pernikahan = Pernikahan::findOrFail($id);

        // Ambil ID pria dan perempuan terkait
        $pria = $pernikahan->pria;
        $perempuan = $pernikahan->perempuan;

        // Update sertif_sucation menjadi false pada pria dan perempuan
        if ($pria) {
            $pria->sertif_sucatin = "false";
            $pria->save();
        }

        if ($perempuan) {
            $perempuan->sertif_sucatin = "false";
            $perempuan->save();
        }

        // Hapus data pernikahan
        $pernikahan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pernikahan berhasil dihapus dan status sertif_sucation diubah.'
        ]);
    }
}
