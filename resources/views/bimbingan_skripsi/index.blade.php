@extends('layouts.dashboard')

@section('content')
    {{-- PEMBIMBING --}}
    @if (Auth::user()->role == 'pembimbing')
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="fw-semibold m-0"> Monitoring Bimbingan Skripsi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bimbingan-skripsi.index') }}" method="GET">
                    <div class="mb-3">
                        <label for="mahasiswa" class="form-label">Pilih Mahasiswa</label>
                        <select class="form-select" id="mahasiswa" name="mahasiswa_id" required>
                            <option value="">Pilih Mahasiswa</option>
                            @foreach ($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Lihat Bimbingan</button>
                </form>

                @if (isset($bimbinganSkripsi))
                    <div class="table-responsive mt-4">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Pembahasan Mahasiswa</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bimbinganSkripsi as $item)
                                    <tr>
                                        <td>{{ $item->mahasiswa->nim }}</td>
                                        <td>{{ $item->mahasiswa->nama }}</td>
                                        <td>{{ $item->pembahasan_mhs }}</td>
                                        <td><a href="{{ asset($item->file) }}" target="_blank">Lihat File</a></td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge bg-warning text-dark">{{ $item->status }}</span>
                                            @elseif($item->status == 'acc')
                                                <span class="badge bg-success">{{ $item->status }}</span>
                                            @elseif($item->status == 'revisi')
                                                <span class="badge bg-danger">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @if ($item->status == 'pending')
                                                    <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal"
                                                        data-bs-target="#pesanModal{{ $item->id }}">Balas</a>
                                                @endif
                                                <a href="#" class="btn btn-danger me-2">Hapus</a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Pesan Modal -->
                                    <div class="modal fade" id="pesanModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="pesanModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="pesanModalLabel{{ $item->id }}">Buat
                                                        Pesan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('bimbingan-skripsi.update', $item->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Nama Mahasiswa</label>
                                                            <input type="text" class="form-control" id="name"
                                                                value="{{ $item->mahasiswa->nama }}" required readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="judulSkripsi" class="form-label">Judul
                                                                Skripsi</label>
                                                            <input type="text" class="form-control" id="judulSkripsi"
                                                                value="{{ $item->mahasiswa->judulSkripsi->judul_skripsi }}"
                                                                required readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pembahasan_mahasiswa" class="form-label">Pembahasan
                                                                Mahasiswa</label>
                                                            <textarea class="form-control" id="pembahasan_mahasiswa" name="pembahasan_mhs" rows="3" readonly required>{{ $item->pembahasan_mhs }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pembahasan_dosen" class="form-label">Pembahasan
                                                                Dosen</label>
                                                            <textarea class="form-control" id="pembahasan_dosen" name="pembahasan_dosen" rows="3" required></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">status
                                                            </label>
                                                            <select class="form-control" name="status" id="">
                                                                <option value="acc">ACC</option>
                                                                <option value="revisi">Revisi</option>
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-center">-- Pilih Mahasiswa untuk melihat bimbingan --</p>
                @endif
            </div>
        </div>
    @endif




    {{-- MAHASISWA --}}
    @if (Auth::user()->role == 'mahasiswa')
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="fw-semibold  m-0">Bimbingan</h4>
                <p>Nama Pembimbing : <span class="fw-bold">{{ Auth::user()->mahasiswa->pembimbing->nama }}</span> </p>

                <h4 class="fw-semibold m-0">Judul Skripsi:</h4>
                <p class="m-0">{{ $judulSkripsi->judul_skripsi ?? '' }} </p>
                @if ($judulSkripsi == null)
                    <span class="text-danger">*Belum ada judul skripsi yang diterima silakan ajukan judul terlebih
                        dahulu!</span>
                    <div class="col-md-3">
                        <a href="/judul-skripsi" class="btn btn-outline-primary d-block mt-4">Ajukan Judul Skripsi</a>
                    </div>
                @endif
            </div>
            @if ($judulSkripsi != null)
                <div class="card-body">
                    <form action="{{ route('bimbingan-skripsi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mahasiswa_id" value="{{ Auth::user()->mahasiswa->id }}">
                        <div class="form-group">
                            <label for="" class="form-label fw-bold d-block">Pilih file pdf</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".pdf"
                                required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="" class="form-label fw-bold">Pembahasan Mahasiswa</label>
                            <textarea id="" cols="30" rows="10" class="form-control" name="pembahasan_mhs">Pembahasan Mahasiswa</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                        <button class="btn btn-danger mt-3">Batal</button>
                    </form>

                </div>
            @endif
        </div>
    @endif
@endsection
