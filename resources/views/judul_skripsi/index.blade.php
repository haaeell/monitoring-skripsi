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
                <div class="table-responsive">
                    @if($riwayatPengajuanSkripsi->isEmpty())
                        <p class="text-center">Belum ada riwayat pengajuan skripsi</p>
                    @else
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Angkatan</th>
                                    <th>Judul Skripsi</th>
                                    <th>Status</th>
                                    <th>DPS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPengajuanSkripsi as $item)
                                    <tr>
                                        <td>{{ $item->created_at->translatedFormat('d F Y H:i') }}</td>
                                        <td>{{ $item->mahasiswa->nim }}</td>
                                        <td>{{ $item->mahasiswa->nama }}</td>
                                        <td>{{ $item->mahasiswa->angkatan }}</td>
                                        <td>{{ $item->judul_skripsi }}</td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge bg-warning">{{ $item->status }}</span>
                                            @elseif ($item->status == 'diterima')
                                                <span class="badge bg-success">{{ $item->status }}</span>
                                            @elseif ($item->status == 'ditolak')
                                                <span class="badge bg-danger">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->mahasiswa->pembimbing->user->name }}</td>
                                        <td>
                                         @if (Auth::user()->role == 'admin')
                                         @if ($item->status == 'pending')
                                         <div class="d-flex">
                                          <form action="{{ route('pengajuan-skripsi.approve', $item->id) }}" method="POST" class="me-2">
                                              @csrf
                                              <button type="submit" class="btn btn-sm btn-primary">Setujui</button>
                                          </form>
                                          <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                  data-bs-target="#rejectModal{{ $item->id }}">
                                              Tolak
                                          </button>
                                      </div>
                                         @endif
                                         @endif
                                        </td>
                                    </tr>
                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1"
                                         aria-labelledby="rejectModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $item->id }}">Tolak Pengajuan Skripsi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('pengajuan-skripsi.reject', $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="catatan_ditolak" class="form-label">Catatan Penolakan</label>
                                                            <textarea class="form-control" id="catatan_ditolak" name="catatan_ditolak" rows="3" required></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
