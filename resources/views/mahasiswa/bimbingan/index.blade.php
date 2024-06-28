@extends('layouts.dashboard')

@section('content')
    {{-- PEMBIMBING --}}
    <div class="card mt-4">
        <div class="card-header">
            <span class="text-danger">Ntar ini buat tampilan Pembimbing</span>
            <h4 class="fw-semibold m-0"> Monitoring Bimbingan Skripsi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Pesan</th>
                            <th>File</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>123456</td>
                            <td>Dhina</td>
                            <td>Catatan</td>
                            <td>File</td>
                            <td>12-12-2022</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#pesanModal">Buat Pesan</a>
                                    <a href="#" class="btn btn-danger me-2">Hapus</a>
                                    <a href="#" class="btn btn-success">Download</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pesanModal" tabindex="-1" aria-labelledby="pesanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pesanModalLabel">Buat Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">nama mahasiswa</label>
                            <input type="text" class="form-control" id="name" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="judulSkripsi" class="form-label">Judul Skripsi</label>
                            <input type="text" class="form-control" id="judulSkripsi" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File PDF</label>
                            <input type="file" class="form-control" id="file" accept=".pdf" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
    
    {{-- MAHASISWA --}}
    <div class="card mt-4">
        <div class="card-header">
            <span class="text-danger">Ntar ini buat tampilan mahasiswa</span>
            <h4 class="fw-semibold  m-0">Bimbingan</h4>
            <p>Nama Pembimbing : Dhina</p>

            <h4 class="fw-semibold m-0">Judul Skripsi:</h4>
            <p class="m-0">Rancang Bangun Sistem Monitoring Skripsi</p>
        </div>
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label for="" class="form-label fw-bold d-block">Pilih file pdf</label>
                    <input type="file" class="form-control" id="file" accept=".pdf" required>
                </div>
                <div class="form-group mt-3">
                    <label for="" class="form-label fw-bold">Tulis Pesan</label>
                    <textarea name="" id="" cols="30" rows="10" class="form-control">Catatan</textarea>
                </div>

                <button class="btn btn-primary mt-3">Kirim</button>
                <button class="btn btn-danger mt-3">Batal</button>
            </form>

        </div>
    </div>
    </div>
@endsection
