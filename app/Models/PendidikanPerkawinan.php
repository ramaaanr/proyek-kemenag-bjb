<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanPerkawinan extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_perkawinan';
    protected $fillable = [
        'perkawinan_id',
        'laki_sd',
        'laki_smp',
        'laki_sma',
        'laki_sarjana',
        'wanita_sd',
        'wanita_smp',
        'wanita_sma',
        'file',
        'wanita_sarjana'
    ];

    // Relasi ke tabel Perkawinan
    public function perkawinan()
    {
        return $this->belongsTo(Perkawinan::class);
    }
}
