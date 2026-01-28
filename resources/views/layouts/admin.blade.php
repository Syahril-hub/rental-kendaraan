<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<div class="d-flex min-vh-100">

    {{-- Sidebar --}}
    <div class="bg-dark text-white p-3" style="width: 250px;">
        <h5 class="mb-4 fw-bold">
            <i class="bi bi-speedometer2 me-2"></i>Admin Panel
        </h5>

        <ul class="nav flex-column gap-2">
            {{-- ✅ DASHBOARD - TAMBAHAN BARU! --}}
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link text-white {{ request()->is('admin/dashboard') ? 'bg-primary rounded' : '' }}">
                    <i class="bi bi-grid-fill me-2"></i> Dashboard
                </a>
            </li>

            {{-- KENDARAAN --}}
            <li class="nav-item">
                <a href="{{ route('admin.kendaraan.index') }}"
                   class="nav-link text-white {{ request()->is('admin/kendaraan*') ? 'bg-primary rounded' : '' }}">
                    <i class="bi bi-bicycle me-2"></i> Kendaraan
                </a>
            </li>

            {{-- PESANAN --}}
            <li class="nav-item">
                <a href="{{ route('admin.pesanan.index') }}"
                   class="nav-link text-white {{ request()->is('admin/pesanan*') ? 'bg-primary rounded' : '' }}">
                    <i class="bi bi-calendar-check me-2"></i> Pesanan
                </a>
            </li>

            {{-- LOGOUT --}}
            <li class="nav-item mt-auto pt-3 border-top border-secondary">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger w-100">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    {{-- Content --}}
    <div class="flex-fill">
        <nav class="navbar navbar-light bg-light px-4 shadow-sm">
            <span class="navbar-text fw-semibold">
                @yield('header', 'Dashboard')
            </span>
            <span class="text-muted small">
                <i class="bi bi-person-circle me-1"></i> Admin
            </span>
        </nav>

        <main class="p-4 bg-light" style="min-height: calc(100vh - 56px);">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
