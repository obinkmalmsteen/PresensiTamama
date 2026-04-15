<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasbonHarian extends Model
{
    use HasFactory;
    protected $table = 'kasbonharian';
    protected $primaryKey = 'id_kasbonharian';

    protected $fillable = [
        'nik_karyawan',
        'nama_karyawan',
        'cabang_karyawan',
        'divisi_karyawan',
        'jabatan_karyawan',
        'tgl_kasbonharian',
        'besar_kasbonharian',
        'status_kasbonharian'
    ];
}
