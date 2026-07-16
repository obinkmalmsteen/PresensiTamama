<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


@extends('layouts.presensi')
@section('content')
    <style>
        /* .logout{
                        position: absolute;
                        color: white;
                        font-size:30px;
                        text-decoration: none;
                        right: 8px;
                    }
                    .logout:hover{
                        color:white;
                    } */
        #presence-section {
            position: absolute;
            top: 180px; /*obink Atur jarak ke atas yang bersifat absolut sesuai dengan kebutuhan Anda */
           
        }

        .swiper-container {
            background: rgba(0, 0, 0, 0);/ width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 17px;
            /* Mengatur sudut bulat pada container */
        }


        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            /* Pastikan slide memenuhi lebar card */
            height: 100%;
            /* Sesuaikan tinggi slide */
            background-size: cover;
            /* Pastikan gambar background menutupi seluruh area */
            background-position: center;
            /* Pusatkan gambar background */
            position: relative;
            /* Untuk memastikan konten dalam slide tetap teratur */
            border-radius: 9px;
            /* Mengatur sudut bulat pada slide */
        }

        .card-content {
            background: rgba(0, 0, 0, 0);
            /* Transparansi latar belakang untuk teks */
            color: white;
            /* Warna teks */
            padding: 1rem;
            text-align: right;
            /* Align text to the right */
            width: 100%;
            height: 150px;
            max-width: 250px;
            /* Limit the width of the text column */
            margin-left: auto;
            /* Push content to the right */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            /* Align items to the end (right) */
        }

        .card-title {
            font-size: 1.2rem;
            /* Sesuaikan ukuran font */
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 0.9rem;
            /* Sesuaikan ukuran font */
        }

        .swiper-container {
            width: 100%;
            /* Pastikan swiper container memenuhi lebar card */
        }

        #menu-section {
            height: 150px; /*obink Atur ukuran tinggi menu-section (kolom Berita) */
            
            overflow: auto;
            /* Tambahkan overflow: auto; jika konten melebihi tinggi yang ditetapkan */
        }

        .nav-tabs .nav-link.active {
            background-color: rgb(211, 211, 211);
            /* Set your desired background color */
            color: #fff;
            /* Set text color to contrast with the background */
        }

        .nav-tabs .nav-link {
            background-color: #f8f9fa;
            /* Set default background color for inactive tabs */
            color: #495057;
            /* Set text color for inactive tabs */
        }
    </style>

    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="section" id="user-section">
            <div class="row">
                <div class="col-10">

                    <div id="user-detail">
                        <div class="avatar">
    @if (!empty(Auth::guard('karyawan')->user()->foto))
        <img src="{{ asset('uploads/karyawan/' . Auth::guard('karyawan')->user()->foto) }}"
            alt="avatar"
            class="imaged w64"
            style="height:60px; border-radius:100%;">
    @else
        <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}"
            alt="avatar"
            class="imaged w64 rounded">
    @endif
