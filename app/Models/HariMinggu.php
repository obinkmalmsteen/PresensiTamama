<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HariMinggu extends Model
{
    use HasFactory;
    protected $table = 'hari_libur';
    protected $fillable = ['tgl_libur', 'keterangan'];
    public $timestamps = false;
}
