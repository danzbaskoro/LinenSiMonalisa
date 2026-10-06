<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GrafikDB;
use App\Traits\Helper;
use App\Traits\JsonResult;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;


class GrafikController extends Controller
{
    use Helper;
    use JsonResult;
    private $grafikDB; 

    public function __construct()
    {
        $this->grafikDB = new GrafikDB();
    }
    public function viewGrafik()
    {
        return view('laporan.view-laporan');
    }
    public function viewLaporanBulan()
    {
        return view('laporan.view-laporan-bulan');
    }
    public function cetakLaporanBulan(Request $request)
    {
        $dataBulan = $request->dataBulan;
        $bulan = $request->dataBulan['bulan'];
        $tahun = $request->dataBulan['tahun'];
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $logo = $this->base64LogoJateng();
        $htmllaporan='';

       
        $tabelLaporan = '<br><table style=\"border-collapse: collapse;width:100%\" border="1" cellspacing="0">';
            $htmllaporan .= $tabelLaporan;
            $tdTanggalLaporan = '<th rowspan="2">Tanggal</th>';
            $tdAlatLaporan = '<th rowspan="2">Nama Ruang</th>';
            $tdRuangLaporan = '<th colspan="39" ">Nama Alat</th>';
            $tdTglSterilLaporan = '<th rowspan="2">Tanggal Penyeterilan</th>';
            $tdKeteranganLaporan = '<th rowspan="2">Keterangan</th>';
            $barisHeader = "<tr>" . $tdTanggalLaporan . $tdAlatLaporan . $tdRuangLaporan .$tdTglSterilLaporan. $tdKeteranganLaporan ."</tr>";
            $htmllaporan .= $barisHeader;
            $headerRuang = '<tr><td>Medikasi Set</td><td>Bak Instrumen Besar</td><td>Bak Instrumen Kecil</td><td>Bougenvil</td><td>Dewandaru</td><td>Flamboyan</td><td>Edelweis</td><td>Geranium</td><td>Helikonia</td><td>Ivy</td><td>Jasmin</td><td>Kana</td><td>Poli Gigi</td><td>EEG</td><td>Poli Bedah</td><td>HD</td><td>OK</td><td>Seroja</td></tr>';
            $trAlat = "<tr>";
            $htmllaporan .= $trAlat;
            $alat = $this->laporanDB->getAlat();
            foreach ($alat as $valueAlat) {
                $namaAlat = "<td>".$valueAlat->nama_alat."</td>";
                $htmllaporan .= $namaAlat;
            }
            $barisNamaAlat = "</tr>";
            $htmllaporan .= $barisNamaAlat;
            $getAlat = $this->laporanDB->getLaporanBulan($bulan, $tahun,$bulan, $tahun);
            
            foreach ($getAlat as $valueIsiAlat) {
                $tanggal = "<td>".$valueIsiAlat->tgl_penyerahan."</td>";
                $namaRuang = "<td>".$valueIsiAlat->nama_ruang."</td>";
                $medikasi_set = "<td>".$valueIsiAlat->medikasi_set."</td>";
                $bak_instrumen_besar = "<td>".$valueIsiAlat->bak_instrumen_besar."</td>";
                $bak_instrumen_kecil = "<td>".$valueIsiAlat->bak_instrumen_kecil."</td>";
                $bengkok = "<td>".$valueIsiAlat->bengkok."</td>";
                $kom = "<td>".$valueIsiAlat->kom."</td>";
                $gunting = "<td>".$valueIsiAlat->gunting."</td>";
                $vooder = "<td>".$valueIsiAlat->vooder."</td>";
                $klem = "<td>".$valueIsiAlat->klem."</td>";
                $pinset_anatomis = "<td>".$valueIsiAlat->pinset_anatomis."</td>";
                $pinset_cirugis = "<td>".$valueIsiAlat->pinset_cirugis."</td>";
                $pinset_tht = "<td>".$valueIsiAlat->pinset_tht."</td>";
                $tounge_spatel = "<td>".$valueIsiAlat->tounge_spatel."</td>";
                $kassa = "<td>".$valueIsiAlat->kassa."</td>";
                $spekullum_recta = "<td>".$valueIsiAlat->spekullum_recta."</td>";
                $diagnostik_set = "<td>".$valueIsiAlat->diagnostik_set."</td>";
                $obgyn_set = "<td>".$valueIsiAlat->obgyn_set."</td>";
                $basic_set_ok_hernia = "<td>".$valueIsiAlat->basic_set_ok_hernia."</td>";
                $basic_set_ok_sc = "<td>".$valueIsiAlat->basic_set_ok_sc."</td>";
                $laparatomy_set = "<td>".$valueIsiAlat->laparatomy_set."</td>";
                $tang_cabut_gigi = "<td>".$valueIsiAlat->tang_cabut_gigi."</td>";
                $blade_laringoskop = "<td>".$valueIsiAlat->blade_laringoskop."</td>";
                $ambubag = "<td>".$valueIsiAlat->ambubag."</td>";
                $masker_sipack = "<td>".$valueIsiAlat->masker_sipack."</td>";
                $selang_ambubag = "<td>".$valueIsiAlat->selang_ambubag."</td>";
                $selang_suction = "<td>".$valueIsiAlat->selang_suction."</td>";
                $set_brathing_sirkuit = "<td>".$valueIsiAlat->set_brathing_sirkuit."</td>";
                $set_ventilator = "<td>".$valueIsiAlat->set_ventilator."</td>";
                $duk_lubang = "<td>".$valueIsiAlat->duk_lubang."</td>";
                $root_elevator = "<td>".$valueIsiAlat->root_elevator."</td>";
                $scapel_handle = "<td>".$valueIsiAlat->scapel_handle."</td>";
                $kassa_darm_doek = "<td>".$valueIsiAlat->kassa_darm_doek."</td>";
                $curatage_set = "<td>".$valueIsiAlat->curatage_set."</td>";
                $breathing_set = "<td>".$valueIsiAlat->breathing_set."</td>";
                $mandrin = "<td>".$valueIsiAlat->mandrin."</td>";
                $medikasi_set_ok_besar = "<td>".$valueIsiAlat->medikasi_set_ok_besar."</td>";
                $medikasi_set_ok_kecil = "<td>".$valueIsiAlat->medikasi_set_ok_kecil."</td>";
                $heating_set = "<td>".$valueIsiAlat->heating_set."</td>";
                $cocor_bebek = "<td>".$valueIsiAlat->cocor_bebek."</td>";
                $gunting_tht = "<td>".$valueIsiAlat->gunting_tht."</td>";
                $tgl_steril = "<td>".$valueIsiAlat->tgl_steril."</td>";
                $total = "<td>".$valueIsiAlat->TOTAL."</td>";
                $barisIsiAlat = "<tr>" . $tanggal . $namaRuang . $medikasi_set . $bak_instrumen_besar . $bak_instrumen_kecil . $bengkok . $kom . $gunting . $vooder . $klem .$pinset_anatomis . $pinset_cirugis . $pinset_tht . $tounge_spatel . $kassa . $spekullum_recta . $diagnostik_set . $obgyn_set . $basic_set_ok_hernia . $basic_set_ok_sc . $laparatomy_set . $tang_cabut_gigi . $blade_laringoskop . $ambubag . $masker_sipack . $selang_ambubag . $selang_suction . $set_brathing_sirkuit . $set_ventilator . $duk_lubang . $root_elevator . $scapel_handle . $kassa_darm_doek . $curatage_set . $breathing_set . $mandrin . $medikasi_set_ok_besar . $medikasi_set_ok_kecil . $heating_set . $cocor_bebek . $gunting_tht . $tgl_steril . $total ."</tr>";
                $htmllaporan .= $barisIsiAlat;
            }
        $arrayData = array(
            "logo" => $logo,
            "tabelLaporan" => $htmllaporan
        );
        // print_r($arrayData);
        // die;
        $pdf = DomPDF::loadView('laporan.cetak-laporan-bulan', $arrayData);
        $pdf->setPaper('A2', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        $base64 = base64_encode($content);
        return $this->resultWithData($base64, true, 200);
        // dd($jumlahHari);
    }

}
