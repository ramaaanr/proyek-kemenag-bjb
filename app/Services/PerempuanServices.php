<?php
namespace App\Services;
use App\Models\Perempuan;

class PerempuanServices {
    public function doStore($data)
    {
        // Ubah key yang memiliki suffix "_perempuan"
        $formattedData = [];
        foreach ($data as $key => $value) {
            $newKey = str_replace('_perempuan', '', $key); // Hapus "_perempuan"
            $formattedData[$newKey] = $value;
        }
        // Lakukan proses insert ke database
        $perempuan = Perempuan::create($formattedData);
        return $perempuan;
    }

    public function doDestroy($id){
        $perempuan = Perempuan::destroy($id);
        return $perempuan;
    }

    public function doUpdate($data, $idPerempuan){
        // Ubah key yang memiliki suffix "_perempuan"
        $formattedData = [];
        foreach ($data as $key => $value) {
            $newKey = str_replace('_perempuan', '', $key); // Hapus "_perempuan"
            $formattedData[$newKey] = $value;
        }
        // Lakukan proses update ke database
        $perempuan = Perempuan::findOrFail($idPerempuan);
        if ($perempuan){
            $perempuan->update($formattedData);
            return $perempuan;
        }
    }
}