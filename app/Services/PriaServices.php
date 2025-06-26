<?php

namespace App\Services;

use App\Models\Pria;

class PriaServices
{
    // public function doStore($data)
    // {
    //     // Ubah key yang memiliki suffix "_pria"
    //     $formattedData = [];
    //     foreach ($data as $key => $value) {
    //         $newKey = str_replace('_pria', '', $key); // Hapus "_pria"
    //         $data[$newKey] = $value;
    //     }
    //     // Lakukan proses insert ke database
    //     $pria = Pria::create($data);
    //     return $pria;
    // }

    public function doStore($data){
        $pria = Pria::create($data);
        if ($pria){
            return([
                'status' => true,
                'message' => "Data Berhasil Disimpan"
            ]);
        }
        return([
            'status' => false,
            'message' => "Data Gagal Disimpan"
        ]);
    }




    public function doDestroy($id){
        $pria = Pria::destroy($id);
        return $pria;
    }

    public function doUpdate($data, $idPria){
        // Ubah key yang memiliki suffix "_pria"
        $formattedData = [];
        foreach ($data as $key => $value) {
            $newKey = str_replace('_pria', '', $key); // Hapus "_pria"
            $formattedData[$newKey] = $value;
        }
        // Lakukan proses update ke database
        $pria = Pria::findOrFail($idPria);
        if ($pria){
            $pria->update($formattedData);
            return $pria;
        }
    }
}
