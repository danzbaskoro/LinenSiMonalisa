<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SterilDb;
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

class SterilController extends Controller
{
    use JsonResult;
    use Helper;
    private $sterilDb;

    public function __construct()
    {
        $this->sterilDb = new SterilDb();
    }
    public function viewSteril(Request $request)
    {
        $tahunList = $this->sterilDb->getListTahun();

        return view('steril.steril-new', compact('tahunList'));

        // return view('steril.steril-new');
    }
    public function viewTambahSteril()
    {
        return view('steril.tambah-data-steril');
    }
    public function getDataSteril(Request $request)
    {
        $result = array();
        $ls = array();
        $draw = $request->draw;
        // $filters = $request->search['value'];
        // $start = $request->start ?? 0;
        // $length = $request->length ?? 10;
        $filters = $request->search['value'];

        $tahun = $request->tahun;
        $status = $request->status;
        // $ruang = $request->ruang ?? '';

        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $kolom = 'kode_steril';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->sterilDb->getDataSteril(
                        $filters,
                        $tahun,
                        $status,
                        $start,
                        $length,
                        $kolom,
                        $order
                    );
        $total = $this->sterilDb->getTotalDataSteril(
            $filters,
            $tahun,
            $status
        );

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->kode_steril . "|" . $item->tgl_penyerahan_alat;
                if ($item->status_pengambilan == 'Sudah diambil' && isset($item->tgl_pengembalian_alat) && $item->tgl_pengembalian_alat!='0000-00-00') {
                    $pdfFormulir='
                     <button type="button" class="btn btn-sm btn-flex btn-primary ms-3 text-center" id="' . $item->kode_steril . '" name="' . $item->kode_steril . '" onclick=CetakDataSteril(this.id)><i class="ki-outline ki-file fs-3 ms-1"></i></button>';
                 }
                 else
                 {
                    $pdfFormulir='
                     <button type="button" class="btn btn-sm btn-flex btn-default ms-3 text-center" id="' . $item->kode_steril . '" name="' . $item->kode_steril . '" ><i class="ki-outline ki-file fs-3 ms-1"></i></button>';
                 }
                 if($item->p_pencucian!=null){
                    $editButton ='<button type="button" class="btn btn-sm btn-flex btn-warning ms-3 text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=EditDataPengambilan(this.id,this.name)><i class="ki-outline ki-scan-barcode fs-3 ms-1"></i></button>';
                 }
                 else
                 {
                    $editButton='';
                 }
                $aksi = '<div class="w-100 text-center">' . $editButton . '<button type="button" class="btn btn-sm btn-flex btn-success ms-3 text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=EditDataSteril(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->kode_steril . '" name="' . $item->kode_steril . '" onclick=HapusDataSteril(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></button>' . $pdfFormulir . '</div>';
                
                
                // $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-success ms-3 text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=EditDataSteril(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-warning text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=DetailDataSteril(this.id,this.name)><i class="ki-outline ki-eye fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->kode_steril . '" name="' . $item->kode_steril . '" onclick=HapusDataSteril(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></div>';

                // $barcode='<div class="w-100 text-center">
                // <button type="button" class="btn btn-sm btn-flex btn-success text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=EditDataSteril(this.id,this.name)><i class="ki-outline ki-scan-barcode fs-3 ms-1"></i></button></div>';

                if (!empty($item->created_at)) {
                    $item->created_at = date('d-m-Y H:i:s', strtotime($item->created_at));
                }

                if (!empty($item->updated_at)) {
                    $item->updated_at = date('d-m-Y H:i:s', strtotime($item->updated_at));
                }

                $a = array($i, $item->kode_steril, $item->nama_ruang, $item->tgl_penyerahan_alat,$item->tgl_kadaluarsa,$item->status_pengambilan, $aksi);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }
    public function getListRuangan()
    {
        
        $resulttbRuangan = $this->sterilDb->getRuangan();
       
        return $this->resultWithData($resulttbRuangan, true, 200);
    }

    public function getListUserCssd()
    {
        
        $resultUserCssd = $this->sterilDb->getUserCssd();
       
        return $this->resultWithData($resultUserCssd, true, 200);
    }

