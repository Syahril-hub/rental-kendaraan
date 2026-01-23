@extends('layouts.app')

@section('content')

<style>
.auth-container {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

.auth-card {
    max-width: 450px;
    width: 100%;
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    padding: 2.5rem;
}

.auth-card h4 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.auth-card .subtitle {
    color: #64748b;
    margin-bottom: 2rem;
    font-size: 0.95rem;
}

.form-label-auth {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-control-auth {
    padding: 0.75rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.2s;
}

.form-control-auth:focus {
    border-color: #4361EE;
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
}

.btn-auth {
    background: #4361EE;
    color: white;
    padding: 0.875rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.2s;
    width: 100%;
}

.btn-auth:hover {
    background: #3651D4;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.divider {
    text-align: center;
    margin: 1.5rem 0;
    position: relative;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e2e8f0;
}

.divider span {
    background: white;
    padding: 0 1rem;
    position: relative;
    color: #64748b;
    font-size: 0.85rem;
}

.btn-google {
    background: white;
    border: 1px solid #e2e8f0;
    color: #1e293b;
    padding: 0.75rem;
    border-radius: 8px;
    font-weight: 600;
    width: 100%;
    transition: all 0.2s;
}

.btn-google:hover {
    border-color: #4361EE;
    background: #f8fafc;
}

.auth-footer {
    text-align: center;
    margin-top: 1.5rem;
    color: #64748b;
}

.auth-footer a {
    color: #4361EE;
    font-weight: 600;
    text-decoration: none;
}

.auth-footer a:hover {
    text-decoration: underline;
}

.password-hint {
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 0.25rem;
}
</style>

<div class="auth-container">
    <div class="auth-card">
        
        <h4>Buat Akun</h4>
        <p class="subtitle">Yuk daftar dulu! Isi data sekali, sewa motor kapan saja tanpa ribet saat liburan.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label-auth">Nama Lengkap</label>
                <input type="text" name="name" class="form-control form-control-auth" 
                       placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label-auth">No. WhatsApp</label>
                <input type="tel" name="phone" class="form-control form-control-auth" 
                       placeholder="08123456789" value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label-auth">Email</label>
                <input type="email" name="email" class="form-control form-control-auth" 
                       placeholder="contoh@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label-auth">Password</label>
                <input type="password" name="password" class="form-control form-control-auth" 
                       placeholder="Minimal 8 karakter" required>
                <div class="password-hint">Minimal 8 karakter</div>
            </div>

            <div class="mb-4">
                <label class="form-label-auth">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control form-control-auth" 
                       placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn-auth">Daftar</button>
        </form>

        <div class="divider">
            <span>CARA LAIN</span>
        </div>

        <button class="btn-google">
            <img src="https://www.google.com/favicon.ico" alt="Google" style="width: 18px; margin-right: 8px;">
            Masuk dengan Google
        </button>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>

    </div>
</div>

@endsection