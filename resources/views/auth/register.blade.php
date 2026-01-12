@extends('layouts.app')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">

                <h4 class="fw-bold mb-1">Buat Akun</h4>
                <p class="text-muted mb-4">
                    Daftar untuk mulai sewa kendaraan dengan mudah dan cepat.
                </p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Masukkan nama lengkap"
                            required>
                    </div>

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
                            placeholder="Minimal 8 karakter"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Daftar
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Login</a>
                    </small>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
