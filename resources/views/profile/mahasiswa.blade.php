@extends('layouts.dashboard')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header text-center">Profil Mahasiswa</h5>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                <img src="{{ $mahasiswa->photo ? asset($mahasiswa->photo) : asset('default-avatar.png') }}" alt="Photo"
                    class="img-thumbnail" style="width: 150px;">
            </div>

            <div class="mb-3 row">
                <label for="nim" class="col-md-2 col-form-label">NIM</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->nim }}" id="nim" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->nama }}" id="nama" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="angkatan" class="col-md-2 col-form-label">Angkatan</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->angkatan }}" id="angkatan" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-md-2 col-form-label">Jenis Kelamin</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->jenis_kelamin }}" id="jenis_kelamin"
                        readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-md-2 col-form-label">Email</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->email }}" id="email" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="telp" class="col-md-2 col-form-label">Telepon</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->telp }}" id="telp" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->alamat }}" id="alamat" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="judul_ta" class="col-md-2 col-form-label">Judul TA</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $mahasiswa->judul_ta }}" id="judul_ta" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pembimbing" class="col-md-2 col-form-label">Pembimbing</label>
                <div class="col-md-10">
                    <input class="form-control" type="text"
                        value="{{ $mahasiswa->pembimbing ? $mahasiswa->pembimbing->nama : '-' }}" id="pembimbing"
                        readonly />
                </div>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#editMahasiswaProfileModal">
                Edit Profile
            </button>
        </div>
    </div>

    <div class="modal fade" id="editMahasiswaProfileModal" tabindex="-1" aria-labelledby="editMahasiswaProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('profile.mahasiswa.update', $mahasiswa->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMahasiswaProfileModalLabel">Edit Profile Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>

                        <!-- Form fields for Mahasiswa details -->
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim"
                                value="{{ $mahasiswa->nim }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $mahasiswa->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text" class="form-control" id="angkatan" name="angkatan"
                                value="{{ $mahasiswa->angkatan }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" {{ $mahasiswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki
                                </option>
                                <option value="P" {{ $mahasiswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $mahasiswa->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="telp" name="telp"
                                value="{{ $mahasiswa->telp }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $mahasiswa->alamat }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="judul_ta" class="form-label">Judul TA</label>
                            <input type="text" class="form-control" id="judul_ta" name="judul_ta"
                                value="{{ $mahasiswa->judul_ta }}">
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing_id" class="form-label">Dosen Pembimbing</label>
                            <select class="form-control" id="pembimbing_id" name="pembimbing_id">
                                <option value="">Pilih Dosen Pembimbing</option>
                                @foreach ($pembimbings as $pembimbing)
                                    <option value="{{ $pembimbing->id }}"
                                        {{ $mahasiswa->pembimbing_id == $pembimbing->id ? 'selected' : '' }}>
                                        {{ $pembimbing->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
