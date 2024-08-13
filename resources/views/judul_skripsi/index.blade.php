@extends('layouts.dashboard')

@section('content')
    <div class="">
        @if (Auth::user()->role == 'mahasiswa')
            <div class="card mb-3 shadow border-0">
                <div class="card-header">
                    <h5 class="fw-semibold m-0 text-primary">Pengajuan Judul Skripsi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengajuan-skripsi.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-fill text-primary"></i></span>
                                        <input type="text" class="form-control" id="nama"
                                            value="{{ Auth::user()->name }}" name="nama" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i
                                                class="bi bi-person-badge text-primary"></i></span>
                                        <input type="text" class="form-control"
                                            value="{{ Auth::user()->mahasiswa->nim }}" id="nim" name="nim"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="angkatan" class="form-label">Angkatan <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-calendar text-primary"></i></span>
                                        <input type="number" class="form-control" id="angkatan"
                                            value="{{ Auth::user()->mahasiswa->angkatan }}" name="angkatan" readonly>
                                    </div>
                                </div>
                            </div>
                            @foreach ($dpsList as $dps)
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="dps_{{ $dps->id }}" class="form-label">DPS {{ $loop->iteration }}
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i
                                                    class="bi bi-calendar text-primary"></i></span>
                                            <select class="form-select" id="dps_{{ $dps->id }}" name="dps">
                                                @foreach ($dpsList as $option)
                                                    <option value="{{ $option->id }}"
                                                        {{ $dps->id == $option->id ? 'selected' : '' }}>
                                                        {{ $option->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="judul_skripsi" class="form-label">Judul Skripsi <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i
                                                class="bi bi-journal-text text-primary"></i></span>
                                        <textarea class="form-control" rows="3" id="judul_skripsi" name="judul_skripsi" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="abstrak" class="form-label">Abstrak <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i
                                                class="bi bi-journal-text text-primary"></i></span>
                                        <textarea class="form-control" rows="10" id="abstrak" name="abstrak" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @endif
        <div class="card shadow border-0">
            <div class="card-header">
                <h5 class="fw-semibold text-primary m-0">Riwayat Pengajuan Judul Skripsi</h5>
            </div>
            <div class="card-body">
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pembimbing')
                    <form method="GET" action="{{ route('judul-skripsi.index') }}">
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
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Angkatan</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Judul Skripsi</th>
                                <th>Status</th>
                                <th>DPS</th>
                                @if (Auth::user()->role == 'pembimbing')
                                    <th>Abstrak</th>
                                @elseif(Auth::user()->role == 'admin')
                                    <th>Abstrak</th>
                                    <th>Aksi</th>
                                @else
                                    <th>Abstrak</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $previousNIM = null;
                            @endphp

                            @foreach ($riwayatPengajuanSkripsi->groupBy('mahasiswa.nim') as $nim => $items)
                                <tr>
                                    <td rowspan="{{ $items->count() }}">{{ $items->first()->mahasiswa->nim }}</td>
                                    <td rowspan="{{ $items->count() }}">{{ $items->first()->mahasiswa->nama }}</td>
                                    <td rowspan="{{ $items->count() }}">{{ $items->first()->mahasiswa->angkatan }}</td>

                                    @foreach ($items as $index => $item)
                                        @if ($index > 0)
                                <tr>
                            @endif

                            <td>{{ $item->created_at->isoFormat('dddd, D MMMM Y') }}</td>

                            <td>{{ $item->judul_skripsi }}</td>
                            <td>
                                @if ($item->status == 'pending')
                                    <span class="badge bg-warning">{{ $item->status }}</span>
                                @elseif ($item->status == 'diterima')
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                @elseif ($item->status == 'ditolak')
                                    <span class="badge bg-danger">{{ $item->status }}</span>
                                    <div>
                                        <small>Catatan: {{ $item->catatan_ditolak }}</small>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $item->mahasiswa->pembimbing->user->name ?? $item->dps }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td>{{ $item->abstrak }}</td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <div class="d-flex">
                                            <!-- Button to trigger the modal -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#approvalModal">
                                                Setujui
                                            </button>
                                            <!-- Approval Modal -->
                                            <div class="modal fade" id="approvalModal" tabindex="-1"
                                                aria-labelledby="approvalModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="approvalModalLabel">Pilih Dosen
                                                                Penguji</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('pengajuan-skripsi.approve', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <input type="hidden" value="{{ $item->dps }}" name="dps">
                                                                    <input type="hidden" value="{{ $item->mahasiswa_id }}" name="user_id">
                                                                    <label for="penguji1" class="form-label">Dosen Penguji
                                                                        1</label>
                                                                    <select name="penguji1_id" id="penguji1"
                                                                        class="form-select" required>
                                                                        <option value="" disabled selected>Pilih
                                                                            Dosen Penguji 1</option>
                                                                        @foreach ($dpsList as $d)
                                                                            <option value="{{ $d->id }}">
                                                                                {{ $d->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="penguji2_id" class="form-label">Dosen Penguji
                                                                        2</label>
                                                                    <select name="penguji2_id" id="penguji2"
                                                                        class="form-select" required>
                                                                        <option value="" disabled selected>Pilih
                                                                            Dosen Penguji 2</option>
                                                                        @foreach ($dpsList as $d)
                                                                            <option value="{{ $d->id }}">
                                                                                {{ $d->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal{{ $item->id }}">
                                                Tolak
                                            </button>
                                        </div>
                                    @endif
                                </td>
                            @else
                                <td>{{ $item->abstrak }}</td>
                            @endif

                            @if ($index > 0)
                                </tr>
                            @endif
                            @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
