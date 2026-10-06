<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SterilisasiExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function query()
    {
        
        return DB::table(DB::raw("(
            SELECT 
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
                    WHERE MONTH(s.tgl_steril) = '{$this->month}' AND YEAR(s.tgl_steril) = '{$this->year}'
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
                    WHERE MONTH(s.tgl_steril) = '{$this->month}' AND YEAR(s.tgl_steril) = '{$this->year}'
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
                    WHERE MONTH(s.tgl_steril) = '{$this->month}' AND YEAR(s.tgl_steril) = '{$this->year}'
                    GROUP BY MONTH(s.tgl_steril)
           
        ) AS combined"))
        ->orderBy('tgl_steril')
        ->orderByRaw("CASE WHEN nama_ruang = 'TOTAL' THEN 1 ELSE 0 END")
        ->orderBy('nama_ruang');
    
    }

    public function headings(): array
    {
        return [
            'Tanggal Steril',
            'Tanggal Penyerahan',
            'Nama Ruang',
            'Medikasi Set',
            'Bak Instrumen Besar',
            'Bak Instrumen Kecil',
            'Bengkok',
            'Kom',
            'Gunting',
            'Vooder',
            'Klem',
            'Pinset Anatomis',
            'Pinset Cirugis',
            'Pinset THT',
            'Tounge Spatel',
            'Kassa',
            'Spekullum Recta',
            'Diagnostik Set',
            'Obgyn Set',
            'Basic Set OK 1/Hernia/APP',
            'Basic Set OK 2/SC set',
            'Laparatomy Set',
            'Tang Cabut Gigi',
            'Blade Laringoskop',
            'Ambubag',
            'Masker Sipack',
            'Selang Ambubag',
            'Selang Suction',
            'Set brathing sirkuit',
            'Set Ventilator',
            'Duk Lubang',
            'Root Elevator',
            'Scapel Handle',
            'Kassa Darm Doek',
            'Curatage Set',
            'Breathing Set',
            'Mandrin',
            'Medikasi Set Ok Besar',
            'Medikasi Set Ok Kecil',
            'Heating Set',
            'Cocor bebek',
            'Gunting THT',
            'Total',
        ];
    }

    public function map($row): array
    {
        return [
            $row->tgl_steril,
            $row->tgl_penyerahan,
            $row->nama_ruang,
            $row->medikasi_set,
            $row->bak_instrumen_besar,
            $row->bak_instrumen_kecil,
            $row->bengkok,
            $row->kom,
            $row->gunting,
            $row->vooder,
            $row->klem,
            $row->pinset_anatomis,
            $row->pinset_cirugis,
            $row->pinset_tht,
            $row->tounge_spatel,
            $row->kassa,
            $row->spekullum_recta,
            $row->diagnostik_set,
            $row->obgyn_set,
            $row->basic_set_ok_hernia,
            $row->basic_set_ok_sc,
            $row->laparatomy_set,
            $row->tang_cabut_gigi,
            $row->blade_laringoskop,
            $row->ambubag,
            $row->masker_sipack,
            $row->selang_ambubag,
            $row->selang_suction,
            $row->set_brathing_sirkuit,
            $row->set_ventilator,
            $row->duk_lubang,
            $row->root_elevator,
            $row->scapel_handle,
            $row->kassa_darm_doek,
            $row->curatage_set,
            $row->breathing_set,
            $row->mandrin,
            $row->medikasi_set_ok_besar,
            $row->medikasi_set_ok_kecil,
            $row->heating_set,
            $row->cocor_bebek,
            $row->gunting_tht,
            $row->TOTAL,
        ];
    }
}