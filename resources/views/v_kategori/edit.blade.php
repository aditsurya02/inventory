@extends('layouts')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Kategori</div>
                    <div class="card-body">
                        <form action="{{ route('kategori.update', $rsetKategori->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <input type="text" name="deskripsi" value="{{ $rsetKategori->deskripsi }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select name="kategori" class="form-control" required>
                                    <option value="M" {{ $rsetKategori->kategori == 'M' ? 'selected' : '' }}>Barang Modal</option>
                                    <option value="A" {{ $rsetKategori->kategori == 'A' ? 'selected' : '' }}>Alat</option>
                                    <option value="BHP" {{ $rsetKategori->kategori == 'BHP' ? 'selected' : '' }}>Bahan Habis Pakai</option>
                                    <option value="BTHP" {{ $rsetKategori->kategori == 'BTHP' ? 'selected' : '' }}>Bahan Tidak Habis Pakai</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection