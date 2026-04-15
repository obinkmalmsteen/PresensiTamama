@foreach ($karyawanlibur as $d )
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->nik }}</td>
    <td>{{ $d->nama_lengkap}}</td>
    <td>{{ $d->jabatan}}</td>
    <td>
        <a href="#" class="btn btn-danger btn-sm removekaryawans" nik="{{ $d->nik }}">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
        </a>
    </td>
</tr>
    
@endforeach

<script>
    $(function(){

        function loadkaryawanlibur(){
            var kode_libur = "{{ $kode_libur }}";
            $("#loadkaryawanlibur").load('/konfigurasi/harilibur/' + kode_libur + '/getkaryawanlibur');
        }
        

        $(".removekaryawans").click(function(e){
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
                }
                
            });
        }); 
    });
</script>