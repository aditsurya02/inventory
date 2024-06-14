@extends('layouts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Barang Masuk</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.update', $rsetBarangmasuk->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="tgl_masuk">Tanggal Masuk:</label>
                                <input type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk', $rsetBarangmasuk->tgl_masuk) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="qty_masuk">Qty Masuk:</label>
                                <input type="number" name="qty_masuk" class="form-control" value="{{ old('qty_masuk', $rsetBarangmasuk->qty_masuk) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="barang_id">Barang:</label>
                                <select name="barang_id" class="form-control" required>
                                    @foreach ($baranggOptions as $barang)
                                        <option value="{{ $barang->id }}" {{ $rsetBarangmasuk->barang_id == $barang->id ? 'selected' : '' }}>{{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
