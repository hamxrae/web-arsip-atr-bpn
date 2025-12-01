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

<!-- ===== ALERTS ===== -->
@include('partials.alerts')

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
                    <label class="form-label">No Surat Tanah *</label>
                    <select name="surat_ukur_id" class="form-select @error('surat_ukur_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Surat Tanah --</option>
                        @foreach($suratUkur as $s)
                            <option value="{{ $s->id }}" {{ old('surat_ukur_id') == $s->id ? 'selected' : '' }}>
                                {{ $s->no_surat_tanah }}
                            </option>
                        @endforeach
                    </select>
                    @error('surat_ukur_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label">Foto (opsional)</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                    <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                    @error('foto')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
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
