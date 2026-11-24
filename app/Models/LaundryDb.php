<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Exception;

class LaundryDb extends Model
{
    public function getLinen($key)
    {
        $q = "SELECT * FROM master_linen WHERE nama_linen LIKE '%" . $key . "%'";
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

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

    public function cekKodeLaundry($tahun)
    {
        $q = sprintf("SELECT * FROM transaksi_linen WHERE YEAR(tgl_penyerahan_linen) = '%s'
        ORDER BY kode_linen DESC LIMIT 1 ", $tahun);
        $result = DB::connection('mysqlserver79')->select($q);

        if (empty($result)) {
            $kode = null;
        } else {
            $kode = $result[0]->kode_linen;
        }

        return $kode;
    }

    public function getDataLinen($filters, int $start, int $length, string $sortField, string $sortOrder)
    {
        $q = sprintf("SELECT a.id, a.nama_linen, a.is_active
                            FROM master_linen a "
                    );

        if (!empty($filters)) {
            $q .= sprintf(" where (a.nama_linen like '%%%s%%' )", $filters);
        }

        $q .= sprintf("order by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getTotalDataLinen($filters)
    {
        $q = sprintf("select COUNT(a.id) AS jumlah from master_linen a ");

        if (!empty($filters)) {
            $q .= sprintf(" where (a.nama_linen like '%%%s%%' )", $filters);
        }

        $result = DB::connection('mysqlserver79')->select($q)[0]->jumlah;
        return $result;
    }

    public function edit($namaTabel, $data, $id)
    {
        try {
            $result = DB::connection('mysqlserver79')->table($namaTabel)
                ->where('id', $id)
                ->update($data);
            return $result;
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return false;
        }
    }

    public function getListTahun()
    {
        $tahun = DB::connection('mysqlserver79')->select("
            SELECT DISTINCT YEAR(tgl_penyerahan_linen) AS tahun
            FROM transaksi_linen
            ORDER BY tahun DESC
        ");

        $list = collect($tahun)->pluck('tahun')->toArray();

        if (!in_array(date('Y'), $list)) {
            array_unshift($list, date('Y'));
        }

        rsort($list);

        return collect($list)->map(function ($item) {
            return (object)['tahun' => $item];
        });
    }

    public function getDataLinenAdm($search, $tahun, $start, $length, $sortField, $sortOrder)
    {
        $q = "
            WITH DataLinenAdm AS
            (
                SELECT

                    ROW_NUMBER() OVER
                    (
                        PARTITION BY s.kode_linen
                        ORDER BY s.id ASC
                    ) AS rn,

                    s.id,
                    s.kode_linen,
                    r.nama_ruang,
                    s.tgl_penyerahan_linen,
                    s.status_pengambilan,
                    s.p_pencucian,
                    s.tgl_pengembalian_linen

                FROM transaksi_linen s
                LEFT JOIN tb_ruang r
                    ON s.id_ruangan = r.id_ruang

                WHERE 1=1
        ";
        // if (!empty($filters)) {
        //     $q .= sprintf(" where (r.nama_ruang like '%%%s%%' )", $filters);
        // }
        if (!empty($search)) {

            $q .= " AND (
                    r.nama_ruang LIKE '%$search%'
                    OR s.kode_linen LIKE '%$search%'
                )";
        }
        if (!empty($tahun) && $tahun != 'all') {
            $q .= " AND YEAR(s.tgl_penyerahan_linen) = '$tahun'";
        }

        // if (!empty($status) && $status != 'all') {
        //     if ($status == 'Kadaluarsa') {
        //         $q .= " AND s.tgl_kadaluarsa < GETDATE()";
        //     } else {
        //         $q .= " AND s.status_pengambilan = '$status'";
        //     }
        // }
        // if (!empty($ruang)) {
        //     $q .= " AND s.id_ruang='$ruang'";
        // }
        $q .= "
            )

            SELECT *
            FROM DataLinenAdm
            WHERE rn = 1

            ORDER BY
            $sortField $sortOrder

            OFFSET $start ROWS
            FETCH NEXT $length ROWS ONLY
            ";
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

    public function getTotalDataLinenAdm($search, $tahun)
    {
        $q = "
            SELECT COUNT(DISTINCT s.kode_linen) AS jumlah
            FROM transaksi_linen s
            LEFT JOIN tb_ruang r
                ON s.id_ruangan = r.id_ruang
            WHERE 1=1
        ";

        // Search
        if (!empty($search)) {
            $q .= " AND (
                        r.nama_ruang LIKE '%$search%'
                        OR s.kode_linen LIKE '%$search%'
                    )";
        }

        // Tahun
        if (!empty($tahun) && $tahun != 'all') {
            $q .= " AND YEAR(s.tgl_penyerahan_linen) = '$tahun'";
        }

        return DB::connection('mysqlserver79')->select($q)[0]->jumlah;
    }

}
