<?php

namespace App\Http\Controllers;

use App\Models\DaftarGaji;
use App\Models\Departemen;
use App\Models\Gajian;
use App\Models\Karyawan;
use App\Models\ProsesGajian;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


use App\Models\HariMinggu;

class GajianController extends Controller
{
    public function index(Request $request)
    {

        $gajian = DB::table('proses_gajian')->orderBy('id_gaji')->get();
        $periode = $gajian->isEmpty() ? 'Tidak ada data' : date('F Y', strtotime($gajian->first()->periode . '-01'));
        //$karyawan = DB::table('karyawan')->orderBy('nik')->get();
        $karyawan = DB::table('karyawan')
        ->leftJoin('kasbonharian', function($join) {
            $join->on('karyawan.nik', '=', 'kasbonharian.nik')
                 ->where('kasbonharian.status_kasbonharian', '=', 1);
        })
        ->leftJoin('kasbon', function($join) {
            $join->on('karyawan.nik', '=', 'kasbon.id_karyawan')
                 ->where('kasbon.sisa_cicilan', '>', 0);
        })
        ->select('karyawan.*', 
                 DB::raw('SUM(IFNULL(kasbonharian.besar_kasbonharian, 0)) as total_kasbonharian'),
                 'kasbon.besar_cicilan as total_besar_cicilan'
        )
        ->groupBy('karyawan.nik',
        'karyawan.nama_lengkap', 
        'karyawan.jabatan', 
        'karyawan.no_hp',
        'karyawan.foto',
        'karyawan.status_jam_kerja',
        'karyawan.status_location',
        'karyawan.password',
        'karyawan.kode_cabang', 
        'karyawan.kode_dept',
        'karyawan.remember_token',
        'karyawan.alamat_lengkap',
        'karyawan.no_ktp',
        'karyawan.status_pernikahan',
        'karyawan.kewarganegaraan',
        'karyawan.agama',
        'karyawan.tanggungan',
        'karyawan.pendidikan_terakhir',
        'karyawan.mulai_bekerja',
        'karyawan.tgl_lahir',
        'karyawan.gaji_pokok',
        'karyawan.tunjangan_jabatan',
        'karyawan.premi_kehadiran',
        'karyawan.subsidi_bpjs',
        'karyawan.tunjangan_komunikasi',
        'karyawan.tunjangan_bbm',
        'karyawan.uang_makan',
        'karyawan.insentif',
        'karyawan.sewa_motor_mobil',
        'karyawan.dana_sosial',
        'karyawan.bpjs_kes_kantor',
        'kasbon.besar_cicilan')


        ->orderBy('karyawan.nik')
        ->get();
        return view('gajian.index', compact('gajian', 'periode', 'karyawan'));
    }

    public function store(Request $request)
    {
     // Ambil nilai periode dari request
     $periode = $request->periode;

     // Pisahkan tahun dan bulan dari nilai periode
     $parts = explode('-', $periode);
     $year = $parts[0];
     $month = $parts[1];
 
     // Array nama-nama bulan
     $months = [
         1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
         5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
         9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
     ];
 
     // Ambil nama bulan pertama (format Mei-Juni 2024)
     $firstMonth = $months[(int)$month];
     
     // Hitung indeks bulan berikutnya
     $nextMonthIndex = ((int)$month % 12) - 1; // Ambil bulan berikutnya dalam lingkaran 12 bulan
     if ($nextMonthIndex == 13) {
         $nextMonthIndex = 1; // Jika hasil modulus adalah 12, set ke 1 (Januari tahun berikutnya)
         $year++; // Tambahkan tahun jika bulan berikutnya adalah Januari
     }
     $lastMonth = $months[$nextMonthIndex];
 
     // Format ulang periode untuk kolom periode_detail
     $formattedPeriod = $lastMonth . '-' . $firstMonth . ' ' . $year;


        $request->validate([
            'nik' => 'required',

            'periode' => 'required|date_format:Y-m',
        ]);

        DB::table('proses_gajian')->insert([
            'nik' => $request->nik,
            'tgl_gajian' => $request->tgl_gajian,
            'nama_karyawan'=>$request->nama_karyawan,
            'divisi_kerja'=>$request->divisi_kerja,
            'posisi_kerja'=>$request->posisi_kerja,
            'kantor_cabang'=>$request->kantor_cabang,
            'periode' => $request->periode,
            'periode_detail' => $formattedPeriod, // Simpan periode yang sudah diformat
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_jabatan' => $request->tunjangan_jabatan,
            'premi_kehadiran' => $request->premi_kehadiran,
            'subsidi_bpjs' => $request->subsidi_bpjs,
            'bpjs_kes_kantor'=>$request->bpjs_kes_kantor,
            'dana_sosial'=>$request->dana_sosial,
            'tunjangan_komunikasi'=>$request->tunjangan_komunikasi,
            'tunjangan_bbm'=>$request->tunjangan_bbm,
            'uang_makan'=>$request->uang_makan,
            'sewa_motor_mobil'=>$request->sewa_motor_mobil,
            'kasbon_kantor'=>$request->total_kasbon_harian,
            'cicilan_pinjaman'=>$request-> total_besar_cicilan,
                  
        ]);

        return redirect()->route('gajian.index')->with('success', 'Data berhasil ditambihkeun.');
    }


  
    
