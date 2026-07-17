@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h3 class="page-title">
                        Nama : {{ $karyawan->nama_lengkap }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
            <style>
                .nav-pills .nav-link {
                    margin-bottom: 1rem;
                }

                .nav-link.active {
                    background-color: #2b53a5 !important;
                    color: #f5fcfff4 !important;
                }

                .bg-custom-gray {
                    background-color: hsl(189, 33%, 96%);
                    /* Atau gunakan nilai RGB yang sesuai */
                }

                .custom-font-size {
                font-size: 18px; /* Ubah ukuran font sesuai kebutuhan Anda */
                bold:true;
                    }



                    
            </style>
            

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3 bg-custom-gray" style="height: 600px;">
                                <div class="card-header bg-custom-gray text-center align-items-center">
                                    <ul class="nav nav-pills flex-column card-header-tabs bg-custom-gray" role="tablist">
                                        <li class="nav-item" role="presentation">
    <img src="{{ asset('public/uploads/karyawan/' . $karyawan->foto) }}"
         alt=""
         width="135px"
         height="180px">
</li>
                                        <br>
                                        Nik : 
                                        <br>
                                        <li class="nav-item custom-font-size" role="presentation">
                                           
                                           <strong>{{ $karyawan->nik }}  </strong>   
                                        </li>
                                        Nama :
                                        <br> 
                                        <li class="nav-item custom-font-size" role="presentation">
                                           <strong>{{ $karyawan->nama_lengkap }} </strong>

                                            
                                        </li>
                                        Cabang : <br>
                                        <li class="nav-item custom-font-size" role="presentation">
                                            <strong>{{ $karyawan->kode_cabang }} </strong>  
                                        </li>
                                    
                                        Divisi : <br> 
                                        <li class="nav-item custom-font-size" role="presentation">
                                         <strong>{{ $karyawan->kode_dept }} </strong>    
                                        </li>
                                        Posisi : <br> 
                                        <li class="nav-item custom-font-size" role="presentation">
                                            
                                        <strong>{{ $karyawan->jabatan }} </strong>     
                                        </li>
                                    
                                    
                                    
                                        
                                        <br>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab01" class="nav-link active" data-bs-toggle="tab"
                                                aria-selected="true" role="tab">
                                                <!-- Icon and label -->
                                                Hitungan Gaji 
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab02" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                                tabindex="-1" role="tab">
                                                <!-- Icon and label -->
                                                Potongan
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#tab03" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                                tabindex="-1" role="tab">
                                                <!-- Icon and label -->
                                                Lain-lain
                                            </a>
                                        </li>
                                    
                                    </ul>
                                </div>
                            </div>


                            <!-- Tab content -->
                            <div class="col-md-9">
                                <div class="card-body">
                                    <form action="/karyawan/{{ $karyawan->nik }}/update" method="POST" id="frmEditkaryawan1"
                                        enctype="multipart/form-data">
                                        @csrf
                         <div class="tab-content">   
                            
                            

                            <div class="tab-pane active show" id="tab01" role="tabpanel">
            
                            
                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        <label for="gaji_pokok" style="margin-top: 12px;">Gaji Pokok</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <label for="" style="margin-top: 12px;">:</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" id="gaji_pokok"
                                                            value="{{ $karyawan->gaji_pokok }}" class="form-control"
                                                            name="gaji_pokok" placeholder="Gaji Pokok">
                                                    </div>
                                                </div>
                                                
                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        <label for="tunjangan_jabatan" style="margin-top: 12px;">Tunjangan Jabatan</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <label for="" style="margin-top: 12px;">:</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" id="tunjangan_jabatan"
                                                            value="{{ $karyawan->tunjangan_jabatan }}" class="form-control"
                                                            name="tunjangan_jabatan" placeholder="Tunjangan Jabatan ">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        <label for="premi_kehadiran" style="margin-top: 12px;">Premi Kehadiran</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <label for="" style="margin-top: 12px;">:</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" id="premi_kehadiran"
                                                            value="{{ $karyawan->premi_kehadiran }}" class="form-control"
                                                            name="premi_kehadiran" placeholder="Premi Kehadiran ">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        <label for="subsidi_bpjs" style="margin-top: 12px;">Tunjangan BPJS</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <label for="" style="margin-top: 12px;">:</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <input type="text" id="subsidi_bpjs"
                                                            value="{{ $karyawan->subsidi_bpjs}}" class="form-control"
                                                            name="subsidi_bpjs" placeholder="subsidi_bpjs BPJS">
                                                    </div>
                                                </div>
                                                


                                            </div>

                                            <div class="tab-pane" id="tab02" role="tabpanel">
                                                <div class="list_container" style="display:none">
                            
                                                    <input type="text" id="jabatan" value="{{ $karyawan->jabatan }}" class="form-control" name="jabatan" placeholder="jabatan">
                                                    <input type="text" id="no_hp" value="{{ $karyawan->no_hp }}" class="form-control" name="no_hp" placeholder="no_hp">   
                                                    <input type="text" id="kode_cabang" value="{{ $karyawan->kode_cabang }}" class="form-control" name="kode_cabang" placeholder="kode_cabang">              
                                                    <input type="text" id="nama_lengkap" value="{{ $karyawan->nama_lengkap }}" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                                                    <input type="text" id="alamat_lengkap" value="{{ $karyawan->alamat_lengkap }}" class="form-control" name="alamat_lengkap" placeholder="Alamat Lengkap">
                                                    <input type="text" id="no_ktp" value="{{ $karyawan->no_ktp }}" class="form-control" name="no_ktp" placeholder="No KTP">
                                                     <input type="text" id="kewarganegaraan" value="{{ $karyawan->kewarganegaraan }}" class="form-control" name="kewarganegaraan" placeholder="Kewarganegaraan">
                                                    <input type="text" id="agama" value="{{ $karyawan->agama }}" class="form-control" name="agama" placeholder="Agama">
                                                    <input type="text" id="status_pernikahan" value="{{ $karyawan->status_pernikahan }}" class="form-control" name="status_pernikahan" placeholder="Status Pernikahan">
                                                    <input type="text" id="tgl_lahir" value="{{ $karyawan->tgl_lahir }}" class="form-control" name="tgl_lahir" placeholder="Tanggal Lahir">
                                                    <input type="text" id="tanggungan" value="{{ $karyawan->tanggungan }}" class="form-control" name="tanggungan" placeholder="Tanggungan">
                                                    <input type="text" id="mulai_bekerja" value="{{ $karyawan->mulai_bekerja }}" class="form-control" name="mulai_bekerja" placeholder="mulai_bekerja">
                                                   
                                                    <input type="hidden"  name="old_foto" value="{{$karyawan->foto}}">
                                                    
                                                    <input type="text" id="pendidikan_terakhir" value="{{ $karyawan->pendidikan_terakhir }}" class="form-control" name="pendidikan_terakhir" placeholder="Pendidikan Terakhir">
                                    
                                                    </div>
                                                <div class="row mt-3">
                                                    <div class="col-3">
                                                        <label for="foto" style="margin-top: 12px;">Divisi</label>
                                                    </div>
                                                    <div class="col-1">
                                                        <label for="" style="margin-top: 12px;">:</label>
                                                    </div>
                                                    <div class="col-8">
                                                        <select name="kode_dept" id="kode_dept" class="form-select">
                                                            <option value="">Divisi</option>
                                                            @foreach ($departemen as $d)
                                                                <option
                                                                    {{ $karyawan->kode_dept == $d->kode_dept ? 'selected' : '' }}
                                                                    value="{{ $d->kode_dept }}">
                                                                    {{ strtoupper($d->nama_dept) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>




                                            </div>




                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Save button at the bottom of all tabs -->
                            <div class="col-12 mt-3">
                                <button class="btn btn-primary w-100" form="frmEditkaryawan1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="10" y1="14" x2="21" y2="3"></line>
                                        <path d="M21 3l-6 18a0.55 .55 0 0 1 -1 0l-3 -7l-7 -3a0.55 .55 0 0 1 0 -1l18 -6">
                                        </path>
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </div>
@endsection


@push('myscript')
<script>
    $(function(){

        $("#tanggal").datepicker({ 
            autoclose: true, 
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });   
        $("#frmEditkaryawan1").submit(function(){
            var nik = $("#frmEditkaryawan1").find("#nik").val();
            var nama_lengkap = $("#frmEditkaryawan1").find("#nama_lengkap").val();
            var jabatan = $("#frmEditkaryawan1").find("#jabatan").val();
            var no_hp = $("#frmEditkaryawan1").find("#no_hp").val();
            var kode_dept = $("#frmEditkaryawan1").find("#kode_dept").val();
            var kode_cabang = $("#frmEditkaryawan1").find("#kode_cabang").val();
            if(nik==""){
               // alert('Nik Harus Diisi');
               Swal.fire({
                title: 'NIK Harus Diisi!',
                text: 'Lengkapi data !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then(()=> {
                    $("#nik").focus();
                });
                $("#nik").focus();
                return false;
            }else if(nama_lengkap == ""){
                Swal.fire({
                title: 'Nama Lengkap belum Diisi!',
                text: 'Lengkapi Data !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then(()=> {
                    $("#nama_lengkap").focus();
                });
                $("#nama_lengkap").focus();
                return false;

            }else if(jabatan == ""){
                Swal.fire({
                title: 'Jabatan Belum Diisi!',
                text: 'Lengkapi Data!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then(()=> {
                    $("#jabatan").focus();
                });
                $("#jabatan").focus();
                return false;

            }else if(no_hp == ""){
                Swal.fire({
                title: 'Nomor HP Belum Diisi!',
                text: 'Lengkapi Data!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then(()=> {
                    $("#no_hp").focus();
                });
                $("#no_hp").focus();
                return false;

            }else if(kode_dept == ""){
                Swal.fire({
                title: 'Divisi Belum Diisi!',
                text: 'Lengkapi Data!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then(()=> {
                    $("#kode_dept").focus();
                });
                $("#kode_dept").focus();
                return false;

            }else if(kode_cabang == ""){
                Swal.fire({
                title: 'Cabang Belum Diisi!',
                text: 'Lengkapi Data!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then(()=> {
                    $("#kode_cabang").focus();
                });
                $("#kode_cabang").focus();
                return false;

            }
        });

        function loadjamkerjabydate(){
            var nik = "{{ $karyawan->nik }}";
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            $("#loadjamkerjabydate").load('/konfigurasi/'+ nik +'/'+ bulan +'/'+ tahun +'/getjamkerjabydate');
        }

        $("#bulan, #tahun").change(function(e){
            loadjamkerjabydate();
        });
        loadjamkerjabydate();
    });
</script>
@endpush