    public function getListAlat(Request $request)
    {
        
        $resultAlat = $this->sterilDb->getAlat($request->key);
       
        return $this->resultWithData($resultAlat, true, 200);
    }
    public function simpanDataSteril(Request $request)
    {
        $idRuang = $request->idRuang;
        $tanggalPenyerahan = $request->tanggalPenyerahan;
        $tanggalSteril = $request->tanggalSteril;
        $jamSteril = $request->jamSteril;
        $tanggalKadaluarsaAlat = $request->tanggalKadaluarsaAlat;
        
        $petugasUnit = $request->petugasUnit;
        $petugasCssd = $request->petugasCssd;
        $tanggalPengembalianAlat = $request->tanggalPengembalianAlat;
        $petugasPencucian = $request->petugasPencucian;
        $petugasPacking = $request->petugasPacking;
        $petugasOperator = $request->petugasOperator;
        $petugasCheck = $request->petugasCheck;
        $petugasUnitPengembalian = $request->petugasUnitPengembalian;
        $petugasCssdPengembalian = $request->petugasCssdPengembalian;
        $keteranganPetugasCssd = $request->keteranganPetugasCssd;
        // dd($keteranganPetugasCssd);
        $alatSteril = $request->alatSteril;

        // $checkKode = $this->sterilDb->cekKodeCssd($tanggalPenyerahan);
        // $lastKode = (int) substr($checkKode[0]->kode_steril, 5);
        

        // if (!empty($checkKode[0]->kode_steril)) {
        //     $nokodeSteril = $lastKode + 1;
        //     $kodeSteril = sprintf("CSSD-%04d", $nokodeSteril);

        // }else{
        //     $kodeSteril = sprintf("CSSD-%04d", 1);
        // }

        $checkKode = $this->sterilDb->cekKodeCssd($tanggalPenyerahan);

        if (!empty($checkKode) && !empty($checkKode[0]->kode_steril)) {

            $lastKode = (int) substr($checkKode[0]->kode_steril, 5);
            $kodeSteril = sprintf("CSSD-%04d", $lastKode + 1);

        } else {

            $kodeSteril = sprintf("CSSD-%04d", 1);

        }
        
       
        
        foreach ($alatSteril as $listAlat) {
            $dataSimpan = array(
                "kode_steril" => $kodeSteril,
                "id_ruang" => $idRuang,
                "id_alat" => $listAlat['idAlatSteril'],
                "jns_alat" => $listAlat['jnsAlat'],
                "jml_alat" => $listAlat['jmlAlat'],
                "tgl_penyerahan_alat" => $tanggalPenyerahan." ".date('H:i:s'),
                "tgl_pengembalian_alat" => $tanggalPengembalianAlat,
                "jam_pengambilan" => date('H:i:s'),
                "tgl_steril" => $tanggalSteril,
                "jam_steril" => $jamSteril,
                "tgl_kadaluarsa" => $tanggalKadaluarsaAlat,
                "p_pencucian" => $petugasPencucian,
                "p_packing" => $petugasPacking,
                "p_operator" => $petugasOperator,
                "p_check_akhir" => $petugasCheck,
                "p_cssd_pengembalian" => $petugasCssdPengembalian,
                "p_unit_pengembalian" => $petugasUnitPengembalian,
                "p_cssd_penerimaan" => $petugasCssd,
                "p_unit_penerimaan" => $petugasUnit,
                "keterangan" => $keteranganPetugasCssd,
                "status_pengambilan" => 'Belum diambil'

                // "USLOGNM" => Session::get(ConstSessions::username)
            );
            $insertDatasteril = $this->sterilDb->insert('steril', $dataSimpan);

            
        }
       
        

        
        return $this->resultWithData('SUKSES', true, 200);
    }
    function detailDataSteril(Request $request)
    {
        $kodeSteril = $request->kodeSteril;
        $idSteril = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_steril;
        $namaRuang = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->nama_ruang;
        $tgl_penyerahan_alat = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_penyerahan_alat;
        $tgl_pengembalian_alat = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_pengembalian_alat;
        $tgl_steril = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_steril;
        $tgl_kadaluarsa = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_kadaluarsa;
        $p_pencucian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_pencucian;
        $p_packing = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_packing;
        $p_operator = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_operator;
        $p_check = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_check;
        $p_cssd_penerimaan = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_cssd_penerimaan;
        $p_unit_penerimaan = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_unit_penerimaan;
        $p_cssd_pengembalian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_cssd_pengembalian;
        $p_unit_pengembalian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_unit_pengembalian;
        $status_pengembalian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->status_pengambilan;
        $url=env('APP_URL') . '/steril/detail-data-steril/'.$kodeSteril;
        // $url=route('data-steril');
        $qrCode = QrCode::size(300)->generate($url);
        return View('steril.detail-steril', compact('idSteril','kodeSteril','namaRuang', 'tgl_penyerahan_alat','tgl_pengembalian_alat', 'tgl_steril', 'tgl_kadaluarsa', 'p_pencucian','p_packing', 'p_operator', 'p_check', 'p_cssd_penerimaan' , 'p_unit_penerimaan', 'p_cssd_pengembalian', 'p_unit_pengembalian', 'status_pengembalian','qrCode'));
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

        $result = $this->sterilDb->getDataAlatSteril($kodeSteril,$filters, $start, $length, $kolom, $order);
        $total = $this->sterilDb->getTotalDataAlatSteril($kodeSteril,$filters);

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

                $a = array($i, $item->nama_alat,$item->satuan_alat, $item->jml_alat,$item->jns_alat,  $aksi);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }

