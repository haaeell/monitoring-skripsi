<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Bimbingan Skripsi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12pt;
        }
        .container {
            margin: 30px;
        }
        .header {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .header img {
            width: 70px;
            margin-right: 20px;
        }
        .header-text {
            flex: 1;
        }
        .header h1, .header h2, .header p {
            margin: 0;
            padding: 0;
        }
        .header h1 {
            font-size: 16pt;
            font-weight: bold;
        }
        .header h2 {
            font-size: 14pt;
            font-weight: normal;
        }
        .header p {
            font-size: 10pt;
            margin-top: 10px;
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
            padding-top: 40px;
        }
    </style>
</head>
<body>
    @foreach ($bimbingan as $item)
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/img/logo-alma-ata.jpg') }}" alt="Logo">
            <div class="header-text">
                <h1>FAKULTAS KOMPUTER DAN TEKNIK</h1>
                <h2>UNIVERSITAS ALMA ATA YOGYAKARTA</h2>
                <p>Jl. Brawijaya No.99, Jadan, Tamantirto, Kec. Kasihan, Bantul, Daerah Istimewa Yogyakarta 55183<br>Telp. (0274) 4342288</p>
            </div>
        </div>
        <hr>

        <table class="">
            <tr>
                <td>Nama</td>
                <td colspan="3">: {{ $item->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td colspan="3">: {{ $item->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td colspan="3">: {{ $item->mahasiswa->prodi }}</td>
            </tr>
            <tr>
                <td>Pembimbing</td>
                <td colspan="3">: {{ $item->mahasiswa->pembimbing->nama }}</td>
            </tr>
            <tr>
                <td>Judul</td>
                <td colspan="3">: {{ $item->mahasiswa->judulSkripsi->judul_skripsi }}</td>
            </tr>
        </table>

        <div style="border: 1px solid; padding:10px">
            <div style="border-bottom: 1px solid">
                <p>Pembahasan Mahasiswa</p>
                <p>{{ $item->pembahasan_mhs }}</p>
            </div>
            <div>
                <p>Pembahasan Pembimbing</p>
                <p>{{ $item->pembahasan_dosen }}</p>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="border: 1px solid black; padding: 8px;">Tanggal</td>
                <td style="border: 1px solid black; padding: 8px;">Ttd mahasiswa</td>
                <td style="border: 1px solid black; padding: 8px;">Ttd pembimbing</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 40px 0;"></td>
                <td style="border: 1px solid black; padding: 40px 0;"></td>
                <td style="border: 1px solid black; padding: 40px 0;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px;">{{ $item->created_at->format('d M Y') }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $item->mahasiswa->nama }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ $item->mahasiswa->pembimbing->nama }}</td>
            </tr>
        </table>
    </div>

    <div class="page-break"></div>
    @endforeach
</body>
</html>
