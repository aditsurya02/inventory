@extends('layouts') <!-- Assuming you have a layout named 'app.blade.php' -->

@section('content')
<div class="container">
        <div class="row justify-content-center"> <!-- Tambahkan kelas justify-content-center di sini -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Barang</div>
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
                                <a href="{{ route('barang.create') }}" class="btn btn-primary mb-2">Tambah Barang</a>
                            </div>
                            <div class="col-md-4 justify-content-end">
                                <form action="{{ route('barang.index') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request()->input('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                                        </div>
                                        @if(request()->filled('search'))
                                            <div class="input-group-append">
                                                <a href="{{ route('barang.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i></a>
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
                            <th>NO</th>
                            <th>MERK</th>
                            <th>SERI</th>
                            <th>SPESIFIKASI</th>
                            <th>STOK</th>
                            <th>KATEGORI</th>
                            <th>FOTO</th>
                            <th style="width: 15%">AKSI</th>


                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($rsetBarang as $rowbarang)
                                <tr>
                                    <td>{{ ($rsetBarang->currentPage() -1) * $rsetBarang->perPage() + $loop->index + 1 }}</td>
                                    <td>{{ $rowbarang->merk  }}</td>
                                    <td>{{ $rowbarang->seri  }}</td>
                                    <td>{{ $rowbarang->spesifikasi  }}</td>
                                    <td>{{ $rowbarang->stok  }}</td>
                                    <td>{{ $rowbarang->kategori->deskripsi  }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/foto/'.$rowbarang->foto) }}" class="rounded" style="width: 150px">
                                    </td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('barang.show', $rowbarang->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('barang.edit', $rowbarang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            
                                            <!-- Form untuk handle delete -->
                                        <form action="{{ route('barang.destroy', $rowbarang->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                            
                                    </td>
                                </tr>
                            @empty
                                <div class="alert">
                                    Data barang belum tersedia!
                                </div>
                            @endforelse
                        </tbody>
                    
                    </table>
                {!! $rsetBarang->links('pagination::bootstrap-5') !!}

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
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

@endsection