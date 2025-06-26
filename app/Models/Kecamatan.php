<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = [
        'nama_kecamatan',
    ];

    // Relasi: Satu kecamatan punya banyak kelurahan
    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class, 'id_kecamatan');
    }
}
