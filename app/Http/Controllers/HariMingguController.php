<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\HariMinggu;
use Illuminate\Http\Request;

class HariMingguController extends Controller
{
    public function harimingguindex()
    {
     $query = HariMinggu::query();
     $query ->orderBy('tgl_libur','desc');
     $hariminggu = $query->paginate(80);
     
     return view('harilibur.harimingguindex', compact('hariminggu'));
    }

   
}
