<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeristiwaPerkawinan extends Model
{
    use HasFactory;

    protected $table = 'peristiwa_perkawinan';
    protected $fillable = [
        'perkawinan_id',
        'kantor',
        'luar_kantor',
        'perkawinan_campuran_laki',
        'perkawinan_campuran_perempuan',
        'rujuk',
        'file' // Tambahkan file dalam fillable
    ];

    // Relasi ke tabel Perkawinan
    public function perkawinan()
    {
        return $this->belongsTo(Perkawinan::class);
    }
}
