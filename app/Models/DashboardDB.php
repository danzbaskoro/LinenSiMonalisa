<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DashboardDB extends Model
{
    public function countAlat()
    {
        $q = sprintf("SELECT COUNT(id_alat) AS JMLALAT FROM alat ");
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

    public function countSteril()
    {
        $q = sprintf("SELECT COUNT(id_steril) AS JMLSTERIL FROM steril ");
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

    public function countKadaluarsa($tglSekarang)
    {
        $q = sprintf("SELECT COUNT(id_steril) AS JMLSTERILKADALUARSA FROM steril
                        WHERE tgl_kadaluarsa < '%s' AND status_pengambilan = 'Belum diambil'", $tglSekarang);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

    // public function getAlatKadaluarsa($tglSekarang)
    // {
    //     $q = sprintf("SELECT * FROM steril s
    //                     LEFT JOIN alat a ON s.id_alat = a.id_alat
    //                     WHERE s.tgl_kadaluarsa < '%s'
    //                     GROUP BY s.kode_steril ", $tglSekarang);
    //     $result = DB::connection('mysqlserver79')->select($q);
    //     return $result;
    // }
    public function getAlatKadaluarsa($tglSekarang,$filters, int $start, int $length, string $sortField, string $sortOrder)
    {
        $q = sprintf("SELECT * FROM steril s
                         LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang");

        // if (!empty($filters)) {
        //     $q .= sprintf(" where s.tgl_kadaluarsa < '%s' OR (r.nama_ruang like '%%%s%%' ) ", $tglSekarang,$filters);
        // }
        $q .= sprintf(" where s.tgl_kadaluarsa < '%s' AND s.status_pengambilan = 'Belum diambil'",  $tglSekarang);

        if (!empty($filters)) {
            $q .= sprintf(" and (r.nama_ruang like '%%%s%%' ) ",$filters);
        }

        // $q .= sprintf(" AND s.tgl_kadaluarsa < '%s'",  $tglSekarang);

        $q .= sprintf(" group by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
        // print_r($q);
        // die();
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getTotalAlatKadaluarsa($tglSekarang,$filters)
    {
        $q = sprintf("select COUNT(DISTINCT s.kode_steril) AS jumlah 
        from steril s LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang ");

        // if (!empty($filters)) {
        //     $q .= sprintf(" where (r.nama_ruang like '%%%s%%' ) ", $filters);
        // }
        $q .= sprintf(" where s.tgl_kadaluarsa < '%s' AND s.status_pengambilan = 'Belum diambil'",  $tglSekarang);

        if (!empty($filters)) {
            $q .= sprintf(" and (r.nama_ruang like '%%%s%%' ) ",$filters);
        }
        // $q .= sprintf(" AND s.tgl_kadaluarsa < '%s' AND s.status_pengambilan = 'Belum diambil'",  $tglSekarang);
        $result = DB::connection('mysqlserver79')->select($q)[0]->jumlah;
        return $result;
    }
    public function getSterilKadaluarsa($kodeSteril)
    {
        $q = sprintf("SELECT s.id_steril,r.id_ruang,r.nama_ruang, s.tgl_penyerahan_alat,s.tgl_pengembalian_alat, 
                        s.tgl_steril, s.tgl_kadaluarsa, 
								u.kode_nama AS p_pencucian, u.id AS id_p_pencucian,u.paraf_user AS paraf_p_pencucian,
                        us.kode_nama AS p_packing, us.id AS id_p_packing,us.paraf_user AS paraf_p_packing,
                        uo.kode_nama AS p_operator, uo.id AS id_p_operator,uo.paraf_user AS paraf_p_operator,
                        uc.kode_nama AS p_check,uc.id AS id_p_check,uc.paraf_user AS paraf_p_check,
                        uct.name AS p_cssd_penerimaan,uct.id AS id_p_cssd_penerimaan, uct.paraf_user AS paraf_p_cssd_penerimaan,
                        s.p_unit_penerimaan, s.p_unit_pengembalian, s.status_pengambilan, s.ttd_unit_pengambilan, s.p_cssd_pengembalian
                        from steril s 
                        INNER JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                        INNER JOIN users u ON s.p_pencucian = u.id
                        INNER JOIN users us ON s.p_packing = us.id
                        INNER JOIN users uo ON s.p_operator = uo.id
                        INNER JOIN users uc ON s.p_check_akhir = uc.id
                        INNER JOIN users uct ON s.p_cssd_penerimaan = uct.id WHERE s.kode_steril  = '%s'
        GROUP BY s.kode_steril", $kodeSteril);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getDataAlatSteril($kodeSteril,$filters, int $start, int $length, string $sortField, string $sortOrder)
    {
        $q = sprintf("SELECT s.id_steril,a.id_alat, a.nama_alat, a.satuan_alat, s.jns_alat, s.jml_alat 
                        FROM steril s
                        INNER JOIN alat a ON s.id_alat = a.id_alat
                        WHERE s.kode_steril = '%s' 
                       ", $kodeSteril);

        if (!empty($filters)) {
            $q .= sprintf(" AND (a.nama_alat like '%%%s%%' )",$filters);
        }

        $q .= sprintf(" group by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getTotalDataAlatSteril($kodeSteril,$filters)
    {
        $q = sprintf("SELECT COUNT(s.id_steril) AS jumlah
                        FROM steril s
                        INNER JOIN alat a ON s.id_alat = a.id_alat 
                        where s.kode_steril = '%s' ", $kodeSteril);

        if (!empty($filters)) {
            $q .= sprintf("AND (a.nama_alat like '%%%s%%' )",$filters);
        }

        $result = DB::connection('mysqlserver79')->select($q)[0]->jumlah;
        return $result;
    }
     //EDIT DATA
     public function editSterilAlatKadaluarsa($namaTabel, $data, $kodeSteril)
     {
         try {
             $result = DB::connection('mysqlserver79')->table($namaTabel)
                 ->where('kode_steril', $kodeSteril)
                 ->update($data);
             return $result;
         } catch (Exception $e) {
             // print_r($e->getMessage());
             return false;
         }
     }
}
