@extends('layouts.dashboard')

@section('content')
   <div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-semibold m-0">Riwayat Bimbingan Skripsi</h4>
        <a href="{{ route('cetak-pdf') }}" class="btn btn-primary" style="float: right">Cetak PDF</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Bimbingan ke</th>
                        <th>Pembahasan Mahasiswa</th>
                        <th>Pembahasan Dosen</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($bimbingan->sortBy('created_at') as $item)
                       <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $item->pembahasan_mhs }}</td>
                          <td>{{ $item->pembahasan_dosen }}</td>
                          <td>{{ $item->created_at->format('d-m-Y') }}</td>
                       </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
