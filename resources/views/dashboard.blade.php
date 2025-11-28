@extends('layouts/app')

@section('content')
<style>
    * {
        --primary-green: #10b981;
        --primary-green-dark: #059669;
        --secondary-blue: #3b82f6;
        --secondary-orange: #f97316;
        --dark-bg: #0f172a;
        --card-bg: #ffffff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --border-light: #e2e8f0;
    }

    .welcome-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        color: white;
        padding: 50px 40px;
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.2);
        animation: slideUp 0.6s ease-out;
        position: relative;
        overflow: hidden;
    }

    .welcome-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .welcome-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -30%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-header h1 {
        font-size: 42px;
        font-weight: 900;
        margin-bottom: 12px;
        letter-spacing: -1px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .welcome-header h1 i {
        font-size: 48px;
        animation: bounce 2s infinite;
    }

    .welcome-header p {
        font-size: 18px;
        opacity: 0.95;
        margin-bottom: 0;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        border: 1px solid #f0f4f8;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        display: flex;
        align-items: center;
        gap: 24px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #3b82f6);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        box-shadow: 0 16px 32px rgba(16, 185, 129, 0.12);
        transform: translateY(-8px);
        border-color: #e0f2fe;
    }

    .stat-icon {
        width: 90px;
        height: 90px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        color: white;
        flex-shrink: 0;
        position: relative;
    }

    .stat-icon::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.1);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover .stat-icon::after {
        opacity: 1;
    }

    .stat-icon.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-icon.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    }

    .stat-icon.orange {
        background: linear-gradient(135deg, #f97316 0%, #c2410c 100%);
    }

    .stat-content h3 {
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stat-content .number {
        font-size: 36px;
        font-weight: 900;
        color: #10b981;
        line-height: 1;
    }

    .stat-content p {
        font-size: 13px;
        color: #94a3b8;
        margin-top: 8px;
    }

    .info-section {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        border: 1px solid #f0f4f8;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }

    .info-section h2 {
        color: #10b981;
        font-size: 28px;
        font-weight: 900;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 3px solid #10b981;
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: -0.5px;
    }

    .info-section h2 i {
        font-size: 32px;
    }

    .info-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
    }

    .info-item {
        padding: 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
        border-left: 5px solid #10b981;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
        position: relative;
        overflow: hidden;
    }

    .info-item::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.05), transparent);
        border-radius: 50%;
    }

    .info-item:hover {
        background: linear-gradient(135deg, #ecfdf5 0%, #dcfce7 100%);
        transform: translateX(8px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.1);
    }

    .info-item i {
        color: #10b981;
        margin-right: 12px;
        font-size: 22px;
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        background: rgba(16, 185, 129, 0.1);
        border-radius: 10px;
    }

    .info-item strong {
        color: #1e293b;
        font-size: 16px;
        font-weight: 700;
        display: inline-block;
        margin-left: 8px;
    }

    .info-item p {
        margin-top: 12px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
        padding-left: 52px;
        margin-left: -52px;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-8px);
        }
    }

    @media (max-width: 768px) {
        .welcome-header {
            padding: 35px 25px;
        }

        .welcome-header h1 {
            font-size: 28px;
            gap: 10px;
        }

        .welcome-header h1 i {
            font-size: 32px;
        }

        .welcome-header p {
            font-size: 15px;
        }

        .stats-container {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .stat-card {
            padding: 20px;
            gap: 16px;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            font-size: 32px;
        }

        .stat-content .number {
            font-size: 28px;
        }

        .info-section {
            padding: 25px;
        }

        .info-section h2 {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .info-list {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .info-item {
            padding: 20px;
        }
    }
</style>

<!-- Welcome Header -->
<div class="welcome-header">
    <div class="welcome-content">
        <h1><i class="fas fa-hand-peace"></i> Selamat Datang di ATR BPN</h1>
        <p>Sistem Manajemen Perizinan - Arsip Tanah dan Surat Ukur</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-book"></i>
        </div>
        <div class="stat-content">
            <h3><i class="fas fa-bookmark"></i> Buku Tanah</h3>
            <div class="number">{{ $totalBukuTanah }}</div>
            <p>Dokumen terdaftar</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-file-alt"></i>
        </div>
        <div class="stat-content">
            <h3><i class="fas fa-file"></i> Surat Ukur</h3>
            <div class="number">{{ $totalSuratUkur }}</div>
            <p>Dokumen tersimpan</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fas fa-user-group"></i>
        </div>
        <div class="stat-content">
            <h3><i class="fas fa-people-group"></i> Peminjam</h3>
            <div class="number">{{ $totalPeminjam }}</div>
            <p>Pengguna aktif</p>
        </div>
    </div>
</div>

<!-- Information Section -->
<div class="info-section">
    <h2><i class="fas fa-sparkles"></i> Menu Utama</h2>
    <div class="info-list">
        <div class="info-item">
            <i class="fas fa-book"></i>
            <strong>Kelola Buku Tanah</strong>
            <p>Tambah, edit, dan kelola data buku tanah arsip dengan mudah dan terstruktur</p>
        </div>
        <div class="info-item">
            <i class="fas fa-file-alt"></i>
            <strong>Kelola Surat Ukur</strong>
            <p>Kelola semua dokumen surat ukur dengan sistem yang terorganisir dan efisien</p>
        </div>
        <div class="info-item">
            <i class="fas fa-user-tie"></i>
            <strong>Data Peminjam</strong>
            <p>Pantau dan kelola data seluruh peminjam dengan informasi lengkap dan akurat</p>
        </div>
        <div class="info-item">
            <i class="fas fa-undo-alt"></i>
            <strong>Pengembalian Dokumen</strong>
            <p>Catat dan kelola proses pengembalian dokumen dengan transparansi penuh</p>
        </div>
        <div class="info-item">
            <i class="fas fa-sliders-h"></i>
            <strong>Manajemen Sistem</strong>
            <p>Kelola semua aspek sistem dengan kontrol penuh dan pengaturan yang fleksibel</p>
        </div>
        <div class="info-item">
            <i class="fas fa-lock"></i>
            <strong>Keamanan Data</strong>
            <p>Data Anda dilindungi dengan enkripsi tingkat tinggi dan sistem keamanan berlapis</p>
        </div>
    </div>
</div>
@endsection()
