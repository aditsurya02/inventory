@extends('layouts')

@section('content')
    <section class="hero py-5">
        <div class="container text-center">
            <h1 class="font-weight-bold">SIJA INVENTORY SYSTEM</h1>
        </div>
    </section>

    <section id="features" class="features py-5">
        <div class="container">
            <div class="row mt-4 d-flex">
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Kategori</h4>
                            <p class="flex-grow-1">Manage categories</p>
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary btn-sm mt-auto">View Categories</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Barang</h4>
                            <p class="flex-grow-1">Manage items</p>
                            <a href="{{ route('barang.index') }}" class="btn btn-outline-primary btn-sm mt-auto">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Barang Masuk</h4>
                            <p class="flex-grow-1">Track incoming items</p>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-outline-primary btn-sm mt-auto">View Incoming Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4 d-flex">
                    <div class="card border-0 shadow rounded flex-fill d-flex flex-column">
                        <div class="card-body text-center d-flex flex-column">
                            <h4 class="font-weight-bold">Barang Keluar</h4>
                            <p class="flex-grow-1">Track outgoing items</p>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-outline-primary btn-sm mt-auto">View Outgoing Items</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @guest
    <section class="cta py-5">
        <div class="container text-center">
            <h4>Ready to get started?</h2>
            <p>Sign up now and enjoy all the features.</p>
            <a href="{{ route('register') }}" class="btn btn-outline-primary">Sign Up</a>
            <a href="{{ route('login') }}" class="btn btn-primary">Sign In</a>
        </div>
    </section>
    @endguest

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