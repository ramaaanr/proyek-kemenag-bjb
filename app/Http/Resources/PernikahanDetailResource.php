<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PernikahanDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tanggal_pernikahan' => $this->tanggal_pernikahan,
            'kecamatan' => $this->kecamatan,
            'tempat_pernikahan' => $this->tempat_pernikahan,

            'status_pernikahan' => $this->whenLoaded('statusPernikahan', function (){
                return [
                    'id' => $this->statusPernikahan->id,
                    'status' => $this->statusPernikahan->status,
                    'tanggal_perceraian' => $this->statusPernikahan->tanggal_perceraian,
                    'alasan_cerai' => $this->statusPernikahan->alasan_cerai
                ];
            }),

            // Data relasi pria, hanya ditampilkan jika relasi telah dimuat
            'pria' => $this->whenLoaded('pria', function () {
                return [
                    'id' => $this->pria->id,
                    'nama' => $this->pria->nama,
                    'usia' => $this->pria->usia,
                    'pendidikan' => $this->pria->pendidikan,
                    'sertif_sucatin' => $this->pria->sertif_sucatin
                ];
            }),

            // Data relasi perempuan, hanya ditampilkan jika relasi telah dimuat
            'perempuan' => $this->whenLoaded('perempuan', function () {
                return [
                    'id' => $this->perempuan->id,
                    'nama' => $this->perempuan->nama,
                    'usia' => $this->perempuan->usia,
                    'pendidikan' => $this->perempuan->pendidikan,
                    'sertif_sucatin' => $this->perempuan->sertif_sucatin
                ];
            }),
        ];
    }
}