    public function edit(Request $request)
{
    $nik = $request->nik;
    $periode = $request->periode;

    $gajian = DB::table('proses_gajian')
        ->where('nik', $nik)
        ->where('periode', $periode)
        ->first();

    if ($gajian) {
        Log::info('Gaji Pokok:', ['gaji_pokok' => $gajian->gaji_pokok]);

        // Parsing periode untuk mendapatkan tanggal awal dan akhir
        $periodeDate = Carbon::createFromFormat('Y-m', $periode);
        $startDate = $periodeDate->copy()->subMonth()->setDay(21)->startOfDay();
        $endDate = $periodeDate->copy()->setDay(20)->endOfDay();

        Log::info('Periode dimulai dari: ' . $startDate);
        Log::info('Periode berakhir pada: ' . $endDate);

        // Query untuk menghitung jumlah hari berdasarkan status
        $statuses = ['h', 'c', 'i', 's', 'a'];
        $attendanceCounts = [];

        foreach ($statuses as $status) {
            $attendanceCounts[$status] = DB::table('presensi')
                ->where('NIK', $nik)
                ->whereBetween('tgl_presensi', [$startDate, $endDate])
                ->where('status', $status)
                ->count();
        }

        $gajian->jumlah_hari_kerja = $attendanceCounts['h'];
        $gajian->jumlah_cuti = $attendanceCounts['c'];
        $gajian->jumlah_izin = $attendanceCounts['i'];
        $gajian->jumlah_sakit = $attendanceCounts['s'];
        $gajian->jumlah_alfa = $attendanceCounts['a'];

        // Penghitungan hari kerja dengan mengurangi hari libur
        $workingDays = $this->calculateWorkingDays($startDate, $endDate);
        $gajian->jumlah_hari_kerja_kalender = $workingDays;

        // Query untuk menghitung jumlah poin keterlambatan
        $totalPointsTerlambat = DB::table('presensi')
            ->where('NIK', $nik)
            ->whereBetween('tgl_presensi', [$startDate, $endDate])
            ->sum('terlambat');

        $gajian->point_terlambat = $totalPointsTerlambat;

    } else {
        Log::error('Data Gajian tidak ditemukan untuk NIK: ' . $nik . ' dan Periode: ' . $periode);
    }

    return view('gajian.edit', compact('gajian'));
}


    



    public function getgajikaryawan(Request $request)
    {
        $kode_dept = Auth::guard('user')->user()->kode_dept;
        $kode_cabang = Auth::guard('user')->user()->kode_cabang;
        $user = User::find(Auth::guard('user')->user()->id);

        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_dept');
        $query->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if (!empty($request->nama_karyawan)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }

        if (!empty($request->kode_dept)) {
            $query->where('karyawan.kode_dept',  $request->kode_dept);
        }
        if (!empty($request->kode_cabang)) {
            $query->where('karyawan.kode_cabang',  $request->kode_cabang);
        }

        if ($user->hasRole('admin divisi')) {
            $query->where('karyawan.kode_dept', $kode_dept);
            $query->where('karyawan.kode_cabang', $kode_cabang);
        }
        $karyawan = $query->paginate(10);

        $departemen = DB::table('departemen')->get();
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('gajian.getgajikaryawan', compact('karyawan', 'departemen', 'cabang'));
    }

    public function setgajikaryawan($nik)
    {
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        $departemen = DB::table('departemen')->get();
        $jamkerja = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();
        $cekjamkerja = DB::table('konfigurasi_jamkerja')->where('nik', $nik)->count();
        $bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        if ($cekjamkerja > 0) {
            $setjamkerja = DB::table('konfigurasi_jamkerja')->where('nik', $nik)->get();
            return view('gajian.setgajikaryawan', compact('cabang', 'departemen', 'karyawan', 'jamkerja', 'setjamkerja', 'bulan'));
        } else {
            return view('gajian.setgajikaryawan', compact('cabang', 'departemen', 'karyawan', 'jamkerja', 'bulan'));
        }
    }

