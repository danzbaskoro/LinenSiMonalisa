<style>
    @page { margin-top: 10px; }

    .container {
            display: flex;
            gap: 20px; /* Jarak antara tabel */
    }
    
</style>

<div style="padding-left: 5px; padding-top: 35px">
    <div style="text-align: left">
        <div style="width: 7%; float: left;">
            {{-- <img src="{{ env('APP_URL') }}/assets/media/logos/logojateng.jpg" width="80" height="80" style="filter: grayscale(100%);vertical-align: center"> --}}
            <img src="data:image/jpeg;base64,{{ $logo }}" width="80" height="80" style="filter: grayscale(100%);vertical-align: center">
        </div>
        <div style="width: 90%;text-align: center; float: right;">
            <p style="font-size: 14px;font-family:'Poppins', 'Helvetica', sans-serif;line-height: 5px"><strong>PEMERINTAH PROVINSI JAWA TENGAH</strong></p>
            <p style="font-size: 16px;font-family: 'Poppins', 'Helvetica', sans-serif;line-height: 5px"><strong>RUMAH SAKIT JIWA DAERAH</strong></p>
            <p style="font-size: 16px;font-family: 'Poppins', 'Helvetica', sans-serif;line-height: 5px"><strong>Dr. RM. SOEDJARWADI</strong></p>
            <p style="font-size: 8px;font-family: 'Poppins', 'Helvetica', sans-serif; line-height: 2px">Jalan Ki. Pandanaran Km.2 Klaten 57425 &nbsp;Telp. 0272-321435, Faks 0272-321418</p>     
            <p style="font-size: 8px;font-family: 'Poppins', 'Helvetica', sans-serif; line-height: 2px">Website : rsjd-sujarwadi.jatengprov.go.id &nbsp;Email: soedjarwadi@jatengprov.go.id</p>
        </div>
    </div>
    <div style="padding-top:85px;">
        <hr style="padding-left: 10px;border-top: 5px double black;">   
    </div>
    {{-- <div style="float: right; font-size: 10px; font-family:'Poppins', 'Helvetica', sans-serif; line-height: 20px">
       tes
    </div> --}}
    {{-- <br> --}}
    <div style="padding-top:0px;text-align: center;font-size: 12px;font-family:'Poppins', 'Helvetica', sans-serif">
       
        <h4 style="margin-bottom:5px; display:inline-block;">
            <strong>FORMULIR PERMINTAAN STERILISASI DAN PENGAMBILAN /INSTRUMEN STERIL UNIT CSSD
            </strong>
        </h4>
       
    </div>
    <div style="padding-top:0px;text-align: left;font-size: 10px;font-family:'Poppins', 'Helvetica', sans-serif">
        <p style="text-decoration: underline;font-weight: bold">
            KETERANGAN :
        </p>
        <ol>
            <li>Pengambilan barang tanpa bukti tidak dilayani </li>
            <li>Pengeluaran barang harus sesuai dengan penerimaan </li>
            <li>Kemasan cacat / rusak jangan di gunakan </li>
        </ol>
        
    </div>

    <div style="padding-top:0px;text-align: left;font-size: 11px;font-family:'Poppins', 'Helvetica', sans-serif">
        <p>
            Nama/unit : {{ $namaRuang }}
        </p>
    </div>

    <div style="padding-top:0px;text-align: left;font-size: 11px;font-family:'Poppins', 'Helvetica', sans-serif">
        <div style="width: 60%;float: left;">
            <table style="border-collapse: collapse;width: 200px;"  cellspacing="0" >
                <tr >
                    <td style="border-top: 1px">Datang tgl.</td>
                    <td>:</td>
                    <td style="width: 40px">{{ $tgl_penyerahan_alat }}</td>
                    <td>Steril tgl.</td>
                    <td>:</td>
                    <td>{{ $tgl_steril }}</td>
                </tr>
                <tr>
                    <td>Jam</td>
                    <td>:</td>
                    <td></td>
                    <td>Jam</td>
                    <td>:</td>
                    <td>{{ $jam_steril }}</td>
                </tr>
                <tr>
                    <td>Diambil tgl.</td>
                    <td>:</td>
                    <td>{{ $tgl_pengembalian_alat }}</td>
                    <td>Exp Date</td>
                    <td>:</td>
                    <td>{{ $tgl_kadaluarsa }}</td>
                </tr>
                <tr>
                    <td>Jam</td>
                    <td>:</td>
                    <td>{{ $jam_pengambilan }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div style="width: 40%;float: right;">
            <table style="border-collapse: collapse;" border="1" cellspacing="0">
                <tr>
                    <td></td>
                    <td></td>
                    <td>Petugas</td>
                    <td>Paraf</td>
                </tr>
                <tr>
                    <td>Pencucian</td>
                    <td>:</td>
                    <td>{{ $p_pencucian }}</td>
                    <td><img style="height: 10px" src="{{ $paraf_p_pencucian }}" alt=""></td>
                </tr>
                <tr>
                    <td>Packing</td>
                    <td>:</td>
                    <td>{{ $p_packing }}</td>
                    <td><img style="height: 10px" src="{{ $paraf_p_packing }}" alt=""></td>
                </tr>
                <tr>
                    <td>Operator</td>
                    <td>:</td>
                    <td>{{ $p_operator }}</td>
                    <td><img style="height: 10px" src="{{ $paraf_p_operator }}" alt=""></td>
                </tr>
                <tr>
                    <td>Check Akhir</td>
                    <td>:</td>
                    <td>{{ $p_check }}</td>
                    <td><img style="height: 10px" src="{{ $paraf_p_check }}" alt=""></td>
                </tr>
            </table>
        </div>    

    </div>
    <div style="padding-top:80px;font-size: 10px; font-family:'Poppins', 'Helvetica', sans-serif; line-height: 18px">
        <p style="font-weight: bold">Steril dengan Autoclave Steam</p>
        <table style="border-collapse: collapse;width:100%" border="1" cellspacing="0">
            {!! $alat !!}
        </table>
        <p style="font-weight: bold">Catatan :
            <br>{!! $keterangan !!}
        </p>
    </div>

    
    
    <div style="padding-top: 10px; font-size: 10px; font-family:'Poppins', 'Helvetica', sans-serif; line-height: 18px">
        <div style="width: 50%;float: left;">
            <table style="border-collapse: collapse;text-align: center"  cellspacing="0">
                <tr>
                    <td colspan="2">Penerimaan</td>
                </tr>
                <tr>
                    <td style="padding: 10px">Petugas Unit</td>
                    <td style="padding: 10px">Petugas CSSD</td>
                </tr>
                <tr>
                    <td style="vertical-align: bottom;"><img style="height: 50px" src="{{ $ttd_unit_penerimaan }}" alt=""></td>
                    <td style="vertical-align: bottom;"><img style="height: 50px" src="{{ $paraf_p_cssd_penerimaan }}" alt=""></td>
                </tr>
                <tr>
                    <td style="vertical-align: bottom;">({{ $p_unit_penerimaan }})</td>
                    <td style="vertical-align: bottom;">({{ $p_cssd_penerimaan }})</td>
                </tr>
            </table>
        </div>
        <div style="width: 50%;float: right;">
            <table style="border-collapse: collapse;text-align: center"  cellspacing="0">
                <tr>
                    <td colspan="2">Penyerahan</td>
                </tr>
                <tr>
                    <td style="padding: 10px">Petugas Unit</td>
                    <td style="padding: 10px">Petugas CSSD </td>
                </tr>
                <tr>
                    <td style="vertical-align: bottom;"><img style="height: 50px" src="{{ $ttd_unit_pengambilan }}" alt=""></td>
                    <td style="vertical-align: bottom;"><img style="height: 50px" src="{{ $paraf_p_cssd_pengembalian }}" alt=""></td>
                </tr>
                <tr>
                    <td style="vertical-align: bottom;">({{ $p_unit_pengembalian }})</td>
                    <td style="vertical-align: bottom;">({{ $p_cssd_pengembalian }})</td>
                </tr>
            </table>
        </div>
    </div>
    </div>


</div>

   
        
            

