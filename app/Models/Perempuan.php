<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perempuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'usia',
        'pendidikan',
        'sertif_sucatin'
    ];
}
