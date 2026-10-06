<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LaporanDB extends Model
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

    // public function getLaporanBulan($bulan1, $tahun1,$bulan2, $tahun2)
    // {
    //     $q = sprintf("SELECT 
    //                 s.tgl_steril AS 'tgl_steril',s.tgl_penyerahan_alat AS 'tgl_penyerahan',
    //                 r.nama_ruang AS 'nama_ruang',
    //                 SUM(CASE WHEN a.nama_alat = 'Medikasi set' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Besar' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_besar',
    //                 SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Kecil' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_kecil',
    //                 SUM(CASE WHEN a.nama_alat = 'Bengkok' THEN s.jml_alat ELSE 0 END) AS 'bengkok',
    //                 SUM(CASE WHEN a.nama_alat = 'Kom' THEN s.jml_alat ELSE 0 END) AS 'kom',
    //                 SUM(CASE WHEN a.nama_alat = 'Gunting' THEN s.jml_alat ELSE 0 END) AS 'gunting',
    //                 SUM(CASE WHEN a.nama_alat = 'Vooder' THEN s.jml_alat ELSE 0 END) AS 'vooder',
    //                 SUM(CASE WHEN a.nama_alat = 'Klem' THEN s.jml_alat ELSE 0 END) AS 'klem',
    //                 SUM(CASE WHEN a.nama_alat = 'Pinset Anatomis' THEN s.jml_alat ELSE 0 END) AS 'pinset_anatomis',
    //                 SUM(CASE WHEN a.nama_alat = 'Pinset Cirugis' THEN s.jml_alat ELSE 0 END) AS 'pinset_cirugis',
    //                 SUM(CASE WHEN a.nama_alat = 'Pinset THT' THEN s.jml_alat ELSE 0 END) AS 'pinset_tht',
    //                 SUM(CASE WHEN a.nama_alat = 'Tounge Spatel' THEN s.jml_alat ELSE 0 END) AS 'tounge_spatel',
    //                 SUM(CASE WHEN a.nama_alat = 'Kassa' THEN s.jml_alat ELSE 0 END) AS 'kassa',
    //                 SUM(CASE WHEN a.nama_alat = 'Spekullum Recta' THEN s.jml_alat ELSE 0 END) AS 'spekullum_recta',
    //                 SUM(CASE WHEN a.nama_alat = 'Diagnostik Set' THEN s.jml_alat ELSE 0 END) AS 'diagnostik_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Obgyn Set' THEN s.jml_alat ELSE 0 END) AS 'obgyn_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Basic Set OK 1/Hernia/APP' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_hernia',
    //                 SUM(CASE WHEN a.nama_alat = 'Basic Set OK 2/SC set' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_sc',
    //                 SUM(CASE WHEN a.nama_alat = 'Laparatomy Set' THEN s.jml_alat ELSE 0 END) AS 'laparatomy_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Tang Cabut Gigi' THEN s.jml_alat ELSE 0 END) AS 'tang_cabut_gigi',
    //                 SUM(CASE WHEN a.nama_alat = 'Blade Laringoskop' THEN s.jml_alat ELSE 0 END) AS 'blade_laringoskop',
    //                 SUM(CASE WHEN a.nama_alat = 'Ambubag' THEN s.jml_alat ELSE 0 END) AS 'ambubag',
    //                 SUM(CASE WHEN a.nama_alat = 'Masker Sipack' THEN s.jml_alat ELSE 0 END) AS 'masker_sipack',
    //                 SUM(CASE WHEN a.nama_alat = 'selang Ambubag' THEN s.jml_alat ELSE 0 END) AS 'selang_ambubag',
    //                 SUM(CASE WHEN a.nama_alat = 'Selang Suction' THEN s.jml_alat ELSE 0 END) AS 'selang_suction',
    //                 SUM(CASE WHEN a.nama_alat = 'set brathing sirkuit' THEN s.jml_alat ELSE 0 END) AS 'set_brathing_sirkuit',
    //                 SUM(CASE WHEN a.nama_alat = 'Set Ventilator' THEN s.jml_alat ELSE 0 END) AS 'set_ventilator',
    //                 SUM(CASE WHEN a.nama_alat = 'Duk Lubang' THEN s.jml_alat ELSE 0 END) AS 'duk_lubang',
    //                 SUM(CASE WHEN a.nama_alat = 'Root Elevator' THEN s.jml_alat ELSE 0 END) AS 'root_elevator',
    //                 SUM(CASE WHEN a.nama_alat = 'Scapel Handle' THEN s.jml_alat ELSE 0 END) AS 'scapel_handle',
    //                 SUM(CASE WHEN a.nama_alat = 'Kassa Darm Doek' THEN s.jml_alat ELSE 0 END) AS 'kassa_darm_doek',
    //                 SUM(CASE WHEN a.nama_alat = 'Curatage Set' THEN s.jml_alat ELSE 0 END) AS 'curatage_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Breathing Set' THEN s.jml_alat ELSE 0 END) AS 'breathing_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Mandrin' THEN s.jml_alat ELSE 0 END) AS 'mandrin',
    //                 SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Besar' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_besar',
    //                 SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Kecil' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_kecil',
    //                 SUM(CASE WHEN a.nama_alat = 'Heating Set' THEN s.jml_alat ELSE 0 END) AS 'heating_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Cocor bebek ' THEN s.jml_alat ELSE 0 END) AS 'cocor_bebek',
    //                 SUM(CASE WHEN a.nama_alat = 'Gunting THT ' THEN s.jml_alat ELSE 0 END) AS 'gunting_tht',
    //                 SUM(s.jml_alat) AS 'TOTAL'
    //                 FROM steril s
    //                 LEFT JOIN alat a ON s.id_alat = a.id_alat
    //                 LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
    //                 WHERE MONTH(s.tgl_steril) = '%s' AND YEAR(s.tgl_steril) = '%s'
    //                 GROUP BY s.tgl_steril,r.nama_ruang
    //                 UNION ALL
    //                 SELECT 
    //                 s.tgl_steril,s.tgl_penyerahan_alat,
    //                 'TOTAL' AS 'nama_ruang',
    //                 SUM(CASE WHEN a.nama_alat = 'Medikasi set' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Besar' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_besar',
    //                 SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Kecil' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_kecil',
    //                 SUM(CASE WHEN a.nama_alat = 'Bengkok' THEN s.jml_alat ELSE 0 END) AS 'bengkok',
    //                 SUM(CASE WHEN a.nama_alat = 'Kom' THEN s.jml_alat ELSE 0 END) AS 'kom',
    //                 SUM(CASE WHEN a.nama_alat = 'Gunting' THEN s.jml_alat ELSE 0 END) AS 'gunting',
    //                 SUM(CASE WHEN a.nama_alat = 'Vooder' THEN s.jml_alat ELSE 0 END) AS 'vooder',
    //                 SUM(CASE WHEN a.nama_alat = 'Klem' THEN s.jml_alat ELSE 0 END) AS 'klem',
    //                 SUM(CASE WHEN a.nama_alat = 'Pinset Anatomis' THEN s.jml_alat ELSE 0 END) AS 'pinset_anatomis',
    //                 SUM(CASE WHEN a.nama_alat = 'Pinset Cirugis' THEN s.jml_alat ELSE 0 END) AS 'pinset_cirugis',
    //                 SUM(CASE WHEN a.nama_alat = 'Pinset THT' THEN s.jml_alat ELSE 0 END) AS 'pinset_tht',
    //                 SUM(CASE WHEN a.nama_alat = 'Tounge Spatel' THEN s.jml_alat ELSE 0 END) AS 'tounge_spatel',
    //                 SUM(CASE WHEN a.nama_alat = 'Kassa' THEN s.jml_alat ELSE 0 END) AS 'kassa',
    //                 SUM(CASE WHEN a.nama_alat = 'Spekullum Recta' THEN s.jml_alat ELSE 0 END) AS 'spekullum_recta',
    //                 SUM(CASE WHEN a.nama_alat = 'Diagnostik Set' THEN s.jml_alat ELSE 0 END) AS 'diagnostik_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Obgyn Set' THEN s.jml_alat ELSE 0 END) AS 'obgyn_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Basic Set OK 1/Hernia/APP' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_hernia',
    //                 SUM(CASE WHEN a.nama_alat = 'Basic Set OK 2/SC set' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_sc',
    //                 SUM(CASE WHEN a.nama_alat = 'Laparatomy Set' THEN s.jml_alat ELSE 0 END) AS 'laparatomy_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Tang Cabut Gigi' THEN s.jml_alat ELSE 0 END) AS 'tang_cabut_gigi',
    //                 SUM(CASE WHEN a.nama_alat = 'Blade Laringoskop' THEN s.jml_alat ELSE 0 END) AS 'blade_laringoskop',
    //                 SUM(CASE WHEN a.nama_alat = 'Ambubag' THEN s.jml_alat ELSE 0 END) AS 'ambubag',
    //                 SUM(CASE WHEN a.nama_alat = 'Masker Sipack' THEN s.jml_alat ELSE 0 END) AS 'masker_sipack',
    //                 SUM(CASE WHEN a.nama_alat = 'selang Ambubag' THEN s.jml_alat ELSE 0 END) AS 'selang_ambubag',
    //                 SUM(CASE WHEN a.nama_alat = 'Selang Suction' THEN s.jml_alat ELSE 0 END) AS 'selang_suction',
    //                 SUM(CASE WHEN a.nama_alat = 'set brathing sirkuit' THEN s.jml_alat ELSE 0 END) AS 'set_brathing_sirkuit',
    //                 SUM(CASE WHEN a.nama_alat = 'Set Ventilator' THEN s.jml_alat ELSE 0 END) AS 'set_ventilator',
    //                 SUM(CASE WHEN a.nama_alat = 'Duk Lubang' THEN s.jml_alat ELSE 0 END) AS 'duk_lubang',
    //                 SUM(CASE WHEN a.nama_alat = 'Root Elevator' THEN s.jml_alat ELSE 0 END) AS 'root_elevator',
    //                 SUM(CASE WHEN a.nama_alat = 'Scapel Handle' THEN s.jml_alat ELSE 0 END) AS 'scapel_handle',
    //                 SUM(CASE WHEN a.nama_alat = 'Kassa Darm Doek' THEN s.jml_alat ELSE 0 END) AS 'kassa_darm_doek',
    //                 SUM(CASE WHEN a.nama_alat = 'Curatage Set' THEN s.jml_alat ELSE 0 END) AS 'curatage_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Breathing Set' THEN s.jml_alat ELSE 0 END) AS 'breathing_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Mandrin' THEN s.jml_alat ELSE 0 END) AS 'mandrin',
    //                 SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Besar' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_besar',
    //                 SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Kecil' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_kecil',
    //                 SUM(CASE WHEN a.nama_alat = 'Heating Set' THEN s.jml_alat ELSE 0 END) AS 'heating_set',
    //                 SUM(CASE WHEN a.nama_alat = 'Cocor bebek ' THEN s.jml_alat ELSE 0 END) AS 'cocor_bebek',
    //                 SUM(CASE WHEN a.nama_alat = 'Gunting THT ' THEN s.jml_alat ELSE 0 END) AS 'gunting_tht',
    //                 SUM(s.jml_alat) AS total
    //                 FROM steril s
    //                 LEFT JOIN alat a ON s.id_alat = a.id_alat
    //                 LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
    //                 WHERE MONTH(s.tgl_steril) = '%s' AND YEAR(s.tgl_steril) = '%s'
    //                 GROUP BY s.tgl_steril
    //                 ORDER BY tgl_steril, CASE WHEN `nama_ruang` = 'TOTAL' THEN 1 ELSE 0 END, `nama_ruang` ", $bulan1, $tahun1,$bulan2, $tahun2);
    //     $result = DB::connection('mysqlserver79')->select($q);
    //     return $result;
    // }

    public function getLaporanBulan($bulan1, $tahun1,$bulan2, $tahun2,$bulan3, $tahun3)
    {
        $q = sprintf("SELECT 
                    s.tgl_steril AS 'tgl_steril',s.tgl_penyerahan_alat AS 'tgl_penyerahan',
                    r.nama_ruang AS 'nama_ruang',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi set' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set',
                    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Besar' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_besar',
                    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Kecil' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_kecil',
                    SUM(CASE WHEN a.nama_alat = 'Bengkok' THEN s.jml_alat ELSE 0 END) AS 'bengkok',
                    SUM(CASE WHEN a.nama_alat = 'Kom' THEN s.jml_alat ELSE 0 END) AS 'kom',
                    SUM(CASE WHEN a.nama_alat = 'Gunting' THEN s.jml_alat ELSE 0 END) AS 'gunting',
                    SUM(CASE WHEN a.nama_alat = 'Vooder' THEN s.jml_alat ELSE 0 END) AS 'vooder',
                    SUM(CASE WHEN a.nama_alat = 'Klem' THEN s.jml_alat ELSE 0 END) AS 'klem',
                    SUM(CASE WHEN a.nama_alat = 'Pinset Anatomis' THEN s.jml_alat ELSE 0 END) AS 'pinset_anatomis',
                    SUM(CASE WHEN a.nama_alat = 'Pinset Cirugis' THEN s.jml_alat ELSE 0 END) AS 'pinset_cirugis',
                    SUM(CASE WHEN a.nama_alat = 'Pinset THT' THEN s.jml_alat ELSE 0 END) AS 'pinset_tht',
                    SUM(CASE WHEN a.nama_alat = 'Tounge Spatel' THEN s.jml_alat ELSE 0 END) AS 'tounge_spatel',
                    SUM(CASE WHEN a.nama_alat = 'Kassa' THEN s.jml_alat ELSE 0 END) AS 'kassa',
                    SUM(CASE WHEN a.nama_alat = 'Spekullum Recta' THEN s.jml_alat ELSE 0 END) AS 'spekullum_recta',
                    SUM(CASE WHEN a.nama_alat = 'Diagnostik Set' THEN s.jml_alat ELSE 0 END) AS 'diagnostik_set',
                    SUM(CASE WHEN a.nama_alat = 'Obgyn Set' THEN s.jml_alat ELSE 0 END) AS 'obgyn_set',
                    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 1/Hernia/APP' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_hernia',
                    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 2/SC set' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_sc',
                    SUM(CASE WHEN a.nama_alat = 'Laparatomy Set' THEN s.jml_alat ELSE 0 END) AS 'laparatomy_set',
                    SUM(CASE WHEN a.nama_alat = 'Tang Cabut Gigi' THEN s.jml_alat ELSE 0 END) AS 'tang_cabut_gigi',
                    SUM(CASE WHEN a.nama_alat = 'Blade Laringoskop' THEN s.jml_alat ELSE 0 END) AS 'blade_laringoskop',
                    SUM(CASE WHEN a.nama_alat = 'Ambubag' THEN s.jml_alat ELSE 0 END) AS 'ambubag',
                    SUM(CASE WHEN a.nama_alat = 'Masker Sipack' THEN s.jml_alat ELSE 0 END) AS 'masker_sipack',
                    SUM(CASE WHEN a.nama_alat = 'selang Ambubag' THEN s.jml_alat ELSE 0 END) AS 'selang_ambubag',
                    SUM(CASE WHEN a.nama_alat = 'Selang Suction' THEN s.jml_alat ELSE 0 END) AS 'selang_suction',
                    SUM(CASE WHEN a.nama_alat = 'set brathing sirkuit' THEN s.jml_alat ELSE 0 END) AS 'set_brathing_sirkuit',
                    SUM(CASE WHEN a.nama_alat = 'Set Ventilator' THEN s.jml_alat ELSE 0 END) AS 'set_ventilator',
                    SUM(CASE WHEN a.nama_alat = 'Duk Lubang' THEN s.jml_alat ELSE 0 END) AS 'duk_lubang',
                    SUM(CASE WHEN a.nama_alat = 'Root Elevator' THEN s.jml_alat ELSE 0 END) AS 'root_elevator',
                    SUM(CASE WHEN a.nama_alat = 'Scapel Handle' THEN s.jml_alat ELSE 0 END) AS 'scapel_handle',
                    SUM(CASE WHEN a.nama_alat = 'Kassa Darm Doek' THEN s.jml_alat ELSE 0 END) AS 'kassa_darm_doek',
                    SUM(CASE WHEN a.nama_alat = 'Curatage Set' THEN s.jml_alat ELSE 0 END) AS 'curatage_set',
                    SUM(CASE WHEN a.nama_alat = 'Breathing Set' THEN s.jml_alat ELSE 0 END) AS 'breathing_set',
                    SUM(CASE WHEN a.nama_alat = 'Mandrin' THEN s.jml_alat ELSE 0 END) AS 'mandrin',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Besar' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_besar',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Kecil' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_kecil',
                    SUM(CASE WHEN a.nama_alat = 'Heating Set' THEN s.jml_alat ELSE 0 END) AS 'heating_set',
                    SUM(CASE WHEN a.nama_alat = 'Cocor bebek ' THEN s.jml_alat ELSE 0 END) AS 'cocor_bebek',
                    SUM(CASE WHEN a.nama_alat = 'Gunting THT ' THEN s.jml_alat ELSE 0 END) AS 'gunting_tht',
                    SUM(s.jml_alat) AS 'TOTAL'
                    FROM steril s
                    LEFT JOIN alat a ON s.id_alat = a.id_alat
                    LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                    WHERE MONTH(s.tgl_steril) = '%s' AND YEAR(s.tgl_steril) = '%s'
                    GROUP BY s.tgl_steril,r.nama_ruang
                    UNION ALL
                    SELECT 
                    s.tgl_steril,s.tgl_penyerahan_alat,
                    CONCAT('TOTAL ', s.tgl_steril) AS 'nama_ruang',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi set' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set',
                    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Besar' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_besar',
                    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Kecil' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_kecil',
                    SUM(CASE WHEN a.nama_alat = 'Bengkok' THEN s.jml_alat ELSE 0 END) AS 'bengkok',
                    SUM(CASE WHEN a.nama_alat = 'Kom' THEN s.jml_alat ELSE 0 END) AS 'kom',
                    SUM(CASE WHEN a.nama_alat = 'Gunting' THEN s.jml_alat ELSE 0 END) AS 'gunting',
                    SUM(CASE WHEN a.nama_alat = 'Vooder' THEN s.jml_alat ELSE 0 END) AS 'vooder',
                    SUM(CASE WHEN a.nama_alat = 'Klem' THEN s.jml_alat ELSE 0 END) AS 'klem',
                    SUM(CASE WHEN a.nama_alat = 'Pinset Anatomis' THEN s.jml_alat ELSE 0 END) AS 'pinset_anatomis',
                    SUM(CASE WHEN a.nama_alat = 'Pinset Cirugis' THEN s.jml_alat ELSE 0 END) AS 'pinset_cirugis',
                    SUM(CASE WHEN a.nama_alat = 'Pinset THT' THEN s.jml_alat ELSE 0 END) AS 'pinset_tht',
                    SUM(CASE WHEN a.nama_alat = 'Tounge Spatel' THEN s.jml_alat ELSE 0 END) AS 'tounge_spatel',
                    SUM(CASE WHEN a.nama_alat = 'Kassa' THEN s.jml_alat ELSE 0 END) AS 'kassa',
                    SUM(CASE WHEN a.nama_alat = 'Spekullum Recta' THEN s.jml_alat ELSE 0 END) AS 'spekullum_recta',
                    SUM(CASE WHEN a.nama_alat = 'Diagnostik Set' THEN s.jml_alat ELSE 0 END) AS 'diagnostik_set',
                    SUM(CASE WHEN a.nama_alat = 'Obgyn Set' THEN s.jml_alat ELSE 0 END) AS 'obgyn_set',
                    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 1/Hernia/APP' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_hernia',
                    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 2/SC set' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_sc',
                    SUM(CASE WHEN a.nama_alat = 'Laparatomy Set' THEN s.jml_alat ELSE 0 END) AS 'laparatomy_set',
                    SUM(CASE WHEN a.nama_alat = 'Tang Cabut Gigi' THEN s.jml_alat ELSE 0 END) AS 'tang_cabut_gigi',
                    SUM(CASE WHEN a.nama_alat = 'Blade Laringoskop' THEN s.jml_alat ELSE 0 END) AS 'blade_laringoskop',
                    SUM(CASE WHEN a.nama_alat = 'Ambubag' THEN s.jml_alat ELSE 0 END) AS 'ambubag',
                    SUM(CASE WHEN a.nama_alat = 'Masker Sipack' THEN s.jml_alat ELSE 0 END) AS 'masker_sipack',
                    SUM(CASE WHEN a.nama_alat = 'selang Ambubag' THEN s.jml_alat ELSE 0 END) AS 'selang_ambubag',
                    SUM(CASE WHEN a.nama_alat = 'Selang Suction' THEN s.jml_alat ELSE 0 END) AS 'selang_suction',
                    SUM(CASE WHEN a.nama_alat = 'set brathing sirkuit' THEN s.jml_alat ELSE 0 END) AS 'set_brathing_sirkuit',
                    SUM(CASE WHEN a.nama_alat = 'Set Ventilator' THEN s.jml_alat ELSE 0 END) AS 'set_ventilator',
                    SUM(CASE WHEN a.nama_alat = 'Duk Lubang' THEN s.jml_alat ELSE 0 END) AS 'duk_lubang',
                    SUM(CASE WHEN a.nama_alat = 'Root Elevator' THEN s.jml_alat ELSE 0 END) AS 'root_elevator',
                    SUM(CASE WHEN a.nama_alat = 'Scapel Handle' THEN s.jml_alat ELSE 0 END) AS 'scapel_handle',
                    SUM(CASE WHEN a.nama_alat = 'Kassa Darm Doek' THEN s.jml_alat ELSE 0 END) AS 'kassa_darm_doek',
                    SUM(CASE WHEN a.nama_alat = 'Curatage Set' THEN s.jml_alat ELSE 0 END) AS 'curatage_set',
                    SUM(CASE WHEN a.nama_alat = 'Breathing Set' THEN s.jml_alat ELSE 0 END) AS 'breathing_set',
                    SUM(CASE WHEN a.nama_alat = 'Mandrin' THEN s.jml_alat ELSE 0 END) AS 'mandrin',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Besar' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_besar',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Kecil' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_kecil',
                    SUM(CASE WHEN a.nama_alat = 'Heating Set' THEN s.jml_alat ELSE 0 END) AS 'heating_set',
                    SUM(CASE WHEN a.nama_alat = 'Cocor bebek ' THEN s.jml_alat ELSE 0 END) AS 'cocor_bebek',
                    SUM(CASE WHEN a.nama_alat = 'Gunting THT ' THEN s.jml_alat ELSE 0 END) AS 'gunting_tht',
                    SUM(s.jml_alat) AS total
                    FROM steril s
                    LEFT JOIN alat a ON s.id_alat = a.id_alat
                    LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                    WHERE MONTH(s.tgl_steril) = '%s' AND YEAR(s.tgl_steril) = '%s'
                    GROUP BY s.tgl_steril
                    UNION ALL
                    SELECT 
                    CONCAT(YEAR(s.tgl_steril), '-', MONTH(s.tgl_steril), '-01') AS tgl_steril,s.tgl_penyerahan_alat,
                    CONCAT('TOTAL BULAN ', MONTH(s.tgl_steril)) AS 'nama_ruang',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi set' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set',
                    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Besar' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_besar',
                    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Kecil' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_kecil',
                    SUM(CASE WHEN a.nama_alat = 'Bengkok' THEN s.jml_alat ELSE 0 END) AS 'bengkok',
                    SUM(CASE WHEN a.nama_alat = 'Kom' THEN s.jml_alat ELSE 0 END) AS 'kom',
                    SUM(CASE WHEN a.nama_alat = 'Gunting' THEN s.jml_alat ELSE 0 END) AS 'gunting',
                    SUM(CASE WHEN a.nama_alat = 'Vooder' THEN s.jml_alat ELSE 0 END) AS 'vooder',
                    SUM(CASE WHEN a.nama_alat = 'Klem' THEN s.jml_alat ELSE 0 END) AS 'klem',
                    SUM(CASE WHEN a.nama_alat = 'Pinset Anatomis' THEN s.jml_alat ELSE 0 END) AS 'pinset_anatomis',
                    SUM(CASE WHEN a.nama_alat = 'Pinset Cirugis' THEN s.jml_alat ELSE 0 END) AS 'pinset_cirugis',
                    SUM(CASE WHEN a.nama_alat = 'Pinset THT' THEN s.jml_alat ELSE 0 END) AS 'pinset_tht',
                    SUM(CASE WHEN a.nama_alat = 'Tounge Spatel' THEN s.jml_alat ELSE 0 END) AS 'tounge_spatel',
                    SUM(CASE WHEN a.nama_alat = 'Kassa' THEN s.jml_alat ELSE 0 END) AS 'kassa',
                    SUM(CASE WHEN a.nama_alat = 'Spekullum Recta' THEN s.jml_alat ELSE 0 END) AS 'spekullum_recta',
                    SUM(CASE WHEN a.nama_alat = 'Diagnostik Set' THEN s.jml_alat ELSE 0 END) AS 'diagnostik_set',
                    SUM(CASE WHEN a.nama_alat = 'Obgyn Set' THEN s.jml_alat ELSE 0 END) AS 'obgyn_set',
                    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 1/Hernia/APP' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_hernia',
                    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 2/SC set' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_sc',
                    SUM(CASE WHEN a.nama_alat = 'Laparatomy Set' THEN s.jml_alat ELSE 0 END) AS 'laparatomy_set',
                    SUM(CASE WHEN a.nama_alat = 'Tang Cabut Gigi' THEN s.jml_alat ELSE 0 END) AS 'tang_cabut_gigi',
                    SUM(CASE WHEN a.nama_alat = 'Blade Laringoskop' THEN s.jml_alat ELSE 0 END) AS 'blade_laringoskop',
                    SUM(CASE WHEN a.nama_alat = 'Ambubag' THEN s.jml_alat ELSE 0 END) AS 'ambubag',
                    SUM(CASE WHEN a.nama_alat = 'Masker Sipack' THEN s.jml_alat ELSE 0 END) AS 'masker_sipack',
                    SUM(CASE WHEN a.nama_alat = 'selang Ambubag' THEN s.jml_alat ELSE 0 END) AS 'selang_ambubag',
                    SUM(CASE WHEN a.nama_alat = 'Selang Suction' THEN s.jml_alat ELSE 0 END) AS 'selang_suction',
                    SUM(CASE WHEN a.nama_alat = 'set brathing sirkuit' THEN s.jml_alat ELSE 0 END) AS 'set_brathing_sirkuit',
                    SUM(CASE WHEN a.nama_alat = 'Set Ventilator' THEN s.jml_alat ELSE 0 END) AS 'set_ventilator',
                    SUM(CASE WHEN a.nama_alat = 'Duk Lubang' THEN s.jml_alat ELSE 0 END) AS 'duk_lubang',
                    SUM(CASE WHEN a.nama_alat = 'Root Elevator' THEN s.jml_alat ELSE 0 END) AS 'root_elevator',
                    SUM(CASE WHEN a.nama_alat = 'Scapel Handle' THEN s.jml_alat ELSE 0 END) AS 'scapel_handle',
                    SUM(CASE WHEN a.nama_alat = 'Kassa Darm Doek' THEN s.jml_alat ELSE 0 END) AS 'kassa_darm_doek',
                    SUM(CASE WHEN a.nama_alat = 'Curatage Set' THEN s.jml_alat ELSE 0 END) AS 'curatage_set',
                    SUM(CASE WHEN a.nama_alat = 'Breathing Set' THEN s.jml_alat ELSE 0 END) AS 'breathing_set',
                    SUM(CASE WHEN a.nama_alat = 'Mandrin' THEN s.jml_alat ELSE 0 END) AS 'mandrin',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Besar' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_besar',
                    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Kecil' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_kecil',
                    SUM(CASE WHEN a.nama_alat = 'Heating Set' THEN s.jml_alat ELSE 0 END) AS 'heating_set',
                    SUM(CASE WHEN a.nama_alat = 'Cocor bebek ' THEN s.jml_alat ELSE 0 END) AS 'cocor_bebek',
                    SUM(CASE WHEN a.nama_alat = 'Gunting THT ' THEN s.jml_alat ELSE 0 END) AS 'gunting_tht',
                    SUM(s.jml_alat) AS total
                    FROM steril s
                    LEFT JOIN alat a ON s.id_alat = a.id_alat
                    LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
                    WHERE MONTH(s.tgl_steril) = '%s' AND YEAR(s.tgl_steril) = '%s'
                    GROUP BY MONTH(s.tgl_steril)
                    ORDER BY tgl_steril, CASE WHEN nama_ruang = 'TOTAL' THEN 1 ELSE 0 END, nama_ruang ", $bulan1, $tahun1,$bulan2, $tahun2,$bulan3, $tahun3);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }

    public function getLaporanTahun($tahun1, $tahun2)
    {
        $q = sprintf("SELECT 
    MONTH(s.tgl_penyerahan_alat) AS bulan,
    r.nama_ruang AS 'nama_ruang',
    SUM(CASE WHEN a.nama_alat = 'Medikasi set' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set',
    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Besar' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_besar',
    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Kecil' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_kecil',
    SUM(CASE WHEN a.nama_alat = 'Bengkok' THEN s.jml_alat ELSE 0 END) AS 'bengkok',
    SUM(CASE WHEN a.nama_alat = 'Kom' THEN s.jml_alat ELSE 0 END) AS 'kom',
    SUM(CASE WHEN a.nama_alat = 'Gunting' THEN s.jml_alat ELSE 0 END) AS 'gunting',
    SUM(CASE WHEN a.nama_alat = 'Vooder' THEN s.jml_alat ELSE 0 END) AS 'vooder',
    SUM(CASE WHEN a.nama_alat = 'Klem' THEN s.jml_alat ELSE 0 END) AS 'klem',
    SUM(CASE WHEN a.nama_alat = 'Pinset Anatomis' THEN s.jml_alat ELSE 0 END) AS 'pinset_anatomis',
    SUM(CASE WHEN a.nama_alat = 'Pinset Cirugis' THEN s.jml_alat ELSE 0 END) AS 'pinset_cirugis',
    SUM(CASE WHEN a.nama_alat = 'Pinset THT' THEN s.jml_alat ELSE 0 END) AS 'pinset_tht',
    SUM(CASE WHEN a.nama_alat = 'Tounge Spatel' THEN s.jml_alat ELSE 0 END) AS 'tounge_spatel',
    SUM(CASE WHEN a.nama_alat = 'Kassa' THEN s.jml_alat ELSE 0 END) AS 'kassa',
    SUM(CASE WHEN a.nama_alat = 'Spekullum Recta' THEN s.jml_alat ELSE 0 END) AS 'spekullum_recta',
    SUM(CASE WHEN a.nama_alat = 'Diagnostik Set' THEN s.jml_alat ELSE 0 END) AS 'diagnostik_set',
    SUM(CASE WHEN a.nama_alat = 'Obgyn Set' THEN s.jml_alat ELSE 0 END) AS 'obgyn_set',
    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 1/Hernia/APP' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_hernia',
    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 2/SC set' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_sc',
    SUM(CASE WHEN a.nama_alat = 'Laparatomy Set' THEN s.jml_alat ELSE 0 END) AS 'laparatomy_set',
    SUM(CASE WHEN a.nama_alat = 'Tang Cabut Gigi' THEN s.jml_alat ELSE 0 END) AS 'tang_cabut_gigi',
    SUM(CASE WHEN a.nama_alat = 'Blade Laringoskop' THEN s.jml_alat ELSE 0 END) AS 'blade_laringoskop',
    SUM(CASE WHEN a.nama_alat = 'Ambubag' THEN s.jml_alat ELSE 0 END) AS 'ambubag',
    SUM(CASE WHEN a.nama_alat = 'Masker Sipack' THEN s.jml_alat ELSE 0 END) AS 'masker_sipack',
    SUM(CASE WHEN a.nama_alat = 'selang Ambubag' THEN s.jml_alat ELSE 0 END) AS 'selang_ambubag',
    SUM(CASE WHEN a.nama_alat = 'Selang Suction' THEN s.jml_alat ELSE 0 END) AS 'selang_suction',
    SUM(CASE WHEN a.nama_alat = 'set brathing sirkuit' THEN s.jml_alat ELSE 0 END) AS 'set_brathing_sirkuit',
    SUM(CASE WHEN a.nama_alat = 'Set Ventilator' THEN s.jml_alat ELSE 0 END) AS 'set_ventilator',
    SUM(CASE WHEN a.nama_alat = 'Duk Lubang' THEN s.jml_alat ELSE 0 END) AS 'duk_lubang',
    SUM(CASE WHEN a.nama_alat = 'Root Elevator' THEN s.jml_alat ELSE 0 END) AS 'root_elevator',
    SUM(CASE WHEN a.nama_alat = 'Scapel Handle' THEN s.jml_alat ELSE 0 END) AS 'scapel_handle',
    SUM(CASE WHEN a.nama_alat = 'Kassa Darm Doek' THEN s.jml_alat ELSE 0 END) AS 'kassa_darm_doek',
    SUM(CASE WHEN a.nama_alat = 'Curatage Set' THEN s.jml_alat ELSE 0 END) AS 'curatage_set',
    SUM(CASE WHEN a.nama_alat = 'Breathing Set' THEN s.jml_alat ELSE 0 END) AS 'breathing_set',
    SUM(CASE WHEN a.nama_alat = 'Mandrin' THEN s.jml_alat ELSE 0 END) AS 'mandrin',
    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Besar' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_besar',
    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Kecil' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_kecil',
    SUM(CASE WHEN a.nama_alat = 'Heating Set' THEN s.jml_alat ELSE 0 END) AS 'heating_set',
    SUM(CASE WHEN a.nama_alat = 'Cocor bebek ' THEN s.jml_alat ELSE 0 END) AS 'cocor_bebek',
    SUM(CASE WHEN a.nama_alat = 'Gunting THT ' THEN s.jml_alat ELSE 0 END) AS 'gunting_tht',
    SUM(s.jml_alat) AS 'TOTAL'
FROM steril s
LEFT JOIN alat a ON s.id_alat = a.id_alat
LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
WHERE YEAR(s.tgl_penyerahan_alat) = '%s'
GROUP BY MONTH(s.tgl_penyerahan_alat), r.nama_ruang

UNION ALL

SELECT 
    MONTH(s.tgl_penyerahan_alat),
    'TOTAL' AS 'nama_ruang',
    SUM(CASE WHEN a.nama_alat = 'Medikasi set' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set',
    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Besar' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_besar',
    SUM(CASE WHEN a.nama_alat = 'Bak Instrumen Kecil' THEN s.jml_alat ELSE 0 END) AS 'bak_instrumen_kecil',
    SUM(CASE WHEN a.nama_alat = 'Bengkok' THEN s.jml_alat ELSE 0 END) AS 'bengkok',
    SUM(CASE WHEN a.nama_alat = 'Kom' THEN s.jml_alat ELSE 0 END) AS 'kom',
    SUM(CASE WHEN a.nama_alat = 'Gunting' THEN s.jml_alat ELSE 0 END) AS 'gunting',
    SUM(CASE WHEN a.nama_alat = 'Vooder' THEN s.jml_alat ELSE 0 END) AS 'vooder',
    SUM(CASE WHEN a.nama_alat = 'Klem' THEN s.jml_alat ELSE 0 END) AS 'klem',
    SUM(CASE WHEN a.nama_alat = 'Pinset Anatomis' THEN s.jml_alat ELSE 0 END) AS 'pinset_anatomis',
    SUM(CASE WHEN a.nama_alat = 'Pinset Cirugis' THEN s.jml_alat ELSE 0 END) AS 'pinset_cirugis',
    SUM(CASE WHEN a.nama_alat = 'Pinset THT' THEN s.jml_alat ELSE 0 END) AS 'pinset_tht',
    SUM(CASE WHEN a.nama_alat = 'Tounge Spatel' THEN s.jml_alat ELSE 0 END) AS 'tounge_spatel',
    SUM(CASE WHEN a.nama_alat = 'Kassa' THEN s.jml_alat ELSE 0 END) AS 'kassa',
    SUM(CASE WHEN a.nama_alat = 'Spekullum Recta' THEN s.jml_alat ELSE 0 END) AS 'spekullum_recta',
    SUM(CASE WHEN a.nama_alat = 'Diagnostik Set' THEN s.jml_alat ELSE 0 END) AS 'diagnostik_set',
    SUM(CASE WHEN a.nama_alat = 'Obgyn Set' THEN s.jml_alat ELSE 0 END) AS 'obgyn_set',
    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 1/Hernia/APP' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_hernia',
    SUM(CASE WHEN a.nama_alat = 'Basic Set OK 2/SC set' THEN s.jml_alat ELSE 0 END) AS 'basic_set_ok_sc',
    SUM(CASE WHEN a.nama_alat = 'Laparatomy Set' THEN s.jml_alat ELSE 0 END) AS 'laparatomy_set',
    SUM(CASE WHEN a.nama_alat = 'Tang Cabut Gigi' THEN s.jml_alat ELSE 0 END) AS 'tang_cabut_gigi',
    SUM(CASE WHEN a.nama_alat = 'Blade Laringoskop' THEN s.jml_alat ELSE 0 END) AS 'blade_laringoskop',
    SUM(CASE WHEN a.nama_alat = 'Ambubag' THEN s.jml_alat ELSE 0 END) AS 'ambubag',
    SUM(CASE WHEN a.nama_alat = 'Masker Sipack' THEN s.jml_alat ELSE 0 END) AS 'masker_sipack',
    SUM(CASE WHEN a.nama_alat = 'selang Ambubag' THEN s.jml_alat ELSE 0 END) AS 'selang_ambubag',
    SUM(CASE WHEN a.nama_alat = 'Selang Suction' THEN s.jml_alat ELSE 0 END) AS 'selang_suction',
    SUM(CASE WHEN a.nama_alat = 'set brathing sirkuit' THEN s.jml_alat ELSE 0 END) AS 'set_brathing_sirkuit',
    SUM(CASE WHEN a.nama_alat = 'Set Ventilator' THEN s.jml_alat ELSE 0 END) AS 'set_ventilator',
    SUM(CASE WHEN a.nama_alat = 'Duk Lubang' THEN s.jml_alat ELSE 0 END) AS 'duk_lubang',
    SUM(CASE WHEN a.nama_alat = 'Root Elevator' THEN s.jml_alat ELSE 0 END) AS 'root_elevator',
    SUM(CASE WHEN a.nama_alat = 'Scapel Handle' THEN s.jml_alat ELSE 0 END) AS 'scapel_handle',
    SUM(CASE WHEN a.nama_alat = 'Kassa Darm Doek' THEN s.jml_alat ELSE 0 END) AS 'kassa_darm_doek',
    SUM(CASE WHEN a.nama_alat = 'Curatage Set' THEN s.jml_alat ELSE 0 END) AS 'curatage_set',
    SUM(CASE WHEN a.nama_alat = 'Breathing Set' THEN s.jml_alat ELSE 0 END) AS 'breathing_set',
    SUM(CASE WHEN a.nama_alat = 'Mandrin' THEN s.jml_alat ELSE 0 END) AS 'mandrin',
    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Besar' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_besar',
    SUM(CASE WHEN a.nama_alat = 'Medikasi Set Ok Kecil' THEN s.jml_alat ELSE 0 END) AS 'medikasi_set_ok_kecil',
    SUM(CASE WHEN a.nama_alat = 'Heating Set' THEN s.jml_alat ELSE 0 END) AS 'heating_set',
    SUM(CASE WHEN a.nama_alat = 'Cocor bebek ' THEN s.jml_alat ELSE 0 END) AS 'cocor_bebek',
    SUM(CASE WHEN a.nama_alat = 'Gunting THT ' THEN s.jml_alat ELSE 0 END) AS 'gunting_tht',
    SUM(s.jml_alat) AS 'TOTAL'
FROM steril s
LEFT JOIN alat a ON s.id_alat = a.id_alat
LEFT JOIN tb_ruang r ON s.id_ruang = r.id_ruang
WHERE YEAR(s.tgl_penyerahan_alat) = '%s'
GROUP BY MONTH(s.tgl_penyerahan_alat)

ORDER BY bulan, CASE WHEN `nama_ruang` = 'TOTAL' THEN 1 ELSE 0 END, `nama_ruang` ",  $tahun1, $tahun2);
        $result = DB::connection('mysqlserver79')->select($q);
        return $result;
    }
}
