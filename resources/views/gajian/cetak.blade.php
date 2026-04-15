<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />
</head>

<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #5D6975;
        text-decoration: underline;
    }

    body {
        position: relative;
        width: 9cm;
        height: 29.7cm;
        margin: 0 auto;
        color: #001028;
        background: #FFFFFF;
        font-family: 'Roboto', Arial, sans-serif;
        font-size: 10px;
        font-family: 'Roboto', Arial, sans-serif;
    }

    header {
        padding: 1px 0;
        margin-bottom: 30px;
    }

    #logo {
        text-align: center;
        margin-bottom: 10px;
    }

    #logo img {
        width: 90px;
    }

    h1 {
        border-top: 1px solid #5D6975;
        border-bottom: 1px solid #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
    }
    h2 {
        border-top: 1px solid #5D6975;
        border-bottom: 1px solid #5D6975;
        color: #5D6975;
        font-size: 2.4em;
        line-height: 1.4em;
        font-weight: normal;
        text-align: center;
        margin: 0 0 20px 0;
        background: url(dimension.png);
    }

    #project {
        float: left;
    }

    #project span {
        color: #5D6975;
        text-align: right;
        width: 52px;
        margin-right: 10px;
        display: inline-block;
        font-size: 0.8em;
    }

    #company {
        float: right;
        text-align: right;
    }

    #project div,
    #company div {
        white-space: nowrap;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 16px;
    }
    .short-table {
            margin-bottom: 2px; /* Atur margin bawah tabel */
            border-collapse: collapse; /* Agar garis antar sel tidak double */
            width: 100%; /* Lebar tabel 100% */
        }
    table tr:nth-child(2n-1) td {
        background: #F5F5F5;
    }

    table th,
    table td {
        text-align: center;
    }

    table th {
        padding: 1px 1px;
        color: #5D6975;
        border-bottom: 1px solid #C1CED9;
        white-space: nowrap;
        font-weight: normal;
    }

    table .service,
    table .desc {
        text-align: left;
    }
    th.service {
        width: 50%;
        vertical-align: top;
        border-top: 1px solid #c7cdd3;
      border-bottom: 1px solid #c7cdd3;
      border-left: 1px solid #c7cdd3;
      border-right: 1px solid #c7cdd3;
    }
    th.total {
        width: 100px;
    }
    table td {
        padding: 1px;
        text-align: right;
    }

    table td.service,
    table td.desc {
      width: 60%;
        vertical-align: top;
        border-top: 1px solid #c7cdd3;
      border-bottom: 1px solid #c7cdd3;
      border-left: 1px solid #c7cdd3;
      border-right: 1px solid #c7cdd3;
    }

    table td.service1,
    table td.desc {
      width: 40%;
      text-align: right;
      /* border-top: 1px solid #c7cdd3; */
      border-bottom: 1px solid #c7cdd3;
      border-left: 1px solid #c7cdd3;
      border-right: 1px solid #c7cdd3;
    }
    table td.service3,
    table td.desc {
      width: 40%;
      text-align: left;
      border-top: 1px solid #c7cdd3;
      border-bottom: 1px solid #c7cdd3;
      border-left: 1px solid #c7cdd3;
      border-right: 1px solid #c7cdd3;
      text-transform: uppercase;
    }

    table td.service2,
    table td.desc {
      width: 40%;
      text-align: center;
      border-top: 1px solid #c7cdd3;
      border-bottom: 1px solid #c7cdd3;
      border-left: 1px solid #c7cdd3;
      border-right: 1px solid #c7cdd3;
    }
    table th.service2,
    table th.desc {
      text-align: center;
      border-top: 1px solid #c7cdd3;
      border-bottom: 1px solid #c7cdd3;
      border-left: 1px solid #c7cdd3;
      border-right: 1px solid #c7cdd3;
    }
    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1em;
        text-transform: uppercase;

    }

    table td.grand {
        border-top: 1px solid #9da3a9;
        border-bottom: 1px solid #8e959d;
        border-left: 1px solid #c7cdd3;
        border-right: 1px solid #c7cdd3;
        
    }
    table td.service5,
    table td.desc {
      width: 40%;
      text-align: left;
      border-top: 1px solid #c7cdd3;
      border-bottom: 1px solid #c7cdd3;
      border-left: 1px solid #c7cdd3;
      border-right: 1px solid #c7cdd3;
    }

    #notices .notice {
        color: #5D6975;
        font-size: 1em;
    }

    footer {
        color: #5D6975;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #C1CED9;
        padding: 1px 0;
        text-align: center;
    }
