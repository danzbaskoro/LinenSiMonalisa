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
}