    public function delete($nik, $periode){
        $delete = DB::table('proses_gajian')->where('nik', $nik)->where('periode', $periode)->delete();
        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal DiHapus']);
        }
    }
    
    public function storegajikaryawan(Request $request)
    {
        $request->validate([
            'nik' => 'required',
        ]);
        DB::table('daftar_gaji')->insert([
            'nik' => $request->nik,
        ]);
        return redirect()->route('gajian.getgajikaryawan')->with('success', 'Data berhasil ditambahkan.');
    }

  public function cetak($nik, $periode)
{
    // Ambil data berdasarkan NIK dan periode
    $gajian = Gajian::where('nik', $nik)
                    ->where('periode', $periode)
                    
                    ->first();

    if (!$gajian) {
        // Tampilkan pesan error jika data tidak ditemukan
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    // Kirim data ke view
    $data['gajian'] = $gajian;

    // Render view untuk PDF
    $pdf = PDF::loadView('gajian.cetak', $data);
      // Ambil nama karyawan
      $namaKaryawan = $gajian->nama_karyawan;

    // Gunakan kolom 'nik' sebagai nama file PDF
    $fileName =  $gajian->nik . '_' . $namaKaryawan . '_' . $gajian->periode . '.pdf';

    // Download file PDF dengan nama yang telah ditentukan
    return $pdf->download($fileName);
}

    public function update($nik, $periode, Request $request)
    {
        $tgl_gajian = $request->input('tgl_gajian');
        $gaji_pokok = $request->input('gaji_pokok');
        $kasbon_gajian = $request->input('kasbon_gajian');
        $kasbon_kantor = $request->input('kasbon_kantor');
        $bolos_kerja = $request->input('bolos_kerja');
        $punishment = $request->input('punishment');
       // $dana_sosial = $request->input('dana_sosial');
        $gaji_total = $request->input('gaji_total');
        $total_pendapatan = $request->input('total_pendapatan');
        $gaji_perhari = $request->input('gaji_perhari');
        $total_potongan = $request->input('total_potongan');
        $gaji_bulanan = $request->input('gaji_bulanan');
       // $tunjangan_bbm = $request->input('tunjangan_bbm');
        $total_tunjangan_bbm = $request->input('total_tunjangan_bbm');
        $total_uang_makan = $request->input('total_uang_makan');
        $insentif = $request->input('insentif');
        $jumlah_hari_kerja_kalender = $request->input('jumlah_hari_kerja_kalender');
        $jumlah_hari_kerja = $request->input('jumlah_hari_kerja');
        $jumlah_alfa = $request->input('jumlah_alfa');
        $total_jumlah_hari_kerja = $request->input('total_jumlah_hari_kerja');
    
        try {
            $data = [
                'tgl_gajian' => $tgl_gajian,
                'kasbon_gajian' => $kasbon_gajian,
                'kasbon_kantor'=>$kasbon_kantor,
                'bolos_kerja'=>$bolos_kerja,
                'punishment'=>$punishment,
              //  'dana_sosial'=>$dana_sosial,
                'gaji_total'=>$gaji_total,
                'total_pendapatan'=>$total_pendapatan,
                'gaji_perhari'=>$gaji_perhari,
                'total_potongan'=>$total_potongan,
                'gaji_bulanan'=>$gaji_bulanan,
               // 'tunjangan_bbm'=>$tunjangan_bbm,
                'total_tunjangan_bbm'=>$total_tunjangan_bbm,
                'total_uang_makan' => $total_uang_makan,
                'insentif'=>$insentif,
                'jumlah_hari_kerja_kalender'=>$jumlah_hari_kerja_kalender,
                'jumlah_hari_kerja'=>$jumlah_hari_kerja,
                'jumlah_alfa'=> $jumlah_alfa,
                'total_jumlah_hari_kerja'=>$total_jumlah_hari_kerja,

            ];
    
            $update = DB::table('proses_gajian')
                ->where('nik', $nik)
                ->where('periode', $periode)
                ->update($data);
    
            if ($update) {
                return redirect()->back()->with('success', 'Data berhasil diupdate');
            } else {
                return redirect()->back()->with('warning', 'Data gagal diupdate');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    

    public function getWorkingDays()
    {
        // Mendapatkan tanggal 21 bulan lalu
        $startDate = Carbon::now()->subMonth()->setDay(21);
        // Mendapatkan tanggal 20 bulan ini
        $endDate = Carbon::now()->setDay(20);

        // Menghitung hari kerja
        $workingDays = $this->calculateWorkingDays($startDate, $endDate);

        return response()->json(['workingDays' => $workingDays]);
    }

    private function calculateWorkingDays($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Mendapatkan semua tanggal libur dari database
        $holidays = HariMinggu::whereBetween('tgl_libur', [$start, $end])->pluck('tgl_libur')->toArray();

        $workingDaysCount = 0;

        foreach (CarbonPeriod::create($start, $end) as $date) {
            // Periksa jika hari ini adalah hari libur
            if (in_array($date->format('Y-m-d'), $holidays)) {
                continue;
            }
            $workingDaysCount++;
        }

        return $workingDaysCount;
    }
   
    
    
    
}
