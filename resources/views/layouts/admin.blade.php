<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex min-vh-100">

    {{-- Sidebar --}}
    <div class="bg-dark text-white p-3" style="width: 240px;">
        <h5 class="mb-4">Admin Panel</h5>

        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a href="{{ route('admin.kendaraan.index') }}"
                   class="nav-link text-white">
                    Kendaraan
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pesanan.index') }}"
                   class="nav-link text-white">
                    Pesanan
                </a>
            </li>
            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-sm btn-danger w-100">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    {{-- Content --}}
    <div class="flex-fill">
        <nav class="navbar navbar-light bg-light px-4">
            <span class="navbar-text">
                @yield('header', 'Dashboard')
            </span>
        </nav>

        <main class="p-4">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
