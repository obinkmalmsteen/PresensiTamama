<?php

namespace App\Http\Controllers;

use App\Models\KasbonHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class KasbonController extends Controller
{
    public function indexkasbon()
    {
        $karyawan = DB::table('karyawan')
            ->select('nik', 'nama_lengkap' ,'kode_cabang','kode_dept','jabatan')
            ->get();
     $kasbon = DB::table('kasbon')->orderBy('id_kasbon')->get();

     return view('kasbon.indexkasbon', compact('kasbon','karyawan'));
    }




    public function indexcicilan($id_kasbon)
    {
       
            // Hitung jumlah cicilan
            $jumlah_cicilan = DB::table('cicilan')
                ->where('id_kasbon', $id_kasbon)
                ->count();
        
            // Update sisa cicilan
            DB::table('kasbon')
                ->where('id_kasbon', $id_kasbon)
                ->update(['sisa_cicilan' => DB::raw('tenor_cicilan - ' . $jumlah_cicilan)]);
        
        
        $kasbon = DB::table('kasbon')->where('id_kasbon', $id_kasbon)->first();
        $cicilan = DB::table('cicilan')
        ->where('id_kasbon', $id_kasbon)
        ->orderBy('id_cicilan')->get();
        return view('kasbon.indexcicilan', compact('cicilan','id_kasbon','kasbon'));
    }

    public function storedatakasbon(Request $request)
    {
        $id_kasbon = $request->id_kasbon;
        $id_karyawan = $request->id_karyawan;
        $nama_karyawan =$request->nama_karyawan;
        $cabang_karyawan =$request->cabang_karyawan;
        $divisi_karyawan =$request->divisi_karyawan;
        $jabatan_karyawan =$request->jabatan_karyawan;
        $jumlah_pinjam = $request->jumlah_pinjam;
        $tanggal_pinjam = $request->tanggal_pinjam;
        $tenor_cicilan = $request->tenor_cicilan;
        $besar_cicilan = $request->besar_cicilan;
        $data = [
            'id_kasbon' => $id_kasbon,
            'id_karyawan'=> $id_karyawan,
            'nama_karyawan'=>$nama_karyawan,
            'cabang_karyawan'=>$cabang_karyawan,
            'divisi_karyawan'=>$divisi_karyawan,
            'jabatan_karyawan'=>$jabatan_karyawan,
            'jumlah_pinjam'=>$jumlah_pinjam,
            'tanggal_pinjam'=>$tanggal_pinjam,
            'tenor_cicilan'=>$tenor_cicilan,
            'sisa_cicilan'=>$tenor_cicilan,
            'besar_cicilan'=>$besar_cicilan
        ];

        $simpankasbon =DB::table('kasbon')->insert($data);
        if($simpankasbon){
            return Redirect::back()->with(['success' => "Data Berhasil Disimpan"]);
        }else{
            return Redirect::back()->with(['warning' => "Data Gagal Disimpan"]);
        }
    }

    public function delete($id_kasbon)
    {
        $hapus = DB::table('kasbon')->where('id_kasbon', $id_kasbon)->delete();
        if($hapus){
            return Redirect::back()->with(['success' => "Data Berhasil Di Hapus"]);
        }else{
            return Redirect::back()->with(['warning' => "Data Gagal Di Hapus"]);
        }
    }

    public function storecicilan(Request $request)
    {
        $id_kasbon = $request->id_kasbon;
        $id_cicilan = $this->generateKodeCicilan($id_kasbon); // Panggil fungsi generate kode cicilan
        $besar_cicilan = $request->besar_cicilan;
        $tanggal_cicilan = $request->tanggal_cicilan;
    
        $data = [
            'id_kasbon' => $id_kasbon,
            'id_cicilan'=> $id_cicilan,
            'besar_cicilan'=>$besar_cicilan,
            'tanggal_cicilan'=>$tanggal_cicilan
        ];
    
        DB::beginTransaction();
        try {
            // Simpan cicilan baru
            DB::table('cicilan')->insert($data);
    
            // Hitung jumlah cicilan
            $jumlah_cicilan = $this->countCicilan($id_kasbon);
    
            // Update sisa cicilan
            DB::table('kasbon')
                ->where('id_kasbon', $id_kasbon)
                ->update(['sisa_cicilan' => DB::raw('tenor_cicilan - ' . $jumlah_cicilan)]);
    
            DB::commit();
            return Redirect::back()->with(['success' => "Data Berhasil Disimpan"]);
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::back()->with(['warning' => "Data Gagal Disimpan"]);
        }
    }
    
    

    public function generateKodeCicilan($id_kasbon)
    {
        $lastCicilan = DB::table('cicilan')
            ->where('id_kasbon', $id_kasbon)
            ->orderBy('id_cicilan', 'desc')
            ->first();
    
        if ($lastCicilan) {
            $lastKode = substr($lastCicilan->id_cicilan, -2); // Ambil dua digit terakhir dari kode cicilan
            $lastNumber = intval($lastKode);
            $newNumber = $lastNumber + 1;
            $newKode = str_pad($newNumber, 2, '0', STR_PAD_LEFT); // Format dengan leading zero
        } else {
            $newKode = '01'; // Jika belum ada data cicilan untuk kasbon tersebut
        }
    
        return $id_kasbon . $newKode;
    }
    public function countCicilan($id_kasbon)
{
    return DB::table('cicilan')
        ->where('id_kasbon', $id_kasbon)
        ->count();
}
      

public function updateSisaCicilan($id_kasbon)
{
    // Hitung jumlah cicilan
    $jumlah_cicilan = DB::table('cicilan')
        ->where('id_kasbon', $id_kasbon)
        ->count();

    // Update sisa cicilan
    DB::table('kasbon')
        ->where('id_kasbon', $id_kasbon)
        ->update(['sisa_cicilan' => DB::raw('tenor_cicilan - ' . $jumlah_cicilan)]);
}

    // public function indexcicilan($id_kasbon)
    // {
    //     $cicilans = Cicilan::where('id_kasbon', $id_kasbon)->get();

    //     // Kembalikan view dengan data cicilan
    //     return view('kasbon.indexcicilan', compact('cicilans', 'id_kasbon'));
    // }


    public function indexhariankasbon()
    {
        $karyawan = DB::table('karyawan')
            ->select('nik', 'nama_lengkap' ,'kode_cabang','kode_dept','jabatan')
            ->get();
     $kasbonharian = DB::table('kasbonharian')->orderBy('id_kasbonharian')->get();

     return view('kasbon.indexhariankasbon', compact('kasbonharian','karyawan'));
    }

    public function storedatahariankasbon(Request $request)
    {
        $id_kasbonharian = $request->id_kasbonharian;
        $nik_karyawan = $request->nik_karyawan;
        $nama_karyawan =$request->nama_karyawan;
        $cabang_karyawan =$request->cabang_karyawan;
        $divisi_karyawan =$request->divisi_karyawan;
        $jabatan_karyawan =$request->jabatan_karyawan;
        $tgl_kasbonharian =$request->tgl_kasbonharian;
        $besar_kasbonharian = $request->besar_kasbonharian;
        
     
        $data = [
            'id_kasbonharian' => $id_kasbonharian,
            'nik_karyawan'=> $nik_karyawan,
            'nama_karyawan'=>$nama_karyawan,
            'cabang_karyawan'=>$cabang_karyawan,
            'divisi_karyawan'=>$divisi_karyawan,
            'jabatan_karyawan'=>$jabatan_karyawan,
            'tgl_kasbonharian'=>$tgl_kasbonharian,
            'besar_kasbonharian'=>$besar_kasbonharian,
            
           
        ];

        $simpankasbonharian =DB::table('kasbonharian')->insert($data);
        if($simpankasbonharian){
            return Redirect::back()->with(['success' => "Data Berhasil Disimpan"]);
        }else{
            return Redirect::back()->with(['warning' => "Data Gagal Disimpan"]);
        }
    }


    public function generateNewIdKasbon()
{
    $lastKasbons = DB::table('kasbon')
                    ->select('id_kasbon')
                    ->orderBy('id_kasbon', 'desc')
                    ->first();

    if ($lastKasbons) {
        $lastIds = intval(substr($lastKasbons->id_kasbon, 2)); // Mengambil angka setelah "KB"
        $newIds = 'KB' . str_pad($lastIds + 1, 3, '0', STR_PAD_LEFT); // Membuat format "KB" dan menambahkan angka dengan padding left
    } else {
        $newIds = 'KB001'; // Jika tidak ada data sebelumnya, maka id baru dimulai dari "KB001"
    }

    return response()->json(['newIds' => $newIds]);
}

    public function generateNewIdKasbonHarian()
{
    $lastKasbon = DB::table('kasbonharian')
                    ->select('id_kasbonharian')
                    ->orderBy('id_kasbonharian', 'desc')
                    ->first();

    if ($lastKasbon) {
        $lastId = intval(substr($lastKasbon->id_kasbonharian, 3));
        $newId = 'KBH' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
    } else {
        $newId = 'KBH00001';
    }

    return response()->json(['newId' => $newId]);
}

public function statuskasbonharian($id_kasbonharian){
    try {
        $kasbonharian = DB::table('kasbonharian')->where('id_kasbonharian',$id_kasbonharian)->first();
        $status_kasbonharian = $kasbonharian->status_kasbonharian;
        if($status_kasbonharian == '2') {
            DB::table('kasbonharian')->where('id_kasbonharian',$id_kasbonharian)->update([          
        'status_kasbonharian' => '1'
            ]);
        }else{
            DB::table('kasbonharian')->where('id_kasbonharian',$id_kasbonharian)->update([          
                'status_kasbonharian' => '2'
                    ]);
        }
        return Redirect::back()->with(['success'=>'Status kasbon harian berhasil di Update']);
    } catch (\Exception $e) {
        return Redirect::back()->with(['warning'=>'Status kasbon harian gagal di Update']);
    }
}


}
