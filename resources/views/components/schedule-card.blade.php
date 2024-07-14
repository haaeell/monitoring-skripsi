<div class="card shadow border-0">
    <div class="card-header">
        <h4 class="fw-semibold m-0">{{ $title }}</h4>
        <a href="#" class="btn btn-primary float-start mt-3" data-bs-toggle="modal" data-bs-target="#{{ $createModalId }}">Tambah Baru</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table datatable" id="{{ $tableId }}">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Judul Skripsi</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Ruangan</th>
                        <th>Penguji</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $category }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->waktu }}</td>
                            <td>{{ $item->ruangan }}</td>
                            <td>
                                <ul>
                                    <li>{{ $item->penguji1->user->name }}</li>
                                    <li>{{ $item->penguji2->user->name }}</li>
                                </ul>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#{{ $editModalIdPrefix . $item->id }}">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{ $deleteModalIdPrefix . $item->id }}">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
