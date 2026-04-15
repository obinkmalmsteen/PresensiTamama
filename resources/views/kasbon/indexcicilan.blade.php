

@extends('layouts.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Data Cicilan Karyawan
                    </h2>
                </div>
            </div>
        </div>
    </div>

    
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::get('warning'))
                                        <div class="alert alert-warning">
                                            {{ Session::get('warning') }}
                                        </div>
                                    @endif

                                </div>
                            </div>

                            @if ($kasbon)
                                <form action="{{ url('/kasbon/update/' . $kasbon->id_kasbon) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-4">
                                          
                                                <div class="col-12">
                                                    <table class="table">
                                                        <h3>Data Karyawan</h3>
                                                        <tr>
                                                            <th>NIK</th>
                                                            <td>{{ $kasbon->id_karyawan }}</td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <th>Nama Karyawan</th>
                                                            <td>{{ $kasbon->nama_karyawan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cabang</th>
                                                            <td>{{ $kasbon->cabang_karyawan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Divisi</th>
                                                            <td>{{ $kasbon->divisi_karyawan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Posisi Kerja</th>
                                                            <td>{{ $kasbon->jabatan_karyawan }}</td>
                                                        </tr>

                                                    </table>
                                                </div>

                                                <div class="col-12">
                                                    <table class="table">
                                                        <h3>Data Kasbon</h3>
                                                        <tr>
                                                            <th>Kode Pinjaman</th>
                                                            <td>{{ $kasbon->id_kasbon }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jumlah Pinjaman</th>
                                                            <td>Rp {{format_uang ($kasbon->jumlah_pinjam) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tanggal Pinjaman</th>
                                                            <td>{{ \Carbon\Carbon::parse( $kasbon->tanggal_pinjam )->format('d M Y') }}</td>
                                                           
                                                        </tr>
                                                        <tr>
                                                            <th>Tenor Cicilan</th>
                                                            <td>{{ $kasbon->tenor_cicilan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Sisa Cicilan</th>
                                                            <td>{{ $kasbon->sisa_cicilan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cicilan / Bulan</th>
                                                            <td>Rp {{format_uang ($kasbon->besar_cicilan )}}</td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                       

                                        <div class="col-4">

                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <h3>Data Cicilan Per Bulan</h3>
                                                            
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode Pinjaman</th>
                                                                <th>Kode Cicilan</th>
                                                                <th>Besar Cicilan</th>
                                                                <th>Tanggal Bayar Cicilan</th>
                                                                {{-- <th>Aksi</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($cicilan as $c)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $c->id_kasbon }}</td>
                                                                    <td>{{ $c->id_cicilan }}</td>
                                                                    <td>{{ $c->besar_cicilan }}</td>
                                                                  
                                                        

                                                                    <td>{{ \Carbon\Carbon::parse($c->tanggal_cicilan)->format('d M Y') }}</td>
                                                             
                                                                    {{-- <td>
                                                                        <div class="btn-group">
                                                                            <a href="/kasbon/indexcicilan"
                                                                                class="S btn btn-success btn-sm ml-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="icon icon-tabler icon-tabler-clock-star"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                                    stroke="currentColor" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path stroke="none" d="M0 0h24v24H0z"
                                                                                        fill="none" />
                                                                                    <path
                                                                                        d="M20.982 11.436a9 9 0 1 0 -9.966 9.51" />
                                                                                    <path
                                                                                        d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                                                                                    <path d="M12 7v5l1 1" />
                                                                                </svg>
                                                                            </a>

                                                                            <form
                                                                                action="/kasbon/ {{ $c->id_kasbon }}/indexkasbon"
                                                                                method="POST" style="margin-left: 5px">
                                                                                @csrf
                                                                                <a
                                                                                    class="btn btn-danger btn-sm delete-confirm">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        class="icon icon-tabler icon-tabler-eraser"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" stroke-width="2"
                                                                                        stroke="currentColor" fill="none"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round">
                                                                                        <path stroke="none"
                                                                                            d="M0 0h24v24H0z"
                                                                                            fill="none" />
                                                                                        <path
                                                                                            d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3" />
                                                                                        <path d="M18 13.3l-6.3 -6.3" />
                                                                                    </svg>
                                                                                </a>
                                                                            </form>
                                                                        </div>
                                                                    </td> --}}
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        
                                                    </table>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <a href="#" class="btn btn-primary  w-100" id="btnBayarCicilan">
                                                               
                                                                Bayar Cicilan Ke {{ $kasbon->tenor_cicilan - $kasbon->sisa_cicilan +1}} dari {{$kasbon->tenor_cicilan}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>
   
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{--modal add input cicialn--}}
  <div class="modal modal-blur fade" id="modal-inputcicilan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Masuk Cicilan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/kasbon/storecicilan" method="POST" id="frmcicilan" >
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" /></svg>
                        </span>
                        <input type="text" id="id_kasbon" value="{{ $kasbon->id_kasbon }}" class="form-control" name="id_kasbon" placeholder="Kode Kasbon">
                      </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                       
                        <input type="hidden" id="id_cicilan" value="" name="id_cicilan" class="form-control" placeholder="Kode Cicilan">
                      </div>
                </div>
            </div>

           
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" /></svg>
                        </span>
                        <input type="text" id="besar_cicilan" style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;" value="{{ $kasbon->besar_cicilan }}" class="form-control" name="besar_cicilan" placeholder="besar Cicilan" readonly>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" /></svg>
                        </span>
                        <input type="date" id="tanggal_cicilan" style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;" value="" class="form-control" name="tanggal_cicilan" placeholder="Tanggal Cicilan" readonly>
                      </div>
                </div>
            </div>
           

            
            <div class="row mt-3">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>

    {{-- modal edit departemen --}}
    <div class="modal modal-blur fade" id="modal-editdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Divisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">

                </div>

            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#btnBayarCicilan").click(function() {
                $("#modal-inputcicilan").modal("show");
            });
            $(".edit").click(function() {
                var kode_dept = $(this).attr('kode_dept');
                $.ajax({
                    type: 'POST',
                    url: '/departemen/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_dept: kode_dept,

                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }

                });
                $("#modal-editdepartemen").modal("show");
            });


            $(function() {
            // Memeriksa kondisi sisa cicilan
            var sisaCicilan = {{ $kasbon->sisa_cicilan }};
            
            // Jika sisa cicilan sudah nol, ubah tombol menjadi hijau dan tulisan "Lunas", serta nonaktifkan fungsi klik
            if (sisaCicilan === 0) {
                $("#btnBayarCicilan")
                    .addClass('btn-success') // tambahkan kelas btn-success untuk mengubah warna tombol menjadi hijau
                    .text('Lunas') // ubah teks tombol menjadi "Lunas"
                    .removeAttr('href') // hapus atribut href agar tombol tidak dapat diklik
                    .css('pointer-events', 'none'); // nonaktifkan pointer events agar tombol tidak dapat diklik
            }
        });

            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda Yakin Mau Menghapus Data Ini ?",
                    text: "Jika Yakin Maka Data Akan Terhapus Permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus Saja!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Di Hapus!",
                            text: "Data sudah terhapus.",
                            icon: "success"
                        });
                    }
                });

            });

            $("#frmdepartemen").submit(function() {
                var kode_dept = $("#kode_dept").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var jabatan = $("#jabatan").val();
                var no_hp = $("#no_hp").val();
                var kode_dept = $("frmdepartemen").find("#kode_dept").val();
                if (kode_dept == "") {
                    // alert('kode dept Harus Diisi');
                    Swal.fire({
                        title: 'kode dept Harus Diisi!',
                        text: 'Lengkapi data !',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $("#kode_dept").focus();
                    });
                    $("#kode_dept").focus();
                    return false;
                } else if (nama_lengkap == "") {
                    Swal.fire({
                        title: 'Nama Lengkap belum Diisi!',
                        text: 'Lengkapi Data !',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $("#nama_lengkap").focus();
                    });
                    $("#nama_lengkap").focus();
                    return false;

                } else if (jabatan == "") {
                    Swal.fire({
                        title: 'Jabatan Belum Diisi!',
                        text: 'Lengkapi Data!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $("#jabatan").focus();
                    });
                    $("#jabatan").focus();
                    return false;

                } else if (no_hp == "") {
                    Swal.fire({
                        title: 'Nomor HP Belum Diisi!',
                        text: 'Lengkapi Data!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $("#no_hp").focus();
                    });
                    $("#no_hp").focus();
                    return false;

                } else if (kode_dept == "") {
                    Swal.fire({
                        title: 'Divisi Belum Diisi!',
                        text: 'Lengkapi Data!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        $("#kode_dept").focus();
                    });
                    $("#kode_dept").focus();
                    return false;

                }
            });
        });
    </script>
@endpush
