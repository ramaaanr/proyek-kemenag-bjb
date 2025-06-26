<?php

namespace App\Services;

use App\Models\Perempuan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PerempuanServices
{
    // public function doStore($data)
    // {
    //     // Ubah key yang memiliki suffix "_perempuan"
    //     $formattedData = [];
    //     foreach ($data as $key => $value) {
    //         $newKey = str_replace('_perempuan', '', $key); // Hapus "_perempuan"
    //         $formattedData[$newKey] = $value;
    //     }
    //     // Lakukan proses insert ke database
    //     $perempuan = Perempuan::create($formattedData);
    //     return $perempuan;
    // }

    public function doStore($data)
    {
        $perempuan = Perempuan::create($data);
        if ($perempuan) {
            return ([
                'status' => true,
                'message' => "Data Berhasil Disimpan"
            ]);
        }
        return ([
            'status' => false,
            'message' => "Data Gagal Disimpan"
        ]);
    }

    public function doDestroy($id)
    {
        try {
            $perempuan = Perempuan::findOrFail($id);
            if ($perempuan){
                $perempuan->destroy($id);
                return ([
                    'status' => true,
                    'message' => "Data Berhasil Dihapus"
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => "Data Tidak Ditemukan"
            ]);
        }
    }

    public function doUpdate($data, $idPerempuan)
    {
        // Ubah key yang memiliki suffix "_perempuan"
        $formattedData = [];
        foreach ($data as $key => $value) {
            $newKey = str_replace('_perempuan', '', $key); // Hapus "_perempuan"
            $formattedData[$newKey] = $value;
        }
        // Lakukan proses update ke database
        $perempuan = Perempuan::findOrFail($idPerempuan);
        if ($perempuan) {
            $perempuan->update($formattedData);
            return $perempuan;
        }
    }
}
