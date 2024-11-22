<?php

namespace App\Services;

use App\Http\Resources\PernikahanDetailResource;
use App\Models\Pernikahan;
use App\Http\Resources\PernikahanIndexResource;

class PernikahanServices
{
    public function getAll($status = null)
    {
        if ($status) {
            $pernikahan = Pernikahan::with(['pria', 'perempuan', 'statusPernikahan'])
                ->whereHas('statusPernikahan', function ($query) use ($status) {
                    $query->where('status', $status);
                })
                ->get();
        } else {
            $pernikahan = Pernikahan::with(['pria', 'perempuan', 'statusPernikahan'])->get();
        }
        return ([
            'status' => true,
            'message' => "Data Pernikahan",
            'data' => PernikahanIndexResource::collection($pernikahan)
        ]);
    }

    public function doShow($id)
    {
        $pernikahan = Pernikahan::with(['pria', 'perempuan', 'statusPernikahan'])->findOrFail($id);
        if ($pernikahan) {
            return ([
                'status' => true,
                'message' => "Detail Data Pernikahan",
                'data' => new PernikahanDetailResource($pernikahan)
            ]);
        }
    }

    public function doStore($idPria, $idPerempuan, $data)
    {
        $dataPernikahan = [
            'id_pria' => $idPria,
            'id_perempuan' => $idPerempuan,
            'id_user' => $data['id_user'],
            'kecamatan' => $data['kecamatan'],
            'tempat_pernikahan' => $data['tempat_pernikahan'],
            'tanggal_pernikahan' => $data['tanggal_pernikahan']
        ];
        $pernikahan = Pernikahan::create($dataPernikahan);
        if ($pernikahan) {
            return $pernikahan;
        }
    }

    public function doFind($id)
    {
        $pernikahan = Pernikahan::findOrFail($id);
        return $pernikahan;
    }

    public function doUpdate($id, $data)
    {
        $pernikahan = Pernikahan::findOrFail($id);
        if ($pernikahan) {
            $pernikahan->update($data);
            return ([
                'status' => true,
                'message' => "Data Berhasil Diubah!"
            ]);
        }
    }
}
