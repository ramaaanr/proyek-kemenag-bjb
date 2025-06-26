<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsiaPengantin extends Model
{
    use HasFactory;

    protected $table = 'usia_pengantin';
    protected $fillable = [
        'perkawinan_id',
        'laki_minus_19',
        'laki_19_21',
        'laki_21_30',
        'laki_30_plus',
        'wanita_minus_19',
        'wanita_19_21',
        'wanita_21_30',
        'file',
        'wanita_30_plus'
    ];

    // Relasi ke tabel Perkawinan
    public function perkawinan()
    {
        return $this->belongsTo(Perkawinan::class);
    }
}
