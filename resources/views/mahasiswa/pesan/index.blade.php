@extends('layouts.dashboard')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <div class="row mt-4">
        @if ($bimbingan->isEmpty())
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Belum Ada Balasan Dari Dosen Pembimbing</h4>
                    <p>Saat ini, belum terdapat balasan dari dosen pembimbing terkait bimbingan skripsi Anda. Pastikan telah mengirimkan bimbingan dan bersiap untuk menunggu respons dari dosen.</p>
                    <hr>
                    <p class="mb-0">Jika memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi dosen pembimbing Anda.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
           <div class="col-md-4">
            <a href="{{ url('/bimbingan-skripsi') }}" class="btn btn-outline-primary btn-lg" role="button">Ajukan Bimbingan Sekarang</a>
           </div>
        @else
            @foreach ($bimbingan as $item)
                <div class="col-md-12">
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <div class="mb-1 row">
                                @php
                                    $notification = Auth::user()->unreadNotifications->firstWhere('data.bimbingan_id', $item->id);
                                    $isNew = $notification ? true : false;
                                @endphp
                               
                                <div class="col-sm-10"> <span class="badge bg-danger">{{ $isNew ? 'Baru' : '' }}</span>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label fw-bold">Tanggal</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">: {{ Carbon::parse($item->created_at)->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label fw-bold">File</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">: <a href="{{ $item->file }}" target="_blank">Lihat File</a></p>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label fw-bold">Pembahasan Mahasiswa</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">: {{ $item->pembahasan_mhs }}</p>
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <label class="col-sm-2 col-form-label fw-bold">Pembahasan Dosen</label>
                                <div class="col-sm-10">
                                    <p class="form-control-plaintext">: {{ $item->pembahasan_dosen }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
