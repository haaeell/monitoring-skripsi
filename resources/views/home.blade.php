@extends('layouts.dashboard')

@section('content')
    @if (auth()->user()->role == 'admin')
    <div class=" mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow  border border-primary">
                    <div class="card-header">Data Dosen</div>

                    <div class="card-body">
                     <p>
                        {{$jumlahDosen}}
                     </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow  border border-primary">
                    <div class="card-header">Jumlah Mahasiswa</div>

                    <div class="card-body">
                     <p>
                        {{$jumlahMahasiswa}}
                     </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow border-primary my-3">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Angkatan</th>
                                    <th>Jumlah Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jumlahMahasiswaPerAngkatan as $angkatan)
                                <tr>
                                    <td>{{ $angkatan->angkatan }}</td>
                                    <td>{{ $angkatan->total }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card shadow border-primary my-3">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Angkatan</th>
                                    <th>Jumlah Mahasiswa</th>
                                    <th>Jumlah Mahasiswa Sempro</th>
                                    <th>Jumlah Mahasiswa Pendadaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jumlahMahasiswaPerAngkatan as $angkatan)
                                <tr>
                                    <td>{{ $angkatan->angkatan }}</td>
                                    <td>{{ $angkatan->total }}</td>
                                    @php
                                        $seminar = $jumlahMahasiswaSeminarPerAngkatan->firstWhere('angkatan', $angkatan->angkatan);
                                        $jumlahSempro = $seminar ? $seminar->total : 0;
                                        $jumlahPendadaran = $seminar ? $seminar->total : 0;
                                    @endphp
                                    <td>{{ $jumlahSempro }}</td>
                                    <td>{{ $jumlahPendadaran }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (auth()->user()->role == 'mahasiswa')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow  border border-primary">
                    <div class="card-header">
                        <i class="bi bi-book"></i> Jumlah Bimbingan
                    </div>
                    <div class="card-body ">
                        <h5 class="fw-bold">{{ $jumlahBimbingan }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow  border border-primary">
                    <div class="card-header">
                        <i class="bi bi-check-circle"></i> Status Bimbingan
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">
                            @php
                                $badgeClass = '';
                                switch($statusBimbingan) {
                                    case 'acc':
                                        $badgeClass = 'badge bg-success text-white';
                                        break;
                                    case 'revisi':
                                        $badgeClass = 'badge bg-danger text-white';
                                        break;
                                    case 'pending':
                                        $badgeClass = 'badge bg-warning text-dark';
                                        break;
                                    default:
                                        $badgeClass = 'badge bg-secondary text-white'; // Default badge color
                                        break;
                                }
                            @endphp
                        
                            <span class="badge {{ $badgeClass }}">
                                {{ ucfirst($statusBimbingan) }}
                            </span>
                        </h5>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow  border border-primary">
                    <div class="card-header">
                        <i class="bi bi-calendar-event"></i> Terakhir Bimbingan
                    </div>
                    <div class="card-body ">
                        <h5 class="fw-bold">{{ $terakhirBimbingan->created_at ?? '-' }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-border-0">
                    <div class="card-header">
                        <h5 class="fw-semibold m-0 text-primary"><i class="bi bi-bookmarks"></i> Judul Skripsi Disetujui</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Judul</th>
                                        <th>Tanggal Diajukan</th>
                                        <th>Status</th>
                                        <th>DPS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($judulDiterima)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $judulDiterima->mahasiswa->nama }}</td>
                                        <td>{{ $judulDiterima->mahasiswa->nim }}</td>
                                        <td class="fw-bold fs-6">{{ strtoupper($judulDiterima->judul_skripsi) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($judulDiterima->created_at)->format('j F Y') }}</td>
                                        <td><span class="badge bg-success">Disetujui</span></td>
                                        <td>{{ $judulDiterima->mahasiswa->pembimbing->user->name }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="fw-bold m-0 text-white"><i class="bi bi-calendar2"></i> Jadwal Ujian</h5>
                    </div>
                    <div class="card-body mt-4">
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Penguji 1</th>
                                        <th>Penguji 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalUjian as $index => $jadwal)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $jadwal->mahasiswa->nama }}</td>
                                            <td>{{ $jadwal->mahasiswa->nim }}</td>
                                            <td>{{ $jadwal->judul }}</td>
                                            <td>{{ $jadwal->kategori }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('j F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
                                            <td>
                                                {{ $jadwal->penguji1->user->name }}
                                            </td>
                                            <td>
                                                {{ $jadwal->penguji2->user->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    @if (auth()->user()->role == 'pembimbing')
    <div class="mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow  border border-primary">
                    <div class="card-header">
                        <i class="bi bi-book text-primary"></i> Jumlah Mahasiswa
                    </div>
                    <div class="card-body ">
                        <h5 class="fw-bold">{{ $jumlahMahasiswaBimbingan }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow  border border-danger">
                    <div class="card-header">
                        <i class="bi bi-check-circle  text-danger"></i> Jumlah Sidang Proposal
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold"> {{ $jumlahSidangProposal }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow  border border-success">
                    <div class="card-header">
                        <i class="bi bi-calendar-event  text-success"></i> Jumlah Sidang Pendadaran
                    </div>
                    <div class="card-body ">
                        <h5 class="fw-bold">{{ $jumlahSidangPendadaran }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="fw-bold m-0 text-white"><i class="bi bi-calendar2"></i> Jadwal Menguji</h5>
                    </div>
                    <div class="card-body mt-4">
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Penguji 1</th>
                                        <th>Penguji 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($jadwalMenguji as $item)
                                       <tr>
                                           <td>{{ $loop->iteration }}</td>
                                           <td>{{ $item->mahasiswa->user->name }}</td>
                                           <td>{{ $item->mahasiswa->nim }}</td>
                                           <td>{{ $item->mahasiswa->judulSkripsi->judul_skripsi }}</td>
                                           <td>{{ $item->kategori }}</td>
                                           <td>{{ $item->tanggal }}</td>
                                           <td>{{ $item->waktu }}</td>
                                           <td>
                                               {{ $item->penguji1->user->name }}
                                           </td>
                                           <td>
                                               {{ $item->penguji2->user->name }}
                                           </td>
                                          
                                       </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
