<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardDB;
use App\Models\GrafikDB;
use App\Traits\Helper;
use App\Traits\JsonResult;

class DashboardController extends Controller
{
    use Helper;
    use JsonResult;
    private $dashboardDB; 
    private $grafikDB; 

    public function __construct()
    {
        $this->dashboardDB = new dashboardDB();
        $this->grafikDB = new grafikDB();
    }
    public function viewDashboard(Request $request)
    {
        // Mengembalikan view ke pengguna
        $getTotalAlat = $this->dashboardDB->countAlat();
        $totalAlat = $getTotalAlat[0]->JMLALAT;
       
        $getTotalSteril = $this->dashboardDB->countSteril();
        $totalSteril = $getTotalSteril[0]->JMLSTERIL;
        $tglsekarang = date('Y-m-d');
        // dd($tglsekarang);
        $getTotalKadaluarsa = $this->dashboardDB->countKadaluarsa($tglsekarang);
        $totalKadaluarsa = $getTotalKadaluarsa[0]->JMLSTERILKADALUARSA;
        $arrayData = array(
            "totalAlat" => $totalAlat,
            "totalSteril" => $totalSteril,
            "totalKadaluarsa" => $totalKadaluarsa
        );
        return view('dashboard.landing', compact('totalAlat', 'totalSteril', 'totalKadaluarsa'));
    }
    public function sterilRuangHarian(Request $request)
    {
        $tanggal = date('Y-m-d');

        $dataResult = $this->grafikDB->getGrafikHarian($tanggal);
        if (!empty($dataResult)) {
            return $this->resultWithData($dataResult, true, 200);
        } else {
            return $this->resultWithData('Data Tidak Ditemukan', false, 200);
        }
    }

