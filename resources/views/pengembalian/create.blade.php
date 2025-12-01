@extends('layouts.admin')

@section('title', 'Tambah Pengembalian - ATR BPN')

@section('content')

@include('partials.form-header', ['title' => 'Tambah Pengembalian', 'subtitle' => 'Form tambah data pengembalian - tampilan konsisten dengan dashboard', 'total' => isset($totalPengembalian) ? $totalPengembalian : (isset($pengembalians) ? $pengembalians->count() : 0), 'icon' => 'fas fa-undo', 'iconColor' => '#f59e0b', 'iconBg' => '#fef3c7'])

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end; gap:8px;">
    <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<!-- ===== FORM CARD ===== -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pengembalian.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">No Buku Tanah</label>
                    <input type="text" name="buku_tanah_no" class="form-control @error('buku_tanah_no') is-invalid @enderror" value="{{ old('buku_tanah_no') }}">
                    @error('buku_tanah_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                    <label class="form-label">Waktu Pengembalian</label>
                    <input type="datetime-local" name="waktu_pengembalian" class="form-control @error('waktu_pengembalian') is-invalid @enderror" value="{{ old('waktu_pengembalian') }}">
                    @error('waktu_pengembalian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex justify-content-end mt-2">
                    <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')
<h3>Tambah Pengembalian</h3>

<form method="POST" action="{{ route('admin.pengembalian.store') }}">
    @csrf

    <label>Nama</label>
    <input type="text" name="nama" class="form-control mb-2" required>

    <label>No Buku Tanah</label>
    <select name="buku_tanah_id" class="form-control mb-2" required>
        @foreach ($bukuTanah as $b)
            <option value="{{ $b->id }}">{{ $b->no_buku_tanah }}</option>
        @endforeach
    </select>

    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control mb-2" required>

    <label>Email</label>
    <input type="email" name="email" class="form-control mb-2" required>

    <label>Waktu Pengembalian</label>
    <input type="datetime-local" name="waktu_pengembalian" class="form-control mb-3" required>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection

