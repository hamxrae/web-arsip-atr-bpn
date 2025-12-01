@extends('layouts.admin')

@section('title', 'Data Pengembalian - ATR BPN')

@section('content')

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="page-title">
        <i class="fas fa-undo" style="color: #10b981;"></i>
        Data Pengembalian
    </div>
    <div class="page-subtitle">Manajemen data pengembalian arsip ATR/BPN</div>
</div>

<!-- ===== ALERTS ===== -->
@include('partials.alerts')

<!-- ===== STATISTICS CARDS ===== -->
<div class="row g-4 mb-32">
    <!-- Card: Total Pengembalian -->
    <div class="col-md-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div style="font-size: 12px; color: #6b7280; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                            Total Data
                        </div>
                        <div style="font-size: 28px; font-weight: 700; color: #111827;">
                            {{ $pengembalians->count() }}
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

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end;">
    <a href="{{ route('admin.pengembalian.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Pengembalian
    </a>
</div>

<!-- ===== DATA TABLE ===== -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>No Buku Tanah</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Waktu Pengembalian</th>
                        <th style="text-align: center; width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengembalians as $item)
                        <tr>
                            <td>
                                <span style="font-weight: 600; color: #111827;">{{ $item->nama }}</span>
                            </td>
                            <td>{{ $item->bukuTanah->no_buku_tanah ?? '-' }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktu_pengembalian)->format('d M Y H:i') }}</td>
                            <td style="text-align: center; display: flex; gap: 4px; justify-content: center;">
                                <a href="{{ route('admin.pengembalian.edit', $item->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pengembalian.destroy', $item->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 48px 16px; color: #9ca3af;">
                                <div style="font-size: 48px; margin-bottom: 12px;">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                <div style="font-weight: 500; color: #6b7280; font-size: 16px;">Tidak ada data</div>
                                <div style="font-size: 14px; color: #9ca3af; margin-top: 4px;">Silakan klik tombol tambah untuk menambahkan data baru</div>
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
