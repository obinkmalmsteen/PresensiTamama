<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: bold;
        }

        .tabeldatakaryawan {
            margin-top: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: bold;
        }

        .tabeldatakaryawan tr td {
            padding: 1px;
            padding-top: 1px;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi tr th {
            border: 1px solid #302f2f;
            padding: 8px;
            background-color: #edebeb;
            font-size: 10px
        }

        .tabelpresensi tr td {
            border: 1px solid #302f2f;
            padding: 5px;
            font-size: 12px;
        }

        .foto {
            width: 30px;
            height: 30px;
        }

        .body.A4.Landscape .sheet {
            width: 297mm !important;
            height: auto !important;
        }
    </style>
</head>
<body class="A4">

    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td style="width:100px">
                    <img src="{{ asset('assets/img/logo_koperasi1.png') }}" width="80" height="57" alt="">
                </td>
                <td>
                    <span id="title">
                        LAPORAN PRESENSI KARYAWAN PERIODE   21 {{ strtoupper($namabulan[$bulan]) }}  -  20 {{ strtoupper($namabulan[ $bulan + 1]) }}  {{ $tahun }}<br>
                        
                        PT. RESTU ABADI EKSPEDISI<br>
                    </span>
                    <span>Jln.Karasak Lama, no.106, Bandung</span>
                </td>
            </tr>
        </table>
        <table class="tabeldatakaryawan">
            <tr>
                <td rowspan="5">
    @if ($karyawan->foto && file_exists(public_path('public/uploads/karyawan/' . $karyawan->foto)))
        <img src="{{ asset('public/uploads/karyawan/' . $karyawan->foto) }}"
             alt=""
             width="80px"
             height="100px">
    @else
        <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}"
             alt=""
             width="80px"
             height="100px">
    @endif
</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $karyawan->nik }}</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>{{ $karyawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $karyawan->jabatan }}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>:</td>
                <td>{{ $karyawan->nama_dept }}</td>
            </tr>
        </table>
        <table class="tabelpresensi">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                {{-- <th>Foto In</th> --}}
                <th>Jam Pulang</th>
                <th>Jam Kerja</th> 
                <th>Status</th>
                <th>Ket</th>
                <th>Punishment point</th>
                {{-- <th>Total </th> --}}
            </tr>
            
            @php
                $total_punishment_points = 0;
            @endphp
        
            @foreach ($presensi as $d)
                @if ($d->status == 'h')
                    @php
                         $path_in = asset('public/uploads/absensi/' . $d->foto_in);
    $path_out = asset('public/uploads/absensi/' . $d->foto_out);
                        $terlambat = hitungjamterlambat($d->jam_masuk, $d->jam_in);
                        $terlambat_desimal = hitungjamterlambatdesimal($d->jam_masuk, $d->jam_in);
                        $j_terlambat = explode(":", $terlambat);
                        $jam_terlambat = intVal($j_terlambat[0]);
        
                        if ($jam_terlambat < 1) {
                            $jam_mulai = $d->jam_masuk;
                        } else {
                            $jam_mulai = $d->jam_in > $d->jam_masuk ? $d->jam_in : $d->jam_masuk;
                        }
                        $jam_berakhir = $d->jam_out > $d->jam_pulang ? $d->jam_pulang : $d->jam_out;
                        $cekhari = gethari(date('D', strtotime($d->tgl_presensi)));
                        $total_jam = hitungjamkerja(
                            $d->tgl_presensi,
                            date("H:i", strtotime($jam_mulai)),
                            date("H:i", strtotime($jam_berakhir)),
                            $d->total_jam,
                            $d->lintashari,
                            date("H:i", strtotime($d->awal_jam_istirahat)),
                            date("H:i", strtotime($d->akhir_jam_istirahat)),
                        );
        
                        // Hitung punishment point berdasarkan rentang
                        if ($terlambat_desimal > 0) {
                            $punishment_point = ceil($terlambat_desimal * 2);
                        } else {
                            $punishment_point = 0;
                        }
        
                        // Tambahkan punishment point ke total
                        $total_punishment_points += $punishment_point;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cekhari }} - {{ date('d-M-Y', strtotime($d->tgl_presensi)) }}</td>
                        <td>{{ $d->jam_in }}</td>
                        {{-- <td><img src="{{ url($path_in) }}" alt="" class="foto"></td> --}}
                        <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</td>
                        <td>{{ $d->nama_jam_kerja }}</td>
                        {{-- <td>
                            @if ($d->jam_out != null)
                                <img src="{{ url($path_out) }}" class="foto" alt="">
                            @else
                                No Photo
                            @endif
                        </td> --}}
                        <td style="text-align: center">{{ $d->status }}</td>
                        <td>
                            @if ($d->jam_in > $d->jam_masuk)
                                Terlambat {{ $terlambat_desimal }} Jam
                            @else
                                <span class="text">Tepat Waktu</span>
                            @endif
                        </td>
                        <td>{{ $punishment_point }}</td>
                        {{-- <td>{{ $total_jam }}</td> --}}
                    </tr>
                @else
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center">{{ $d->status }}</td>
                        <td>{{ $d->keterangan }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            @endforeach
        
            <tr>
                <td colspan="7" style="text-align: right;"><strong>Total</strong></td>
                <td><strong>{{ $total_punishment_points }}</strong></td>
            </tr>
        </table>
        
        
        
        <table width="100%" style="margin-top:20px">
            <tr>
                <td colspan="2" style="text-align: right">Bandung, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: right; vertical-align:bottom" height="100px">
                    <u>Tiwi Nurlinawati</u><br>
                    <i><b>HRD</b></i>
                </td>
               
            </tr>

        </table>
    </section>

</body>

</html>
