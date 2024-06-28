@extends('layouts.dashboard')

@section('content')
<div class="row mt-4">
    <h3 class="fw-bold">Pesan Bimbingan</h3>
    <div class="col-md-12">
        <div class="card shadow mb-3">
            <div class="card-body">
                <div class="mb-1 row">
                    <label class="col-sm-2 col-form-label fw-bold">Bimbingan ke-</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">: 1</p>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label class="col-sm-2 col-form-label fw-bold">Tanggal</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">: 2 Januari 2024</p>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label class="col-sm-2 col-form-label fw-bold">Dokumen</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">: ini file</p>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label class="col-sm-2 col-form-label fw-bold">Pesan</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea laudantium, nam doloribus enim saepe alias sapiente inventore atque dolor temporibus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, dolor?</p>
                    </div>
                </div>
                <div class="mb-1 row">
                    <label class="col-sm-2 col-form-label fw-bold">Status</label>
                    <div class="col-sm-10">
                        <p class="form-control-plaintext">: 2 Januari 2024</p>
                    </div>
                </div>
                <button class="btn btn-primary float-end">Sudah dibaca</button>
            </div>
        </div>
    </div>
</div>
@endsection
