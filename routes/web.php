<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\IzinabsenController;
use App\Http\Controllers\IzinsakitController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\GajianController;
use App\Http\Controllers\HariliburController;
use App\Http\Controllers\HariMingguController;
use App\Http\Controllers\IzincutiController;
use App\Http\Controllers\KasbonController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role as ModelsRole;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin',[AuthController::class,'proseslogin']);
});

Route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin',[AuthController::class,'prosesloginadmin']);
});

Route::middleware(['auth:karyawan'])->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('proseslogout',[AuthController::class,'proseslogout']);

//presensi
Route::get('/presensi/{kode_jam_kerja}/create',[PresensiController::class,'create']);
Route::get('/presensi/pilihjamkerja',[PresensiController::class,'pilihjamkerja']);
Route::post('/presensi/store',[PresensiController::class,'store']);

//edit profile
Route::get('/editprofile',[PresensiController::class,'editprofile']);
Route::post('/presensi/{nik}/updateprofile',[PresensiController::class,'updateprofile']);

//histori
Route::get('/presensi/histori',[PresensiController::class,'histori']);
Route::post('/gethistori',[PresensiController::class,'gethistori']);

//izin
Route::get('/presensi/izin',[PresensiController::class,'izin']);
Route::get('/presensi/buatizin',[PresensiController::class,'buatizin']);
Route::post('/presensi/storeizin',[PresensiController::class,'storeizin']);
Route::post('/presensi/cekpengajuanizin',[PresensiController::class,'cekpengajuanizin']);

//izin absen

Route::get('/izinabsen',[IzinabsenController::class,'create']);
Route::post('/izinabsen/store',[IzinabsenController::class,'store']);
Route::get('/izinabsen/{kode_izin}/edit',[IzinabsenController::class,'edit']);
Route::post('/izinabsen/{kode_izin}/update',[IzinabsenController::class,'update']);

//izin sakit
Route::get('/izinsakit',[IzinsakitController::class,'create']);
Route::post('/izinsakit/store',[IzinsakitController::class,'store']);
Route::get('/izinsakit/{kode_izin}/edit',[IzinsakitController::class,'edit']);
Route::post('/izinsakit/{kode_izin}/update',[IzinsakitController::class,'update']);

//izin cuti
Route::get('/izincuti',[IzincutiController::class,'create']);
Route::post('/izincuti/store',[IzincutiController::class,'store']);
Route::get('/izincuti/{kode_izin}/edit',[IzincutiController::class,'edit']);
Route::post('/izincuti/{kode_izin}/update',[IzincutiController::class,'update']);
Route::post('/izincuti/getmaxcuti',[IzincutiController::class,'getmaxcuti']);

Route::get('/izin/{kode_izin}/showact',[PresensiController::class,'showact']);
Route::get('/izin/{kode_izin}/delete',[PresensiController::class,'deleteizin']);

});
//Route yang bisa di akses oleh administrator dan admin divisi

Route::group(['middleware' => ['role:administrator|admin divisi,user']], function() {
    Route::get('proseslogoutadmin',[AuthController::class,'proseslogoutadmin']);
    Route::get('/panel/dashboardadmin',[DashboardController::class,'dashboardadmin']);
    //karyawan
    Route::get('/karyawan',[KaryawanController::class,'index']);
    Route::get('/karyawan/{nik}/resetpassword',[KaryawanController::class,'resetpassword']);
    Route::get('/karyawan/{nik}/setkaryawanprofil',[KaryawanController::class,'setkaryawanprofil']);


//konfigurasi jam kerja
    Route::post('/konfigurasi/storesetjamkerja',[KonfigurasiController::class,'storesetjamkerja']);
    Route::post('/konfigurasi/updatesetjamkerja',[KonfigurasiController::class,'updatesetjamkerja']);
    Route::get('/konfigurasi/{nik}/setjamkerja',[KonfigurasiController::class,'setjamkerja']);
    Route::post('/konfigurasi/storesetjamkerjabydate',[KonfigurasiController::class,'storesetjamkerjabydate']);
    Route::get('/konfigurasi/{nik}/{bulan}/{tahun}/getjamkerjabydate',[KonfigurasiController::class,'getjamkerjabydate']);
    Route::post('/konfigurasi/deletejamkerjabydate',[KonfigurasiController::class,'deletejamkerjabydate']);

    //monitoring presensi
   
    Route::get('/presensi/personalmonitoringindex',[PresensiController::class,'personalmonitoringindex']);
    Route::post('/presensi/personalmonitoring',[PresensiController::class,'personalmonitoring']);
    Route::get('/presensi/monitoring',[PresensiController::class,'monitoring']);
Route::post('/getpresensi',[PresensiController::class,'getpresensi']);
Route::post('/tampilkanpeta',[PresensiController::class,'tampilkanpeta']);
//laporan presensi
Route::get('/presensi/laporan',[PresensiController::class,'laporan']);
Route::post('/presensi/cetaklaporan',[PresensiController::class,'cetaklaporan']);
Route::get('/presensi/rekap',[PresensiController::class,'rekap']);
Route::post('/presensi/cetakrekap',[PresensiController::class,'cetakrekap']);
//izin sakit presensi
Route::get('/presensi/izinsakit',[PresensiController::class,'izinsakit']);

Route::post('/koreksipresensi',[PresensiController::class,'koreksipresensi']);
Route::post('/storekoreksipresensi',[PresensiController::class,'storekoreksipresensi']);


    
});