    public function detailDataAlatSterilEdit(Request $request)
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

        $result = $this->sterilDb->getDataAlatSteril($kodeSteril,$filters, $start, $length, $kolom, $order);
        $total = $this->sterilDb->getTotalDataAlatSteril($kodeSteril,$filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                
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

    public function editDataListAlatSteril(Request $request)
    {
        $dataAlatSteril = $request->dataAlatSteril;
        
        $idSteril = $request->dataAlatSteril['idSteril'];
        $jmlAlatSteril = $request->dataAlatSteril['jmlAlatSteril'];
        $idAlatSteril = $request->dataAlatSteril['idAlatSteril'];
        $jnsAlatSteril = $request->dataAlatSteril['jnsAlatSteril'];
        // dd($idSteril);
        $arrayDataAlatSteril = array(
            "id_alat" => $idAlatSteril,
            "jns_alat" => $jnsAlatSteril,
            "jml_alat" => $jmlAlatSteril
        );
        
        $updateDataAlatSteril = $this->sterilDb->edit('steril', $arrayDataAlatSteril, $idSteril);
        if (!$updateDataAlatSteril) {
            return $this->resultWithData("Gagal Update Data Alat Steril", false, 200);
        } else {
            return $this->resultWithData($updateDataAlatSteril, true, 200);
        }
    }
    function viewEditDataSteril(Request $request)
    {
        $kodeSteril = $request->kodeSteril;
        
        $cekkodeSteril = $this->sterilDb->cekKodeSteril($kodeSteril);
        if (empty($cekkodeSteril)) {
            $idSteril = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_steril;
            $namaRuang = $this->sterilDb->getIdSteril($kodeSteril)[0]->nama_ruang;
            $idRuang = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_ruang;
            $tgl_penyerahan_alat = $this->sterilDb->getIdSteril($kodeSteril)[0]->tgl_penyerahan_alat;
            $tgl_pengembalian_alat = $this->sterilDb->getIdSteril($kodeSteril)[0]->tgl_pengembalian_alat;
            $jam_pengembalian_alat = $this->sterilDb->getIdSteril($kodeSteril)[0]->jam_pengambilan;
            $tgl_steril = $this->sterilDb->getIdSteril($kodeSteril)[0]->tgl_steril;
            $jam_steril = $this->sterilDb->getIdSteril($kodeSteril)[0]->jam_steril;
            $tgl_kadaluarsa = $this->sterilDb->getIdSteril($kodeSteril)[0]->tgl_kadaluarsa;
            $id_p_pencucian = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_p_pencucian;
            $p_pencucian = "-";
            $id_p_packing = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_p_packing;
            $p_packing ="-";
            $id_p_operator = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_p_operator;
            $p_operator = "-";
            $id_p_check = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_p_check;
            $p_check = "-";
            $id_p_cssd_penerimaan = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_p_cssd_penerimaan;
            $p_cssd_penerimaan = "-";
            $p_unit_penerimaan = $this->sterilDb->getIdSteril($kodeSteril)[0]->p_unit_penerimaan;
            $id_p_cssd_pengembalian = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_p_cssd_pengembalian;
            $p_cssd_pengembalian = $this->sterilDb->getIdSteril($kodeSteril)[0]->id_p_cssd_pengembalian;
            $p_unit_pengembalian = $this->sterilDb->getIdSteril($kodeSteril)[0]->p_unit_pengembalian;
            $status_pengembalian = $this->sterilDb->getIdSteril($kodeSteril)[0]->status_pengambilan;
            $keterangan_cssd = $this->sterilDb->getIdSteril($kodeSteril)[0]->keterangan;
            $keterangan_pengirim = $this->sterilDb->getIdSteril($kodeSteril)[0]->keterangan_user;
            // $ttdcanvas = "data:image/png;base64, " . $getData[0]->ttd_unit_pengambilan;
            $ttd_unit_pengambilan = "data:image/png;base64, " . $this->sterilDb->getIdSteril($kodeSteril)[0]->ttd_unit_pengambilan;
        }else
        {
            $idSteril = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_steril;
            $namaRuang = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->nama_ruang;
            $idRuang = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_ruang;
            $tgl_penyerahan_alat = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_penyerahan_alat;
            $tgl_pengembalian_alat = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_pengembalian_alat;
            $jam_pengembalian_alat = $this->sterilDb->getIdSteril($kodeSteril)[0]->jam_pengambilan;
            $tgl_steril = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_steril;
            $jam_steril = $this->sterilDb->getIdSteril($kodeSteril)[0]->jam_steril;
            $tgl_kadaluarsa = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->tgl_kadaluarsa;
            $id_p_pencucian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_p_pencucian;
            $p_pencucian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_pencucian;
            $id_p_packing = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_p_packing;
            $p_packing = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_packing;
            $id_p_operator = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_p_operator;
            $p_operator = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_operator;
            $id_p_check = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_p_check;
            $p_check = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_check;
            $id_p_cssd_penerimaan = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_p_cssd_penerimaan;
            $p_cssd_penerimaan = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_cssd_penerimaan;
            $p_unit_penerimaan = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_unit_penerimaan;
            $id_p_cssd_pengembalian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->id_p_cssd_pengembalian;
            $p_cssd_pengembalian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_cssd_pengembalian;
            $p_unit_pengembalian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->p_unit_pengembalian;
            $status_pengembalian = $this->sterilDb->cekKodeSteril($kodeSteril)[0]->status_pengambilan;
            $keterangan_cssd = $this->sterilDb->getIdSteril($kodeSteril)[0]->keterangan;
            $keterangan_pengirim = $this->sterilDb->getIdSteril($kodeSteril)[0]->keterangan_user;
            $ttd_unit_pengambilan = "data:image/png;base64, " . $this->sterilDb->cekKodeSteril($kodeSteril)[0]->ttd_unit_pengambilan;
        }
        
        
        
        $url=config('app.url') . '/steril/view-data-pengambilan/'.$kodeSteril;
        // $url=route('data-steril');
        // dd($status_pengembalian);
        $qrCode = QrCode::size(300)->generate($url);
        return View('steril.edit-data-steril', compact('idSteril','kodeSteril','namaRuang','idRuang', 'tgl_penyerahan_alat','tgl_pengembalian_alat','jam_pengembalian_alat', 'tgl_steril','jam_steril', 'tgl_kadaluarsa','id_p_pencucian', 'p_pencucian','id_p_packing','p_packing','id_p_operator', 'p_operator','id_p_check', 'p_check','id_p_cssd_penerimaan', 'p_cssd_penerimaan' , 'p_unit_penerimaan','id_p_cssd_pengembalian', 'p_cssd_pengembalian', 'p_unit_pengembalian', 'status_pengembalian','keterangan_cssd','keterangan_pengirim','ttd_unit_pengambilan','qrCode'));
    }

    public function editDataSteril(Request $request)
    {
        $dataSteril = $request->dataSteril;
        
       
        $kodeSteril = $request->dataSteril['kodeSteril'];
        $idRuang = $request->dataSteril['idRuang'];
        $petugasUnit = $request->dataSteril['petugasUnit'];
        $petugasCssd = $request->dataSteril['petugasCssd'];
        $tanggalPenyerahan = $request->dataSteril['tanggalPenyerahan'];
        $tanggalSteril = $request->dataSteril['tanggalSteril'];
        $jamSteril = $request->dataSteril['jamSteril'];
        $tanggalKadaluarsaAlat = $request->dataSteril['tanggalKadaluarsaAlat'];
        $tanggalPengembalianAlat = $request->dataSteril['tanggalPengembalianAlat'];
        $jamPengambilanAlat = $request->dataSteril['jamPengambilanAlat'];
        $catatanPtgCssd = $request->dataSteril['catatanPtgCssd'];
        $petugasPencucian = $request->dataSteril['petugasPencucian'];
        $petugasPacking = $request->dataSteril['petugasPacking'];
        $petugasOperator = $request->dataSteril['petugasOperator'];
        $petugasCheck = $request->dataSteril['petugasCheck'];
        $petugasUnitPengembalian = $request->dataSteril['petugasUnitPengembalian'];
        $petugasCssdPengembalian = $request->dataSteril['petugasCssdPengembalian'];
        // dd($dataSteril);
        
        if (
    ($petugasUnitPengembalian == null || $petugasUnitPengembalian == '') &&
    ($tanggalPengembalianAlat == null || $tanggalPengembalianAlat == '0000-00-00') &&
    ($petugasCssdPengembalian == null || $petugasCssdPengembalian == '')
) {
    $status_pengembalian = 'Belum diambil';
} else {
    $status_pengembalian = 'Sudah diambil';
}
        
        $arrayDataSteril = array(
            
                "id_ruang" => $idRuang,
                "tgl_penyerahan_alat" => $tanggalPenyerahan,
                "tgl_pengembalian_alat" => $tanggalPengembalianAlat,
                "jam_pengambilan" => $jamPengambilanAlat,
                "tgl_steril" => $tanggalSteril,
                "jam_steril" => $jamSteril,
                "tgl_kadaluarsa" => $tanggalKadaluarsaAlat,
                "p_pencucian" => $petugasPencucian,
                "p_packing" => $petugasPacking,
                "p_operator" => $petugasOperator,
                "p_check_akhir" => $petugasCheck,
                "p_cssd_pengembalian" => $petugasCssdPengembalian,
                "p_unit_pengembalian" => $petugasUnitPengembalian,
                "p_cssd_penerimaan" => $petugasCssd,
                "p_unit_penerimaan" => $petugasUnit,
                "keterangan" => $catatanPtgCssd,
                "status_pengambilan" => $status_pengembalian
        );
        // dd($dataSteril);
        $updateDataAlatSteril = $this->sterilDb->editSteril('steril', $arrayDataSteril, $kodeSteril);
        if (!$updateDataAlatSteril) {
            return $this->resultWithData("Gagal Update Data Steril", false, 200);
        } else {
            return $this->resultWithData($updateDataAlatSteril, true, 200);
        }
    }

    function viewDataPengambilan(Request $request)
    {
        $kodeSteril = $request->kodeSteril;
        $idSteril = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->id_steril;
        $namaRuang = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->nama_ruang;
        $idRuang = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->id_ruang;
        $tgl_penyerahan_alat = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->tgl_penyerahan_alat;
        $tgl_pengembalian_alat = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->tgl_pengembalian_alat;
        $jam_pengembalian_alat = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->jam_pengambilan;
        $tgl_steril = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->tgl_steril;
        $tgl_kadaluarsa = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->tgl_kadaluarsa;

        $id_p_pencucian = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->id_p_pencucian;
        $p_pencucian = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->p_pencucian;
        $id_p_packing = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->id_p_packing;
        $p_packing = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->p_packing;
        $id_p_operator = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->id_p_operator;
        $p_operator = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->p_operator;
        $id_p_check = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->id_p_check;
        $p_check = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->p_check;
        $id_p_cssd_penerimaan = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->id_p_cssd_penerimaan;
        $p_cssd_penerimaan = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->p_cssd_penerimaan;
        $p_unit_penerimaan = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->p_unit_penerimaan;
        $catatanCssd = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->catatan_cssd;
        $catatanUnit = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->catatan_unit;
        
        $status_pengembalian = $this->sterilDb->cekSterilPengembalian($kodeSteril)[0]->status_pengambilan;
        $url=config('app.url') . '/steril/view-data-pengambilan/'.$kodeSteril;
        // $url=route('data-steril');
        // dd($status_pengembalian);
        $qrCode = QrCode::size(300)->generate($url);
        return View('steril.data-pengambilan', compact('idSteril','kodeSteril','namaRuang','idRuang', 'tgl_penyerahan_alat','tgl_pengembalian_alat','jam_pengembalian_alat', 'tgl_steril', 'tgl_kadaluarsa','id_p_pencucian', 'p_pencucian','id_p_packing','p_packing','id_p_operator', 'p_operator','id_p_check', 'p_check','id_p_cssd_penerimaan', 'p_cssd_penerimaan' , 'p_unit_penerimaan','catatanCssd','catatanUnit', 'status_pengembalian','qrCode'));
    }

    public function editDataPengambilanSteril(Request $request)
    {
        $dataPengambilanSteril = $request->dataPengambilanSteril;
        
    //    dd($dataPengambilanSteril);
        $kodeSteril = $request->dataPengambilanSteril['kodeSteril'];
       
        $petugasUnitPengambilan = $request->dataPengambilanSteril['petugasUnitPengambilan'];
        $petugasCssdPengambilan = $request->dataPengambilanSteril['petugasCssdPengambilan'];
        $tanggalPengambilan = $request->dataPengambilanSteril['tanggalPengambilanAlat'];
        $jamPengambilan = $request->dataPengambilanSteril['jamPengambilanAlat'];
        $ttdUnitPengambilan = $request->dataPengambilanSteril['ttdUnitPengambilan'];
       
       
        
        $arrayDataPengambilanSteril = array(
            
                
                "p_cssd_pengembalian" => $petugasCssdPengambilan,
                "p_unit_pengembalian" => $petugasUnitPengambilan,
                "tgl_pengembalian_alat" => $tanggalPengambilan,
                "jam_pengambilan" => $jamPengambilan,
                "ttd_unit_pengambilan" => $ttdUnitPengambilan,
                "status_pengambilan" => 'Sudah diambil'
        );
        
        $updateDataPengambilanSteril = $this->sterilDb->editSteril('steril', $arrayDataPengambilanSteril, $kodeSteril);
        if (!$updateDataPengambilanSteril) {
            return $this->resultWithData("Gagal Update Data Steril", false, 200);
        } else {
            return $this->resultWithData($updateDataPengambilanSteril, true, 200);
        }
    }

    public function hapusDataSteril(Request $request)
    {
        $hapusDataSteril = $this->sterilDb->hapusDataSteril($request->kodeSteril);
        if (!$hapusDataSteril) {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::failed, "Hapus Data Gagal");
            return $this->resultWithData("Gagal Hapus Data", false, 200);
        } else {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::success, "Hapus Data Berhasil");
            return $this->resultWithData("Sukses Hapus Data", true, 200);
        }
    }

    public function hapusDataAlatSteril(Request $request)
    {
        $hapusDataAlatSteril = $this->sterilDb->hapusDataAlatSteril($request->idSteril);
        if (!$hapusDataAlatSteril) {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::failed, "Hapus Data Gagal");
            return $this->resultWithData("Gagal Hapus Data", false, 200);
        } else {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::success, "Hapus Data Berhasil");
            return $this->resultWithData("Sukses Hapus Data", true, 200);
        }
    }
    public function cetakFormSteril(Request $request)
    {
        $htmlAlat = '';
        $headerAlat = "<tr><td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">&nbsp;&nbsp;&nbsp;No.</label></td><td style=\"text-align:center;padding:5px;width:35%;\"><label style=\"padding-bottom:3px;\">Nama Barang</label></td><td style=\"text-align:center;padding:5px;width:10%;\"><label style=\"padding-bottom:3px;\">Jenis Alat</label></td><td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">Jumlah</label></td><td style=\"text-align:left;padding:5px;width:10%;\"><label style=\"padding-bottom:3px;\">Satuan</label></td></tr>";
        $htmlAlat .= $headerAlat;
        $getAlat = $this->sterilDb->getAlatByKode($request->kodeSteril);
        $no =1;
        foreach ($getAlat as $valueAlat){
            $nomorUrut = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">&nbsp;&nbsp;&nbsp;" . $no . "</label></td>";
            $namaAlat = "<td style=\"text-align:center;padding:5px;width:15%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->nama_alat . "</label></td>";
            $jenisAlat = "<td style=\"text-align:center;padding:5px;width:15%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->jns_alat . "</label></td>";
            $jumlahAlat = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->jml_alat . "</label></td>";
            $satuanAlat = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->satuan_alat . "</label></td>";
            // $keteranganAlat = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">-</label></td>";
            $no++;
            $barisAlat = "<tr>" . $nomorUrut . $namaAlat . $jenisAlat . $jumlahAlat .$satuanAlat."</tr>";
            $htmlAlat .= $barisAlat;
        }
        $getData = $this->sterilDb->cekKodeSteril($request->kodeSteril);
        // dd($getData);
        // $qrCode = QrCode::size(50)->generate($noPasien);
        // $qrCode64 = base64_encode($qrCode);
        $ttdcanvas = "data:image/png;base64, " . $getData[0]->ttd_unit_pengambilan;
        $parafPtgPencucian = "data:image/png;base64, " . $getData[0]->paraf_p_pencucian;
        $parafPtgPacking = "data:image/png;base64, " . $getData[0]->paraf_p_packing;
        $parafPtgoperator = "data:image/png;base64, " . $getData[0]->paraf_p_operator;
        $parafPtgCheck = "data:image/png;base64, " . $getData[0]->paraf_p_check;
        $parafPtgPenerimaan = "data:image/png;base64, " . $getData[0]->paraf_p_cssd_penerimaan;
        $parafPtgPengembalian = "data:image/png;base64, " . $getData[0]->paraf_p_cssd_pengembalian;
        $parafUnitPengirim = "data:image/png;base64, " . $getData[0]->ttd_unit_pengirim;
        $ttdGambar = "<img  src=\"" . $ttdcanvas . "\">";
        $logo = $this->base64LogoJateng();
        $arrayData = array(
            "logo" => $logo,
            "alat" => $htmlAlat,
            "namaRuang" => $getData[0]->nama_ruang,
            "tgl_penyerahan_alat" =>$getData[0]->tgl_penyerahan_alat,
            "tgl_pengembalian_alat" =>$getData[0]->tgl_pengembalian_alat,
            "jam_pengambilan" =>$getData[0]->jam_pengambilan,
            "tgl_steril" =>$getData[0]->tgl_steril,
            "jam_steril" =>$getData[0]->jam_steril,
            "tgl_kadaluarsa" =>$getData[0]->tgl_kadaluarsa,
            "p_pencucian" =>$getData[0]->p_pencucian,
            "p_packing" =>$getData[0]->p_packing,
            "p_operator" =>$getData[0]->p_operator,
            "p_check" =>$getData[0]->p_check,
            "paraf_p_pencucian" =>$parafPtgPencucian,
            "paraf_p_packing" =>$parafPtgPacking,
            "paraf_p_operator" =>$parafPtgoperator,
            "paraf_p_check" =>$parafPtgCheck,
            "p_cssd_penerimaan" =>$getData[0]->p_cssd_penerimaan,
            "paraf_p_cssd_penerimaan" =>$parafPtgPenerimaan,
            "p_unit_penerimaan" =>$getData[0]->p_unit_penerimaan,
            "p_cssd_pengembalian" =>$getData[0]->p_cssd_pengembalian,
            "paraf_p_cssd_pengembalian" =>$parafPtgPengembalian,
            "p_unit_pengembalian" =>$getData[0]->p_unit_pengembalian,
            "keterangan" =>$getData[0]->keterangan,
            "ttd_unit_pengambilan" => $ttdcanvas,
            "ttd_unit_penerimaan" => $parafUnitPengirim

        );
        // print_r($arrayData);
        // die;
        $pdf = DomPDF::loadView('steril.cetak-form-steril', $arrayData);
        $pdf->setPaper('A5', 'potrait');
        $content = $pdf->download()->getOriginalContent();

        $base64 = base64_encode($content);
        return $this->resultWithData($base64, true, 200);
    }

}
