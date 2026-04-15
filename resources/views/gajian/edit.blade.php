{{-- <form action="/gajian/{{$gajian->nik}}/update" method="POST" id="frmeditgaji"> --}}

<style>
    input[readonly] {
        background-color: #c3c3c3;
        /* Abu-abu gelap */
        color: #000;
        /* Warna teks */
    }
</style>

<div class="page-body">

    <div class="row mt-1">
        <div class="col-12">

            <div class="row">
                <div class="col-6">
                    <div class="card mt-1">
                        <div class="card-header">
                            <div class="col-12">
                                <table class="table" style="border-spacing: 0; border-collapse: collapse;">
                                    <tr style="height: 20px; width:50%;">
                                        <th style="background-color:#d5cece; color: rgb(128, 123, 123); text-align: center; margin: 0; padding: 2px;">Data Gaji Karyawan</th>
                                        <th style="background-color:#d5cece; color: white; text-align: center; margin: 0; padding: 2px;"></th>
                                     </tr>
 
                                    <tr>
                                        <th style="padding: 5px; height: 20px; width:60%;"">NIK</th>
                                        <td style="padding: 5px;">{{ $gajian->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Nama Karyawan</th>
                                        <td style="padding: 5px;">{{ $gajian->nama_karyawan }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Cabang</th>
                                        <td style="padding: 5px;">{{ $gajian->kantor_cabang }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Divisi</th>
                                        <td style="padding: 5px;">{{ $gajian->divisi_kerja }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Posisi Kerja</th>
                                        <td style="padding: 5px;">{{ $gajian->posisi_kerja }}</td>
                                    </tr>
                                    <tr><th></th></tr>
                                   
                                    <tr style="height: 20px;">
                                        <th style="background-color:#d5cece; color: rgb(128, 123, 123); text-align: center; margin: 0; padding: 2px;">Gaji Tetap Bulanan</th>
                                        <th style="background-color:#d5cece; color: white; text-align: center; margin: 0; padding: 2px;"></th>
                                     </tr>
                                    <tr>
                                        <th style="padding: 5px;">Gaji Pokok</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->gaji_pokok) }}</td>
                                        <td id="hidden_gaji_pokok" style="display: none; padding: 5px;">
                                            {{ $gajian->gaji_pokok }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Tunjangan Jabatan</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->tunjangan_jabatan) }}</td>
                                        <td id="hidden_tunjangan_jabatan" style="display: none; padding: 5px;">
                                            {{ $gajian->tunjangan_jabatan }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Premi Kehadiran</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->premi_kehadiran) }}</td>
                                        <td id="hidden_premi_kehadiran" style="display: none; padding: 5px;">
                                            {{ $gajian->premi_kehadiran }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Tunjangan Komunikasi</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->tunjangan_komunikasi) }}
                                        </td>
                                        <td id="hidden_tunjangan_komunikasi" style="display: none; padding: 5px;">
                                            {{ $gajian->tunjangan_komunikasi }}</td>
                                    </tr>
                                   
                                   
                                    <tr>
                                        <th style="padding: 5px;">Sewa Motor/Mobil Per Bulan</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->sewa_motor_mobil) }}</td>
                                        <td id="hidden_sewa_motor_mobil" style="display: none; padding: 5px;">
                                            {{ $gajian->sewa_motor_mobil }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Subsidi BPJS</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->subsidi_bpjs) }}</td>
                                        <td id="hidden_subsidi_bpjs" style="display: none; padding: 5px;">
                                            {{ $gajian->subsidi_bpjs }}</td>
                                    </tr>
                                    <tr><th></th></tr>
                              
 <tr style="height: 20px;">
    <th style="background-color:#d5cece; color: rgb(128, 123, 123); text-align: center; margin: 0; padding: 2px;">Gaji Variable Harian</th>
    <th style="background-color:#d5cece; color: white; text-align: center; margin: 0; padding: 2px;"></th>
 </tr>
                                    <tr>
                                        <th style="padding: 5px;">Uang Makan</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->uang_makan) }}</td>
                                        <td id="hidden_uang_makan" style="display: none; padding: 5px;">
                                            {{ $gajian->uang_makan }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Tunjangan BBM</th>
                                        <td style="padding: 5px;" id="tunjangan_bbm_display">Rp
                                            {{ format_uang($gajian->tunjangan_bbm) }}</td>
                                        <td id="hidden_tunjangan_bbm" style="display: none; padding: 5px;">
                                            {{ $gajian->tunjangan_bbm }}</td>
                                    </tr>
                                    <tr><th></th></tr>

                                    <tr style="height: 20px;">
                                        <th style="background-color:#d5cece; color: rgb(128, 123, 123); text-align: center; margin: 0; padding: 2px;">Potongan</th>
                                        <th style="background-color:#d5cece; color: white; text-align: center; margin: 0; padding: 2px;"></th>
                                     </tr>
                                    <tr>
                                        <th style="padding: 5px;">Potongan Dana Sosial</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->dana_sosial) }}</td>
                                        <td id="hidden_dana_sosial" style="display: none; padding: 5px;">
                                            {{ $gajian->dana_sosial }}</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Potongan BPJS KES Kantor</th>
                                        <td style="padding: 5px;">Rp {{ format_uang($gajian->bpjs_kes_kantor) }}</td>
                                        <td id="hidden_bpjs_kes_kantor" style="display: none; padding: 5px;">
                                            {{ $gajian->bpjs_kes_kantor }}</td>
                                    </tr>
                                    <tr style="height: 20px;">
                                        <th style="background-color:#d5cece; color: rgb(128, 123, 123); text-align: center; margin: 0; padding: 2px;">Data Absensi</th>
                                        <th style="background-color:#d5cece; color: white; text-align: center; margin: 0; padding: 2px;"></th>
                                     </tr>

                                    <tr>
                                        <th style="padding: 5px;">HKK / Hari Kerja Kalender Dikurangi libur Nasional dan
                                            Cuti Bersama </th>
                                        <td id="jumlah_hari_kerja_kalender" style="padding: 5px;">
                                            {{ $gajian->jumlah_hari_kerja_kalender }} Hari</td>
                                    </tr>
                                    
                                   
                                    <tr>
                                        <th style="padding: 5px;">Hadir</th>
                                        <td id="jumlah_hari_kerja" style="padding: 5px;">
                                            {{ $gajian->jumlah_hari_kerja}} Hari</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Sakit</th>
                                        <td id="jumlah_hari_sakit" style="padding: 5px;">{{ $gajian->jumlah_sakit }}
                                            Hari</td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Izin</th>
                                        <td id="jumlah_hari_izin" style="padding: 5px;">{{ $gajian->jumlah_izin }} Hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Cuti</th>
                                        <td id="jumlah_hari_cuti" style="padding: 5px;">{{ $gajian->jumlah_cuti }} Hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="padding: 5px;">Point Terlambat</th>
                                        <td id="point_terlambat" style="padding: 5px;">{{ $gajian->point_terlambat }} 
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <th style="padding: 5px;">Alfa</th>
                                        <td id="jumlah_hari_alfa" style="padding: 5px;">{{ $gajian->jumlah_alfa }} Hari
                                        </td>
                                    </tr> --}}
                                </table>
                            </div>
                        </div>

                    </div>



                </div>

                <div class="col-6 ">
                    <div class="card">
                        <div class="card-body ">
                            <form action="/gajian/{{ $gajian->nik }}/{{ $gajian->periode }}/update" method="POST"
                                id="frmeditgaji">
                                @csrf
                                <div class="row ">
                                    <div class="row ">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="tgl_gajian">Tanggal Gajian:</label>
                                                <input type="date" class="form-control" id="tgl_gajian"
                                                    name="tgl_gajian" value="{{ $gajian->tgl_gajian }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="jumlah_hari_kerja_kalender">HK Kantor:</label>
                                                <input type="text" class="form-control" id="jumlah_hari_kerja_kalender"
                                                    name="jumlah_hari_kerja_kalender" value="{{ $gajian->jumlah_hari_kerja_kalender }}">
                                            </div>
                                        </div>

                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="total_jumlah_hari_kerja">HK Karyawan:</label>
                                                <input type="text" class="form-control" id="total_jumlah_hari_kerja"
                                                    name="total_jumlah_hari_kerja" value="{{ $gajian->total_jumlah_hari_kerja }}">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="jumlah_alfa">Absen:</label>
                                                <input type="text" class="form-control" id="jumlah_alfa"
                                                    name="jumlah_alfa" value="{{ $gajian->jumlah_alfa }}">
                                            </div>
                                        </div>
                                    </div>
                                    


                                   

                                    <div class="row">
                                        <div class="col-5">
                                            <label for="total_uang_makan" style="margin-top: 12px;">( + ) Uang Makan X Kehadiran</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
    
                                        <div class="col-5">
                                            <div class="input-icon mb-3">
    
                                                <input type="text" id="total_uang_makan"
                                                    value="{{ $gajian->total_uang_makan !== null ? format_uang($gajian->total_uang_makan) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_total_uang_makan')"
                                                    name="total_uang_makan" placeholder=" - ">
                                                <input type="hidden" id="hidden_total_uang_makan"
                                                    value="{{ $gajian->total_uang_makan !== null ? $gajian->total_uang_makan : '' }}"
                                                    name="total_uang_makan">
                                            </div>
                                        </div> 
                                    </div> 

                                    <div class="row">
                                        <div class="col-5">
                                            <label for="total_tunjangan_bbm" style="margin-top: 12px;">( + ) Tunjangan BBM X Kehadiran</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
    
                                        <div class="col-5">
                                            <div class="input-icon mb-3">
    
                                                <input type="text" id="total_tunjangan_bbm"
                                                    value="{{ $gajian->total_tunjangan_bbm !== null ? format_uang($gajian->total_tunjangan_bbm) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_total_tunjangan_bbm')"
                                                    name="total_tunjangan_bbm" placeholder=" - ">
                                                <input type="hidden" id="hidden_total_tunjangan_bbm"
                                                    value="{{ $gajian->total_tunjangan_bbm !== null ? $gajian->total_tunjangan_bbm : '' }}"
                                                    name="total_tunjangan_bbm">
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="insentif" style="margin-top: 12px;">( + ) Insentif</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
    
                                        <div class="col-5">
                                            <div class="input-icon mb-3">
    
                                                <input type="text" id="insentif"
                                                    value="{{ $gajian->insentif !== null ? format_uang($gajian->insentif) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_insentif')"
                                                    name="insentif" placeholder=" - ">
                                                <input type="hidden" id="hidden_insentif"
                                                    value="{{ $gajian->insentif !== null ? $gajian->insentif : '' }}"
                                                    name="insentif">
                                            </div>
                                        </div> 
                                    </div>

                                   

                                    
                                    <div class="row">
                                    <div class="col-5">
                                        <label for="jabatan" style="margin-top: 12px;"> ( - ) Kasbon Gajian</label>
                                    </div>
                                    <div class="col-1">
                                        <label for="" style="margin-top: 12px;">:</label>
                                    </div>
                                    <div class="col-1">
                                        <label for="" style="margin-top: 12px;">Rp</label>
                                    </div>

                                    <div class="col-5">
                                        <div class="input-icon mb-3">

                                            <input type="text" id="kasbon_gajian"
                                                value="{{ $gajian->kasbon_gajian !== null ? format_uang($gajian->kasbon_gajian) : '' }}"
                                                class="form-control"
                                                oninput="formatRupiah(this, 'hidden_kasbon_gajian')"
                                                name="kasbon_gajian" placeholder=" - ">
                                            <input type="hidden" id="hidden_kasbon_gajian"
                                                value="{{ $gajian->kasbon_gajian !== null ? $gajian->kasbon_gajian : '' }}"
                                                name="kasbon_gajian">
                                        </div>
                                    </div> 
                                 </div> 

                                     <div class="row">
                                    <div class="col-5">
                                        <label for="jabatan" style="margin-top: 12px;">( - ) Kasbon Kantor</label>
                                    </div>
                                    <div class="col-1">
                                        <label for="" style="margin-top: 12px;">:</label>
                                    </div>
                                    <div class="col-1">
                                        <label for="" style="margin-top: 12px;">Rp</label>
                                    </div>
                                    <div class="col-5">
                                        <div class="input-icon mb-3">

                                            <input type="text" id="kasbon_kantor"
                                                value="{{ $gajian->kasbon_kantor !== null ? format_uang($gajian->kasbon_kantor) : '' }}"
                                                class="form-control"
                                                oninput="formatRupiah(this, 'hidden_kasbon_kantor')"
                                                name="kasbon_kantor" placeholder=" - ">
                                            <input type="hidden" id="hidden_kasbon_kantor"
                                                value="{{ $gajian->kasbon_kantor !== null ? $gajian->kasbon_kantor : '' }}"
                                                name="kasbon_kantor">
                                        </div>
                                    </div>
                                 </div> 


                                 <div class="row">
                                    <div class="col-5">
                                        <label for="jabatan" style="margin-top: 12px;">( - ) Cicilan Pinjaman Kantor</label>
                                    </div>
                                    <div class="col-1">
                                        <label for="" style="margin-top: 12px;">:</label>
                                    </div>
                                    <div class="col-1">
                                        <label for="" style="margin-top: 12px;">Rp</label>
                                    </div>
                                    <div class="col-5">
                                        <div class="input-icon mb-3">

                                            <input type="text" id="cicilan_pinjaman"
                                                value="{{ $gajian->cicilan_pinjaman !== null ? format_uang($gajian->cicilan_pinjaman) : '' }}"
                                                class="form-control"
                                                oninput="formatRupiah(this, 'hidden_cicilan_pinjaman')"
                                                name="cicilan_pinjaman" placeholder=" - ">
                                            <input type="hidden" id="hidden_cicilan_pinjaman"
                                                value="{{ $gajian->cicilan_pinjaman !== null ? $gajian->cicilan_pinjaman : '' }}"
                                                name="cicilan_pinjaman">
                                        </div>
                                    </div>
                                 </div> 

                                    <div class="row">
                                        <div class="col-5">
                                            <label for="jabatan" style="margin-top: 12px;">( - ) Potongan Bolos Kerja</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-icon mb-3">

                                                <input type="text" id="bolos_kerja"
                                                    value="{{ $gajian->bolos_kerja !== null ? format_uang($gajian->bolos_kerja) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_bolos_kerja')"
                                                    name="bolos_kerja" placeholder=" - ">
                                                <input type="hidden"
                                                    id="hidden_bolos_kerja"value="{{ $gajian->bolos_kerja !== null ? $gajian->bolos_kerja : '' }}"
                                                    name="bolos_kerja">
                                            </div>
                                        </div>
                                    </div> 
 

                                     <div class="row">
                                        <div class="col-5">
                                            <label for="jabatan" style="margin-top: 12px;">( - ) Punishment</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-icon mb-3">

                                                <input type="text" id="punishment"
                                                    value="{{ $gajian->punishment !== null ? format_uang($gajian->punishment) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_punishment')"
                                                    name="punishment" placeholder=" - ">
                                                <input type="hidden" id="hidden_punishment"
                                                    value="{{ $gajian->punishment !== null ? $gajian->punishment : '' }}"
                                                    name="punishment">

                                            </div>
                                        </div>
                                    </div> 

                                    

                                    
                                  



                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button type="button" onclick="calculateTotal()"
                                                    class="btn btn-grey w-100"
                                                    style="background-color:#75f059; color: white;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calculator">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M4 3m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                                        <path
                                                            d="M8 7m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                                                        <path d="M8 14l0 .01" />
                                                        <path d="M12 14l0 .01" />
                                                        <path d="M16 14l0 .01" />
                                                        <path d="M8 17l0 .01" />
                                                        <path d="M12 17l0 .01" />
                                                        <path d="M16 17l0 .01" />
                                                    </svg>
                                                    Hitung Total
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                   

                                    <div class="row mt-1">
                                        <div class="col-5">
                                            <label for="gaji_tetap" style="margin-top: 12px;">Gaji Full 1 Bulan
                                                </label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-icon mb-3">

                                                <input type="text" id="gaji_bulanan"
                                                    value="{{ $gajian->gaji_bulanan !== null ? format_uang($gajian->gaji_bulanan) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_gaji_bulanan')"
                                                    name="gaji_bulanan" placeholder="gaji bulanan" required>
                                                <input type="hidden" id="hidden_gaji_bulanan"
                                                    value="{{ $gajian->gaji_bulanan !== null ? format_uang($gajian->gaji_bulanan) : '' }}"
                                                    name="gaji_bulanan" required>
                                            </div>

                                        </div>
                                    </div>


                                   

                                    <div class="row mt-1">
                                        <div class="col-5">
                                            <label for="total_pendapatan" style="margin-top: 12px;">Total Pendapatan (Gaji Full + Subsidi BPJS + Insentif)</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-icon mb-3">

                                                <input type="text" id="total_pendapatan"
                                                    value="{{ $gajian->total_pendapatan !== null ? format_uang($gajian->total_pendapatan) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_gaji_bulanan')"
                                                    name="total_pendapatan" placeholder="gaji bulanan" required>
                                                <input type="hidden" id="hidden_total_pendapatan"
                                                    value="{{ $gajian->total_pendapatan !== null ? format_uang($gajian->total_pendapatan) : '' }}"
                                                    name="total_pendapatan" required>
                                            </div>

                                        </div>
                                    </div> 

                                    <div class="row mt-1">
                                        <div class="col-5">
                                            <label for="total_potongan" style="margin-top: 12px;">Total
                                                Potongan</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-icon mb-3">

                                                <input type="text" id="total_potongan"
                                                    value="{{ $gajian->total_potongan !== null ? format_uang($gajian->total_potongan) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_total_potongan')"
                                                    name="total_potongan" placeholder=" - ">
                                                <input type="hidden" id="hidden_total_potongan"
                                                    value="{{ $gajian->total_potongan !== null ? $gajian->total_potongan : '' }}"
                                                    name="total_potongan">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-5">
                                            <label for="gaji_total" style="margin-top: 12px;">Total Gaji
                                                Diterima</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-icon mb-3">

                                                <input type="text" id="gaji_total"
                                                    value="{{ $gajian->gaji_total !== null ? format_uang($gajian->gaji_total) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_gaji_total')"
                                                    name="gaji_total" placeholder="gaji_total" required>
                                                <input type="hidden" id="hidden_gaji_total"
                                                    value="{{ $gajian->gaji_total !== null ? format_uang($gajian->gaji_total) : '' }}"
                                                    name="gaji_total" required>
                                            </div>
                                        </div>
                                        <div class="col-1">

                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-5">
                                            <label for="gaji_perhari" style="margin-top: 12px;">Pendapatan Rata-rata Per Hari</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">:</label>
                                        </div>
                                        <div class="col-1">
                                            <label for="" style="margin-top: 12px;">Rp</label>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-icon mb-3">

                                                <input type="text" id="gaji_perhari"
                                                    value="{{ $gajian->gaji_perhari !== null ? format_uang($gajian->gaji_perhari) : '' }}"
                                                    class="form-control"
                                                    oninput="formatRupiah(this, 'hidden_gaji_total')"
                                                    name="gaji_perhari" placeholder="gaji_perhari" required>
                                                <input type="hidden" id="hidden_gaji_perhari"
                                                    value="{{ $gajian->gaji_perhari !== null ? format_uang($gajian->gaji_perhari) : '' }}"
                                                    name="gaji_perhari" required>
                                            </div>
                                        </div>
                                        <div class="col-1">

                                        </div>
                                    </div>

                                    




                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary w-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-tabler icon-tabler-device-floppy"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24V0H0z" fill="none" />
                                                        <path
                                                            d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                                    </svg>
                                                    Simpen
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            Cetak PDF
            </button>
        </div>
    </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>





