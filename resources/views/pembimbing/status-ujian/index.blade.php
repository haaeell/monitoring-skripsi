@extends('layouts.dashboard')

@section('content')
<div class="card shadow border-0">
    <div class="card-header">
        <h5 class="fw-semibold text-primary m-0">Riwayat Pengajuan Judul Skripsi</h5>
    </div>
    <div class="card-body">
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pembimbing')
            <form method="GET" action="{{ route('status-ujian.index') }}">
                <div class="mb-3">
                    <label for="angkatan" class="form-label">Filter Angkatan</label>
                    <select class="form-select" id="angkatan" name="angkatan" onchange="this.form.submit()">
                        <option value="">Semua Angkatan</option>
                        @foreach ($angkatanOptions as $angkatan)
                            <option value="{{ $angkatan }}"
                                {{ request('angkatan') == $angkatan ? 'selected' : '' }}>
                                {{ $angkatan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        @endif
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ujianMahasiswaBimbingan as $ujian)
                        <tr>
                            <td>{{ $ujian->id }}</td>
                            <td>{{ $ujian->mahasiswa->nama }}</td>
                            <td>{{ $ujian->judul }}</td>
                            <td>{{ $ujian->kategori }}</td>
                            <td>{{ $ujian->tanggal }}</td>
                            <td>{{ $ujian->waktu }}</td>
                            <td>{{ $ujian->status }}</td>
                            <td>
                                <form action="{{ route('status-ujian.update', $ujian->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select name="status" class="form-select" onchange="this.form.submit()">
                                            <option value="revisi" {{ $ujian->status == 'revisi' ? 'selected' : '' }}>Revisi</option>
                                            <option value="lulus" {{ $ujian->status == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                            <option value="mengulang" {{ $ujian->status == 'mengulang' ? 'selected' : '' }}>Mengulang</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
