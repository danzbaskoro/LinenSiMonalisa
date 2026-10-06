<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlatDb extends Model
{
    // use HasFactory;
    public function getDataAlat($filters, int $start, int $length, string $sortField, string $sortOrder)
    {
        $q = sprintf("SELECT a.id_alat, a.nama_alat, a.satuan_alat
                            FROM alat a "
                    );

        if (!empty($filters)) {
            $q .= sprintf(" where (a.nama_alat like '%%%s%%' )", $filters);
        }

        $q .= sprintf(" order by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getTotalDataAlat($filters)
    {
        $q = sprintf("select COUNT(a.id_alat) AS jumlah from alat a ");

        if (!empty($filters)) {
            $q .= sprintf(" where (a.nama_alat like '%%%s%%' )", $filters);
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

    //EDIT DATA
    public function edit($namaTabel, $data, $id)
    {
        try {
            $result = DB::connection('mysqlserver79')->table($namaTabel)
                ->where('id_alat', $id)
                ->update($data);
            return $result;
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return false;
        }
    }

    public function hapusDataAlat($idAlat)
    {
        
        $deleted = DB::connection('mysqlserver79')->table('alat')->where('id_alat', '=', $idAlat)->delete();
        return $deleted;
    }

    public function getDataRuang($filters, int $start, int $length, string $sortField, string $sortOrder)
    {
        $q = sprintf("SELECT *
                            FROM tb_ruang "
                    );

        if (!empty($filters)) {
            $q .= sprintf(" where (nama_ruang like '%%%s%%' )", $filters);
        }

        $q .= sprintf(" order by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getTotalDataRuang($filters)
    {
        $q = sprintf("select COUNT(id_ruang) AS jumlah from tb_ruang ");

        if (!empty($filters)) {
            $q .= sprintf(" where (nama_ruang like '%%%s%%' )", $filters);
        }

        $result = DB::connection('mysqlserver79')->select($q)[0]->jumlah;
        return $result;
    }

    public function editRuang($namaTabel, $data, $id)
    {
        try {
            $result = DB::connection('mysqlserver79')->table($namaTabel)
                ->where('id_ruang', $id)
                ->update($data);
            return $result;
        } catch (Exception $e) {
            // print_r($e->getMessage());
            return false;
        }
    }

    public function hapusDataRuang($idRuang)
    {
        
        $deleted = DB::connection('mysqlserver79')->table('tb_ruang')->where('id_ruang', '=', $idRuang)->delete();
        return $deleted;
    }

    //user
    public function getDataUser($filters, int $start, int $length, string $sortField, string $sortOrder)
    {
        $q = sprintf("SELECT *
                            FROM users "
                    );

        if (!empty($filters)) {
            $q .= sprintf(" where (name like '%%%s%%' )", $filters);
        }

        $q .= sprintf(" order by %s %s limit %s offset %s", $sortField, $sortOrder, $length, $start);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getTotalDataUser($filters)
    {
        $q = sprintf("select COUNT(id) AS jumlah from users ");

        if (!empty($filters)) {
            $q .= sprintf(" where (name like '%%%s%%' )", $filters);
        }

        $result = DB::connection('mysqlserver79')->select($q)[0]->jumlah;
        return $result;
    }

    public function editUser($namaTabel, $data, $id)
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

    public function hapusDataUser($id)
    {
        
        $deleted = DB::connection('mysqlserver79')->table('users')->where('id', '=', $id)->delete();
        return $deleted;
    }
}