    public function grafikSterilBulanan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        
        $dataResult = $this->grafikDB->getGrafikBulan($bulan, $tahun);
        // dd($dataResult);
        if (!empty($dataResult)) {
            return $this->resultWithData($dataResult, true, 200);
        } else {
            return $this->resultWithData('Data Tidak Ditemukan', false, 200);
        }
    }
    public function getDataAlatKadaluarsa(Request $request)
    {
        $result = array();
        $ls = array();
        $draw = $request->draw;
        $tglsekarang = date('Y-m-d');
        $filters = $request->search['value'];
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $kolom = 's.kode_steril';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->dashboardDB->getAlatKadaluarsa($tglsekarang,$filters, $start, $length, $kolom, $order);
        $total = $this->dashboardDB->getTotalAlatKadaluarsa($tglsekarang,$filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->kode_steril . "|" . $item->tgl_penyerahan_alat;
                
                $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-warning ms-3 text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=sterilUlang(this.id,this.name)><i class="ki-outline ki-glass fs-3 ms-1"></i></button></div>';
                
                if (!empty($item->created_at)) {
                    $item->created_at = date('d-m-Y H:i:s', strtotime($item->created_at));
                }

                if (!empty($item->updated_at)) {
                    $item->updated_at = date('d-m-Y H:i:s', strtotime($item->updated_at));
                }

                $a = array($i, $item->kode_steril, $item->nama_ruang, $item->tgl_steril,$item->tgl_kadaluarsa,$item->status_pengambilan, $aksi);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }
    function getViewSterilUlang(Request $request)
    {
        $kodeSteril = $request->kodeSteril;
        
            $cekkodeSteril = $this->dashboardDB->getSterilKadaluarsa($kodeSteril);
            $idSteril = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_steril;
            $namaRuang = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->nama_ruang;
            $idRuang = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_ruang;
            $tgl_penyerahan_alat = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->tgl_penyerahan_alat;
            $tgl_pengembalian_alat = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->tgl_pengembalian_alat;
            $tgl_steril = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->tgl_steril;
            $tgl_kadaluarsa = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->tgl_kadaluarsa;
            $id_p_pencucian = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_p_pencucian;
            $p_pencucian = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_pencucian;
            $id_p_packing = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_p_packing;
            $p_packing = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_packing;
            $id_p_operator = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_p_operator;
            $p_operator = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_operator;
            $id_p_check = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_p_check;
            $p_check = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_check;
            $id_p_cssd_penerimaan = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_p_cssd_penerimaan;
            $p_cssd_penerimaan = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_cssd_penerimaan;
            $p_unit_penerimaan = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_unit_penerimaan;
            // $id_p_cssd_pengembalian = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->id_p_cssd_pengembalian;
            // $p_cssd_pengembalian = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_cssd_pengembalian;
            // $p_unit_pengembalian = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->p_unit_pengembalian;
            $status_pengembalian = $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->status_pengambilan;
            $ttd_unit_pengambilan = "data:image/png;base64, " . $this->dashboardDB->getSterilKadaluarsa($kodeSteril)[0]->ttd_unit_pengambilan;
        
        
        
        return View('dashboard.view-form-steril-ulang', compact('idSteril','kodeSteril','namaRuang','idRuang', 'tgl_penyerahan_alat','tgl_pengembalian_alat', 'tgl_steril', 'tgl_kadaluarsa','id_p_pencucian', 'p_pencucian','id_p_packing','p_packing','id_p_operator', 'p_operator','id_p_check', 'p_check','id_p_cssd_penerimaan', 'p_cssd_penerimaan' , 'p_unit_penerimaan', 'status_pengembalian','ttd_unit_pengambilan',));
    }

    public function detailDataAlatSteril(Request $request)
    {
        $result = array();
        $ls = array();
        $draw = $request->draw;
        $filters = $request->search['value'];
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $kodeSteril = $request->kodeSteril;
        // dd($kodeSteril);
        $kolom = 'id_steril';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->dashboardDB->getDataAlatSteril($kodeSteril,$filters, $start, $length, $kolom, $order);
        $total = $this->dashboardDB->getTotalDataAlatSteril($kodeSteril,$filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->id_steril . "|" . $item->id_alat. "|" . $item->nama_alat . "|" . $item->jml_alat . "|" . $item->jns_alat;
                $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-warning text-center" id="' . $item->id_steril . '" name="' . $data_name . '" onclick=EditDataAlatSteril(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->id_steril . '" name="' . $item->id_steril . '" onclick=HapusDataAlatSteril(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></div>';

                if (!empty($item->created_at)) {
                    $item->created_at = date('d-m-Y H:i:s', strtotime($item->created_at));
                }

                if (!empty($item->updated_at)) {
                    $item->updated_at = date('d-m-Y H:i:s', strtotime($item->updated_at));
                }

                $a = array($i, $item->nama_alat,$item->satuan_alat, $item->jml_alat,$item->jns_alat);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }
    public function editDataSterilAlatKadaluarsa(Request $request)
    {
        $dataSteril = $request->dataSterilAlatKadaluarsa;
        
       
        $kodeSteril = $request->dataSterilAlatKadaluarsa['kodeSteril'];
        $idRuang = $request->dataSterilAlatKadaluarsa['idRuang'];
        $petugasUnit = $request->dataSterilAlatKadaluarsa['petugasUnit'];
        $petugasCssd = $request->dataSterilAlatKadaluarsa['petugasCssd'];
        $tanggalPenyerahan = $request->dataSterilAlatKadaluarsa['tanggalPenyerahan'];
        $tanggalSteril = $request->dataSterilAlatKadaluarsa['tanggalSteril'];
        $tanggalKadaluarsaAlat = $request->dataSterilAlatKadaluarsa['tanggalKadaluarsaAlat'];
        
        $petugasPencucian = $request->dataSterilAlatKadaluarsa['petugasPencucian'];
        $petugasPacking = $request->dataSterilAlatKadaluarsa['petugasPacking'];
        $petugasOperator = $request->dataSterilAlatKadaluarsa['petugasOperator'];
        $petugasCheck = $request->dataSterilAlatKadaluarsa['petugasCheck'];
        $ketPengambilan = $request->dataSterilAlatKadaluarsa['ketPengambilan'];
       
        
        $arrayDataSteril = array(
            
                "id_ruang" => $idRuang,
                "tgl_penyerahan_alat" => $tanggalPenyerahan,
                "tgl_steril" => $tanggalSteril,
                "tgl_kadaluarsa" => $tanggalKadaluarsaAlat,
                "p_pencucian" => $petugasPencucian,
                "p_packing" => $petugasPacking,
                "p_operator" => $petugasOperator,
                "p_check_akhir" => $petugasCheck,
                "p_cssd_penerimaan" => $petugasCssd,
                "p_unit_penerimaan" => $petugasUnit,
                "keterangan" => $ketPengambilan
        );
        // dd($dataSteril);
        $updateDataAlatSteril = $this->dashboardDB->editSterilAlatKadaluarsa('steril', $arrayDataSteril, $kodeSteril);
        if (!$updateDataAlatSteril) {
            return $this->resultWithData("Gagal Update Data", false, 200);
        } else {
            return $this->resultWithData($updateDataAlatSteril, true, 200);
        }
    }
}
