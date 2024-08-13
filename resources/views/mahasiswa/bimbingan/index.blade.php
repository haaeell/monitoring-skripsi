@extends('layouts.dashboard')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-semibold m-0"> Monitoring Bimbingan Skripsi</h4>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('bimbingan.index') }}">
            <div class="mb-3">
                <label for="angkatan" class="form-label">Filter Angkatan</label>
                <select class="form-select select2" id="angkatan" name="angkatan" onchange="this.form.submit()">
                    <option value="">Semua Angkatan</option>
                    @foreach ($angkatanOptions as $angkatan)
                        <option value="{{ $angkatan }}" {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                            {{ $angkatan }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Judul Skripsi</th>
                        <th>Keterangan</th>
                        <th>Jumlah Bimbingan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswaBimbingan as $item)
                    <tr>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judulSkripsi->judul_skripsi ?? '-'  }}</td>
                        <td>
                            @php
                                $status = $item->bimbinganSkripsi->last()->status ?? '-';
                                $badgeClass = '';
                                
                                switch($status) {
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
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        
                        <td>{{ $item->bimbinganSkripsi->count() }}</td>
                        <td>
                            <a href="/bimbingan-skripsi?mahasiswa_id={{ $item->id }}" class="btn btn-primary edit-keterangan" >Riwayat Bimbingan</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection




