<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Rekapitulasi Laporan Warga - Lapor Sapa</h2>
    <p>Tanggal Cetak: {{ date('d M Y, H:i') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelapor</th>
                <th>Judul</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $key => $l)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $l->created_at->format('d M Y') }}</td>
                <td>{{ $l->nama_pelapor }}</td>
                <td>{{ $l->judul_laporan }}</td>
                <td>{{ $l->lokasi }}</td>
                <td>{{ $l->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>