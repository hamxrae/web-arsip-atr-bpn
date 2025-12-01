@extends('layouts.admin')

@section('title', 'Detail Peminjam - ATR BPN')

@section('content')

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="page-title">
        <i class="fas fa-user" style="color: #10b981;"></i>
        Detail Peminjam
    </div>
    <div class="page-subtitle">Informasi lengkap data peminjam</div>
</div>

<!-- ===== ALERTS ===== -->
@include('partials.alerts')

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end; gap:8px;">
    <a href="{{ route('admin.peminjam.edit', $peminjam->id) }}" class="btn btn-warning">
        <i class="fas fa-edit me-1"></i>Edit
    </a>
    <a href="{{ route('admin.peminjam.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<!-- ===== DETAIL CARD ===== -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Foto Peminjam -->
            <div class="col-md-3 text-center mb-4">
                @if($peminjam->foto)
                    <img src="{{ asset('storage/peminjam/'.$peminjam->foto) }}" 
                         alt="Foto {{ $peminjam->nama_peminjam }}" 
                         style="width: 200px; height: 200px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                @else
                    <div style="width: 200px; height: 200px; background-color: #f3f4f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-user" style="font-size: 80px; color: #d1d5db;"></i>
                    </div>
                @endif
            </div>

            <!-- Detail Data -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted">Nama Peminjam</label>
                        <p class="fs-5 fw-bold">{{ $peminjam->nama_peminjam }}</p>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted">No HP</label>
                        <p class="fs-5 fw-bold">{{ $peminjam->no_hp }}</p>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted">Email</label>
                        <p class="fs-5 fw-bold">{{ $peminjam->email }}</p>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted">No Surat Tanah</label>
                        <p class="fs-5 fw-bold">{{ $peminjam->suratUkur->no_surat_tanah ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted">Ukuran Tanah</label>
                        <p class="fs-5 fw-bold">{{ $peminjam->suratUkur->ukuran_luar_tanah ?? '-' }}</p>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-muted">Tanggal Peminjaman</label>
                        <p class="fs-5 fw-bold">{{ \Carbon\Carbon::parse($peminjam->created_at)->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Action Buttons -->
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('admin.peminjam.edit', $peminjam->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Edit
            </a>
            <form action="{{ route('admin.peminjam.destroy', $peminjam->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash me-1"></i>Hapus
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
