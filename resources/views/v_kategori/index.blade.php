@extends('layouts') <!-- Assuming you have a layout named 'app.blade.php' -->

@section('content')
    <div class="container">
        <div class="row justify-content-center"> <!-- Tambahkan kelas justify-content-center di sini -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Kategori</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('Gagal'))
                            <div class="alert alert-danger mt-3">
                                {{ session('Gagal') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-8 justify-content-end">
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-2">Tambah Kategori</a>
                            </div>
                            <div class="col-md-4 justify-content-end">
                                <form action="{{ route('kategori.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ request()->input('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                        @if(request()->filled('search'))
                                            <div class="input-group-append">
                                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr>

                        

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Deskripsi</th>
                                    <th>Ket. Kategori</th>
                                    <th>Kode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rsetKategori as $kategori)
                                    <tr>
                                        <td>{{ ($rsetKategori->currentPage() -1) * $rsetKategori->perPage() + $loop->index + 1 }}</td>
                                        <td>{{ $kategori->deskripsi }}</td>
                                        <td>{{ $kategori->ketKategori }}</td>
                                        <td>{{ $kategori->kategori }}</td>
                                        <td>
                                            <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            
                                            <!-- Form untuk handle delete -->
                                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $rsetKategori->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('Gagal'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('Gagal') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

@endsection
