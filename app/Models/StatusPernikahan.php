<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPernikahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pernikahan',
        'status',
        'tanggal_perceraian',
        'alasan_cerai'
    ];

    public function pernikahan()
    {
        return $this->belongsTo(Pernikahan::class, 'id_pernikahan', 'id');
    }
}
