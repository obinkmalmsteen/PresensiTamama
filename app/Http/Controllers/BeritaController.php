<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = DB::table('berita')->orderBy('kode_berita')->get();
        return view('berita.index', compact('berita'));
    }

    public function store(Request $request)
    {
        $kode_berita = $request->kode_berita;
        $tanggal_berita = $request->tanggal_berita;
        $nama_berita = $request->nama_berita;
        $isi_berita = $request->isi_berita;

        if($request->hasFile('gambar')){
            $gambar = $kode_berita.".".$request->file('gambar')->getClientOriginalExtension();
        }else{
            $gambar = null;
        }
    try {
        $data = [
            'kode_berita' => $kode_berita,
            'tanggal_berita' => $tanggal_berita,
            'nama_berita'=> $nama_berita,
            'isi_berita'=> $isi_berita,
            'gambar' => $gambar,
               
        ];
        $simpan = DB::table('berita')->insert($data);
        if($simpan){
            if($request->hasFile('gambar')){
                $folderPath = "public/uploads/gambar/";
                $request->file('gambar')->storeAs($folderPath, $gambar);
            }
            return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
        }
    } catch (\Exception $e) {
      
        if($e->getCode()==23000){
        
        $message="---> Data dengan Kode ".$kode_berita." Sudah Ada!";
       }else{
        $message = " Hubungi IT";
       }
       return Redirect::back()->with(['warning'=>'Data gagal disimpan '.$message]);
    }
    }


    public function edit(Request $request)
    {
        $kode_berita = $request->kode_berita ;
        $berita = DB::table('berita')->where('kode_berita',$kode_berita )->first();
        return view('berita.edit', compact('berita'));

    }

    public function update($kode_berita, Request $request){
        $kode_berita = $request->kode_berita;
        $tanggal_berita = $request->tanggal_berita;
        $nama_berita = $request->nama_berita;
        $isi_berita = $request->isi_berita;
        $old_foto = $request->old_foto;
        if($request->hasFile('gambar')){
            $gambar = $kode_berita.".".$request->file('gambar')->getClientOriginalExtension();
        }else{
            $gambar = $old_foto;
        }
    try {
        $data = [
            'kode_berita' => $kode_berita,
            'tanggal_berita' => $tanggal_berita,
            'nama_berita'=> $nama_berita,
            'isi_berita'=> $isi_berita,
            'gambar'=>$gambar
            
        ];
        $update = DB::table('berita')->where('kode_berita', $kode_berita)->update($data);
        if($update){
            if($request->hasFile('gambar')){
                $folderPath = "public/uploads/gambar/";
                $folderPathOld = "public/uploads/gambar/". $old_foto;
                Storage::delete($folderPathOld);
                $request->file('gambar')->storeAs($folderPath, $gambar);
            }
            return Redirect::back()->with(['success'=>'Data berhasil Diupdate']);
        }
    } catch (\Exception $e) {
       
       return Redirect::back()->with(['warning'=>'Data gagal Diupdate']);
    }

    }

   

    public function delete($kode_berita )
    {
        $hapus = DB::table('berita')->where('kode_berita', $kode_berita )->delete();
        if($hapus){
            return Redirect::back()->with(['success' => "Data Berhasil Di Hapus"]);
        }else{
            return Redirect::back()->with(['warning' => "Data Gagal Di Hapus"]);
        }
    }
}
