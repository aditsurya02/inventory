@extends('layouts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Barang Masuk</div>
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('barangkeluar.update', $barangkeluar->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tgl_keluar">Tanggal Keluar:</label>
                                <input type="date" name="tgl_keluar" class="form-control" value="{{ old('tgl_keluar', $barangkeluar->tgl_keluar) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="qty_keluar">Qty Keluar:</label>
                                <input type="number" name="qty_keluar" class="form-control" value="{{ old('qty_keluar', $barangkeluar->qty_keluar) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang:</label>
                                <select name="barang_id" class="form-control" required>
                                    <option value="" selected disabled>Pilih Barang</option>
                                    @foreach ($barangOptions as $barang)
                                        <option value="{{ $barang->id }}" {{ $barangkeluar->barang_id == $barang->id ? 'selected' : '' }}>{{ $barang->merk }} - {{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