//Route yang hanya bisa di akses oleh administrator
Route::group(['middleware' => ['role:administrator,user']], function() {

  //gajian
  
  //Route::post('/gajian/{nik}/update', [GajianController::class, 'update'])->name('gajian.update');
  Route::get('/gajian', [GajianController::class, 'index'])->name('gajian.index');
     Route::post('/gajian/store', [GajianController::class, 'store'])->name('gajian.store');
    Route::post('/gajian/edit',[GajianController::class,'edit']);
    Route::post('/gajian/{nik}/{periode}/update', [GajianController::class, 'update']);
    Route::post('/gajian/{nik}/{periode}/delete', [GajianController::class, 'delete']);
    Route::get('/gajian/cetak/{nik}/{periode}', [GajianController::class, 'cetak'])->name('gajian.cetak');



   
    Route::get('/gajian/getgajikaryawan', [GajianController::class, 'getgajikaryawan'])->name('gajian.getgajikaryawan');
    Route::post('/gajian/getgajikaryawan/storegajikaryawan', [GajianController::class,'storegajikaryawan']);
    Route::get('/gajian/{nik}/setgajikaryawan',[GajianController::class,'setgajikaryawan']);


//kasbon
Route::get('/kasbon/indexkasbon', [KasbonController::class, 'indexkasbon'])->name('kasbon.indexkasbon');
//Route::get('/kasbon/indexcicilan', [KasbonController::class, 'indexcicilan'])->name('kasbon.indexcicilan');
Route::get('/kasbon/{id_kasbon}/indexcicilan', [KasbonController::class, 'indexcicilan'])->name('kasbon.indexcicilan');
Route::post('/kasbon/storecicilan',[KasbonController::class,'storecicilan']);
Route::post('/kasbon/storedatakasbon',[KasbonController::class,'storedatakasbon']);
Route::post('/kasbon/{id_kasbon}/delete',[KasbonController::class,'delete']);
//kasbon harian
Route::get('/kasbon/indexhariankasbon', [KasbonController::class, 'indexhariankasbon'])->name('kasbon.indexhariankasbon');
Route::post('/kasbon/storedatahariankasbon',[KasbonController::class,'storedatahariankasbon']);
Route::get('/kasbon/generateNewIdKasbonHarian', [KasbonController::class, 'generateNewIdKasbonHarian']);
Route::get('/kasbon/generateNewIdKasbon', [KasbonController::class, 'generateNewIdKasbon']);

Route::get('/kasbon/{id_kasbonharian}/statuskasbonharian',[KasbonController::class,'statuskasbonharian']);
// routes/web.php 


 



    //karyawan
   
    Route::post('/karyawan/store',[KaryawanController::class,'store']);
    Route::post('/karyawan/edit',[KaryawanController::class,'edit']);
    Route::post('/karyawan/{nik}/update',[KaryawanController::class,'update']);
    Route::post('/karyawan/{nik}/delete',[KaryawanController::class,'delete']);
    Route::get('/karyawan/{nik}/lockandunlocklocation',[KaryawanController::class,'lockandunlocklocation']);
    Route::get('/karyawan/{nik}/lockandunlockjamkerja',[KaryawanController::class,'lockandunlockjamkerja']);
 

// Departemen
Route::get('/departemen',[DepartemenController::class,'index'])->middleware('permission:view-departemen,user');
Route::post('/departemen/store',[DepartemenController::class,'store']);
Route::post('/departemen/edit',[DepartemenController::class,'edit']);
Route::post('/departemen/{kode_dept}/update',[DepartemenController::class,'update']);
Route::post('/departemen/{kode_dept}/delete',[DepartemenController::class,'delete']);


//monitoring presensi

Route::post('/presensi/approveizinsakit',[PresensiController::class,'approveizinsakit']);
Route::get('/presensi/{kode_izin}/batalkanizinsakit',[PresensiController::class,'batalkanizinsakit']);

//kantor cabang
Route::get('/cabang',[CabangController::class,'index']);
Route::post('/cabang/store',[CabangController::class,'store']);
Route::post('/cabang/edit',[CabangController::class,'edit']);
Route::post('/cabang/update',[CabangController::class,'update']);
Route::post('/cabang/{kode_cabang}/delete',[CabangController::class,'delete']);

//konfigurasi


Route::get('/konfigurasi/lokasikantor',[KonfigurasiController::class,'lokasikantor']);
Route::post('/konfigurasi/updatelokasikantor',[KonfigurasiController::class,'updatelokasikantor']);
Route::get('/konfigurasi/jamkerja',[KonfigurasiController::class,'jamkerja']);
Route::post('/konfigurasi/storejamkerja',[KonfigurasiController::class,'storejamkerja']);
Route::post('/konfigurasi/editjamkerja',[KonfigurasiController::class,'editjamkerja']);
Route::post('/konfigurasi/updatejamkerja',[KonfigurasiController::class,'updatejamkerja']);
Route::post('/konfigurasi/{kode_jam_kerja}/delete',[KonfigurasiController::class,'deletejamkerja']);


Route::get('/konfigurasi/jamkerjadept',[KonfigurasiController::class,'jamkerjadept']);
Route::get('/konfigurasi/jamkerjadept/create',[KonfigurasiController::class,'createjamkerjadept']);
Route::post('/konfigurasi/jamkerjadept/store',[KonfigurasiController::class,'storejamkerjadept']);
Route::get('/konfigurasi/jamkerjadept/{kode_jk_dept}/edit',[KonfigurasiController::class,'editjamkerjadept']);
Route::post('/konfigurasi/jamkerjadept/{kode_jk_dept}/update',[KonfigurasiController::class,'updatejamkerjadept']);
Route::get('/konfigurasi/jamkerjadept/{kode_jk_dept}/show',[KonfigurasiController::class,'showjamkerjadept']);
Route::get('/konfigurasi/jamkerjadept/{kode_jk_dept}/delete',[KonfigurasiController::class,'deletejamkerjadept']);

Route::get('/konfigurasi/users',[UserController::class, 'index']);
Route::post('/konfigurasi/users/store',[UserController::class, 'store']);
Route::post('/konfigurasi/users/edit',[UserController::class, 'edit']);
Route::post('/konfigurasi/users/{id_user}/update',[UserController::class, 'update']);
Route::post('/konfigurasi/users/{id_user}/delete',[UserController::class, 'delete']);

//Hari libur
Route::get('/konfigurasi/harilibur',[HariliburController::class,'index']);
Route::get('/konfigurasi/harilibur/create',[HariliburController::class,'create']);
Route::post('/konfigurasi/harilibur/store',[HariliburController::class,'store']);
Route::post('/konfigurasi/harilibur/edit',[HariliburController::class,'edit']);
Route::post('/konfigurasi/harilibur/{kode_libur}/update',[HariliburController::class,'update']);
Route::post('/konfigurasi/harilibur/{kode_libur}/delete',[HariliburController::class,'delete']);
Route::get('/konfigurasi/harilibur/{kode_libur}/setkaryawanlibur',[HariliburController::class,'setkaryawanlibur']);
Route::get('/konfigurasi/harilibur/{kode_libur}/setlistkaryawanlibur',[HariliburController::class,'setlistkaryawanlibur']);
Route::get('/konfigurasi/harilibur/{kode_libur}/getsetlistkaryawanlibur',[HariliburController::class,'getsetlistkaryawanlibur']);
Route::post('/konfigurasi/harilibur/storekaryawanlibur',[HariliburController::class,'storekaryawanlibur']);
Route::post('/konfigurasi/harilibur/removekaryawanlibur',[HariliburController::class,'removekaryawanlibur']);
Route::get('/konfigurasi/harilibur/{kode_libur}/getkaryawanlibur',[HariliburController::class,'getkaryawanlibur']);

//Hari Minggu
Route::get('/konfigurasi/hariminggu',[HariMingguController::class,'harimingguindex']);
Route::get('/get-working-days', [GajianController::class, 'getWorkingDays']);

//cuti
Route::get('/cuti',[CutiController::class,'index']);
Route::post('/cuti/store',[CutiController::class,'store']);
Route::post('/cuti/edit',[CutiController::class,'edit']);
Route::post('/cuti/{kode_cuti}/update',[CutiController::class,'update']);
Route::post('/cuti/{kode_cuti}/delete',[CutiController::class,'delete']);

//berita
Route::get('/berita',[BeritaController::class,'index']);
Route::post('/berita/store',[BeritaController::class,'store']);
Route::post('/berita/edit',[BeritaController::class,'edit']);
Route::post('/berita/{kode_berita}/update',[BeritaController::class,'update']);
Route::post('/berita/{kode_berita}/delete',[BeritaController::class,'delete']);




});

Route::get('/createrolepermission',function() {
    try {
        ModelsRole::create(['name'=>'admin departemen']);
       // ModelsPermission::create(['name'=>'view-karyawan']);
       // ModelsPermission::create(['name'=>'view-departemen']);
        echo "sukses";
    } catch (\Exception $e) {
      
       echo "Error";
    }

});

Route::get('/give-user-role',function(){
    try {
        $user = User::findorfail(1);
        $user->assignRole('administrator');
        echo"Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }

});

Route::get('/give-role-permission',function(){
    try {
        $role = ModelsRole::findorfail(1);
        $role->givePermissionTo('view-departemen');
        echo"Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }

});


