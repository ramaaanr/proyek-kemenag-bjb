<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use SoftDeletes; // Tambahkan ini
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'laporan'; // Nama tabel yang benar, bukan 'laporans'

    protected $fillable = ['tahun', 'bulan', 'status', 'user_id'];

    const STATUS_BELUM = 'BELUM';
    const STATUS_DIAJUKAN = 'DIAJUKAN';
    const STATUS_DITOLAK = 'DITOLAK';
    const STATUS_DISETUJUI = 'DISETUJUI';
    public function perkawinans()
    {
        return $this->hasMany(Perkawinan::class, 'laporan_id');
    }
}