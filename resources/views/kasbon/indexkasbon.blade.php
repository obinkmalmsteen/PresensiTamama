@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          
          <h2 class="page-title">
            Data Pinjaman Karyawan
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
                               
                                    @if(Session::get('success'))
                                        <div class="alert alert-success">                                   
                                           {{Session::get('success')}}
                                        </div>
                                    @endif
                                    @if(Session::get('warning'))
                                        <div class="alert alert-warning">                                   
                                           {{Session::get('warning')}}
                                        </div>
                                    @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahDataKasbon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Tambah data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <form action="/departemen" method="GET">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <input type="text" name="nama_dept" class="form-control" placeholder="Cari Nama Divisi">
                                        </div>
                                    </div>
                                    
                                    <div class="col-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                           Cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pinjaman</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Cabang</th>
                                            <th>Divisi</th>
                                            <th>Jabatan</th>
                                            <th>JML Pinjam</th>
                                            <th>TGL Pinjaman</th>
                                            <th>Tenor Cicilan</th>
                                            <th>Sisa Cicilan</th>
                                           
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kasbon as $d)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$d->id_kasbon}}</td>
                                            <td>{{$d->id_karyawan}}</td>
                                            <td>{{$d->nama_karyawan}}</td>
                                            <td>{{$d->cabang_karyawan}}</td>
                                            <td>{{$d->divisi_karyawan}}</td>
                                            <td>{{$d->jabatan_karyawan}}</td>
                                            <td>{{$d->jumlah_pinjam}}</td>
                                            <td>{{$d->tanggal_pinjam}}</td>
                                            <td>{{$d->tenor_cicilan}}  Cicilan </td>
                                            <td class="text-center">
                                                @if ($d->sisa_cicilan == 0  )
                                                    <a href="#"> 
                                                        <span class="badge bg-success badge-sm" style="color: white;">
                                                            Lunas
                                                        </span>
                                                    </a>
                                                @else
                                                    <a href="#"> 
                                                        <span class="badge bg-danger badge-sm" style="color: white;">
                                                            {{$d->sisa_cicilan}} X 
                                                        </span>
                                                    </a>  
                                                @endif
                                            </td>
                                           
                                         
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ url('/kasbon/' . $d->id_kasbon . '/indexcicilan') }}" class="btn btn-primary btn-sm ml-2">
                                                        Detail
                                                    </a>
                                                           
                                                    <form action="/kasbon/{{$d->id_kasbon}}/delete" method="POST" style="margin-left: 5px">
                                                        @csrf
                                                        <a class="btn btn-danger btn-sm delete-confirm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3" /><path d="M18 13.3l-6.3 -6.3" /></svg>
                                                        </a>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>   
  </div>
{{--modal add data kasbon--}}
  <div class="modal modal-blur fade" id="modal-inputkasbon" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Pinjaman</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/kasbon/storedatakasbon" method="POST" id="frmdatakasbon" >
            @csrf
        

            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" /><path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" /></svg>
                        </span>
                        <input type="text" id="id_kasbon" value="" style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;"class="form-control " name="id_kasbon" placeholder="ID Kasbon">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="id_karyawan" value="" name="id_karyawan" class="form-control" placeholder="NIK Karyawan" readonly>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="nama_karyawan" value="" name="nama_karyawan" class="form-control" placeholder="Nama Karyawan" readonly>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="cabang_karyawan" value="" name="cabang_karyawan" class="form-control" placeholder="Kantor Cabang" readonly>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="divisi_karyawan" value="" name="divisi_karyawan" class="form-control" placeholder="Divisi Karyawan" readonly>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="jabatan_karyawan" value="" name="jabatan_karyawan" class="form-control" placeholder="Jabatan Karyawan" readonly>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="jumlah_pinjam" value="" style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;" name="jumlah_pinjam" class="form-control" placeholder="Jumlah Pinjam">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="date" id="tanggal_pinjam" value=""  style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;" name="tanggal_pinjam" class="form-control" placeholder="Tanggal Pinjam">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="tenor_cicilan" value="" style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;" name="tenor_cicilan" class="form-control" placeholder="Tenor Cicilan">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        
                        <input type="hidden" id="sisa_cicilan" style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;" value="" name="sisa_cicilan" class="form-control" placeholder="Sisa Cicilan">
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1z" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1z" /><path d="M19 11l0 2" /></svg>
                        </span>
                        <input type="text" id="besar_cicilan" value="" style="background-color: #f0f8ff; border-color: #0d6efd; color: #000000;" name="besar_cicilan" class="form-control" placeholder="Besar Cicilan">
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
  

  <!-- Modal Memilih Karyawan -->
