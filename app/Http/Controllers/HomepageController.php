<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Helper;
use App\Traits\JsonResult;
use App\Models\HomepageDB;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class HomepageController extends Controller
{
    use Helper;
    use JsonResult;
    private $homepageDB;

    public function __construct()
    {
       
       $this->homepageDB = new HomepageDB();
    }
    public function viewHome(Request $request)
    {
        return view('homepage.daftar-steril');
    }
    public function getDataSteril(Request $request)
    {
        $result = array();
        $ls = array();
        $draw = $request->draw;
        $filters = $request->search['value'];
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $kolom = 'kode_steril';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->homepageDB->getDataSteril($filters, $start, $length, $kolom, $order);
        $total = $this->homepageDB->getTotalDataSteril($filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->kode_steril . "|" . $item->tgl_penyerahan_alat;
                if ($item->status_pengambilan == 'Sudah diambil') {
                    $pdfFormulir='
                     <button type="button" class="btn btn-sm btn-flex btn-primary ms-3 text-center" id="' . $item->kode_steril . '" name="' . $item->kode_steril . '" onclick=CetakDataSteril(this.id)><i class="ki-outline ki-file fs-3 ms-1"></i></button>';
                 }
                 else
                 {
                    $pdfFormulir='
                     <button type="button" class="btn btn-sm btn-flex btn-default ms-3 text-center" id="' . $item->kode_steril . '" name="' . $item->kode_steril . '" ><i class="ki-outline ki-file fs-3 ms-1"></i></button>';
                 }
                 
                $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-success ms-3 text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=DetailDataSteril(this.id,this.name)><i class="ki-outline ki-eye fs-3 ms-1"></i></button>' . $pdfFormulir . '</div>';
                
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
    public function cetakFormSteril(Request $request)
    {
        $htmlAlat = '';
        $headerAlat = "<tr><td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">&nbsp;&nbsp;&nbsp;No.</label></td><td style=\"text-align:center;padding:5px;width:35%;\"><label style=\"padding-bottom:3px;\">Nama Barang</label></td><td style=\"text-align:center;padding:5px;width:10%;\"><label style=\"padding-bottom:3px;\">Jenis Alat</label></td><td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">Jumlah</label></td><td style=\"text-align:left;padding:5px;width:10%;\"><label style=\"padding-bottom:3px;\">Satuan</label></td><td style=\"text-align:right;padding:5px;width:15%;\"><label style=\"padding-bottom:3px;\">Keterangan</label></td></tr>";
        $htmlAlat .= $headerAlat;
        $getAlat = $this->homepageDB->getAlatByKode($request->kodeSteril);
        $no =1;
        foreach ($getAlat as $valueAlat){
            $nomorUrut = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">&nbsp;&nbsp;&nbsp;" . $no . "</label></td>";
            $namaAlat = "<td style=\"text-align:center;padding:5px;width:15%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->nama_alat . "</label></td>";
            $jenisAlat = "<td style=\"text-align:center;padding:5px;width:15%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->jns_alat . "</label></td>";
            $jumlahAlat = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->jml_alat . "</label></td>";
            $satuanAlat = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">" . $valueAlat->satuan_alat . "</label></td>";
            $keteranganAlat = "<td style=\"text-align:center;padding:5px;width:5%;\"><label style=\"padding-bottom:3px;\">-</label></td>";
            $no++;
            $barisAlat = "<tr>" . $nomorUrut . $namaAlat . $jenisAlat . $jumlahAlat .$satuanAlat. $keteranganAlat ."</tr>";
            $htmlAlat .= $barisAlat;
        }
        $getData = $this->homepageDB->cekKodeSteril($request->kodeSteril);
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
    function viewDetailDataSteril(Request $request)
    {
        $kodeSteril = $request->kodeSteril;
        
        $cekkodeSteril = $this->homepageDB->cekKodeSteril($kodeSteril);
        if (empty($cekkodeSteril)) {
            $idSteril = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_steril;
            $namaRuang = $this->homepageDB->getIdSteril($kodeSteril)[0]->nama_ruang;
            $idRuang = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_ruang;
            $tgl_penyerahan_alat = $this->homepageDB->getIdSteril($kodeSteril)[0]->tgl_penyerahan_alat;
            $tgl_pengembalian_alat = $this->homepageDB->getIdSteril($kodeSteril)[0]->tgl_pengembalian_alat;
            $tgl_steril = $this->homepageDB->getIdSteril($kodeSteril)[0]->tgl_steril;
            $tgl_kadaluarsa = $this->homepageDB->getIdSteril($kodeSteril)[0]->tgl_kadaluarsa;
            $id_p_pencucian = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_p_pencucian;
            $p_pencucian = "-";
            $id_p_packing = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_p_packing;
            $p_packing ="-";
            $id_p_operator = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_p_operator;
            $p_operator = "-";
            $id_p_check = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_p_check;
            $p_check = "-";
            $id_p_cssd_penerimaan = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_p_cssd_penerimaan;
            $p_cssd_penerimaan = "-";
            $p_unit_penerimaan = $this->homepageDB->getIdSteril($kodeSteril)[0]->p_unit_penerimaan;
            $id_p_cssd_pengembalian = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_p_cssd_pengembalian;
            $p_cssd_pengembalian = $this->homepageDB->getIdSteril($kodeSteril)[0]->id_p_cssd_pengembalian;
            $p_unit_pengembalian = $this->homepageDB->getIdSteril($kodeSteril)[0]->p_unit_pengembalian;
            $status_pengembalian = $this->homepageDB->getIdSteril($kodeSteril)[0]->status_pengambilan;
            // $ttdcanvas = "data:image/png;base64, " . $getData[0]->ttd_unit_pengambilan;
            $ttd_unit_pengambilan = "data:image/png;base64, " . $this->homepageDB->getIdSteril($kodeSteril)[0]->ttd_unit_pengambilan;
        }else
        {
            $idSteril = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_steril;
            $namaRuang = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->nama_ruang;
            $idRuang = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_ruang;
            $tgl_penyerahan_alat = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->tgl_penyerahan_alat;
            $tgl_pengembalian_alat = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->tgl_pengembalian_alat;
            $tgl_steril = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->tgl_steril;
            $tgl_kadaluarsa = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->tgl_kadaluarsa;
            $id_p_pencucian = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_p_pencucian;
            $p_pencucian = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_pencucian;
            $id_p_packing = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_p_packing;
            $p_packing = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_packing;
            $id_p_operator = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_p_operator;
            $p_operator = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_operator;
            $id_p_check = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_p_check;
            $p_check = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_check;
            $id_p_cssd_penerimaan = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_p_cssd_penerimaan;
            $p_cssd_penerimaan = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_cssd_penerimaan;
            $p_unit_penerimaan = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_unit_penerimaan;
            $id_p_cssd_pengembalian = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->id_p_cssd_pengembalian;
            $p_cssd_pengembalian = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_cssd_pengembalian;
            $p_unit_pengembalian = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->p_unit_pengembalian;
            $status_pengembalian = $this->homepageDB->cekKodeSteril($kodeSteril)[0]->status_pengambilan;
            $ttd_unit_pengambilan = "data:image/png;base64, " . $this->homepageDB->cekKodeSteril($kodeSteril)[0]->ttd_unit_pengambilan;
        }
        
        // $url=route('data-steril');
        // dd($status_pengembalian);
        
        return View('homepage.detail-data-steril', compact('idSteril','kodeSteril','namaRuang','idRuang', 'tgl_penyerahan_alat','tgl_pengembalian_alat', 'tgl_steril', 'tgl_kadaluarsa','id_p_pencucian', 'p_pencucian','id_p_packing','p_packing','id_p_operator', 'p_operator','id_p_check', 'p_check','id_p_cssd_penerimaan', 'p_cssd_penerimaan' , 'p_unit_penerimaan','id_p_cssd_pengembalian', 'p_cssd_pengembalian', 'p_unit_pengembalian', 'status_pengembalian','ttd_unit_pengambilan',));
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

        $result = $this->homepageDB->getDataAlatSteril($kodeSteril,$filters, $start, $length, $kolom, $order);
        $total = $this->homepageDB->getTotalDataAlatSteril($kodeSteril,$filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->id_steril . "|" . $item->id_alat. "|" . $item->nama_alat . "|" . $item->jml_alat . "|" . $item->jns_alat;
                

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

    public function viewAjuanSteril(Request $request)
    {
        return view('homepage.ajuan-steril-homepage');
    }

    public function viewAjuanLaundry(Request $request)
    {
        return view('homepage.ajuan-laundry-homepage');
    }

    public function simpanAjuanSteril(Request $request)
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
    //INSERT DATA
    public function insert($namaTabel, $data)
    {
        try {
            $result = DB::connection('mysqlserver79')->table($namaTabel)
                ->insert($data);
            return $result;
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return false;
        }
    }
}
