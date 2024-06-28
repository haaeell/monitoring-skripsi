@extends('layouts.dashboard')

@section('content')
    {{-- PEMBIMBING --}}
    @if (Auth::user()->role == 'pembimbing')
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="fw-semibold m-0"> Monitoring Bimbingan Skripsi</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                                    <td><a href="{{asset($item->file)}}">Lihat File</a></td>
                                    <td><span class="badge bg-success">{{ $item->status }}</span></td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                           @if ($item->status == 'belum dibaca')
                                           <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#pesanModal{{ $item->id }}">Balas</a>
                                           @endif
                                            <a href="#" class="btn btn-danger me-2">Hapus</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Pesan Modal -->
                                <div class="modal fade" id="pesanModal{{ $item->id }}" tabindex="-1" aria-labelledby="pesanModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="pesanModalLabel{{ $item->id }}">Buat Pesan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('bimbingan-skripsi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Nama Mahasiswa</label>
                                                        <input type="text" class="form-control" id="name" value="{{ $item->mahasiswa->nama }}" required readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="judulSkripsi" class="form-label">Judul Skripsi</label>
                                                        <input type="text" class="form-control" id="judulSkripsi" value="{{ $item->mahasiswa->judul_ta }}" required readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pembahasan_mahasiswa" class="form-label">Pembahasan Mahasiswa</label>
                                                        <textarea class="form-control" id="pembahasan_mahasiswa" name="pembahasan_mhs" rows="3" readonly required>{{ $item->pembahasan_mhs }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="pembahasan_dosen" class="form-label">Pembahasan Dosen</label>
                                                        <textarea class="form-control" id="pembahasan_dosen" name="pembahasan_dosen" rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    {{-- MAHASISWA --}}
    @if (Auth::user()->role == 'mhs')
        <div class="card mt-4">
            <div class="card-header">
                <span class="text-danger">Ntar ini buat tampilan mahasiswa</span>
                <h4 class="fw-semibold  m-0">Bimbingan</h4>
                <p>Nama Pembimbing : {{Auth::user()->mahasiswa->pembimbing->nama}}</p>

                <h4 class="fw-semibold m-0">Judul Skripsi:</h4>
                <p class="m-0">{{Auth::user()->mahasiswa->judul_skripsi}}</p>
            </div>
            <div class="card-body">
                <form action="{{ route('bimbingan-skripsi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="mahasiswa_id" value="{{ Auth::user()->mahasiswa->id }}">
                    <div class="form-group">
                        <label for="" class="form-label fw-bold d-block">Pilih file pdf</label>
                        <input type="file" class="form-control" id="file" name="file" accept=".pdf" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="" class="form-label fw-bold">Pembahasan Mahasiswa</label>
                        <textarea id="" cols="30" rows="10" class="form-control" name="pembahasan_mhs">Pembahasan Mahasiswa</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Kirim</button>
                    <button class="btn btn-danger mt-3">Batal</button>
                </form>

            </div>
        </div>
    @endif
@endsection