<script>
   function calculateTotal() {
    var gajiPokok = parseFloat(document.getElementById('hidden_gaji_pokok').innerText || 0);
    var tunjanganJabatan = parseFloat(document.getElementById('hidden_tunjangan_jabatan').innerText || 0);
    var premiKehadiran = parseFloat(document.getElementById('hidden_premi_kehadiran').innerText || 0);
    var subsidiBpjs = parseFloat(document.getElementById('hidden_subsidi_bpjs').innerText || 0);
    var kasbonGajian = parseFloat(document.getElementById('hidden_kasbon_gajian').value || 0);
    var kasbonKantor = parseFloat(document.getElementById('hidden_kasbon_kantor').value || 0);
    var cicilanPinjaman = parseFloat(document.getElementById('hidden_cicilan_pinjaman').value || 0);
    var bolosKerja = parseFloat(document.getElementById('hidden_bolos_kerja').value || 0);
    var punishment = parseFloat(document.getElementById('hidden_punishment').value || 0);
    var danaSosial = parseFloat(document.getElementById('hidden_dana_sosial').innerText || 0);
    var totalTunjanganBbm = parseFloat(document.getElementById('hidden_total_tunjangan_bbm').value || 0);
    var tunjanganKomunikasi = parseFloat(document.getElementById('hidden_tunjangan_komunikasi').innerText || 0);
    var totalUangMakan = parseFloat(document.getElementById('hidden_total_uang_makan').value || 0);
    var sewaMotorMobil = parseFloat(document.getElementById('hidden_sewa_motor_mobil').innerText || 0);
    var inSentif = parseFloat(document.getElementById('hidden_insentif').value || 0);
    var bpjsKesKantor = parseFloat(document.getElementById('hidden_bpjs_kes_kantor').innerText || 0);
    var jumlahHariKerja = parseFloat(document.getElementById('jumlah_hari_kerja').innerText || 0);
    var jumlahHariSakit = parseFloat(document.getElementById('jumlah_hari_sakit').innerText || 0);
    var jumlahHariCuti = parseFloat(document.getElementById('jumlah_hari_cuti').innerText || 0);
    var jumlahHariKantor = parseFloat(document.getElementById('jumlah_hari_kerja_kalender').innerText || 0);
    var pointTerlambat = parseFloat(document.getElementById('point_terlambat').innerText || 0);

    var gajiTetap = gajiPokok + tunjanganJabatan + premiKehadiran;
    var tetapBulanan = gajiPokok + tunjanganJabatan + premiKehadiran + tunjanganKomunikasi + totalTunjanganBbm + totalUangMakan + sewaMotorMobil;
    var gajiPerhari = tetapBulanan / jumlahHariKantor;
    gajiPerhari = Math.round(gajiPerhari);

    var totalHariKerja = jumlahHariKerja + jumlahHariSakit + jumlahHariCuti;
    var jumlahHariBolos = jumlahHariKantor - totalHariKerja;
    var nilaiPunishment = pointTerlambat * 10000;
    var potonganBolos = jumlahHariBolos * gajiPerhari;

    var totalPendapatan = tetapBulanan + subsidiBpjs + inSentif;
    var totalPotongan = kasbonGajian + kasbonKantor + cicilanPinjaman + potonganBolos + punishment + danaSosial + bpjsKesKantor;
    var total = totalPendapatan - totalPotongan ;
    

    document.getElementById('total_jumlah_hari_kerja').value = totalHariKerja.toLocaleString('id-ID');

    document.getElementById('jumlah_alfa').value = jumlahHariBolos.toLocaleString('id-ID');



    document.getElementById('gaji_bulanan').value = tetapBulanan.toLocaleString('id-ID');
    document.getElementById('hidden_gaji_bulanan').value = tetapBulanan;

    document.getElementById('gaji_perhari').value = gajiPerhari.toLocaleString('id-ID');
    document.getElementById('hidden_gaji_perhari').value = gajiPerhari;

    document.getElementById('total_pendapatan').value = totalPendapatan.toLocaleString('id-ID');
    document.getElementById('hidden_total_pendapatan').value = totalPendapatan;

    document.getElementById('punishment').value = nilaiPunishment.toLocaleString('id-ID');
    document.getElementById('hidden_punishment').value = nilaiPunishment;

    document.getElementById('bolos_kerja').value = potonganBolos.toLocaleString('id-ID');
    document.getElementById('hidden_bolos_kerja').value = potonganBolos;

    



    document.getElementById('total_potongan').value = totalPotongan.toLocaleString('id-ID');
    document.getElementById('hidden_total_potongan').value = totalPotongan;

    document.getElementById('gaji_total').value = total.toLocaleString('id-ID');
    document.getElementById('hidden_gaji_total').value = total;

   
}



    function formatRupiah(element, hiddenElementId) {
        var value = element.value.replace(/\D/g, '');
        var formattedValue = (value / 100).toLocaleString('id-ID');
        element.value = formattedValue;

        document.getElementById(hiddenElementId).value = value / 100;
    }

    function formatRupiah(input, hiddenInputId) {
        let value = input.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = rupiah;

        // Update hidden input with the raw number
        document.getElementById(hiddenInputId).value = value.replace(/\./g, '');
    }
