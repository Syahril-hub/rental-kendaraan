@extends('layouts.app')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-1">Masuk</h4>
                <p class="text-muted mb-4">
                    Masuk untuk melanjutkan pemesanan kendaraan.
                </p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="contoh@email.com"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Masuk
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Daftar</a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
