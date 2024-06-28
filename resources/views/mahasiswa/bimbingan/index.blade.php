@extends('layouts.dashboard')

@section('content')
   <div class="card mt-4">
    <div class="card-header">
        <h4 class="fw-semibold m-0"> Monitoring Bimbingan Skripsi</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Judul Skripsi</th>
                        <th>Jumlah Bimbingan</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($mahasiswaBimbingan as $item)
                       <tr>
                           <td>{{ $item->nim }}</td>
                           <td>{{ $item->nama }}</td>
                           <td>{{ $item->judul_ta }}</td>
                           <td>{{ $item->bimbinganSkripsi->count() }}</td>
                          
                       </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
