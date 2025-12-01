@extends('layouts.admin')

@section('title', 'Detail Surat Ukur - ATR BPN')

@section('content')

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="page-title">
        <i class="fas fa-file-pdf" style="color: #10b981;"></i>
        Detail Surat Ukur
    </div>
    <div class="page-subtitle">Informasi lengkap data surat ukur</div>
</div>

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end; gap:8px;">
    <a href="{{ route('admin.suratukur.edit', $data->id) }}" class="btn btn-warning">
        <i class="fas fa-edit me-1"></i>Edit
    </a>
    <a href="{{ route('admin.suratukur.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<!-- ===== DETAIL CARD ===== -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="form-label text-muted">No Surat Tanah</label>
                <p class="fs-5 fw-bold">{{ $data->no_surat_tanah }}</p>
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label text-muted">Tahun</label>
                <p class="fs-5 fw-bold">{{ $data->tahun_tanah }}</p>
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label text-muted">Ukuran Luar Tanah</label>
                <p class="fs-5 fw-bold">{{ $data->ukuran_luar_tanah }}</p>
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label text-muted">No Buku Tanah</label>
                <p class="fs-5 fw-bold">{{ $data->bukuTanah->no_buku_tanah ?? '-' }}</p>
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label text-muted">Nama Pemilik</label>
                <p class="fs-5 fw-bold">{{ $data->bukuTanah->nama_pemilik ?? '-' }}</p>
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label text-muted">Tanggal Dibuat</label>
                <p class="fs-5 fw-bold">{{ \Carbon\Carbon::parse($data->created_at)->format('d M Y H:i') }}</p>
            </div>
        </div>

        <hr>

        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('admin.suratukur.edit', $data->id) }}" class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>Edit
            </a>
            <form action="{{ route('admin.suratukur.destroy', $data->id) }}" method="POST" style="display: inline;">
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
