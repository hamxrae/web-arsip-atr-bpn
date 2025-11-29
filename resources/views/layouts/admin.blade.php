<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .app-shell { display:flex; min-height:100vh; }
        .sidebar { width:220px; background:#0b5b2b; color:#fff; padding:20px 12px; }
        .sidebar .logo { font-weight:700; font-size:20px; display:flex; align-items:center; gap:10px; padding:8px 12px; }
        .sidebar a { color:rgba(255,255,255,0.9); text-decoration:none; display:block; padding:10px 12px; border-radius:6px; margin-bottom:6px; }
        .sidebar a:hover { background:rgba(255,255,255,0.04); }
        .main { flex:1; background:#f6f7f9; }
        .topbar { height:64px; display:flex; align-items:center; gap:12px; padding:10px 20px; background:#fff; border-bottom:1px solid #eee; }
        .search-box { flex:1; max-width:600px; }
        .content { padding:24px; }
        .card-clean { border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,0.04); background:#fff; }
    </style>
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12c0 4.418 3.582 8 8 8s8-3.582 8-8" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>ATR BPN</span>
            </div>
            <nav class="mt-3">
                <a href="{{ route('dashboard') }}"><i class="fas fa-chart-pie me-2"></i> Dashboard</a>
                <a href="{{ route('admin.bukutanah.index') }}"><i class="fas fa-book me-2"></i> Daftar Buku Tanah</a>
                <a href="{{ route('admin.suratukur.index') }}"><i class="fas fa-file-pdf me-2"></i> Daftar Surat Ukur</a>
                <a href="{{ route('admin.peminjam.index') }}"><i class="fas fa-users me-2"></i> Peminjam</a>
                <a href="{{ route('admin.pengembalian.index') }}"><i class="fas fa-undo me-2"></i> Pengembalian</a>
            </nav>
        </aside>

        <div class="main">
            <header class="topbar">
                <form class="search-box d-flex" action="" method="GET">
                    <input type="text" name="q" class="form-control" placeholder="Cari di sini...">
                    <button class="btn btn-success ms-2"><i class="fas fa-search"></i></button>
                </form>
                <div class="d-flex align-items-center" style="min-width:180px; justify-content:flex-end; gap:12px;">
                    <div class="text-muted">&nbsp;</div>
                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=0b5b2b&color=fff&rounded=true" width="32" height="32" style="border-radius:50%" alt="avatar">
                            <span class="ms-2">{{ Auth::user()->name ?? 'Admin' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
