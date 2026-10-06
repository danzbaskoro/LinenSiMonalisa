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
    
    <div style="padding-top:40px;font-size: 10px; font-family:'Poppins', 'Helvetica', sans-serif; line-height: 18px">
        {!! $tabelLaporan !!}
    </div>


    
  
    </div>


</div>

   
        
            

