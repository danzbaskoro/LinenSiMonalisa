<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LaundryDb;
use App\Traits\JsonResult;
use App\Traits\Helper;
use Illuminate\Support\Facades\Session;
use App\Enums\ConstSessions;
use App\Enums\ConstLogAuditrail;
use App\Traits\LogAuditrail;
use App\Enums\ConstActivityStatus;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class LaundryController extends Controller
{
    use JsonResult;
    use Helper;
    private $laundryDb;

    public function __construct()
    {
        $this->laundryDb = new LaundryDb();
    }

    public function viewLaundry(Request $request)
    {
        $tahunList = $this->laundryDb->getListTahun();

        return view('laundry.linen', compact('tahunList'));
    }

    public function viewTambahLinen()
    {
        return view('laundry.tambah-data-linen');
    }
    
    public function getListLinen(Request $request)
    {
        $resultLinen = $this->laundryDb->getLinen($request->key);
        return $this->resultWithData($resultLinen, true, 200);
    }

    public function simpanAjuanLaundry(Request $request)
    {
        $dataAjuanSteril = $request->dataAjuanSteril;
        
    //    dd($dataPengambilanSteril);

        $idRuang = $request->dataAjuanSteril['idRuang'];
       
        $petugas_unit = $request->dataAjuanSteril['petugas_unit'];
        $tanggalPenyerahan = $request->dataAjuanSteril['tanggalPenyerahan'];
        $cttnUSer = $request->dataAjuanSteril['cttnUSer'];
        $ttdUnitPengirim = $request->dataAjuanSteril['ttdUnitPengirim'];
       
        $alatSteril = $request->dataAjuanSteril['alatSteril'];
        $checkKode = $this->homepageDB->cekKodeCssd($tanggalPenyerahan);
        $lastKode = (int) substr($checkKode[0]->kode_steril, 5);
        

        if (!empty($checkKode[0]->kode_steril)) {
            $nokodeSteril = $lastKode + 1;
            $kodeSteril = sprintf("CSSD-%04d", $nokodeSteril);

        }else{
            $kodeSteril = sprintf("CSSD-%04d", 1);
        }
        foreach ($alatSteril as $listAlat) {
            $arrayDataAjuanSteril = array(
                    "kode_steril" => $kodeSteril,
                    "id_ruang" => $idRuang,
                    "id_alat" => $listAlat['idAlatSteril'],
                    "jns_alat" => $listAlat['jnsAlat'],
                    "jml_alat" => $listAlat['jmlAlat'],
                    "tgl_penyerahan_alat" => $tanggalPenyerahan." ".date('H:i:s'),
                    "p_unit_penerimaan" => $petugas_unit,
                    "ttd_unit_pengirim" => $ttdUnitPengirim,
                    "keterangan_user" => $cttnUSer,
                    "status_pengambilan" => 'Belum diambil'
            );
            $arrayDataAjuanSteril = $this->homepageDB->insert('steril', $arrayDataAjuanSteril);
        }
        // dd($arrayDataPengambilanSteril);
        
        if (!$arrayDataAjuanSteril) {
            return $this->resultWithData("Gagal Update Data Steril", false, 200);
        } else {
            return $this->resultWithData($arrayDataAjuanSteril, true, 200);
        }
    }

}
