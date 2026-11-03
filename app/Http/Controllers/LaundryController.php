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
        $idRuang = $request->dataAjuanLaundry['idRuang'];
       
        $petugas_unit = $request->dataAjuanLaundry['petugasUnit'];
        $tanggalPenyerahan = $request->dataAjuanLaundry['tanggalPenyerahan'];
        $ketUserPengirim = $request->dataAjuanLaundry['ketUserPengirim'];
        $ttdUnitPengirim = $request->dataAjuanLaundry['ttdUnitPengirim'];
       
        $alatLinen = $request->dataAjuanLaundry['barangLaundry'];
        $checkKode = $this->laundryDb->cekKodeLaundry($tanggalPenyerahan);
        $lastKode = (int) substr($checkKode[0]->kode_linen, 5);
        

        if (!empty($checkKode[0]->kode_linen)) {
            $nokodeLinen = $lastKode + 1;
            $kodeLinen = sprintf("LINEN-%04d", $nokodeLinen);

        }else{
            $kodeLinen = sprintf("LINEN-%04d", 1);
        }
        foreach ($alatLinen as $listAlat) {
            $arrayDataAjuanLinen = array(
                    "kode_linen" => $kodeLinen,
                    "id_ruangan" => $idRuang,
                    "id_linen" => $listAlat['idLinen'],
                    "jumlah_masuk" => $listAlat['jmlBarang'],
                    "berat_kg" => $listAlat['brtBarang'],
                    "tgl_penyerahan_linen" => $tanggalPenyerahan." ".date('H:i:s'),
                    "p_unit_penerimaan" => $petugas_unit,
                    "ttd_unit_pengirim" => $ttdUnitPengirim,
                    "keterangan_user" => $ketUserPengirim,
                    "status_pengambilan" => 'Belum diambil'
            );
            dd($arrayDataAjuanLinen);

            $arrayDataAjuanL = $this->laundryDb->insert('transaksi_linen', $arrayDataAjuanLinen);
        }
        // dd($arrayDataPengambilanSteril);
        
        if (!$arrayDataAjuanL) {
            return $this->resultWithData("Gagal Update Data Linen", false, 200);
        } else {
            return $this->resultWithData($arrayDataAjuanLinen, true, 200);
        }
    }

}
