<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Exception;

class HomepageDB extends Model
{
    // use HasFactory;
    public function getDataSteril($filters, int $start, int $length, string $sortField, string $sortOrder)
    {
        $q = sprintf("SELECT s.kode_steril, s.id_steril, r.nama_ruang, s.tgl_penyerahan_alat, s.tgl_kadaluarsa, s.status_pengambilan FROM steril s
                        LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang ");

        if (!empty($filters)) {
            $q .= sprintf(" where (r.nama_ruang like '%%%s%%' )", $filters);
        }

        $q .= sprintf(" group by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getTotalDataSteril($filters)
    {
        $q = sprintf("select COUNT(DISTINCT s.kode_steril) AS jumlah from steril s LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang ");

        if (!empty($filters)) {
            $q .= sprintf(" where (r.nama_ruang like '%%%s%%' )", $filters);
        }

        $result = DB::connection('mysqlserver79')->select($q)[0]->jumlah;
        return $result;
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
    public function cekKodeSteril($kodeSteril)
    {
        $q = sprintf("SELECT s.id_steril,r.id_ruang,r.nama_ruang, s.tgl_penyerahan_alat,s.tgl_pengembalian_alat, s.jam_pengambilan , s.jam_steril,
                        s.tgl_steril, s.tgl_kadaluarsa, s.keterangan, s.keterangan_user,
								u.kode_nama AS p_pencucian, u.id AS id_p_pencucian,u.paraf_user AS paraf_p_pencucian,
                        us.kode_nama AS p_packing, us.id AS id_p_packing,us.paraf_user AS paraf_p_packing,
                        uo.kode_nama AS p_operator, uo.id AS id_p_operator,uo.paraf_user AS paraf_p_operator,
                        uc.kode_nama AS p_check,uc.id AS id_p_check,uc.paraf_user AS paraf_p_check,
                        uct.name AS p_cssd_penerimaan,uct.id AS id_p_cssd_penerimaan, uct.paraf_user AS paraf_p_cssd_penerimaan,
                        uca.name AS p_cssd_pengembalian,uca.id AS id_p_cssd_pengembalian, uca.paraf_user AS paraf_p_cssd_pengembalian,
                        s.p_unit_penerimaan, s.p_unit_pengembalian, s.status_pengambilan, s.ttd_unit_pengambilan, s.ttd_unit_pengirim
                        from steril s 
                        INNER JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                        INNER JOIN users u ON s.p_pencucian = u.id
                        INNER JOIN users us ON s.p_packing = us.id
                        INNER JOIN users uo ON s.p_operator = uo.id
                        INNER JOIN users uc ON s.p_check_akhir = uc.id
                        INNER JOIN users uct ON s.p_cssd_penerimaan = uct.id
                        INNER JOIN users uca ON s.p_cssd_pengembalian = uca.id WHERE s.kode_steril  = '%s'
        GROUP BY s.kode_steril", $kodeSteril);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getAlatByKode($kodeSteril)
    {
        $q = sprintf("SELECT * FROM steril s
                        LEFT JOIN alat a ON s.id_alat = a.id_alat
                        WHERE s.kode_steril = '%s'
        ORDER BY kode_steril DESC  ", $kodeSteril);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getIdSteril($kodeSteril)
    {
        $q = sprintf("SELECT s.id_steril,r.id_ruang,r.nama_ruang, s.tgl_penyerahan_alat,s.tgl_pengembalian_alat, 
                        s.tgl_steril, s.tgl_kadaluarsa, s.p_pencucian  AS id_p_pencucian,
                        s.p_packing AS id_p_packing,
                        s.p_operator AS id_p_operator, 
                        s.p_check_akhir AS id_p_check,
                        s.p_cssd_penerimaan AS id_p_cssd_penerimaan,
                        s.p_unit_penerimaan,s.p_cssd_pengembalian AS id_p_cssd_pengembalian,
						s.p_unit_pengembalian, s.status_pengambilan, s.ttd_unit_pengambilan
                        from steril s 
                        INNER JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                        WHERE s.kode_steril  = '%s'
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
    public function cekKodeCssd($tahun)
    {
        $q = sprintf("SELECT * FROM steril WHERE YEAR(tgl_penyerahan_alat) = '%s'
        ORDER BY kode_steril DESC LIMIT 1 ", $tahun);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    
}
