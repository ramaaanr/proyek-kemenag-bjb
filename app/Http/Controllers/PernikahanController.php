<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\StatusPernikahanServices;
use App\Services\PerempuanServices;
use App\Services\PernikahanServices;
use App\Services\PriaServices;
use Illuminate\Http\Request;

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

    public function index (Request $request){
        $status = $request->query('status');
        $results = $this->pernikahanServices->getAll($status);
        return $results;
    }

    public function show($id){
        $results = $this->pernikahanServices->doShow($id);
        return $results;
    }

    public function store (Request $request){
        $request->validate([
            'id_user' => 'required',
            'kecamatan' => 'required',
            'tempat_pernikahan' => 'required',
            'tanggal_pernikahan' => 'required',
            'nama_pria' => 'required',
            'usia_pria' => 'required',
            'pendidikan_pria' => 'required',
            'sertif_sucatin_pria' => 'required',
            'nama_perempuan' => 'required',
            'usia_perempuan' => 'required',
            'pendidikan_perempuan' => 'required',
            'sertif_sucatin_perempuan' => 'required',
        ]);
        $dataPria = $request->except([
            'id_user',
            'kecamatan',
            'tempat_pernikahan',
            'tanggal_pernikahan',
            'nama_perempuan',
            'usia_perempuan',
            'pendidikan_perempuan',
            'sertif_sucatin_perempuan'
        ]);
        $dataPerempuan = $request->except([
            'id_user',
            'kecamatan',
            'tempat_pernikahan',
            'tanggal_pernikahan',
            'nama_pria',
            'usia_pria',
            'pendidikan_pria',
            'sertif_sucatin_pria'
        ]);
        $dataPernikahan = $request->except([
            'nama_pria',
            'usia_pria',
            'pendidikan_pria',
            'sertif_sucatin_pria',
            'nama_perempuan',
            'usia_perempuan',
            'pendidikan_perempuan',
            'sertif_sucatin_perempuan'
        ]);
        $createPria = $this->priaServices->doStore($dataPria);
        $createPerempuan = $this->perempuanServices->doStore($dataPerempuan);
        if ($createPria && $createPerempuan){
            $pernikahan = $this->pernikahanServices->doStore($createPria->id, $createPerempuan->id, $dataPernikahan);
            if ($pernikahan){
                $statusPernikahan = $this->statusPernikahanServices->doStore($pernikahan->id);
                return $statusPernikahan;
            }
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'id_user' => 'required',
            'kecamatan' => 'required',
            'tempat_pernikahan' => 'required',
            'tanggal_pernikahan' => 'required',
            'nama_pria' => 'required',
            'usia_pria' => 'required',
            'pendidikan_pria' => 'required',
            'sertif_sucatin_pria' => 'required',
            'nama_perempuan' => 'required',
            'usia_perempuan' => 'required',
            'pendidikan_perempuan' => 'required',
            'sertif_sucatin_perempuan' => 'required',
        ]);
        $dataPria = $request->except([
            'id_user',
            'kecamatan',
            'tempat_pernikahan',
            'tanggal_pernikahan',
            'nama_perempuan',
            'usia_perempuan',
            'pendidikan_perempuan',
            'sertif_sucatin_perempuan'
        ]);
        $dataPerempuan = $request->except([
            'id_user',
            'kecamatan',
            'tempat_pernikahan',
            'tanggal_pernikahan',
            'nama_pria',
            'usia_pria',
            'pendidikan_pria',
            'sertif_sucatin_pria'
        ]);
        $dataPernikahan = $request->except([
            'nama_pria',
            'usia_pria',
            'pendidikan_pria',
            'sertif_sucatin_pria',
            'nama_perempuan',
            'usia_perempuan',
            'pendidikan_perempuan',
            'sertif_sucatin_perempuan'
        ]);
        $dataStatusPernikahan = $request->only([
            'status',
            'tanggal_perceraian',
            'alasan_cerai'
        ]);

        $pernikahan = $this->pernikahanServices->doFind($id);
        if ($pernikahan){
            $updatePerempuan = $this->perempuanServices->doUpdate($dataPerempuan, $pernikahan->id_perempuan);
            $updatePria = $this->priaServices->doUpdate($dataPria, $pernikahan->id_pria);
            $updatePernikahan = $this->pernikahanServices->doUpdate($id, $dataPernikahan);
            if ($updatePerempuan && $updatePria && $updatePernikahan){
                $updateStatusPernikahan = $this->statusPernikahanServices->doUpdate($id, $dataStatusPernikahan);
                return $updateStatusPernikahan;
            }
        }
    }

    public function destroy($id){
        $pernikahan = $this->pernikahanServices->doFind($id);
        if ($pernikahan){
            $this->priaServices->doDestroy($pernikahan->id_pria);
            $this->perempuanServices->doDestroy($pernikahan->id_perempuan);
            return ([
                'status' => true,
                'message' => "Data Berhasil Dihapus!"
            ]);
        }
    }
}