</style>

<body>
  


  <table class="short-table">
       
       
    <tr>
        <th class="service2">BUKTI PEMBAYARAN</th>
        <th class="service2" rowspan="2" style="height: 60px;"> PT RESTU ABADI EKSPEDISI </th>
        
    </tr>
    <tr>
        <td class="service2" style="font-weight: bold; text-transform: uppercase;">{{ $gajian->periode_detail }}</td>
       
       
    </tr>


</table>
      <table class="short-table">
       
       
            <tr>
                <td class="service5">NIK</td>
               
                <td class="service5" style="font-weight: bold;"> {{ $gajian->nik }}</td>
            </tr>
            <tr>
                <td class="service5">Nama Karyawan</td>
                
                <td class="service5" style="font-weight: bold;"> {{ $gajian->nama_karyawan }}</td>
            </tr>
            <tr>
              <td class="service5">Periode</td>
              
              <td class="service5" > {{ $gajian->periode }}</td>
          </tr>
            <tr>
                <td class="service5">Kantor Cabang</td>
               
                <td class="service5"> {{ $gajian->kantor_cabang }}</td>
            </tr>
            <tr>
                <td class="service5">Divisi</td>
               
                <td class="service5"> {{$gajian->divisi_kerja }}</td>
            </tr>
            <tr>
                <td class="service5">Jabatan</td>
                
                <td class="service5"> {{ $gajian->posisi_kerja }}</td>
            </tr>
           
        
    </table>

    <table>
       
       
      <tr>
          <th class="service2">HK KANTOR</th>
          <th class="service2">HK KARYAWAN</th>
          <th class="service2">ABSEN</th>
      </tr>
      <tr>
          <td class="service2">{{ $gajian->jumlah_hari_kerja_kalender }}</td>
          <td class="service2">{{ $gajian->total_jumlah_hari_kerja }}</td>
          <td class="service2">{{ $gajian->jumlah_alfa}}</td>
      </tr>

  
