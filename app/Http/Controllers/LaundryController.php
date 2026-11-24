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

        return view('laundry.data-laundry', compact('tahunList'));
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
        $lastKode = (int) substr($checkKode, 6);
        // $lastKode = (int) substr($checkKode[0]->kode_linen, 5);
        
        if ($checkKode != null) {
            $nokodeLinen = $lastKode + 1;
            $kodeLinen = sprintf("LINEN-%04d", $nokodeLinen);

        }else{
            $kodeLinen = sprintf("LINEN-%04d", 1);
        }
    //    dd($kodeLinen);
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

            $arrayDataAjuanL = $this->laundryDb->insert('transaksi_linen', $arrayDataAjuanLinen);
        }
        // dd($arrayDataPengambilanSteril);
        
        if (!$arrayDataAjuanL) {
            return $this->resultWithData("Gagal Update Data Linen", false, 200);
        } else {
            return $this->resultWithData($arrayDataAjuanLinen, true, 200);
        }
    }

    public function getDataLinen(Request $request)
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
        $kolom = 'kode_linen';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->laundryDb->getDataLinenAdm(
                        $filters,
                        $tahun,
                        // $status,
                        $start,
                        $length,
                        $kolom,
                        $order
                    );
        $total = $this->laundryDb->getTotalDataLinenAdm(
            $filters,
            $tahun
            // $status
        );

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->kode_linen . "|" . $item->tgl_penyerahan_linen;
                if ($item->status_pengambilan == 'Sudah diambil' && isset($item->tgl_pengembalian_linen) && $item->tgl_pengembalian_linen!='0000-00-00') {
                    $pdfFormulir='
                     <button type="button" class="btn btn-sm btn-flex btn-primary ms-3 text-center" id="' . $item->kode_linen . '" name="' . $item->kode_linen . '" onclick=CetakDataLaundry(this.id)><i class="ki-outline ki-file fs-3 ms-1"></i></button>';
                 }
                 else
                 {
                    $pdfFormulir='
                     <button type="button" class="btn btn-sm btn-flex btn-default ms-3 text-center" id="' . $item->kode_linen . '" name="' . $item->kode_linen . '" ><i class="ki-outline ki-file fs-3 ms-1"></i></button>';
                 }
                 if($item->p_pencucian!=null){
                    $editButton ='<button type="button" class="btn btn-sm btn-flex btn-warning ms-3 text-center" id="' . $item->kode_linen . '" name="' . $data_name . '" onclick=EditDataPengambilan(this.id,this.name)><i class="ki-outline ki-scan-barcode fs-3 ms-1"></i></button>';
                 }
                 else
                 {
                    $editButton='';
                 }
                $aksi = '<div class="w-100 text-center">' . $editButton . '<button type="button" class="btn btn-sm btn-flex btn-success ms-3 text-center" id="' . $item->kode_linen . '" name="' . $data_name . '" onclick=EditDataLaundry(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->kode_linen . '" name="' . $item->kode_linen . '" onclick=HapusDataLaundry(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></button>' . $pdfFormulir . '</div>';
                
                
                // $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-success ms-3 text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=EditDataSteril(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-warning text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=DetailDataSteril(this.id,this.name)><i class="ki-outline ki-eye fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->kode_steril . '" name="' . $item->kode_steril . '" onclick=HapusDataSteril(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></div>';

                // $barcode='<div class="w-100 text-center">
                // <button type="button" class="btn btn-sm btn-flex btn-success text-center" id="' . $item->kode_steril . '" name="' . $data_name . '" onclick=EditDataSteril(this.id,this.name)><i class="ki-outline ki-scan-barcode fs-3 ms-1"></i></button></div>';

                if (!empty($item->created_at)) {
                    $item->created_at = date('d-m-Y H:i:s', strtotime($item->created_at));
                }

                if (!empty($item->updated_at)) {
                    $item->updated_at = date('d-m-Y H:i:s', strtotime($item->updated_at));
                }

                $a = array($i, $item->kode_linen, $item->nama_ruang, $item->tgl_penyerahan_linen,$item->status_pengambilan, $aksi);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }

}
