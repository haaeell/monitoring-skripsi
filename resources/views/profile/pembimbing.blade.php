@extends('layouts.dashboard')

@section('content')
    <div class="card mb-4">
        <h5 class="card-header">Profil Pembimbing</h5>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                <img src="{{ $pembimbing->photo ? asset($pembimbing->photo) : asset('default-avatar.png') }}" alt="Photo"
                    class="img-thumbnail" style="width: 150px;">
            </div>

            <div class="mb-3 row">
                <label for="nik" class="col-md-2 col-form-label">NIK</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $pembimbing->nik }}" id="nik" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nama" class="col-md-2 col-form-label">Nama</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $pembimbing->nama }}" id="nama" readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-md-2 col-form-label">Jenis Kelamin</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $pembimbing->jenis_kelamin }}" id="jenis_kelamin"
                        readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-md-2 col-form-label">Email</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $pembimbing->user->email }}" id="email"
                        readonly />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="telp" class="col-md-2 col-form-label">Telepon</label>
                <div class="col-md-10">
                    <input class="form-control" type="text" value="{{ $pembimbing->telp }}" id="telp" readonly />
                </div>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#editPembimbingProfileModal">
                Edit Profile
            </button>
        </div>
    </div>

    <!-- Pembimbing Profile Details -->

    <!-- Edit Pembimbing Profile Modal -->
    <div class="modal fade" id="editPembimbingProfileModal" tabindex="-1" aria-labelledby="editPembimbingProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('profile.pembimbing.update', $pembimbing->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPembimbingProfileModalLabel">Edit Profile Pembimbing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                        </div>

                        <!-- Form fields for Pembimbing details -->
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ $pembimbing->nik }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $pembimbing->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" {{ $pembimbing->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki
                                </option>
                                <option value="P" {{ $pembimbing->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $pembimbing->user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="telp" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="telp" name="telp"
                                value="{{ $pembimbing->telp }}" required>
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
