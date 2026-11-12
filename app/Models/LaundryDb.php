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
        $q = sprintf("SELECT a.id, a.nama_linen
                            FROM master_linen a "
                    );

        if (!empty($filters)) {
            $q .= sprintf(" where (a.nama_linen like '%%%s%%' )", $filters);
        }

        $q .= sprintf(" where a.is_active = 1 order by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
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
}
