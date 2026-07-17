<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $kode_dept = Auth::guard('user')->user()->kode_dept;
        $kode_cabang = Auth::guard('user')->user()->kode_cabang;
        $user = User::find(Auth::guard('user')->user()->id);

        $query = Karyawan::query();
        $query->select('karyawan.*','nama_dept');
        $query->join('departemen','karyawan.kode_dept','=','departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan. '%' );
        }

        if(!empty($request->kode_dept)){
            $query->where('karyawan.kode_dept',  $request->kode_dept );
        }
        if(!empty($request->kode_cabang)){
            $query->where('karyawan.kode_cabang',  $request->kode_cabang );
        }

        if ($user->hasRole('admin divisi')){
            $query->where('karyawan.kode_dept',$kode_dept);
            $query->where('karyawan.kode_cabang',$kode_cabang);
        }
        $karyawan = $query->paginate(10); 

        $departemen = DB::table('departemen')->get();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('karyawan.index',compact('karyawan','departemen','cabang'));
    }
    public function store(Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_cabang = $request->kode_cabang;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('123');
        
       
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = null;
        }
    try {
        $data = [
            'nik' => $nik,
            'nama_lengkap'=> $nama_lengkap,
            'jabatan'=> $jabatan,
            'no_hp'=> $no_hp,
            'kode_cabang'=>$kode_cabang,
            'kode_dept'=>$kode_dept,
            'foto'=>$foto,
            'password'=>$password,
            
        ];
        $simpan = DB::table('karyawan')->insert($data);
        if($simpan){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success'=>'Data berhasil disimpan']);
        }
    } catch (\Exception $e) {
       if($e->getCode()==23000){
        $message="---> Data dengan Nik ".$nik." Sudah Ada!";
       }else{
        $message = " Hubungi IT";
       }
       return Redirect::back()->with(['warning'=>'Data gagal disimpan '.$message]);
    }
    }

    public function setkaryawanprofil($nik) 
    {
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
      $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
      $departemen =DB::table('departemen')->get();
      $jamkerja = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();
      $cekjamkerja = DB::table('konfigurasi_jamkerja')->where('nik',$nik)->count();
      $bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
      if($cekjamkerja > 0){
        $setjamkerja = DB::table('konfigurasi_jamkerja')->where('nik',$nik)->get();
        return view('karyawan.editsetkaryawanprofil',compact('cabang','departemen','karyawan','jamkerja','setjamkerja','bulan'));
      }else{
      return view('karyawan.setkaryawanprofil',compact('cabang','departemen','karyawan','jamkerja','bulan'));
    }
  }
    public function edit(Request $request){
        $nik = $request->nik;
        $departemen =DB::table('departemen')->get();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('karyawan.edit', compact('departemen','karyawan','cabang'));
    }

    public function update($nik, Request $request){
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_cabang = $request->kode_cabang;
        $kode_dept = $request->kode_dept;
        $alamat_lengkap = $request->alamat_lengkap;
        $no_ktp = $request->no_ktp;
        $status_pernikahan  = $request-> status_pernikahan;
        $kewarganegaraan  = $request-> kewarganegaraan;
        $agama  = $request-> agama;
        $tanggungan  = $request->tanggungan ;
        $pendidikan_terakhir  = $request->pendidikan_terakhir ;
        $mulai_bekerja  = $request->mulai_bekerja;
        $tgl_lahir  = $request->tgl_lahir ;
        $gaji_pokok = $request->gaji_pokok;
        $tunjangan_jabatan = $request->tunjangan_jabatan;
        $premi_kehadiran = $request->premi_kehadiran;
        $tunjangan_komunikasi = $request->tunjangan_komunikasi;
        $tunjangan_bbm = $request->tunjangan_bbm;
        $uang_makan = $request->uang_makan;
        $sewa_motor_mobil = $request->sewa_motor_mobil;
        $insentif = $request->insentif;
        $subsidi_bpjs=$request->subsidi_bpjs;
        $bpjs_kes_kantor=$request->bpjs_kes_kantor;
        $dana_sosial=$request->dana_sosial;
        $password = Hash::make('123');
        $old_foto = $request->old_foto;
        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $old_foto;
        }
    try {
        $data = [
            'nik' => $nik,
            'nama_lengkap'=> $nama_lengkap,
            'jabatan'=> $jabatan,
            'no_hp'=> $no_hp,
            'kode_cabang'=>$kode_cabang,
            'kode_dept'=>$kode_dept,
            'alamat_lengkap'=> $alamat_lengkap,
            'no_ktp'=>$no_ktp,
            'status_pernikahan'=>$status_pernikahan,
            'kewarganegaraan'=>$kewarganegaraan,
            'agama'=>$agama,
            'tanggungan'=>$tanggungan,
            'pendidikan_terakhir'=>$pendidikan_terakhir,
            'mulai_bekerja'=>$mulai_bekerja,
            'tgl_lahir'=>$tgl_lahir,
            'gaji_pokok'=>$gaji_pokok,
            'tunjangan_jabatan'=>$tunjangan_jabatan,
            'premi_kehadiran'=>$premi_kehadiran,
            'subsidi_bpjs'=>$subsidi_bpjs,
            'tunjangan_komunikasi'=>$tunjangan_komunikasi,
            'tunjangan_bbm'=>$tunjangan_bbm,
            'uang_makan'=>$uang_makan,
            'sewa_motor_mobil'=>$sewa_motor_mobil,
            'insentif'=>$insentif,
            'bpjs_kes_kantor'=>$bpjs_kes_kantor,
            'dana_sosial'=>$dana_sosial,
            'foto'=>$foto,
            'password'=>$password
        ];
        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if($update){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/karyawan/";
                $folderPathOld = "public/uploads/karyawan/". $old_foto;
                Storage::delete($folderPathOld);
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success'=>'Data berhasil Diupdate']);
        }
    } catch (\Exception $e) {
       
       return Redirect::back()->with(['warning'=>'Data gagal Diupdate']);
    }

    }

    public function delete($nik){
        $delete = DB::table('karyawan')-> where('nik', $nik)->delete();
        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil DiHapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal DiHapus']);
        }
    }

    public function resetpassword($nik)
    {    
        $nik = Crypt::decrypt($nik);
        $password = Hash::make('123');
        $reset = DB::table('karyawan')->where('nik',$nik)->update([
            'password' => $password
        ]);
        if($reset){
            return Redirect::back()->with(['success'=>'Password Berhasil Di Reset']);
        }else{
            return Redirect::back()->with(['warning'=>'Password GAGAL di Reset!']);
        
        }


    }

    public function lockandunlocklocation($nik){
        try {
            $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
            $status_location = $karyawan->status_location;
            if($status_location == '1') {
                DB::table('karyawan')->where('nik',$nik)->update([          
            'status_location' => '0'
                ]);
            }else{
                DB::table('karyawan')->where('nik',$nik)->update([          
                    'status_location' => '1'
                        ]);
            }
            return Redirect::back()->with(['success'=>'Status Location berhasil di Update']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Status Location gagal di Update']);
        }
    }

    public function lockandunlockjamkerja($nik){
        try {
            $karyawan = DB::table('karyawan')->where('nik',$nik)->first();
            $status_jam_kerja = $karyawan->status_jam_kerja;
            if($status_jam_kerja == '1') {
                DB::table('karyawan')->where('nik',$nik)->update([          
            'status_jam_kerja' => '0'
                ]);
            }else{
                DB::table('karyawan')->where('nik',$nik)->update([          
                    'status_jam_kerja' => '1'
                        ]);
            }
            return Redirect::back()->with(['success'=>'Status Jam Kerja berhasil di Update']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning'=>'Status Jam Kerja gagal di Update']);
        }
    }

    

}
