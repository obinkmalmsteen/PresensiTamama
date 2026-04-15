
@foreach ($karyawan as $d)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->jabatan }}</td>
        <td>
            @if (!empty($d->ceknik))
            <a href="#" class="btn btn-success btn-sm removekaryawan" nik="{{ $d->nik }}">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
               </a>
            @else 
            <a href="#" class="btn btn-grey btn-sm tambahkaryawan" nik="{{ $d->nik }}">
                <svg    width="12"  height="12"  viewBox="0 0 24 24"  fill="none"  ></svg>
             
            </a>
                @endif
        </td>
    </tr>
@endforeach

<script>
    $(function(){
        function loadsetlistkaryawanlibur(){
            var kode_libur = "{{$kode_libur}}";
            $("#loadsetlistkaryawanlibur").load('/konfigurasi/harilibur/' + kode_libur + '/getsetlistkaryawanlibur');
        }
        function loadkaryawanlibur(){
            var kode_libur = "{{$kode_libur}}";
            $("#loadkaryawanlibur").load('/konfigurasi/harilibur/' + kode_libur + '/getkaryawanlibur');
        }
        
        

        $(".tambahkaryawan").click(function(e){
            var kode_libur = "{{ $kode_libur }}";
            var nik = $(this).attr('nik');
            $.ajax({
                type: 'POST',
                url: '/konfigurasi/harilibur/storekaryawanlibur',
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_libur: kode_libur,
                    nik: nik
                },
                cache: false,
                success: function(respond) {
                    if (respond.status === 'success') {
                        
                        loadsetlistkaryawanlibur();
                        loadkaryawanlibur();
                    } else if (respond.status === 'warning') {
                        Swal.fire({
                            title: 'Warning!',
                            text: respond.message,
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: respond.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan: ' + error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        $(".removekaryawan").click(function(e){
            var kode_libur = "{{ $kode_libur }}";
            var nik = $(this).attr('nik');
            $.ajax({
                type: 'POST',
                url: '/konfigurasi/harilibur/removekaryawanlibur',
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_libur: kode_libur,
                    nik: nik
                },
                cache: false,
                success: function(respond) {
                    if (respond.status === 'success') {
                       
                        loadsetlistkaryawanlibur();
                        loadkaryawanlibur();
                    } else if (respond.status === 'warning') {
                        Swal.fire({
                            title: 'Warning!',
                            text: respond.message,
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: respond.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan: ' + error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });


    });
</script>
