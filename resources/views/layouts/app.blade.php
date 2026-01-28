<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ED.RENT - Rental Motor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-blue: #4361EE;
            --primary-blue-hover: #3651D4;
            --success-green: #16a34a;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --bg-light: #f8fafc;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
        }

        /* Navbar Custom */
        .navbar-custom {
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand-custom {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue) !important;
            letter-spacing: -0.5px;
        }

        .nav-link-custom {
            color: var(--text-dark) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.2s;
        }

        .nav-link-custom:hover {
            color: var(--primary-blue) !important;
        }

        .btn-primary-custom {
            background: var(--primary-blue);
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary-custom:hover {
            background: var(--primary-blue-hover);
            transform: translateY(-1px);
        }

        .btn-outline-primary-custom {
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            background: white;
            transition: all 0.2s;
        }

        .btn-outline-primary-custom:hover {
            background: var(--primary-blue);
            color: white;
        }

        /* Footer */
        footer {
            background: white;
            border-top: 1px solid var(--border-color);
            margin-top: 80px;
            padding: 40px 0 20px;
        }

        footer h6 {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        footer a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        footer a:hover {
            color: var(--primary-blue);
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-blue);
        }

        /* Utilities */
        .text-primary-custom {
            color: var(--primary-blue) !important;
        }

        .bg-primary-custom {
            background: var(--primary-blue) !important;
        }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand-custom" href="/">ED.RENT</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link-custom" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-custom" href="{{ route('kendaraan.index') }}">Pilih Kendaraan</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link-custom" href="{{ route('user.pesanan.index') }}">Daftar Pesanan</a>
                        </li>
                        <li class="nav-item ms-2">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary-custom btn-sm">
                                    Keluar
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary-custom btn-sm">
                                Masuk
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand mb-3">ED.RENT</div>
                    <p class="text-muted">
                        Pilihan terlengkap, harga transparan, dan layanan 24 jam. 
                        Siap menemani setiap petualangan Anda.
                    </p>
                </div>

                <div class="col-lg-2 col-md-4 mb-4">
                    <h6>Kontak</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Chat Admin</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 mb-4">
                    <h6>Social Media</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Instagram</a></li>
                        <li class="mb-2"><a href="#">Facebook</a></li>
                    </ul>
                </div>
            </div>

            <hr class="my-4">

            <div class="text-center text-muted">
                <small>©2025 ED.RENT. All rights reserved</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>