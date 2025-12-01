@extends('layouts.admin')

@section('title', 'Dashboard - ATR BPN')

@section('content')

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="page-title">
        <i class="fas fa-chart-line" style="color: #10b981;"></i>
        Dashboard
    </div>
    <div class="page-subtitle">Selamat datang di Sistem Manajemen Arsip ATR/BPN Garut</div>
</div>

<!-- ===== STATISTICS CARDS ===== -->
<div class="row g-4 mb-32">
    <!-- Card: Total Buku Tanah -->
    <div class="col-md-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div style="font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                            Total Buku Tanah
                        </div>
                        <div style="font-size: 28px; font-weight: 700; color: #111827;">
                            {{ $totalBukuTanah }}
                        </div>
                    </div>
                    <div style="width: 56px; height: 56px; background-color: #d1fae5; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #10b981;">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card: Total Surat Ukur -->
    <div class="col-md-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div style="font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                            Total Surat Ukur
                        </div>
                        <div style="font-size: 28px; font-weight: 700; color: #111827;">
                            {{ $totalSuratUkur }}
                        </div>
                    </div>
                    <div style="width: 56px; height: 56px; background-color: #dbeafe; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #3b82f6;">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card: Total Peminjam -->
    <div class="col-md-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div style="font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                            Total Peminjam
                        </div>
                        <div style="font-size: 28px; font-weight: 700; color: #111827;">
                            {{ $totalPeminjam }}
                        </div>
                    </div>
                    <div style="width: 56px; height: 56px; background-color: #fce7f3; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #ec4899;">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card: Total Pengembalian -->
    <div class="col-md-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div style="font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                            Total Pengembalian
                        </div>
                        <div style="font-size: 28px; font-weight: 700; color: #111827;">
                            {{ $totalPengembalian }}
                        </div>
                    </div>
                    <div style="width: 56px; height: 56px; background-color: #fef3c7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #f59e0b;">
                        <i class="fas fa-undo"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== RECENT DATA TABLE ===== -->
<div class="card">
    <div class="card-header">
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h5 style="margin: 0; font-weight: 600; color: #111827; font-size: 16px;">
                    <i class="fas fa-list me-2"></i>Data Buku Tanah Terbaru
                </h5>
            </div>
            <a href="{{ route('admin.bukutanah.index') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-right me-1"></i>Lihat Semua
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>No Buku Tanah</th>
                        <th>Nama Pemilik</th>
                        <th>Desa / Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Jenis Pelayanan</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukuTanah as $item)
                        <tr>
                            <td>
                                <span style="font-weight: 600; color: #111827;">{{ $item->no_buku_tanah }}</span>
                            </td>
                            <td>{{ $item->nama_pemilik }}</td>
                            <td>{{ $item->desa_kelurahan }}</td>
                            <td>{{ $item->kecamatan }}</td>
                            <td>{{ $item->jenis_pelayanan }}</td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $item->status_berkas }}</span>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.bukutanah.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 32px; color: #9ca3af;">
                                <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ===== CUSTOM STYLES ===== -->
<style>
    .mb-32 {
        margin-bottom: 32px;
    }

    .page-header {
        margin-bottom: 32px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 14px;
    }
</style>

@endsection
