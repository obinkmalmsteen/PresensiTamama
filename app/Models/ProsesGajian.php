<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesGajian extends Model
{
    protected $table = 'proses_gajian'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'nik',
        'periode',
        'tgl_gajian',
        'gaji_pokok',
        // Tambahkan field lainnya yang dapat diisi
    ];

    // Definisikan relasi atau method lain jika diperlukan
}
