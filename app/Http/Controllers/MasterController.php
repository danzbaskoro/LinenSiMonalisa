<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AlatDb;
use App\Traits\JsonResult;
use Illuminate\Support\Facades\Session;
use App\Enums\ConstSessions;
use App\Enums\ConstLogAuditrail;
use App\Traits\LogAuditrail;
use App\Enums\ConstActivityStatus;
use Illuminate\Support\Facades\Hash;


class MasterController extends Controller
{
    use JsonResult;
    private $alatDB;

    public function __construct()
    {
        $this->alatDB = new AlatDb();
    }
    public function viewDataAlat()
    {
        return view('master-data.alat');
    }
    public function getDataAlat(Request $request)
    {
        $result = array();
        $ls = array();
        $draw = $request->draw;
        $filters = $request->search['value'];
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $kolom = 'created_at';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->alatDB->getDataAlat($filters, $start, $length, $kolom, $order);
        $total = $this->alatDB->getTotalDataAlat($filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->nama_alat . "|" . $item->satuan_alat;
                $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-warning text-center" id="' . $item->id_alat . '" name="' . $data_name . '" onclick=EditDataAlat(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->id_alat . '" name="' . $item->id_alat . '" onclick=HapusDataAlat(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></div>';

                if (!empty($item->created_at)) {
                    $item->created_at = date('d-m-Y H:i:s', strtotime($item->created_at));
                }

                if (!empty($item->updated_at)) {
                    $item->updated_at = date('d-m-Y H:i:s', strtotime($item->updated_at));
                }

                $a = array($i, $item->nama_alat, $item->satuan_alat, $aksi);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }
    public function addDataAlat(Request $request)
    {
        $dataAlat = $request->dataAlat;
        $namaAlat = $request->dataAlat['namaAlat'];
        $satuanAlat = $request->dataAlat['satuanAlat'];

        $arrayDataAlat = array(
            "nama_alat" => $namaAlat,
            "satuan_alat" => $satuanAlat
        );
        
        $insertDataAlat = $this->alatDB->insert('alat', $arrayDataAlat);
        if (!$insertDataAlat) {
            return $this->resultWithData("Gagal Simpan Data Alat", false, 200);
        } else {
            return $this->resultWithData($insertDataAlat, true, 200);
        }
    }

    public function editDataAlat(Request $request)
    {
        $dataAlat = $request->dataAlat;
        $idAlat = $request->dataAlat['idAlat'];
        $namaAlat = $request->dataAlat['namaAlat'];
        $satuanAlat = $request->dataAlat['satuanAlat'];

        $arrayDataAlat = array(
            "nama_alat" => $namaAlat,
            "satuan_alat" => $satuanAlat
        );
        
        $updateDataAlat = $this->alatDB->edit('alat', $arrayDataAlat, $idAlat);
        if (!$updateDataAlat) {
            return $this->resultWithData("Gagal Update Data Alat", false, 200);
        } else {
            return $this->resultWithData($updateDataAlat, true, 200);
        }
    }

    public function hapusDataAlat(Request $request)
    {
        $hapusDataAlat = $this->alatDB->hapusDataAlat($request->idAlat);
        if (!$hapusDataAlat) {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::failed, "Hapus Data Gagal");
            return $this->resultWithData("Gagal Hapus Data", false, 200);
        } else {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::success, "Hapus Data Berhasil");
            return $this->resultWithData("Sukses Hapus Data", true, 200);
        }
    }

    //data ruang
    public function viewDataRuang()
    {
        return view('master-data.ruangan');
    }
    public function getDataRuang(Request $request)
    {
        $result = array();
        $ls = array();
        $draw = $request->draw;
        $filters = $request->search['value'];
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $kolom = 'created_at';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->alatDB->getDataRuang($filters, $start, $length, $kolom, $order);
        $total = $this->alatDB->getTotalDataRuang($filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->nama_ruang;
                $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-warning text-center" id="' . $item->id_ruang . '" name="' . $data_name . '" onclick=EditDataRuang(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->id_ruang . '" name="' . $item->id_ruang . '" onclick=HapusDataRuang(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></div>';

                if (!empty($item->created_at)) {
                    $item->created_at = date('d-m-Y H:i:s', strtotime($item->created_at));
                }

                if (!empty($item->updated_at)) {
                    $item->updated_at = date('d-m-Y H:i:s', strtotime($item->updated_at));
                }

                $a = array($i, $item->nama_ruang, $aksi);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }
    public function addDataRuang(Request $request)
    {
        $dataRuang = $request->dataRuang;
        $namaRuang = $request->dataRuang['namaRuang'];

        $arrayDataRuang = array(
            "nama_ruang" => $namaRuang
        );
        
        $insertDataRuang = $this->alatDB->insert('tb_ruang', $arrayDataRuang);
        if (!$insertDataRuang) {
            return $this->resultWithData("Gagal Simpan Data Alat", false, 200);
        } else {
            return $this->resultWithData($insertDataRuang, true, 200);
        }
    }

    public function editDataRuang(Request $request)
    {
        $dataRuang = $request->dataRuang;
        $idRuang = $request->dataRuang['idRuang'];
        $namaRuang = $request->dataRuang['namaRuang'];

        $arrayDataRuang = array(
            "nama_ruang" => $namaRuang
        );
        
        $updateDataRuang = $this->alatDB->editRuang('tb_ruang', $arrayDataRuang, $idRuang);
        if (!$updateDataRuang) {
            return $this->resultWithData("Gagal Update Data Ruang", false, 200);
        } else {
            return $this->resultWithData($updateDataRuang, true, 200);
        }
    }

    public function hapusDataRuang(Request $request)
    {
        $hapusDataRuang = $this->alatDB->hapusDataRuang($request->idRuang);
        if (!$hapusDataRuang) {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::failed, "Hapus Data Gagal");
            return $this->resultWithData("Gagal Hapus Data", false, 200);
        } else {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::success, "Hapus Data Berhasil");
            return $this->resultWithData("Sukses Hapus Data", true, 200);
        }
    }

