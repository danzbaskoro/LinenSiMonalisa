<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GrafikDB extends Model
{
    // use HasFactory;
    public function getRuangan()
    {
        $q = sprintf("SELECT * FROM tb_ruang ");
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

    public function getAlat()
    {
        $q = sprintf("SELECT * FROM alat ORDER BY id_alat ASC ");
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

    public function getGrafikHarian($tanggal)
    {
        $q = sprintf("SELECT r.nama_ruang AS namaruang, SUM(s.jml_alat) AS jml
                    FROM steril s
                    LEFT JOIN alat a ON s.id_alat = a.id_alat
                    LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                    WHERE tgl_steril = '%s'
                    GROUP BY  r.nama_ruang", $tanggal);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
    public function getGrafikBulan($bulan, $tahun)
    {
        $q = sprintf("SELECT r.nama_ruang, SUM(s.jml_alat) AS jml 
                    FROM steril s
                    LEFT JOIN alat a ON s.id_alat = a.id_alat
                    LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                    WHERE MONTH(s.tgl_penyerahan_alat) = '%s' AND YEAR(s.tgl_penyerahan_alat) = '%s'
                    GROUP BY s.tgl_penyerahan_alat, r.nama_ruang", $bulan, $tahun);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
}
