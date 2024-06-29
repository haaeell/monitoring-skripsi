<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Bimbingan Skripsi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 200px;
        }
        .header h2, .header h3 {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .no-border {
            border: none;
        }
        .no-border td {
            border: none;
        }
        .signature-table {
            margin-top: 40px;
            width: 100%;
        }
        .signature-table td {
            border: none;
            text-align: center;
            padding: 40px 0 0 0;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    @foreach ($bimbingan as $item)
    <div class="header">
        {{-- <img src="{{ public_path('almaatadfix.png') }}" alt="Logo"> --}}
        <h2>FAKULTAS KOMPUTER DAN TEKNIK</h2>
        <h3>UNIVERSITAS ALMA ATA YOGYAKARTA</h3>
        <p>Jl. Brawijaya No.99, Jadan, Tamantirto, Kec. Kasihan, Bantul, Daerah Istimewa Yogyakarta 55183<br>Telp. (0274) 4342288</p>
    </div>
    <table class="no-border">
        <tr>
            <td>Nama</td>
            <td colspan="3">: {{ $bimbingan->first()->mahasiswa->nama }}</td>
        </tr>
        <tr>
            <td>NIM</td>
            <td colspan="3">: {{ $bimbingan->first()->mahasiswa->nim }}</td>
        </tr>
        <tr>
            <td>Pembimbing</td>
            <td colspan="3">: {{ $bimbingan->first()->mahasiswa->pembimbing->nama }}</td>
        </tr>
        <tr>
            <td>Judul</td>
            <td colspan="3">: {{ $bimbingan->first()->mahasiswa->judul_ta }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Pembahasan Mahasiswa</td>
            <td>{{ $item->pembahasan_mhs }}</td>
        </tr>
        <tr>
            <td>Pembahasan Dosen</td>
            <td>{{ $item->pembahasan_dosen }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $item->created_at->format('d M Y') }}</td>
        </tr>
    </table>
    <table class="signature-table">
        <tr>
            <td>Mahasiswa</td>
            <td>Pembimbing</td>
        </tr>
        <tr>
            <td>__________________</td>
            <td>__________________</td>
        </tr>
    </table>
    <div class="page-break"></div>
    @endforeach
</body>
</html>
