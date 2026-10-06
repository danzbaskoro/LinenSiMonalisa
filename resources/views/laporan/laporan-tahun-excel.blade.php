
<table style="border-collapse: collapse;width:100%" border="1" cellspacing="0">
    <thead>
        <tr>
            <th colspan="42" style="text-align: center; font-size: 16px;">
                Laporan Sterilisasi Tahun {{ $tahun }}
            </th>
        </tr>
        <tr>
            <th rowspan="2">Bulan</th>
            <th rowspan="2">Nama Ruang</th>
            <th colspan="39">Nama Alat</th>
            <th rowspan="2">Total</th>
        </tr>
        <tr>
            <td>Medikasi Set</td>
            <td>Bak Instrumen Besar</td>
            <td>Bak Instrumen Kecil</td>
            <td>Bengkok</td>
            <td>Kom</td>
            <td>Gunting</td>
            <td>Vooder</td>
            <td>Klem</td>
            <td>Pinset Anatomis</td>
            <td>Pinset Cirugis</td>
            <td>Pinset THT</td>
            <td>Tounge Spatel</td>
            <td>Kassa</td>
            <td>Spekullum Recta</td>
            <td>Diagnostik Set</td>
            <td>Obgyn Set</td>
            <td>Basic Set OK 1/Hernia/APP</td>
            <td>Basic Set OK 2/SC set</td>
            <td>Laparatomy Set</td>
            <td>Tang Cabut Gigi</td>
            <td>Blade Laringoskop</td>
            <td>Ambubag</td>
            <td>Masker Sipack</td>
            <td>Selang Ambubag</td>
            <td>Selang Suction</td>
            <td>Set brathing sirkuit</td>
            <td>Set Ventilator</td>
            <td>Duk Lubang</td>
            <td>Root Elevator</td>
            <td>Scapel Handle</td>
            <td>Kassa Darm Doek</td>
            <td>Curatage Set</td>
            <td>Breathing Set</td>
            <td>Mandrin</td>
            <td>Medikasi Set Ok Besar</td>
            <td>Medikasi Set Ok Kecil</td>
            <td>Heating Set</td>
            <td>Cocor bebek</td>
            <td>Gunting THT</td>
        </tr>
    </thead>
    <tbody>
        {{-- <pre>{{ dd($data) }}</pre> --}}
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->bulan }}</td>
                <td>{{ $row->nama_ruang }}</td>
                <td>{{ $row->medikasi_set }}</td>
                <td>{{ $row->bak_instrumen_besar }}</td>
                <td>{{ $row->bak_instrumen_kecil }}</td>
                <td>{{ $row->bengkok }}</td>
                <td>{{ $row->kom }}</td>
                <td>{{ $row->gunting }}</td>
                <td>{{ $row->vooder }}</td>
                <td>{{ $row->klem }}</td>
                <td>{{ $row->pinset_anatomis }}</td>
                <td>{{ $row->pinset_cirugis }}</td>
                <td>{{ $row->pinset_tht }}</td>
                <td>{{ $row->tounge_spatel }}</td>
                <td>{{ $row->kassa }}</td>
                <td>{{ $row->spekullum_recta }}</td>
                <td>{{ $row->diagnostik_set }}</td>
                <td>{{ $row->obgyn_set }}</td>
                <td>{{ $row->basic_set_ok_hernia }}</td>
                <td>{{ $row->basic_set_ok_sc }}</td>
                <td>{{ $row->laparatomy_set }}</td>
                <td>{{ $row->tang_cabut_gigi }}</td>
                <td>{{ $row->blade_laringoskop }}</td>
                <td>{{ $row->masker_sipack }}</td>
                <td>{{ $row->ambubag }}</td>
                <td>{{ $row->selang_ambubag }}</td>
                <td>{{ $row->selang_suction }}</td>
                <td>{{ $row->set_brathing_sirkuit }}</td>
                <td>{{ $row->set_ventilator }}</td>
                <td>{{ $row->duk_lubang }}</td>
                <td>{{ $row->root_elevator }}</td>
                <td>{{ $row->scapel_handle }}</td>
                <td>{{ $row->kassa_darm_doek }}</td>
                <td>{{ $row->curatage_set }}</td>
                <td>{{ $row->breathing_set }}</td>
                <td>{{ $row->mandrin }}</td>
                <td>{{ $row->medikasi_set_ok_besar }}</td>
                <td>{{ $row->medikasi_set_ok_kecil }}</td>
                <td>{{ $row->heating_set }}</td>
                <td>{{ $row->cocor_bebek }}</td>
                <td>{{ $row->gunting_tht }}</td>
                <td>{{ $row->TOTAL }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
