@extends('layouts') <!-- Gantilah 'layouts.app' dengan layout yang sesuai -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Barang Masuk</div>
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

                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-primary mb-2">Tambah Barang Masuk</a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Quantity Masuk</th>
                                    <th>Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Barangmasuk as $barangmasuk)
                                    <tr>
                                        <td>{{ ($Barangmasuk->currentPage() -1) * $Barangmasuk->perPage() + $loop->index + 1 }}</td>
                                        <td>{{ $barangmasuk->tgl_masuk }}</td>
                                        <td>{{ $barangmasuk->qty_masuk }}</td>
                                        <td>{{ $barangmasuk->barang->merk }} - {{ $barangmasuk->barang->seri }}</td>
                                        <td>
                                            <a href="{{ route('barangmasuk.edit', $barangmasuk->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Form untuk handle delete -->
                                            <form action="{{ route('barangmasuk.destroy', $barangmasuk->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $Barangmasuk->links('pagination::bootstrap-4') }}
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
