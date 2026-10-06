<table>
    <thead>
        <tr>
            <th colspan="4" style="text-align: center; font-size: 16px;">
                Laporan Sterilisasi Bulan {{ $bulanNama }} Tahun {{ $tahun }}
            </th>
        </tr>
        <tr>
            <th>Tanggal Steril</th>
            <th>Tanggal Penyerahan</th>
            <th>Nama Ruang</th>
            <th>Medikasi Set</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->tgl_steril }}</td>
                <td>{{ $row->tgl_penyerahan_alat }}</td>
                <td>{{ $row->nama_ruang }}</td>
                <td>{{ $row->medikasi_set }}</td>
                <td>{{ $row->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>