<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ATR BPN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            min-height: 100vh;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .dashboard-header {
            background: white;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .dashboard-header h1 {
            color: #059669;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .dashboard-header p {
            color: #666;
            font-size: 16px;
            margin-bottom: 0;
        }

        .user-info {
            font-size: 14px;
            color: #999;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #eee;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 12px;
            color: #059669;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #059669;
        }

        .menu-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .menu-header {
            background: #f8f9fa;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #333;
            font-size: 16px;
        }

        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            padding: 15px 25px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            transition: background 0.3s;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .menu-item:hover {
            background: #f8f9fa;
        }

        .menu-item a {
            color: #059669;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            width: 100%;
            transition: color 0.3s;
        }

        .menu-item a:hover {
            color: #047857;
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .info-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .info-text {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .logout-btn {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
            margin-top: 15px;
            width: 100%;
        }

        .logout-btn:hover {
            background: #991b1b;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                padding: 20px;
            }

            .dashboard-header h1 {
                font-size: 24px;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-number {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1><i class="fas fa-chart-bar"></i> Dashboard</h1>
            <p>Sistem Manajemen Arsip ATR/BPN</p>
            <div class="user-info">
                👤 Selamat datang, <strong>{{ Auth::user()->name }}</strong> ({{ Auth::user()->email }})
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-label">Total Buku Tanah</div>
                <div class="stat-number">{{ $totalBukuTanah }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="stat-label">Total Surat Ukur</div>
                <div class="stat-number">{{ $totalSuratUkur }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-label">Total Peminjam</div>
                <div class="stat-number">{{ $totalPeminjam }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-undo"></i>
                </div>
                <div class="stat-label">Total Pengembalian</div>
                <div class="stat-number">{{ $totalPengembalian }}</div>
            </div>
        </div>

        <!-- Menu & Info -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-8">
                <div class="menu-card">
                    <div class="menu-header">
                        <i class="fas fa-bars"></i> Menu Utama
                    </div>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="{{ route('admin.bukutanah.index') }}">
                                <i class="fas fa-book"></i>
                                Kelola Buku Tanah
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.suratukur.index') }}">
                                <i class="fas fa-file-pdf"></i>
                                Kelola Surat Ukur
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.peminjam.index') }}">
                                <i class="fas fa-users"></i>
                                Data Peminjam
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.pengembalian.index') }}">
                                <i class="fas fa-undo"></i>
                                Pengembalian Dokumen
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="info-card">
                    <div class="info-title">
                        <i class="fas fa-lightbulb"></i> Informasi
                    </div>
                    <p class="info-text">
                        Gunakan menu di atas untuk mengakses modul utama. Kelola data arsip dengan mudah dan aman.
                    </p>
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
