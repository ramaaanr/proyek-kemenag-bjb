<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PernikahanIndexResource extends JsonResource
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
            // Data relasi pria, hanya ditampilkan jika relasi telah dimuat
            'pria' => $this->whenLoaded('pria', function () {
                return [
                    'id' => $this->pria->id,
                    'nama' => $this->pria->nama,
                ];
            }),

            // Data relasi perempuan, hanya ditampilkan jika relasi telah dimuat
            'perempuan' => $this->whenLoaded('perempuan', function () {
                return [
                    'id' => $this->perempuan->id,
                    'nama' => $this->perempuan->nama,
                ];
            }),

            'status_pernikahan' => $this->whenLoaded('statusPernikahan', function () {
                return [
                    'id' => $this->statusPernikahan->id,
                    'status' => $this->statusPernikahan->status,
                ];
            }),

        ];
    }
}
