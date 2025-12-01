@extends('layouts.admin')

@section('title', 'Tambah Peminjam - ATR BPN')

@section('content')

@include('partials.form-header', ['title' => 'Tambah Peminjam', 'subtitle' => 'Form tambah data peminjam - tampilan konsisten dengan dashboard', 'total' => isset($totalPeminjam) ? $totalPeminjam : (isset($peminjams) ? $peminjams->count() : 0), 'icon' => 'fas fa-users', 'iconColor' => '#ec4899', 'iconBg' => '#fce7f3'])

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end; gap:8px;">
    <a href="{{ route('admin.peminjam.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<!-- ===== FORM CARD ===== -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.peminjam.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" class="form-control @error('nama_peminjam') is-invalid @enderror" value="{{ old('nama_peminjam') }}">
                    @error('nama_peminjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">No Surat Tanah</label>
                    <input type="text" name="surat_ukur_no" class="form-control @error('surat_ukur_no') is-invalid @enderror" value="{{ old('surat_ukur_no') }}" placeholder="Masukkan No Surat Tanah atau ID">
                    @error('surat_ukur_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex justify-content-end mt-2">
                    <a href="{{ route('admin.peminjam.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
