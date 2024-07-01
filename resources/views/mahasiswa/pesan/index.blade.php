@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        @foreach ($bimbingan as $item)
            <div class="col-md-12">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <div class="mb-1 row">
                            @php
                            $notification = Auth::user()->unreadNotifications->firstWhere('data.bimbingan_id', $item->id);
                            $isNew = $notification ? true : false;
                            
                        @endphp
                        <label class="col-sm-2 col-form-label fw-bold">Bimbingan ke- </label>
                        
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">: {{ $loop->iteration }} <span class="badge bg-danger">{{ $isNew ? 'Baru' : '' }}</span></p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label fw-bold">Tanggal</label>
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">:{{ $item->created_at }}</p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label fw-bold">File</label>
                            <div class="col-sm-10">
                                <p class="form-control-plaintext">: <a href="{{ $item->file }}" target="_blank">Lihat
                                        File</a></p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label class="col-sm-2 col-form-label fw-bold">Pembahasan mahasisewa</label>
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
    </div>
@endsection
