@extends('layouts.dashboard')

@section('content')
    <div class=" mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">Data Dosen</div>

                    <div class="card-body">
                     <p>
                        {{$jumlahDosen}}
                     </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">Data Mahasiswa</div>

                    <div class="card-body">
                     <p>
                        {{$jumlahMahasiswa}}
                     </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