    //user
    public function viewDataUser()
    {
        return view('master-data.user');
    }
    public function getDataUser(Request $request)
    {
        $result = array();
        $ls = array();
        $draw = $request->draw;
        $filters = $request->search['value'];
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $kolom = 'created_at';
        $order = 'desc';
        if ($request->order ?? false) {
            $kolom = $request->order[0]['column'];
            $order = $request->order[0]['dir'];
        }

        $result = $this->alatDB->getDataUser($filters, $start, $length, $kolom, $order);
        $total = $this->alatDB->getTotalDataUser($filters);

        if ($total > 0) {
            $a = array();
            $i = $request->start + 1;
            foreach ($result as $item) {
                $data_name = $item->name . "|" . $item->username . "|" . $item->kode_nama. "|" . $item->paraf_user;
                $aksi = '<div class="w-100 text-center"><button type="button" class="btn btn-sm btn-flex btn-success text-center" id="' . $item->id . '" name="' . $item->id . '" onclick=ResetPasswordUser(this.id)><i class="ki-outline ki-security-user  fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-warning ms-3 text-center" id="' . $item->id . '" name="' . $data_name . '" onclick=EditDataUser(this.id,this.name)><i class="ki-outline ki-notepad-edit fs-3 ms-1"></i></button><button type="button" class="btn btn-sm btn-flex btn-danger ms-3 text-center" id="' . $item->id . '" name="' . $item->id . '" onclick=HapusDataUser(this.id)><i class="ki-outline ki-cross-square fs-3 ms-1"></i></button></div>';

                if (!empty($item->created_at)) {
                    $item->created_at = date('d-m-Y H:i:s', strtotime($item->created_at));
                }

                if (!empty($item->updated_at)) {
                    $item->updated_at = date('d-m-Y H:i:s', strtotime($item->updated_at));
                }

                $a = array($i, $item->name, $item->username, $item->kode_nama, $aksi);
                array_push($ls, $a);
                $i++;
            }
        }

        $result = array('draw' => $draw, 'recordsTotal' => $total, 'recordsFiltered' => $total, 'data' => $ls);
        return response()->json($result);
    }

    public function addDataUser(Request $request)
    {
        $dataUser = $request->dataUser;
        $namaUser = $request->dataUser['namaUser'];
        $username = $request->dataUser['userName'];
        $password = $request->dataUser['passwordUser'];
        $kodeNama = $request->dataUser['kodeUser'];
        $parafUser = $request->dataUser['parafUser'];

        $arrayData = array(
            "name" => $namaUser,
            "username" => $username,
            "password" => Hash::make($password),
            "kode_nama" => $kodeNama,
            "paraf_user" => $parafUser

        );
        
        $insertDataUser = $this->alatDB->insert('users', $arrayData);
        if (!$insertDataUser) {
            return $this->resultWithData("Gagal Simpan Data", false, 200);
        } else {
            return $this->resultWithData($insertDataUser, true, 200);
        }
    }

    public function editDataUser(Request $request)
    {
        $dataUser = $request->dataUser;
        $idUser = $request->dataUser['idUser'];
        $namaUser = $request->dataUser['namaUser'];
        $username = $request->dataUser['userName'];
        $kodeNama = $request->dataUser['kodeUser'];

        $arrayData = array(
            "name" => $namaUser,
            "username" => $username,
            "kode_nama" => $kodeNama

        );
        
        $updateDataUser = $this->alatDB->editUser('users', $arrayData, $idUser);
        if (!$updateDataUser) {
            return $this->resultWithData("Gagal Update Data User", false, 200);
        } else {
            return $this->resultWithData($updateDataUser, true, 200);
        }
    }

    public function hapusDataUser(Request $request)
    {
        $hapusDataUser = $this->alatDB->hapusDataUser($request->idUser);
        if (!$hapusDataUser) {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::failed, "Hapus Data Gagal");
            return $this->resultWithData("Gagal Hapus Data", false, 200);
        } else {
        //     $this->addLogAuditrail(Session::get(ConstSessions::username), ConstLogAuditrail::deleteData, ConstActivityStatus::success, "Hapus Data Berhasil");
            return $this->resultWithData("Sukses Hapus Data", true, 200);
        }
    }

    public function resetPassUser(Request $request)
    {
        $dataUser = $request->dataUser;
        $idUser = $request->dataUser['idUser'];
        $password = '123456';

        $arrayData = array(
            "password" => Hash::make($password)

        );
        
        $updatePassUser = $this->alatDB->editUser('users', $arrayData, $idUser);
        if (!$updatePassUser) {
            return $this->resultWithData("Gagal Update Password User", false, 200);
        } else {
            return $this->resultWithData($updatePassUser, true, 200);
        }
    }
}