</div>
                        <div id="user-info">
                            <h3 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h3>
                            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>

                            <span id="user-role">( {{ Auth::guard('karyawan')->user()->kode_cabang }} ) </span>

                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div id="user-detail">
                        <div class="avatar">
                          
                                <img src="assets/img/logo_koperasi.png" alt="avatar" class="imaged w64 rounded">
                          

                        </div>

                    </div>

                </div>

            </div>



        </div>
{{-- obink background buat berita:  style="background-image: url('{{ asset('storage/uploads/gambar/' . $berita->gambar) }}');"> --}}

        <div class="section" id="menu-section">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($beritas as $berita)
                        <div class="swiper-slide" style="background: #ffffff;"">
                            <div class="card-content">
                                <h5 class="card-title">{{ $berita->nama_berita }}</h5>
                                <h5 class="card-text">{{ $berita->isi_berita }}</h5>
                                <p class="card-text"><small class="text-muted">{{ $berita->tanggal_berita }}</small></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>


        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="row">
                    <div class="col-6">
                        <div class="card gradasigreen">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        @if ($presensihariini != null)
                                            @if ($presensihariini->foto_in != null)
                                                @php

                                                    $path = Storage::url(
                                                        'uploads/absensi/' . $presensihariini->foto_in,
                                                    );
                                                @endphp
                                                <img src="{{ url($path) }}" alt="" class="imaged w48 ">
                                            @else
                                                <ion-icon name="camera"></ion-icon>
                                            @endif
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Masuk</h4>
                                        <span>
                                            {{ $presensihariini != null ? date('H:i', strtotime($presensihariini->jam_in)) . ' WIB' : 'Belum Absen' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card gradasired">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                        @if ($presensihariini != null)
                                            @if ($presensihariini->foto_out != null)
                                                @php
                                                    $path = Storage::url(
                                                        'uploads/absensi/' . $presensihariini->foto_out,
                                                    );
                                                @endphp
                                                <img src="{{ url($path) }}" alt="" class="imaged w48 ">
                                            @else
                                                <ion-icon name="camera"></ion-icon>
                                            @endif
                                        @else
                                            <ion-icon name="camera"></ion-icon>
                                        @endif

                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Pulang</h4>
                                        <span>
                                            {{ $presensihariini != null && $presensihariini->jam_out != null ? date('H:i', strtotime($presensihariini->jam_out)) . ' WIB' : 'Belum Absen' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="rekappresensi">
                <h4>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h4>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !important; line-height:0.5rem">
                                <span class="badge bg-light"
                                    style="position:absolute; top:3px; right:10px; font-size:1rem; z-index:999">{{ $rekappresensi->jmlhadir }}</span>
                                <ion-icon name="finger-print-outline" style="font-size: 1.6rem;"
                                    class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem font-weight:500">Hadir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !important; line-height:0.5rem">
                                <span class="badge bg-light"
                                    style="position:absolute; top:3px; right:10px; font-size:1rem; z-index:999">{{ $rekappresensi->jmlizin }}</span>

                                <ion-icon name="footsteps-outline" style="font-size: 1.6rem;"
                                    class="text-success mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem font-weight:500">Izin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !important; line-height:0.5rem">
                                <span class="badge bg-light"
                                    style="position:absolute; top:3px; right:10px; font-size:1rem; z-index:999">{{ $rekappresensi->jmlsakit }}</span>
                                <ion-icon name="medkit-outline" style="font-size: 1.6rem;"
                                    class="text-warning mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem font-weight:500">Sakit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text-center" style="padding: 16px 12px !important; line-height:0.5rem">
                                <span class="badge bg-light"
                                    style="position:absolute; top:3px; right:10px; font-size:1rem; z-index:999">{{ $rekappresensi->jmlcuti }}</span>
                                <ion-icon name="storefront-outline" style="font-size: 1.6rem;"
                                    class="text-danger mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem font-weight:500">Cuti</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="presencetab mt-2">
                    <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                        <ul class="nav nav-tabs style1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                    Absensi Bulan Ini
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                    Leaderboard
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content mt-2" style="margin-bottom:100px;">
                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                            <!---
                                    <ul class="listview image-listview">
                                        @foreach ($historibulanini as $d)
    @php
        $path = Storage::url('uploads/absensi/' . $d->foto_in);
    @endphp
                                        <li>
                                            <div class="item">
                                                <div class="icon-box bg-primary">
                                                   <ion-icon name="finger-print-outline"></ion-icon>
                                                </div>
                                                <div class="in">
                                                    <div>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</div>
                                                    <span class="badge badge-success">{{ $d->jam_in }}</span>
                                                    <span class="badge badge-danger">{{ $presensihariini != null && $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</span>
                                                </div>
                                            </div>
                                        </li>
    @endforeach
                                    </ul>
                                    --->
                            <style>
                                .historicontent {
                                    display: flex;
                                    margin-top: 10px;
                                    margin-left: 10px;
                                }

                                .datapresensi {
                                    margin-left: 10px;
                                }


                                .historicard {
                                    border: 1px solid #ddd;
                                    border-radius: 10px;
                                    padding: 5px;
                                    margin: 10px auto;
                                    background-color: #f9f9f9;
                                }

                                .historicard.logo {
                                    display: flex;
                                    align-items: center;
                                    margin-bottom: 10px;
                                    /*  border-bottom: 1px solid #929292;  Added border */
                                    padding-bottom: 5px;
                                    /* Added padding to separate content from border */
                                    margin-bottom: 5px;
                                    /* Added margin to separate rows */
                                    /* Adjusted margin */

                                }

                                .historicard .logo img {
                                    width: 50px;
                                    height: 50px;
                                    margin-right: 5px;
                                }

                                .historicard .details {
                                    margin-top: 5px;

                                }

                                .historicard .details .row {
                                    /*   border-bottom: 1px solid #929292; /* Added border */
                                    padding-bottom: 1px;
                                    /* Added padding to separate content from border */
                                    margin-bottom: 5px;
                                    /* Added margin to separate rows */
                                    margin-right: 15px;

                                }

                                .historicard .detailss {
                                    margin-top: 5px;

                                }

                                .historicard .detailss .row {

                                    padding-bottom: 5px;
                                    /* Added padding to separate content from border */
                                    margin-bottom: 5px;
                                    /* Added margin to separate rows */
                                    background-color: #eeeeee;
                                }

                                .historicard .row .time {
                                    /*  background-color: #ddf0d8; /* Background color for columns */
                                    padding: 10px;
                                    /* Added padding to columns */

                                    border-bottom: 1px solid #d5d5d5;
                                    border-top: 1px solid #d5d5d5;

                                }

                                .historicard .row .times {
                                    /*  background-color: #eed8d8; /* Background color for columns */
                                    padding: 10px;
                                    /* Added padding to columns */
                                    border-left: 1px solid #d5d5d5;
                                    border-bottom: 1px solid #d5d5d5;
                                    border-top: 1px solid #d5d5d5;

                                }

                                /* Increase font size for Absen Pulang */
                                .historicard .row .time strong {
                                    font-size: 16px;
                                    /* Adjust the font size as needed */
                                }

                                .historicard .row .times strong {
                                    font-size: 16px;
                                    /* Adjust the font size as needed */
                                }
                            </style>

                            @foreach ($historibulanini as $d)
                                @if ($d->status == 'h')
                                    <div class="card historicard mb-1">
                                        <div class="details">
                                            <div class="row">
                                                <div class="col-6  ">
                                                    <strong> Tgl :
                                                        {{ date('d M Y', strtotime($d->tgl_presensi)) }}</strong>
                                                </div>
                                                <div class="col-6  text-right">
                                                    <strong>{{ $d->nama_jam_kerja }} </strong>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-6 time">
                                                <div>Absen Masuk</div>
                                                <strong> {!! $d->jam_in != null
                                                    ? date('H:i', strtotime($d->jam_in)) . ' WIB'
                                                    : '<span class="text-danger">Belum Scan</span>' !!} </strong>
                                            </div>

                                            <div class="col-6 times text-right">
                                                <div>Absen Pulang</div>
                                                <strong> {!! $d->jam_out != null
                                                    ? date('H:i', strtotime($d->jam_out)) . ' WIB'
                                                    : '<span class="text-danger"> Belum Scan</span>' !!}</strong>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <strong id="keterangan" class="mt-1">
                                                    @php
                                                        $jam_in = date('H:i', strtotime($d->jam_in));
                                                        $jam_masuk = date('H:i', strtotime($d->jam_masuk));

                                                        $jadwal_jam_masuk = $d->tgl_presensi . ' ' . $jam_masuk;
                                                        $jam_presensi = $d->tgl_presensi . '' . $jam_in;
                                                    @endphp
                                                    @if ($jam_in > $jam_masuk)
                                                        @php
                                                            $jmlterlambat = hitungjamterlambat(
                                                                $jadwal_jam_masuk,
                                                                $jam_presensi,
                                                            );
                                                            $jmlterlambatdesimal = hitungjamterlambatdesimal(
                                                                $jadwal_jam_masuk,
                                                                $jam_presensi,
                                                            );
                                                        @endphp
                                                        <span class="danger">Terlambat {{ $jmlterlambat }}
                                                            ({{ $jmlterlambatdesimal }} jam)
                                                        </span>
                                                    @else
                                                        <span class="primary">Tepat Waktu</span>
                                                    @endif

                                                </strong>
                                            </div>
                                        </div>



                                        {{-- <div class="card-body">
                        <div class="historicontent">
                            <div class="iconpresensi">
                                <ion-icon name="finger-print-outline" style="font-size: 32px;" class="text-success"></ion-icon>
                            </div>
                        <div class="datapresensi">
                        <h4 style="line-height:2px">{{$d->nama_jam_kerja}} Tanggal : {{date("d-m-Y",strtotime($d->tgl_presensi)) }}</h4>
                        <br>
                        <h4 style="line-height:2px">Absen Masuk--> -->Absen Pulang</h4>
                        
                        <span> 
                            {!! $d->jam_in != null ? date("H:i",strtotime($d->jam_in)). " WIB" : '<span class="text-danger">Belum Scan</span>' !!}                                
                           
                        </span>
                        <span>--> --> --> </span>
                        <span> 
                                                         
                            {!! $d->jam_out != null ? date("H:i",strtotime($d->jam_out)). " WIB"  : '<span class="text-danger"> Belum Scan</span>' !!}
                        </span>
                        <div id="keterangan" class="mt-1" >
                            @php
                                $jam_in = date("H:i",strtotime($d->jam_in));
                                $jam_masuk = date("H:i",strtotime($d->jam_masuk));

                                $jadwal_jam_masuk = $d->tgl_presensi. " ".$jam_masuk;
                                $jam_presensi = $d->tgl_presensi."".$jam_in;
                            @endphp
                            @if ($jam_in > $jam_masuk)
                            @php
                                $jmlterlambat = hitungjamterlambat($jadwal_jam_masuk,$jam_presensi);
                                $jmlterlambatdesimal = hitungjamterlambatdesimal($jadwal_jam_masuk,$jam_presensi);
                            @endphp
                              <span class="danger">Terlambat {{$jmlterlambat}} ({{$jmlterlambatdesimal}} jam)</span>  
                            @else
                                <span class="color:success">Tepat Waktu</span>  
                            @endif

                        </div>    
                    </div> --}}
                                    </div>
                                @elseif ($d->status == 'i')
                                    <div class="card historicard mb-1" style="border: 1px solid rgb(155, 4, 185)">
                                        <div class="card-body">
                                            <div class="historicontent">
                                                <div class="iconpresensi">
                                                    <ion-icon name="footsteps-outline" style="font-size: 48px;"
                                                        class="text-info"></ion-icon>
                                                </div>
                                                <div class="datapresensi">
                                                    <h3 style="line-height:2px">IZIN </h3>
                                                    <h4 style="margin:0px !important ">
                                                        {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</h4>
                                                    <span>
                                                        No Izin : {{ $d->kode_izin }}
                                                    </span>
                                                    <br>
                                                    <span>
                                                        Ket : {{ $d->keterangan }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($d->status == 's')
                                    <div class="card historicard mb-1" style="border: 1px solid rgb(255, 0, 0)">
                                        <div class="card-body">
                                            <div class="historicontent">
                                                <div class="iconpresensi">
                                                    <ion-icon name="medkit-outline" style="font-size: 48px;"
                                                        class="text-warning"></ion-icon>
                                                </div>
                                                <div class="datapresensi">
                                                    <h3 style="line-height:2px">SAKIT </h3>
                                                    <h4 style="margin:0px !important ">
                                                        {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</h4>
                                                    <span>No Izin : {{ $d->kode_izin }}</span>
                                                    <br>
                                                    <span>
                                                        Ket : {{ $d->keterangan }}
                                                    </span>
                                                    <br>
                                                    @if (!empty($d->doc_sid))
                                                        <span style="color:blue">
                                                            <ion-icon name="document-attach-outline"></ion-icon>
                                                            Surat Ket Dokter
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($d->status == 'c')
                                    <div class="card historicard mb-1" style="border: 1px solid rgb(2, 159, 47)">
                                        <div class="card-body">
                                            <div class="historicontent">
                                                <div class="iconpresensi">
                                                    <ion-icon name="storefront-outline" style="font-size: 48px;"
                                                        class="text-blue"></ion-icon>
                                                </div>
                                                <div class="datapresensi">
                                                    <h3 style="line-height:2px">CUTI - {{ $d->nama_cuti }}</h3>
                                                    <h4 style="margin:0px !important ">
                                                        {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</h4>
                                                    <span class="text-info">No Izin : {{ $d->kode_izin }}</span>
                                                    <br>
                                                    <span>
                                                        Ket : {{ $d->keterangan }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel">
                            <ul class="listview image-listview">
                                @foreach ($leaderboard as $d)
                                    <li>
                                        <div class="item">
                                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image"
                                                class="image">
                                            <div class="in">
                                                <div>
                                                    <b> {{ $d->nama_lengkap }}</b><br>
                                                    <small class="text-muted">{{ $d->jabatan }}</small>
                                                </div>
                                                <span
                                                    class="badge {{ $d->jam_in < '08:30' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $d->jam_in }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- * App Capsule -->
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000, // 5000 ms = 5 seconds
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 40,
                    },
                },
            });
        });
    </script>
