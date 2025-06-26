<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkawinan extends Model
{
    use HasFactory;

    protected $table = 'perkawinan';
    protected $fillable = [
        'laporan_id',
        'kelurahan_id',
        'jumlah_perkawinan',
        'peristiwa_perkawinan',
        'pendidikan_perkawinan',
        'kursus_calon_pengantin',
        'usia_pengantin',
    ];


    // Relasi ke tabel Laporan
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    // Relasi ke tabel Kelurahan
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    // Relasi ke tabel PeristiwaPerkawinan
    public function peristiwaPerkawinan()
    {
        return $this->hasOne(PeristiwaPerkawinan::class);
    }

    // Relasi ke tabel PendidikanPerkawinan
    public function pendidikanPerkawinan()
    {
        return $this->hasOne(PendidikanPerkawinan::class);
    }

    // Relasi ke tabel KursusCalonPengantin
    public function kursusCalonPengantin()
    {
        return $this->hasOne(KursusCalonPengantin::class);
    }

    // Relasi ke tabel UsiaPengantin
    public function usiaPengantin()
    {
        return $this->hasOne(UsiaPengantin::class);
    }
}