</table>
   
   
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service2">RINCIAN</th>
                   
                    <th class="service2">BESARAN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="service">Gaji Pokok</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->gaji_pokok) }}</td>
                </tr>
                @if($gajian->tunjangan_jabatan != 0 && $gajian->tunjangan_jabatan != null)
                <tr>
                    <td class="service">Tunjangan Jabatan</td>
                    
                    <td class="service1">Rp {{ format_uang($gajian->tunjangan_jabatan) }}</td>
                </tr>
                @endif
                @if($gajian->premi_kehadiran != 0 && $gajian->premi_kehadiran != null)
                <tr>
                    <td class="service">Premi Kehadiran</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->premi_kehadiran) }}</td>
                </tr>
                @endif
                
                
          
             
             
           
          

            @if($gajian->total_tunjangan_bbm != 0 && $gajian->total_tunjangan_bbm != null)
            <tr>
              <td  class="service " >Total Tunjangan BBM</td>
             
              <td class="service1" >Rp {{ format_uang($gajian->total_tunjangan_bbm) }}</td>
          </tr>
          @endif
          @if($gajian->tunjangan_komunikasi != 0 && $gajian->tunjangan_komunikasi != null)
            <tr>
              <td  class="service " >Tunjangan Komunikasi</td>
             
              <td class="service1" >Rp {{ format_uang($gajian->tunjangan_komunikasi) }}</td>
          </tr>
          @endif
          @if($gajian->total_uang_makan != 0 && $gajian->total_uang_makan != null)
          <tr>
            <td  class="service ">Total Uang Makan</td>
           
            <td class="service1" >Rp {{ format_uang($gajian->total_uang_makan) }}</td>
        </tr>
        @endif
        @if($gajian->sewa_motor_mobil != 0 && $gajian->sewa_motor_mobil != null)
          <tr>
            <td  class="service ">Sewa Motor/Mobil</td>
           
            <td class="service1" >Rp {{ format_uang($gajian->sewa_motor_mobil) }}</td>
        </tr>
        @endif
        @if($gajian->gaji_bulanan != 0 && $gajian->gaji_bulanan != null)
                <tr>
                  <td  class="grand " style="font-weight: bold;">Total Full Gaji 1 Bln</td>
                 
                  <td class="grand" style="font-weight: bold;">Rp {{ format_uang($gajian->gaji_bulanan) }}</td>
              </tr>
              @endif
              @if($gajian->total_uang_makan != 0 && $gajian->total_uang_makan != null)
              <tr>
                <td  class="service ">Rata2 Gaji Perhari  Rp {{ format_uang($gajian->gaji_perhari) }}</td>
               
                <td class="service1" ></td>
            </tr>
            @endif

        <tr>
            <td class="service" style="font-weight: bold;">Tambahan (+) </td>
           
            <td class="service1"></td>
        </tr>
        @if($gajian->insentif != 0 && $gajian->insentif != null)
                <tr>
                    <td class="service">Insentif</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->insentif) }}</td>
                </tr>
                @endif
                @if($gajian->subsidi_bpjs != 0 && $gajian->subsidi_bpjs != null)
                <tr>
                    <td class="service">Subsidi BPJS</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->subsidi_bpjs) }}</td>
                </tr>
                @endif
            @if($gajian->bonus != 0 && $gajian->bonus != null)
                <tr>
                    <td class="service">Lain lain</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->bonus) }}</td>
                </tr>
                @endif
                <tr>
                  <td  class="grand " style="font-weight: bold;">Total Pendapatan</td>
                 
                    <td class="grand" style="font-weight: bold;">Rp {{ format_uang($gajian->total_pendapatan) }}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
              <tr>
                <th class="service2">POTONGAN</th>
               
                <th class="service2">BESARAN</th>
            </tr>
            </thead>
            <tbody>
                @if($gajian->kasbon_gajian != 0 && $gajian->kasbon_gajian != null)
                <tr>
                    <td class="service">Kasbon Gajian</td>
                  
                    <td class="service1">Rp {{ format_uang($gajian->kasbon_gajian) }}</td>
                </tr>
                @endif
                @if($gajian->kasbon_kantor != 0 && $gajian->kasbon_kantor != null)
                <tr>
                    <td class="service">Kasbon Kantor</td>
                    
                    <td class="service1">Rp {{ format_uang($gajian->kasbon_kantor) }}</td>
                </tr>
                @endif
                @if($gajian->kasbon_kantor != 0 && $gajian->kasbon_kantor != null)
                <tr>
                    <td class="service">Cicilan Pinjaman Ke Kantor</td>
                    
                    <td class="service1">Rp {{ format_uang($gajian->cicilan_pinjaman) }}</td>
                </tr>
                @endif
                @if($gajian->bolos_kerja != 0 && $gajian->bolos_kerja != null)
                <tr>
                    <td class="service">Bolos Kerja</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->bolos_kerja) }}</td>
                </tr>
                @endif
                @if($gajian->punishment != 0 && $gajian->punishment != null)
                <tr>
                    <td class="service">Punishment</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->punishment) }}</td>
                </tr>
                @endif
                @if($gajian->dana_sosial != 0 && $gajian->dana_sosial != null)
                <tr>
                    <td class="service">Dana Sosial</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->dana_sosial) }}</td>
                </tr>
                @endif
                @if($gajian->bpjs_kes_kantor != 0 && $gajian->bpjs_kes_kantor != null)
                <tr>
                    <td class="service">BPJS KES Kantor</td>
                   
                    <td class="service1">Rp {{ format_uang($gajian->bpjs_kes_kantor) }}</td>
                </tr>
                @endif
                <tr>
                    <td  class="grand " style="font-weight: bold;">Total Potongan</td>
                   
                    <td class="grand" style="font-weight: bold;">Rp {{ format_uang($gajian->total_potongan) }}</td>
                </tr>
                
            </tbody>
        </table>
        <table>
          <tr>
            <td class="4" class="grand " style="font-weight: bold;">TOTAL GAJI BERSIH</td>
            
            <td class="grand " style="font-weight: bold;">Rp {{ format_uang($gajian->gaji_total) }}</td>
        </tr>
        </table>
        <div id="notices">
            <div>Keterangan:</div>
            <div class="notice">Bolos Dua Hari DiPotongkan Ke Jatah Cuti Tahunan</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>

    <script>
      // Fungsi untuk menggantikan nilai angka dengan teks yang diinginkan
      function replaceMonthValue() {
          const monthElement = document.getElementById('month');
          const monthValue = monthElement.innerText;

          switch (monthValue) {
              case '06':
                  monthElement.innerText = 'Mei-Juni';
                  break;
              // Tambahkan kasus lainnya jika perlu
              default:
                  // Default action
                  break;
          }
      }

      // Panggil fungsi saat halaman selesai dimuat
      document.addEventListener('DOMContentLoaded', replaceMonthValue);
  </script>
</body>

</html>
