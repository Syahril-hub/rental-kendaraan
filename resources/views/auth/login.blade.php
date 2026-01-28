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

/* ✅ TAMBAHAN: Style untuk password toggle */
.password-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #64748b;
    cursor: pointer;
    padding: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.2s;
}

.password-toggle:hover {
    color: #4361EE;
}

.form-control-auth.with-icon {
    padding-right: 40px;
}
</style>

<div class="auth-container">
    <div class="auth-card">
        
        <h4>Masuk</h4>
        <p class="subtitle">Siap keliling Jogja lagi? Masuk untuk melanjutkan booking motor Anda.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label-auth">Email / No. WhatsApp</label>
                <input type="text" name="email" class="form-control form-control-auth" 
                       placeholder="contoh@email.com atau 08123456789" required>
            </div>

            {{-- ✅ PASSWORD DENGAN TOGGLE SHOW/HIDE --}}
            <div class="mb-4">
                <label class="form-label-auth">Password</label>
                <div class="password-wrapper">
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control form-control-auth with-icon" 
                           placeholder="Masukkan password" 
                           required>
                    <button type="button" 
                            class="password-toggle" 
                            id="togglePassword"
                            aria-label="Toggle password visibility">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember" style="font-size: 0.9rem;">
                    Ingatkan saya
                </label>
                <a href="#" class="float-end" style="font-size: 0.9rem; color: #4361EE; text-decoration: none;">
                    Lupa password?
                </a>
            </div>

            <button type="submit" class="btn-auth">Masuk</button>
        </form>

        <div class="divider">
            <span>CARA LAIN</span>
        </div>

        <button class="btn-google">
            <img src="https://www.google.com/favicon.ico" alt="Google" style="width: 18px; margin-right: 8px;">
            Masuk dengan Google
        </button>

        <div class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>

    </div>
</div>

{{-- ✅ JAVASCRIPT PASSWORD TOGGLE --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (togglePassword && password && eyeIcon) {
        togglePassword.addEventListener('click', function() {
            // Toggle type password/text
            const type = password.type === 'password' ? 'text' : 'password';
            password.type = type;
            
            // Toggle icon
            if (type === 'password') {
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            } else {
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            }
        });
    }
});
</script>

@endsection
