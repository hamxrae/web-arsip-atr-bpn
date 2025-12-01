@extends('layouts.admin')

@section('title', 'Edit Pengembalian - ATR BPN')

@section('content')

@include('partials.form-header', ['title' => 'Edit Pengembalian', 'subtitle' => 'Form edit data pengembalian - tampilan konsisten dengan dashboard', 'total' => 0, 'icon' => 'fas fa-undo', 'iconColor' => '#f59e0b', 'iconBg' => '#fef3c7'])

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end; gap:8px;">
    <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<!-- ===== ALERTS ===== -->
@include('partials.alerts')

<!-- ===== FORM CARD ===== -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.pengembalian.update', $pengembalian->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pengembalian->nama) }}">
                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">No Buku Tanah</label>
                    <select name="buku_tanah_id" class="form-select @error('buku_tanah_id') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach($bukuTanah as $b)
                            <option value="{{ $b->id }}" {{ old('buku_tanah_id', $pengembalian->buku_tanah_id) == $b->id ? 'selected' : '' }}>
                                {{ $b->no_buku_tanah }} - {{ $b->nama_pemilik }}
                            </option>
                        @endforeach
                    </select>
                    @error('buku_tanah_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $pengembalian->no_hp) }}">
                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pengembalian->email) }}">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Waktu Pengembalian</label>
                    @php
                        try {
                            $dtValue = $pengembalian->waktu_pengembalian ? \Carbon\Carbon::parse($pengembalian->waktu_pengembalian)->format('Y-m-d\TH:i') : null;
                        } catch (\Exception $e) {
                            $dtValue = old('waktu_pengembalian', null);
                        }
                    @endphp
                    <input type="datetime-local" name="waktu_pengembalian" class="form-control @error('waktu_pengembalian') is-invalid @enderror" value="{{ old('waktu_pengembalian', $dtValue) }}">
                    @error('waktu_pengembalian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex justify-content-end mt-2">
                    <a href="{{ route('admin.pengembalian.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
