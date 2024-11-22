<?php
namespace App\Services;
use App\Models\StatusPernikahan;

class StatusPernikahanServices {
    public function doStore ($idPernikahan){
        $data = [
            'id_pernikahan' => $idPernikahan,
            'status' => "Menikah",
            'created_at' => now()->format('Asia/Makassar')
        ];
        $statusPernikahan = StatusPernikahan::create($data);
        if ($statusPernikahan){
            return ([
                'status' => true,
                'message' => "Data Berhasil Dibuat!"
            ]);
        }
    }

    public function doUpdate($id, $data){
        $statusPernikahan = StatusPernikahan::where('id_pernikahan', $id)->first();
        if ($statusPernikahan){
            $statusPernikahan->update($data);
            return ([
                'status' => true,
                'message' => "Data Berhasil Dirubah!"
            ]);
        }
    }
}