<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Karyawan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "karyawan";
    protected $primaryKey = "nik";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jabatan',
        'no_hp',
        'kode_cabang',
        'kode_dept',
        'alamat_lengkap',
        'no_ktp',
        'status_pernikahan',
        'kewarganegaraan',
        'agama',
        'tanggungan',
        'pendidikan_terakhir',
        'mulai_bekerja',
        'tgl_lahir',
        'gaji_pokok',
        'tunjangan_jabatan',
        'premi_kehadiran',
        'subsidi_bpjs',
        'tunjangan_komunikasi',
        'tunjangan_bbm',
        'uang_makan',
        'sewa_motor_mobil',
        'insentif',
        'bpjs_kes_kantor',
        'dana_sosial',
        'foto',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
