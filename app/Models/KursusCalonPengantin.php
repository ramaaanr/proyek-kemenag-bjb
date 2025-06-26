<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusCalonPengantin extends Model
{
    use HasFactory;

    protected $table = 'kursus_calon_pengantin';
    protected $fillable = ['perkawinan_id', 'jumlah_laki', 'jumlah_wanita', 'file'];

    // Relasi ke tabel Perkawinan
    public function perkawinan()
    {
        return $this->belongsTo(Perkawinan::class);
    }
}
