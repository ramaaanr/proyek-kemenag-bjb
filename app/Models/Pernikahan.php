<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pernikahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pria',
        'id_perempuan',
        'id_user',
        'kecamatan',
        'tempat_pernikahan',
        'tanggal_pernikahan'
    ];
    public function pria()
    {
        return $this->belongsTo(Pria::class, 'id_pria', 'id');
    }
    public function perempuan()
    {
        return $this->belongsTo(Perempuan::class, 'id_perempuan', 'id');
    }

    public function statusPernikahan()
    {
        return $this->hasOne(StatusPernikahan::class, 'id_pernikahan', 'id');
    }
}
