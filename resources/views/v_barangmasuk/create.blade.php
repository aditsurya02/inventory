@extends('layouts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Barang Masuk</div>
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Masuk:</label>
                                <input type="date" name="tgl_masuk" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="qty_masuk">Qty Masuk:</label>
                                <input type="number" name="qty_masuk" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang:</label>
                                <select name="barang_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Barang</option>
                                    @foreach ($barangOptions as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->merk }} - {{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-secondary" href="{{ route('barangmasuk.index') }}">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection