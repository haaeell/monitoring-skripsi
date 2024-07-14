@extends('layouts.dashboard')

@section('content')
    @if (Auth::user()->role == 'mahasiswa')
        @if ($jumlahBimbingan < 8)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading"><i class="bi bi-info-circle-fill"></i> Perhatian!</h4>
                <p>Oops, Anda perlu menyelesaikan bimbingan yang diperlukan sebelum mendaftar seminar. Saat ini, jumlah
                    bimbingan yang Anda lakukan adalah {{ $jumlahBimbingan }}. Pastikan untuk menyelesaikan bimbingan yang
                    dibutuhkan dengan segera.</p>
                <hr>
                <p class="mb-0 fw-bold fs-6">Semangat dan terus berusaha!</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <div class="card shadow border-0">
                <div class="card-header">
                    <h4 class="text-primary fw-semibold mb-4"> Buat Jadwal Seminar</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jadwal-ujian.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="judul" name="judul"
                                    value="{{ $judulSkripsi ? $judulSkripsi->judul_skripsi : '' }}" readonly required>
                                @if ($judulSkripsi == null)
                                    <span class="text-danger">*Belum ada judul skripsi yang diterima</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control" id="kategori" name="kategori" required>
                                    <option value="Proposal">Proposal</option>
                                    <option value="Pendadaran">Pendadaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="col-md-6">
                                <label for="penguji1" class="form-label">Penguji 1 <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="penguji1" name="penguji1_id" required>
                                    <option value="">Pilih Penguji 1</option>
                                    @foreach ($penguji as $pembimbing)
                                        <option value="{{ $pembimbing->id }}">{{ $pembimbing->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="waktu" class="form-label">Waktu <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" id="waktu" name="waktu" required>
                            </div>
                            <div class="col-md-6">
                                <label for="penguji2" class="form-label">Penguji 2 <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" id="penguji2" name="penguji2_id" required>
                                    <option value="">Pilih Penguji 2</option>
                                    @foreach ($penguji as $pembimbing)
                                        <option value="{{ $pembimbing->id }}">{{ $pembimbing->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @endif

    @endif

    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'mahasiswa')
        <div class="card shadow border-0 mt-4">
            <div class="card-header">
                <h4 class="mb-4 text-primary fw-semibold">{{ Auth::user()->role == 'mahasiswa' ? 'Riwayat' : '' }} Pengajuan
                    Jadwal Seminar</h4>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hovered datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Ruangan</th>
                                <th>Penguji 1</th>
                                <th>Penguji 2</th>
                                <th>Status</th>
                                @if (Auth::user()->role == 'admin')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwalUjian as $index => $jadwal)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jadwal->judul }}</td>
                                    <td>{{ $jadwal->kategori }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
                                    <td>{{ $jadwal->ruangan }}</td>
                                    <td>{{ $jadwal->penguji1->nama }}</td>
                                    <td>{{ $jadwal->penguji2->nama }}</td>
                                    <td>
                                        @if ($jadwal->status == 'pending')
                                            <span class="badge bg-warning text-dark">{{ $jadwal->status }}</span>
                                        @elseif($jadwal->status == 'diterima')
                                            <span class="badge bg-success">{{ $jadwal->status }}</span>
                                        @elseif($jadwal->status == 'ditolak')
                                            <span class="badge bg-danger">{{ $jadwal->status }}</span>
                                        @endif
                                    </td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            @if ($jadwal->status == 'pending')
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#setujuiModal{{ $jadwal->id }}">
                                                        Setujui
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#tolakModal{{ $jadwal->id }}">
                                                        Tolak
                                                    </button>
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @foreach ($jadwalUjian as $jadwal)
            <!-- Modal Setujui -->
            <div class="modal fade" id="setujuiModal{{ $jadwal->id }}" tabindex="-1"
                aria-labelledby="setujuiModalLabel{{ $jadwal->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="setujuiModalLabel{{ $jadwal->id }}">Setujui Jadwal Ujian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('jadwal-ujian.setujui', $jadwal->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="ruangan{{ $jadwal->id }}" class="form-label">Ruangan</label>
                                    <input type="text" class="form-control" id="ruangan{{ $jadwal->id }}"
                                        name="ruangan">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Setujui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Tolak -->
            <div class="modal fade" id="tolakModal{{ $jadwal->id }}" tabindex="-1"
                aria-labelledby="tolakModalLabel{{ $jadwal->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tolakModalLabel{{ $jadwal->id }}">Tolak Jadwal Ujian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('jadwal-ujian.tolak', $jadwal->id) }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan Penolakan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    @endif


@endsection
