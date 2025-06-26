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
        'id_kelurahan',
        'hasil_rujukan',
        'tanggal_pernikahan'
    ];
    protected $appends = ['nama_kelurahan', 'nama_kecamatan'];

    public function getNamaKelurahanAttribute()
    {
        return $this->kelurahan->nama_kelurahan ?? null;
    }

    public function getNamaKecamatanAttribute()
    {
        return $this->kelurahan->kecamatan->nama_kecamatan ?? null;
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'id_kelurahan');
    }
    // Relasi ke tabel Kecamatan
    // Tambahkan method ini:
    public function kecamatan()
    {
        return $this->kelurahan ? $this->kelurahan->kecamatan : null;
    }

    public function pria()
    {
        return $this->belongsTo(Pria::class, 'id_pria', 'id');
    }
    public function perempuan()
    {
        return $this->belongsTo(Perempuan::class, 'id_perempuan', 'id');
    }
}
