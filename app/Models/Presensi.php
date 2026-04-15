<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Presensi extends Model
{
    protected $fillable = ['jam_in', 'kode_jam_kerja', 'terlambat'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($presensi) {
            $jamKerja = DB::table('jam_kerjas')->where('kode_jam', $presensi->kode_jam_kerja)->first();

            if ($jamKerja) {
                $jamMasuk = new \DateTime($jamKerja->jam_masuk);
                $jamIn = new \DateTime($presensi->jam_in);

                if ($jamIn > $jamMasuk) {
                    $interval = $jamMasuk->diff($jamIn);
                    $presensi->terlambat = $interval->h * 60 + $interval->i;
                } else {
                    $presensi->terlambat = 0;
                }
            }
        });
    }
}
