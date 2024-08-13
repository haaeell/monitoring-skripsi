@extends('layouts.dashboard')

@section('content')
    <div class="mt-4">


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="mahasiswa-tab" data-bs-toggle="tab" data-bs-target="#mahasiswa"
                    type="button" role="tab" aria-controls="mahasiswa" aria-selected="true">Mahasiswa</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dosen-tab" data-bs-toggle="tab" data-bs-target="#dosen" type="button"
                    role="tab" aria-controls="dosen" aria-selected="false">Dosen</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="mahasiswa" role="tabpanel" aria-labelledby="mahasiswa-tab">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <button class="btn btn-primary text-white me-2" data-bs-toggle="modal"
                        data-bs-target="#createMahasiswaModal">Tambah Baru</button>
                    <div>
                        <span>Total Mahasiswa: {{ $totalMahasiswa }}</span>
                    </div>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <form method="GET" action="{{ route('users.index') }}">
                            <div class="mb-3">
                                <label for="angkatan" class="form-label">Filter Angkatan</label>
                                <select class="form-select" id="angkatan" name="angkatan" onchange="this.form.submit()">
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
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Status Proposal</th>
                                        <th>Status Pendadaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mahasiswas as $mahasiswa)
                                        <tr>
                                            <td>{{ $mahasiswa->nim }}</td>
                                            <td>{{ $mahasiswa->nama }}</td>
                                            <td>
                                                {{ $mahasiswa->status_sidang['proposal'] ? 'Sudah' : 'Belum' }}
                                            </td>
                                            <td>
                                                {{ $mahasiswa->status_sidang['pendadaran'] ? 'Sudah' : 'Belum' }}
                                            </td>
                                            <td>
                                                <div class="d-flex text-white">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editMahasiswaModal{{ $mahasiswa->id }}"
                                                        class="btn btn-sm btn-warning me-2">Edit</a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#readMahasiswaModal{{ $mahasiswa->id }}"
                                                        class="btn btn-sm btn-secondary me-2">Detail</a>
                                                    <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Detail Mahasiswa -->
                                        <div class="modal fade" id="readMahasiswaModal{{ $mahasiswa->id }}" tabindex="-1"
                                            aria-labelledby="readMahasiswaModalLabel{{ $mahasiswa->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="readMahasiswaModalLabel{{ $mahasiswa->id }}">Detail
                                                            Mahasiswa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <dl class="row">
                                                            <dt class="col-sm-4">NIM</dt>
                                                            <dd class="col-sm-8">{{ $mahasiswa->nim }}</dd>
                                                            <dt class="col-sm-4">Nama</dt>
                                                            <dd class="col-sm-8">{{ $mahasiswa->nama }}</dd>
                                                            <dt class="col-sm-4">Angkatan</dt>
                                                            <dd class="col-sm-8">{{ $mahasiswa->angkatan }}</dd>
                                                            <dt class="col-sm-4">Jenis Kelamin</dt>
                                                            <dd class="col-sm-8">
                                                                {{ $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                            </dd>
                                                            <dt class="col-sm-4">Email</dt>
                                                            <dd class="col-sm-8">{{ $mahasiswa->email }}</dd>
                                                            <dt class="col-sm-4">Telepon</dt>
                                                            <dd class="col-sm-8">{{ $mahasiswa->telp }}</dd>
                                                            <dt class="col-sm-4">Alamat</dt>
                                                            <dd class="col-sm-8">{{ $mahasiswa->alamat }}</dd>
                                                          
                                                          
                                                        </dl>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Edit Mahasiswa -->
                                        <div class="modal fade" id="editMahasiswaModal{{ $mahasiswa->id }}" tabindex="-1"
                                            aria-labelledby="editMahasiswaModalLabel{{ $mahasiswa->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editMahasiswaModalLabel{{ $mahasiswa->id }}">Edit
                                                            Mahasiswa</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}"
                                                            method="POST" id="editMahasiswaForm">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="edit_nim" class="form-label">NIM</label>
                                                                <input type="text" class="form-control" id="edit_nim"
                                                                    name="nim" value="{{ $mahasiswa->nim }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_nama" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="edit_nama"
                                                                    name="nama" value="{{ $mahasiswa->nama }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_angkatan"
                                                                    class="form-label">Angkatan</label>
                                                                <input type="number" class="form-control"
                                                                    id="edit_angkatan" name="angkatan"
                                                                    value="{{ $mahasiswa->angkatan }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_jenis_kelamin" class="form-label">Jenis
                                                                    Kelamin</label>
                                                                <select class="form-control" id="edit_jenis_kelamin"
                                                                    name="jenis_kelamin" required>
                                                                    <option value="L"
                                                                        {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                        Laki-laki
                                                                    </option>
                                                                    <option value="P"
                                                                        {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                        Perempuan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_email" class="form-label">Email</label>
                                                                <input type="email" class="form-control"
                                                                    id="edit_email" name="email"
                                                                    value="{{ $mahasiswa->email }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_telp" class="form-label">Telepon</label>
                                                                <input type="text" class="form-control" id="edit_telp"
                                                                    name="telp" value="{{ $mahasiswa->telp }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_alamat" class="form-label">Alamat</label>
                                                                <textarea class="form-control" id="edit_alamat" name="alamat" required>{{ $mahasiswa->alamat }}</textarea>
                                                            </div>
                                                
                                                           
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>





            <div class="tab-pane fade" id="dosen" role="tabpanel" aria-labelledby="dosen-tab">
                <div class="d-flex justify-content-between align-items-center my-3">
                    <a class="btn btn-primary me-2 text-white" data-bs-toggle="modal"
                        data-bs-target="#createPembimbingModal">Tambah
                        Baru</a>
                    <div>
                        <span>Total Dosen: {{ $totalPembimbing }}</span>
                    </div>
                </div>
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telpon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembimbings as $pembimbing)
                                        <tr>
                                            <td>{{ $pembimbing->nik }}</td>
                                            <td>{{ $pembimbing->nama }}</td>
                                            <td>{{ $pembimbing->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                            <td>{{ $pembimbing->telp }}</td>
                                            <td>
                                                <div class="d-flex text-white">
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#editPembimbingModal{{ $pembimbing->id }}"
                                                        class="btn btn-sm btn-warning me-2">Edit</a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#readPembimbingModal{{ $pembimbing->id }}"
                                                        class="btn btn-sm btn-secondary me-2">Detail</a>
                                                    <a data-bs-toggle="modal" data-bs-target="#deletePembimbingModal"
                                                        class="btn btn-sm btn-danger me-2">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="readPembimbingModal{{ $pembimbing->id }}"
                                            tabindex="-1"
                                            aria-labelledby="readPembimbingModalLabel{{ $pembimbing->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="readPembimbingModalLabel{{ $pembimbing->id }}">Detail
                                                            Pembimbing</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <dl class="row">
                                                            <dt class="col-sm-4">NIK</dt>
                                                            <dd class="col-sm-8"> : {{ $pembimbing->nik }}</dd>

                                                            <dt class="col-sm-4">Nama</dt>
                                                            <dd class="col-sm-8"> : {{ $pembimbing->nama }}</dd>

                                                            <dt class="col-sm-4">Jenis Kelamin</dt>
                                                            <dd class="col-sm-8"> :
                                                                {{ $pembimbing->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                                            </dd>

                                                            <dt class="col-sm-4">Telepon</dt>
                                                            <dd class="col-sm-8"> : {{ $pembimbing->telp }}</dd>
                                                        </dl>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
    <!-- Modal Read Pembimbing -->

    <div class="modal fade" id="readPembimbingModal" tabindex="-1" aria-labelledby="readPembimbingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="readPembimbingModalLabel">Detail
                    Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">NIK</dt>
                    <dd class="col-sm-8"> : {{ $pembimbing->nik }}</dd>

                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8"> : {{ $pembimbing->nama }}</dd>

                    <dt class="col-sm-4">Jenis Kelamin</dt>
                    <dd class="col-sm-8"> :
                        {{ $pembimbing->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </dd>

                    <dt class="col-sm-4">Telepon</dt>
                    <dd class="col-sm-8"> : {{ $pembimbing->telp }}</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

                                        <!-- Modal Edit Pembimbing -->
                                        <div class="modal fade" id="editPembimbingModal{{ $pembimbing->id }}"
                                            tabindex="-1"
                                            aria-labelledby="editPembimbingModalLabel{{ $pembimbing->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editPembimbingModalLabel{{ $pembimbing->id }}">Edit
                                                            Pembimbing</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('pembimbing.update', $pembimbing->id) }}"
                                                            method="POST" id="editPembimbingForm">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="edit_nik" class="form-label">NIK</label>
                                                                <input type="text" class="form-control" id="edit_nik"
                                                                    name="nik" value="{{ $pembimbing->nik }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_nama" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="edit_nama"
                                                                    name="nama" value="{{ $pembimbing->nama }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_jenis_kelamin" class="form-label">Jenis
                                                                    Kelamin</label>
                                                                <select class="form-control" id="edit_jenis_kelamin"
                                                                    name="jenis_kelamin" required>
                                                                    <option value="L"
                                                                        {{ $pembimbing->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                        Laki-laki
                                                                    </option>
                                                                    <option value="P"
                                                                        {{ $pembimbing->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                        Perempuan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="edit_telp" class="form-label">Telepon</label>
                                                                <input type="text" class="form-control" id="edit_telp"
                                                                    name="telp" value="{{ $pembimbing->telp }}"
                                                                    required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Delete Pembimbing -->
                                        <div class="modal fade" id="deletePembimbingModal{{ $pembimbing->id }}"
                                            tabindex="-1"
                                            aria-labelledby="deletePembimbingModalLabel{{ $pembimbing->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="deletePembimbingModalLabel{{ $pembimbing->id }}">
                                                            Konfirmasi
                                                            Hapus Pembimbing</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Anda yakin ingin menghapus data pembimbing ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('pembimbing.destroy', $pembimbing->id) }}"
                                                            method="POST" id="deletePembimbingForm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="createMahasiswaModal" tabindex="-1" aria-labelledby="createMahasiswaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMahasiswaModalLabel">Tambah Mahasiswa Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mahasiswa.store') }}" method="POST" id="createMahasiswaForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="number" class="form-control" id="angkatan" name="angkatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telp" name="telp" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal Create Pembimbing -->
    <div class="modal fade" id="createPembimbingModal" tabindex="-1" aria-labelledby="createPembimbingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPembimbingModalLabel">Tambah Pembimbing Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pembimbing.store') }}" method="POST" id="createPembimbingForm">
                        @csrf
                        <div class="mb-3">
                            <label for="create_nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="create_nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="create_nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="create_nama" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="create_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="create_jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="create_telp" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="create_telp" name="telp" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


  


@endsection
