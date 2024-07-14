@php
    $nimValue = isset($item) ? $item->nim : '';
    $namaValue = isset($item) ? $item->nama : '';
    $judulValue = isset($item) ? $item->judul : '';
    $tanggalValue = isset($item) ? $item->tanggal : '';
    $waktuValue = isset($item) ? $item->waktu : '';
    $ruanganValue = isset($item) ? $item->ruangan : '';
    $penguji1Value = isset($item) ? $item->penguji1_id : '';
    $penguji2Value = isset($item) ? $item->penguji2_id : '';
@endphp
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" id="nim" value="{{ $nimValue }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" id="nama" value="{{ $namaValue }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="judul" class="form-label">Judul Skripsi</label>
        <input type="text" name="judul" class="form-control" id="judul" value="{{ $judulValue }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{ $tanggalValue }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="waktu" class="form-label">Waktu</label>
        <input type="time" name="waktu" class="form-control" id="waktu" value="{{ $waktuValue }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="ruangan" class="form-label">Ruangan</label>
        <input type="text" name="ruangan" class="form-control" id="ruangan" value="{{ $ruanganValue }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="penguji1_id" class="form-label">Penguji 1</label>
        <select name="penguji1_id" class="form-select" id="penguji1_id" required>
            <option value="">Pilih Penguji 1</option>
            @foreach ($penguji as $p)
                <option value="{{ $p->id }}" {{ $penguji1Value == $p->id ? 'selected' : '' }}>{{ $p->user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="penguji2_id" class="form-label">Penguji 2</label>
        <select name="penguji2_id" class="form-select" id="penguji2_id" required>
            <option value="">Pilih Penguji 2</option>
            @foreach ($penguji as $p)
                <option value="{{ $p->id }}" {{ $penguji2Value == $p->id ? 'selected' : '' }}>{{ $p->user->name }}</option>
            @endforeach
        </select>
    </div>
</div>
