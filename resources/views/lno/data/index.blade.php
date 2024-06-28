@extends('layouts.dashboard')

@section('content')
<div class="mt-4">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="mahasiswa-tab" data-bs-toggle="tab" data-bs-target="#mahasiswa" type="button" role="tab" aria-controls="mahasiswa" aria-selected="true">Mahasiswa</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dosen-tab" data-bs-toggle="tab" data-bs-target="#dosen" type="button" role="tab" aria-controls="dosen" aria-selected="false">Dosen</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
            <div class="d-flex justify-content-between align-items-center my-3">
                <button class="btn btn-primary me-2">Tambah Baru</button>
                <div>
                    <span>Total Mahasiswa: 12</span>
                  
                </div>
            </div>
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>203200169</td>
                                    <td>M.Haikal Jawahir</td>
                                    <td>Penerapan Customer Relationship Management (CRM) dalam Pengembangan Sistem Informasi Travel Berbasis Web (Studi Kasus: CV. Mandiri Tour & Travel Subang)</td>
                                    <td>Andri Pramuntadi, M.Kom</td>
                                    <td>Aktif</td>
                                    <td>
                                       <div class="d-flex">
                                        <a href="#" class="btn btn-sm btn-primary me-2">Edit</a>
                                        <a href="#" class="btn btn-sm btn-warning me-2">Detail</a>
                                        <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                       </div>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
            <div class="d-flex justify-content-between align-items-center my-3">
                <button class="btn btn-primary me-2">Tambah Baru</button>
                <div>
                    <span>Total Dosen: 12</span>
                  
                </div>
            </div>
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Judul</th>
                                    <th>Dosen Pembimbing</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>203200169</td>
                                    <td>M.Haikal Jawahir</td>
                                    <td>Penerapan Customer Relationship Management (CRM) dalam Pengembangan Sistem Informasi Travel Berbasis Web (Studi Kasus: CV. Mandiri Tour & Travel Subang)</td>
                                    <td>Andri Pramuntadi, M.Kom</td>
                                    <td>Aktif</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-sm btn-primary me-2">Edit</a>
                                            <a href="#" class="btn btn-sm btn-warning me-2">Detail</a>
                                            <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                                           </div>
                                    </td>
                                </tr>
                                <!-- Add more rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
