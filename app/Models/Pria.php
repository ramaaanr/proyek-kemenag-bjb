<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'usia',
        'pendidikan',
        'sertif_sucatin',
        'kewarganegaraan',
    ];

    public function pernikahan()
    {
        return $this->hasOne(Pernikahan::class, 'id_pria', 'id');
    }
}
