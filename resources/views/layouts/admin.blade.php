<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - ATR BPN')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* ===== ROOT COLORS ===== */
        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
            --primary-light: #d1fae5;
            --sidebar-bg: #1f2937;
            --sidebar-hover: #374151;
            --topbar-bg: #ffffff;
            --content-bg: #f3f4f6;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            --card-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* ===== GLOBAL STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--content-bg);
        }

        /* ===== LAYOUT STRUCTURE ===== */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: #ffffff;
            padding: 24px 16px;
            overflow-y: auto;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin-bottom: 32px;
            font-weight: 700;
            font-size: 18px;
            border-radius: 8px;
            background: rgba(16, 185, 129, 0.1);
        }

        .sidebar-logo svg {
            width: 32px;
            height: 32px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu-item {
            margin-bottom: 8px;
        }

        .sidebar-menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .sidebar-menu-link:hover,
        .sidebar-menu-link.active {
            background-color: var(--sidebar-hover);
            color: #ffffff;
            padding-left: 20px;
        }

        .sidebar-menu-link i {
            width: 20px;
            text-align: center;
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background-color: var(--topbar-bg);
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            height: 72px;
            box-shadow: var(--card-shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left {
            flex: 1;
            max-width: 400px;
        }

        .topbar-search {
            display: flex;
            gap: 8px;
        }

        .topbar-search input {
            border-radius: 6px;
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            font-size: 14px;
        }

        .topbar-search input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            font-size: 14px;
            color: #374151;
        }

        /* ===== CONTENT AREA ===== */
        .content-wrapper {
            flex: 1;
            padding: 32px 24px;
            overflow-y: auto;
        }

        /* ===== CARDS ===== */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--card-shadow-lg);
        }

        .card-header {
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 12px 12px 0 0 !important;
            padding: 16px;
        }

        .card-body {
            padding: 24px;
        }

        /* ===== PAGE HEADER ===== */
        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 14px;
        }

        /* ===== BUTTONS ===== */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* ===== TABLES ===== */
        .table {
            margin-bottom: 0;
            font-size: 14px;
        }

        .table thead {
            background-color: #f9fafb;
        }

        .table thead th {
            border-bottom: 2px solid #e5e7eb;
            color: #374151;
            font-weight: 600;
            padding: 12px 16px;
        }

        .table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        /* ===== BADGES ===== */
        .badge {
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                width: 240px;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .content-wrapper {
                padding: 16px 12px;
            }

            .page-title {
                font-size: 20px;
            }

            .topbar-left {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- ===== SIDEBAR ===== -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <i class="fas fa-leaf"></i>
                <span>ATR BPN</span>
            </div>

            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-menu-link @if(request()->routeIs('dashboard')) active @endif">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.bukutanah.index') }}" class="sidebar-menu-link @if(request()->routeIs('admin.bukutanah.*')) active @endif">
                        <i class="fas fa-book"></i>
                        <span>Daftar Buku Tanah</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.suratukur.index') }}" class="sidebar-menu-link @if(request()->routeIs('admin.suratukur.*')) active @endif">
                        <i class="fas fa-file-pdf"></i>
                        <span>Daftar Surat Ukur</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.peminjam.index') }}" class="sidebar-menu-link @if(request()->routeIs('admin.peminjam.*')) active @endif">
                        <i class="fas fa-users"></i>
                        <span>Daftar Peminjam</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('admin.pengembalian.index') }}" class="sidebar-menu-link @if(request()->routeIs('admin.pengembalian.*')) active @endif">
                        <i class="fas fa-undo"></i>
                        <span>Pengembalian</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- ===== MAIN CONTENT ===== -->
        <div class="main-wrapper">
            <!-- ===== TOPBAR ===== -->
            <header class="topbar">
                <div class="topbar-left">
                    <form class="topbar-search">
                        <input type="text" placeholder="Cari data..." readonly>
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="topbar-right">
                    <div class="dropdown">
                        <div class="user-profile" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=10b981&color=fff&bold=true&size=128" alt="Avatar" class="user-avatar">
                            <div class="user-info">
                                <div style="font-weight: 600; color: #111827;">{{ Auth::user()->name ?? 'Admin' }}</div>
                                <div style="font-size: 12px; color: #6b7280;">Admin</div>
                            </div>
                        </div>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item" style="cursor: pointer;">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- ===== CONTENT ===== -->
            <main class="content-wrapper">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
