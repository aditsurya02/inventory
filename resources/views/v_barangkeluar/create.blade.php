@extends('layouts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Barang Keluar</div>
                    <div class="card-body">

                        <form action="{{ route('barangkeluar.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="font-weight">Tanggal Keluar:</label>
                                <input type="date" name="tgl_keluar" class="form-control @error('tgl_keluar') is-invalid @enderror" 
                                    value="{{ old('tgl_keluar') }}" placeholder="Masukkan Tanggal" required>
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="qty_keluar">Jumlah Keluar:</label>
                                <input type="number" name="qty_keluar" class="form-control @error('qty_keluar') is-invalid @enderror" 
                                    value="{{ old('qty_keluar') }}" required>
                                @error('qty_keluar')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                @enderror    
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang:</label>
                                <select name="barang_id" class="form-control" required>
                                    <option value="" selected disabled>Pilih Barang</option>
                                    @foreach ($barangOptions as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->merk }} - {{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="{{ route('barangkeluar.index') }}">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
