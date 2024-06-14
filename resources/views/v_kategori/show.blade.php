@extends('layouts')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Kategori</div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>ID:</strong>
                            {{ $rsetKategori->id }}
                        </div>
                        <div class="form-group">
                            <strong>Deskripsi:</strong>
                            {{ $rsetKategori->deskripsi }}
                        </div>
                        <div class="form-group">
                            <strong>Kategori:</strong>
                            {{ $rsetKategori->kategori }}
                        </div>
                        <a class="btn btn-primary" href="{{ route('kategori.index') }}">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection