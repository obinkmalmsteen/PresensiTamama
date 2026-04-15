@extends('layouts.admin.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Proses Gajian
                    </h2>
                </div>




            </div>
        </div>
    </div>
    <style>
        /* Mengatur lebar modal */
        .modal-dialog-custom {
            max-width: 1200px;
            /* Anda bisa mengganti nilai ini sesuai kebutuhan */
        }

        .modal-dialog-tambahkaryawan {
            max-width: 800px;
            /* Anda bisa mengganti nilai ini sesuai kebutuhan */
        }

        .modal-content {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>

    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Proses Gaji Karyawan - Periode <span
                                id="selected-period">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</span></h3>
                        <div class="col-auto ms-auto d-print-none">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                                Tambah Data
                            </button>
                        </div>
                    </div>


                    <div class="container-xl mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-select" id="yearSelect">
                                    @php
                                        $currentYear = date('Y');
                                        $selectedYear = request('year', $currentYear); // get selected year from request, default to current year
                                    @endphp
                                    @for ($i = $currentYear - 2; $i <= $currentYear; $i++)
                                        <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Tabs navs -->
                        @php
                            $months = [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember',
                            ];
                            $currentMonth = request('month', \Carbon\Carbon::now()->month); // get selected month from request, default to current month
                        @endphp
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @for ($i = 1; $i <= 12; $i++)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $i == $currentMonth ? 'active' : '' }}"
                                        id="tab{{ $i }}-tab" data-bs-toggle="tab" href="#tab{{ $i }}"
                                        role="tab" aria-controls="tab{{ $i }}"
                                        aria-selected="{{ $i == $currentMonth ? 'true' : 'false' }}">
                                        {{ $months[$i - 1] }}
                                    </a>
                                </li>
                            @endfor
                        </ul>
                        <!-- Tabs navs -->


                        <style>
                            .half-screen {
                                width: 50%;
                                /* Ubah lebar kartu sesuai kebutuhan Anda */
                            }

                            /* Warna latar belakang tab yang dipilih */
                            .nav-tabs .nav-item .nav-link.active {
                                background-color: #007bff;
                                /* Warna biru sebagai contoh */
                                color: #fff;
                                /* Warna teks putih sebagai contoh */
                            }
                        </style>
                        <!-- Tabs content -->
                        <div class="tab-content" id="myTabContent">
                            @for ($i = 1; $i <= 12; $i++)
                                <div class="tab-pane fade {{ $i == $currentMonth ? 'show active' : '' }}"
                                    id="tab{{ $i }}" role="tabpanel"
                                    aria-labelledby="tab{{ $i }}-tab">

                                    <div class="card mt-2 ">

                                        <div class="row">
                                            <div class="col">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>

                                                            <th>Nik</th>
                                                            <th>Nama Karyawan</th>
                                                            <th>Cabang</th>
                                                            <th>Divisi</th>
                                                            <th>Posisi</th>
                                                            <th>periode </th>
                                                            <th>Tanggal Gajian</th>
                                                            <th>Total Gaji</th>
                                                            <th>Status</th>
                                                            <th>cetak</th>

                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($gajian as $g)
                                                            @if (date('n', strtotime($g->periode . '-01')) == $i && date('Y', strtotime($g->periode . '-01')) == $selectedYear)
                                                                <tr>

                                                                    <td>{{ $g->nik }}</td>
                                                                    <td>{{ $g->nama_karyawan }}</td>
                                                                    <td>{{ $g->kantor_cabang }}</td>
                                                                    <td>{{ $g->divisi_kerja }}</td>
                                                                    <td>{{ $g->posisi_kerja }}</td>
                                                                    <td>{{ $g->periode }}</td>
                                                                    <td>{{ $g->tgl_gajian }}</td>
                                                                    <td>Rp {{ format_uang($g->gaji_total) }}</td>


                                                                    <td>
                                                                        @if ($g->status == '1')
                                                                            <span class="badge bg-success"
                                                                                style="color: white;">Dibayar</span>
                                                                        @elseif ($g->status == '2')
                                                                            <span class="badge bg-danger"
                                                                                style="color: white;">Belum</span>
                                                                        @elseif ($g->status == '3')
                                                                            <span class="badge bg-primary"
                                                                                style="color: white;">Sebagian</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <a href="#"
                                                                                class="edit btn btn-info btn-sm"
                                                                                data-nik="{{ $g->nik }}"
                                                                                data-periode="{{ $g->periode }}">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="icon icon-tabler icon-tabler-edit"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                                    stroke="currentColor" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path stroke="none" d="M0 0h24V0H0z"
                                                                                        fill="none" />
                                                                                    <path
                                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                                    <path
                                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                                    <path d="M16 5l3 3" />
                                                                                </svg>
                                                                            </a>


                                                                            <form
                                                                                action="/gajian/{{ $g->nik }}/{{ $g->periode }}/delete"
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

                                                                            {{-- <a href="{{ route('gajian.cetak') }}" class="btn btn-ouline-primary"></a> --}}
                                                                    <td>
                                                                        <a href="{{ route('gajian.cetak', ['nik' => $g->nik, 'periode' => $g->periode]) }}"
                                                                            class="btn btn-outline-primary">Export PDF</a>
                                                                    </td>





                                            </div>
                                            </td>


                                            </tr>
                            @endif
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>

                </div>



            </div>
            @endfor
        </div>
        <!-- Tabs content -->
    </div>
    </div>
    </div>
    </div>
    </div>


    <!-- Modal Pilih Karyawan -->
    <div class="modal fade" id="pilihKaryawanModal" tabindex="-1" aria-labelledby="pilihKaryawanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-tambahkaryawan" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pilihKaryawanModalLabel">Pilih Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Cabang</th>
                                <th>Divisi</th>
                                <th>Posisi Kerja</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $k)
                                <tr>
                                    <td>{{ $k->nik }}</td>
                                    <td>{{ $k->nama_lengkap }}</td>
                                    <td>{{ $k->kode_cabang }}</td>
                                    <td>{{ $k->kode_dept }}</td>
                                    <td>{{ $k->jabatan }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary pilih-karyawan"
                                            data-nik="{{ $k->nik }}" data-nama-karyawan="{{ $k->nama_lengkap }}"
                                            data-kantor-cabang="{{ $k->kode_cabang }}"
                                            data-divisi-kerja="{{ $k->kode_dept }}"
                                            data-posisi-kerja="{{ $k->jabatan }}"
                                            data-gaji-pokok="{{ $k->gaji_pokok }}"
                                            data-tunjangan-jabatan="{{ $k->tunjangan_jabatan }}"
                                            data-premi-kehadiran="{{ $k->premi_kehadiran }}"
                                            data-subsidi-bpjs="{{ $k->subsidi_bpjs }}"
                                            data-bpjs-kes-kantor="{{ $k->bpjs_kes_kantor }}"
                                            data-dana-sosial="{{ $k->dana_sosial }}"
                                            data-uang-makan="{{ $k->uang_makan }}"
                                            data-tunjangan-bbm="{{ $k->tunjangan_bbm }}"
                                            data-sewa-motor-mobil="{{ $k->sewa_motor_mobil }}"
                                            data-tunjangan-komunikasi="{{ $k->tunjangan_komunikasi }}"
                                            data-total-kasbonharian="{{ $k->total_kasbonharian }}"
                                            data-total-besar-cicilan="{{ $k->total_besar_cicilan }}">Pilih</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('gajian.store') }}" method="POST">
                    @csrf
                    @if ($errors->has('nik'))
                        <div class="alert alert-danger">
                            {{ $errors->first('nik') }}
                        </div>
                    @endif
                    <div class="modal-body">
                        {{-- <div class="mb-2">
                            <label for="nik" class="form-label">NIK</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nik" name="nik" required
                                    readonly>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#pilihKaryawanModal">Pilih Karyawan</button>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-4">
                                <label for="tgl_gajian" style="margin-top: 12px;">Tanggal Gajian</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="date" class="form-control" id="tgl_gajian" name="tgl_gajian">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="nik" style="margin-top: 12px;">NIK</label>
                            </div>
                            <div class="col-5">
                                <div class="input-icon mb-3">
                                    <input type="input" class="form-control" id="nik" name="nik">
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#pilihKaryawanModal">Pilih Karyawan</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="nama_karyawan" style="margin-top: 12px;">Nama Karyawan</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="kantor_cabang" style="margin-top: 12px;">Kantor Cabang</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="kantor_cabang" name="kantor_cabang">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-4">
                                <label for="divisi_kerja" style="margin-top: 12px;">Divisi Kerja</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="divisi_kerja" name="divisi_kerja">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-4">
                                <label for="posisi_kerja" style="margin-top: 12px;">Posisi Kerja</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="posisi_kerja" name="posisi_kerja">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-4">
                                <label for="periode" style="margin-top: 12px;">Periode Gaji</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="periode" name="periode">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-4">
                                <label for="gaji_pokok" style="margin-top: 12px;">Gaji Pokok</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="tunjangan_jabatan" style="margin-top: 12px;">Tunjangan Jabatan</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="tunjangan_jabatan"
                                        name="tunjangan_jabatan">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="premi_kehadiran" style="margin-top: 12px;">Premi Kehadiran</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="premi_kehadiran"
                                        name="premi_kehadiran">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="subsidi_bpjs" style="margin-top: 12px;">Subsidi BPJS</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="subsidi_bpjs" name="subsidi_bpjs">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="bpjs_kes_kantor" style="margin-top: 12px;">BPJS KES Kantor</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="bpjs_kes_kantor"
                                        name="bpjs_kes_kantor">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="dana_sosial" style="margin-top: 12px;">Dana Sosial</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="dana_sosial" name="dana_sosial">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="tunjangan_bbm" style="margin-top: 12px;">Tunjangan BBM</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="tunjangan_bbm" name="tunjangan_bbm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="uang_makan" style="margin-top: 12px;">Uang Makan</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="uang_makan" name="uang_makan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="sewa_motor_mobil" style="margin-top: 12px;">Sewa Motor/Mobil</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="sewa_motor_mobil"
                                        name="sewa_motor_mobil">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="tunjangan_komunikasi" style="margin-top: 12px;">Tunjangan Komunikasi</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="tunjangan_komunikasi"
                                        name="tunjangan_komunikasi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="total_kasbon_harian" style="margin-top: 12px;">Total Kasbon Harian</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="total_kasbon_harian"
                                        name="total_kasbon_harian">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="total_besar_cicilan" style="margin-top: 12px;">Cicilan Kasbon Bulanan</label>
                            </div>
                            <div class="col-8">
                                <div class="input-icon mb-3">
                                    <input type="text" class="form-control" id="total_besar_cicilan"
                                        name="total_besar_cicilan">
                                </div>
                            </div>
                        </div>






                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Edit Data -->
    <div class="modal modal-blur fade" id="modal-editgajikaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
            <div class="modal-content">


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="modal-body" id="loadeditform">
                    <!-- Form Edit Data akan dimuat di sini melalui Ajax -->
                </div>
            </div>
        </div>
    </div>


@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            // Function to update existing NIKs based on the active tab
            function updateExistingNiks() {
                var activeTabId = $('#myTab .nav-link.active').attr('id').replace('tab', '').replace('-tab', '');
                var existingNiks = [];

                // Iterate through the visible table rows in the active tab
                $("#tab" + activeTabId + " table tbody tr").each(function() {
                    var nik = $(this).find('td:first').text().trim();
                    if (nik) {
                        existingNiks.push(nik);
                    }
                });

                // Sembunyikan tombol 'Pilih' jika NIK sudah ada dalam daftar gajian
                document.querySelectorAll('.pilih-karyawan').forEach(function(button) {
                    var nik = button.getAttribute('data-nik');
                    if (existingNiks.includes(nik)) {
                        button.closest('tr').style.display = 'none';
                    } else {
                        button.closest('tr').style.display = ''; // Reset display if not in the list
                    }
                });
            }

            // Initial call to update NIKs on page load
            updateExistingNiks();

            // Recalculate existing NIKs when a tab is shown
            $('#myTab .nav-link').on('shown.bs.tab', function() {
                updateExistingNiks();
            });

            // Handle the edit button click
            $(".edit").click(function() {
                var nik = $(this).data('nik');
                var periode = $(this).data('periode');
                $.ajax({
                    type: 'POST',
                    url: '/gajian/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        nik: nik,
                        periode: periode
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                        $("#modal-editgajikaryawan").modal("show");
                        runCalculationScript();
                        calculateTotal();
                    }
                });
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



            // Handle the "Pilih" button in modal pemilihan karyawan
            document.querySelectorAll('.pilih-karyawan').forEach(function(button) {
                button.addEventListener('click', function() {
                    var nik = this.getAttribute('data-nik');
                    var nama_karyawan = this.getAttribute('data-nama-karyawan');
                    var kantor_cabang = this.getAttribute('data-kantor-cabang');
                    var divisi_kerja = this.getAttribute('data-divisi-kerja');
                    var posisi_kerja = this.getAttribute('data-posisi-kerja');

                    var gaji_pokok = this.getAttribute('data-gaji-pokok');
                    var tunjangan_jabatan = this.getAttribute('data-tunjangan-jabatan');
                    var premi_kehadiran = this.getAttribute('data-premi-kehadiran');
                    var subsidi_bpjs = this.getAttribute('data-subsidi-bpjs');
                    var bpjs_kes_kantor = this.getAttribute('data-bpjs-kes-kantor');
                    var dana_sosial = this.getAttribute('data-dana-sosial');
                    var uang_makan = this.getAttribute('data-uang-makan');
                    var sewa_motor_mobil = this.getAttribute('data-sewa-motor-mobil');
                    var tunjangan_bbm = this.getAttribute('data-tunjangan-bbm');
                    var tunjangan_komunikasi = this.getAttribute('data-tunjangan-komunikasi');
                    var total_kasbonharian = this.getAttribute('data-total-kasbonharian');
                    var total_besar_cicilan = this.getAttribute('data-total-besar-cicilan');


                    // Isi input NIK di modal "Tambah Data"
                    document.getElementById('nik').value = nik;
                    document.getElementById('nama_karyawan').value = nama_karyawan;
                    document.getElementById('kantor_cabang').value = kantor_cabang;
                    document.getElementById('divisi_kerja').value = divisi_kerja;
                    document.getElementById('posisi_kerja').value = posisi_kerja;
                    document.getElementById('gaji_pokok').value = gaji_pokok;
                    document.getElementById('tunjangan_jabatan').value = tunjangan_jabatan;
                    document.getElementById('premi_kehadiran').value = premi_kehadiran;
                    document.getElementById('subsidi_bpjs').value = subsidi_bpjs;
                    document.getElementById('bpjs_kes_kantor').value = bpjs_kes_kantor;
                    document.getElementById('dana_sosial').value = dana_sosial;
                    document.getElementById('uang_makan').value = uang_makan;
                    document.getElementById('sewa_motor_mobil').value = sewa_motor_mobil;
                    document.getElementById('tunjangan_bbm').value = tunjangan_bbm;
                    document.getElementById('tunjangan_komunikasi').value = tunjangan_komunikasi;
                    document.getElementById('total_kasbon_harian').value = total_kasbonharian;
                    document.getElementById('total_besar_cicilan').value = total_besar_cicilan;


                    // Tutup modal pemilihan karyawan
                    var pilihKaryawanModal = bootstrap.Modal.getInstance(document.getElementById(
                        'pilihKaryawanModal'));
                    if (pilihKaryawanModal) {
                        pilihKaryawanModal.hide();
                    }

                    // Tetap buka modal "Tambah Data"
                    var addDataModal = new bootstrap.Modal(document.getElementById('addDataModal'));
                    addDataModal.show();
                });
            });

            // Handle tab and period selection
            var tabs = document.querySelectorAll('#myTab .nav-link');
            var periodSpan = document.getElementById('selected-period');
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            var currentYear = {{ $selectedYear }};
            var periodInput = document.getElementById('periode');
            var yearSelect = document.getElementById('yearSelect');

            tabs.forEach(function(tab, index) {
                tab.addEventListener('shown.bs.tab', function(event) {
                    var selectedMonth = months[index];
                    periodSpan.innerText = selectedMonth + ' ' + currentYear;
                    periodInput.value = currentYear + '-' + ('0' + (index + 1)).slice(-2);
                    updateExistingNiks(); // Update NIKs when tab is changed
                });

                if (tab.classList.contains('active')) {
                    var selectedMonth = months[index];
                    periodSpan.innerText = selectedMonth + ' ' + currentYear;
                    periodInput.value = currentYear + '-' + ('0' + (index + 1)).slice(-2);
                }
            });

            yearSelect.addEventListener('change', function() {
                var selectedYear = this.value;
                var currentMonth = new Date().getMonth() + 1; // Get current month
                window.location.href = '/gajian?year=' + selectedYear + '&month=' + currentMonth;
            });
        });

        $('#modal-editgajikaryawan').on('show.bs.modal', function(e) {
            $.ajax({
                url: '/get-working-days',
                type: 'GET',
                success: function(response) {
                    $('#workingDays').val(response.workingDays);
                },
                error: function() {
                    alert('Error loading data.');
                }
            });
        });




        $(document).ready(function() {
            const totalTunjanganBBMInput = document.getElementById('total_tunjangan_bbm');
            const hiddenTotalTunjanganBBMInput = document.getElementById('hidden_total_tunjangan_bbm');
            const totalUangMakanInput = document.getElementById('total_uang_makan');
            const hiddenTotalUangMakanInput = document.getElementById('hidden_total_uang_makan');

            // Jika hidden_total_tunjangan_bbm memiliki nilai, tampilkan nilai tersebut
            if (hiddenTotalTunjanganBBMInput.value !== '') {
                totalTunjanganBBMInput.value = 'Rp ' + parseFloat(hiddenTotalTunjanganBBMInput.value)
                    .toLocaleString('id-ID');
            } else {
                // Jika belum ada nilai, lakukan perhitungan dan tampilkan hasil kalkulasi
                runCalculationScript();
            }

            // Jika hidden_total_uang_makan memiliki nilai, tampilkan nilai tersebut
            if (hiddenTotalUangMakanInput.value !== '') {
                totalUangMakanInput.value = 'Rp ' + parseFloat(hiddenTotalUangMakanInput.value)
                    .toLocaleString('id-ID');
            } else {
                // Jika belum ada nilai, lakukan perhitungan dan tampilkan hasil kalkulasi
                runCalculationScript();
               
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

            const gajiPokokElement = document.getElementById('hidden_gaji_pokok');
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

            //gaji pokok
            const totalGajiInput = document.getElementById('gaji_bulanan');
            totalGajiInput.value = 'Rp ' + gajiPokokElement.toLocaleString('id-ID');

        }
    </script>
     

@endpush