<div class="modal modal-blur fade" id="modal-pilihkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pilih Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form search -->
                <form id="form-search-karyawan">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari berdasarkan NIK atau Nama" id="search-input" aria-describedby="button-search">
                        <button class="btn btn-outline-primary" type="button" id="button-search">Cari</button>
                    </div>
                </form>
                <!-- Table daftar karyawan -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Cabang</th>
                            <th>Divisi</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="list-karyawan">
                        <!-- Isi tabel dengan data karyawan -->
                        @foreach ($karyawan as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nik }}</td>
                            <td>{{ $k->nama_lengkap }}</td>
                            <td>{{ $k->kode_cabang }}</td>
                            <td>{{ $k->kode_dept }}</td>
                            <td>{{ $k->jabatan }}</td>
                            <td>
                                <!-- Tambahkan tombol pilih untuk memilih karyawan -->
                                <button type="button"  class="btn btn-primary btn-sm btn-pilih-karyawan" data-nik="{{ $k->nik }}" data-nama_lengkap="{{ $k->nama_lengkap }}" data-cabang_karyawan="{{ $k->kode_cabang }}" data-divisi_karyawan="{{ $k->kode_dept }}" data-jabatan_karyawan="{{ $k->jabatan }}"> 
                                    
                                    Pilih
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




{{--modal edit data kasbon--}}
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
  
        // $("#btnTambahDataKasbon").click(function(){
        //     $("#modal-inputkasbon").modal("show");

        //     $("#modal-pilihkaryawan").modal("show");
        //     //     });
        // });
        $(function(){
    $("#btnTambahDataKasbon").click(function(){
        // Tampilkan modal untuk input NIK Karyawan
        $("#modal-inputkasbon").modal("show");
        // Selain itu, tambahkan kode di bawah untuk menampilkan modal memilih karyawan
        $("#modal-pilihkaryawan").modal("show");
    });
});

        $(".edit").click(function(){
            var kode_dept = $(this).attr('kode_dept');
            $.ajax({
                type:'POST'
                ,url:'/departemen/edit'
                ,cache: false
                ,data:{
                    _token:"{{ csrf_token(); }}"
                    ,kode_dept: kode_dept,

                },
                success: function(respond){
                    $("#loadeditform").html(respond);
                }

            });
            $("#modal-editdepartemen").modal("show");
        });

        $(document).ready(function(){
        // Fungsi untuk pencarian
        $('#button-search').click(function(){
            var searchValue = $('#search-input').val().toLowerCase().trim();
            $('#list-karyawan tr').each(function(){
                var textNIK = $(this).find('td:nth-child(2)').text().toLowerCase();
                var textNama = $(this).find('td:nth-child(3)').text().toLowerCase();
                if(textNIK.includes(searchValue) || textNama.includes(searchValue)){
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Fungsi untuk memilih karyawan
        $(document).on('click', '.btn-pilih-karyawan', function(){
            var nik = $(this).data('nik');
            var nama_lengkap = $(this).data('nama_lengkap');
            var cabang_karyawan = $(this).data('cabang_karyawan');
            var divisi_karyawan = $(this).data('divisi_karyawan');
            var jabatan_karyawan = $(this).data('jabatan_karyawan');
            

            // Tambahkan karyawan yang dipilih ke form utama
            $('#id_karyawan').val(nik);
            $('#nama_karyawan').val(nama_lengkap);
            $('#cabang_karyawan').val(cabang_karyawan);
            $('#divisi_karyawan').val(divisi_karyawan);
            $('#jabatan_karyawan').val(jabatan_karyawan);

            // Tutup modal
            $('#modal-pilihkaryawan').modal('hide');
        });
    });

   
    document.addEventListener('DOMContentLoaded', function () {
    // Saat tombol "Pilih" di modal pilih karyawan diklik
    document.getElementById('btn-pilih-karyawan').addEventListener('click', function () {
        $('#modal-pilihkaryawan').modal('hide'); // Tutup modal pilih karyawan
        $('#modal-inputkasbon').modal('show'); // Buka modal tambah data
    });

    // Saat modal tambah data dibuka
    $('#modal-inputkasbon').on('show.bs.modal', function () {
        fetch('/kasbon/generateNewIdKasbon')
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_kasbon').value = data.newId;
            });
    });
});


        $(".delete-confirm").click(function(e){
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

        $("#frmdepartemen").submit(function(){
            var kode_dept = $("#kode_dept").val();
            var nama_lengkap = $("#nama_lengkap").val();
            var jabatan = $("#jabatan").val();
            var no_hp = $("#no_hp").val();
            var kode_dept = $("frmdepartemen").find("#kode_dept").val();
            if(kode_dept==""){
               // alert('kode dept Harus Diisi');
               Swal.fire({
                title: 'kode dept Harus Diisi!',
                text: 'Lengkapi data !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then(()=> {
                    $("#kode_dept").focus();
                });
                $("#kode_dept").focus();
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

            }
        });
    
</script>
    
@endpush