</script>

<!-- Halaman View Edit (Dimuat Melalui AJAX) -->
<script>
    // Saat halaman dimuat
    $(document).ready(function() {
        const totalTunjanganBBMInput = document.getElementById('total_tunjangan_bbm');
        const hiddenTotalTunjanganBBMInput = document.getElementById('hidden_total_tunjangan_bbm');
        const totalUangMakanInput = document.getElementById('total_uang_makan');
        const hiddenTotalUangMakanInput = document.getElementById('hidden_total_uang_makan');

        // Jika hidden_total_tunjangan_bbm memiliki nilai, tampilkan nilai tersebut
        if (hiddenTotalTunjanganBBMInput.value !== '') {
            totalTunjanganBBMInput.value = parseFloat(hiddenTotalTunjanganBBMInput.value)
                .toLocaleString('id-ID');
        } else {
            // Jika belum ada nilai, lakukan perhitungan dan tampilkan hasil kalkulasi
            runCalculationScript();
        }

        // Jika hidden_total_uang_makan memiliki nilai, tampilkan nilai tersebut
        if (hiddenTotalUangMakanInput.value !== '') {
            totalUangMakanInput.value = parseFloat(hiddenTotalUangMakanInput.value)
                .toLocaleString('id-ID');
        } else {
            // Jika belum ada nilai, lakukan perhitungan dan tampilkan hasil kalkulasi
            runCalculationScript();
            calculateTotal();
        }
    });

    function runCalculationScript() {
        // Kalkulasi Tunjangan BBM
        const tunjanganBBMElement = document.getElementById('hidden_tunjangan_bbm');
        let tunjanganBBM = 0;
        if (tunjanganBBMElement) {
            const tunjanganBBMValue = parseFloat(tunjanganBBMElement.textContent.trim());
            if (!isNaN(tunjanganBBMValue)) {
                tunjanganBBM = tunjanganBBMValue;
            }
        }

        // Kalkulasi Uang Makan
        const uangMakanElement = document.getElementById('hidden_uang_makan');
        let uangMakan = 0;
        if (uangMakanElement) {
            const uangMakanValue = parseFloat(uangMakanElement.textContent.trim());
            if (!isNaN(uangMakanValue)) {
                uangMakan = uangMakanValue;
            }
        }

        

        const jumlahHariKerjaText = document.getElementById('jumlah_hari_kerja').textContent.trim();
        const jumlahHariKerja = parseInt(jumlahHariKerjaText.replace(' Hari', ''), 10);
        const totalTunjanganBBM = tunjanganBBM * jumlahHariKerja;
        const totalUangMakan = uangMakan * jumlahHariKerja;

        // Masukkan nilai desimal ke dalam hidden_total_tunjangan_bbm dan hidden_total_uang_makan
        const hiddenTotalTunjanganBBMInput = document.getElementById('hidden_total_tunjangan_bbm');
        hiddenTotalTunjanganBBMInput.value = totalTunjanganBBM;
        const hiddenTotalUangMakanInput = document.getElementById('hidden_total_uang_makan');
        hiddenTotalUangMakanInput.value = totalUangMakan;

        // Tampilkan nilai dalam format Rupiah
        const totalTunjanganBBMInput = document.getElementById('total_tunjangan_bbm');
        totalTunjanganBBMInput.value = 'Rp ' + totalTunjanganBBM.toLocaleString('id-ID');
        const totalUangMakanInput = document.getElementById('total_uang_makan');
        totalUangMakanInput.value = 'Rp ' + totalUangMakan.toLocaleString('id-ID');
    }
</script>
