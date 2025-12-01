@extends('layouts.admin')

@section('title', 'Tambah Surat Ukur - ATR BPN')

@section('content')

@include('partials.form-header', ['title' => 'Tambah Surat Ukur', 'subtitle' => 'Form tambah data surat ukur - tampilan konsisten dengan dashboard', 'total' => isset($totalSuratUkur) ? $totalSuratUkur : (isset($data) ? $data->count() : 0), 'icon' => 'fas fa-file-pdf', 'iconColor' => '#3b82f6', 'iconBg' => '#dbeafe'])

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end; gap:8px;">
    <a href="{{ route('admin.suratukur.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<!-- ===== FORM CARD ===== -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.suratukur.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">No Surat Tanah</label>
                    <input type="text" name="no_surat_tanah" class="form-control @error('no_surat_tanah') is-invalid @enderror" value="{{ old('no_surat_tanah') }}">
                    @error('no_surat_tanah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Ukuran Luar</label>
                    <input type="text" name="ukuran_luar_tanah" class="form-control @error('ukuran_luar_tanah') is-invalid @enderror" value="{{ old('ukuran_luar_tanah') }}">
                    @error('ukuran_luar_tanah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun_tanah" class="form-control @error('tahun_tanah') is-invalid @enderror" value="{{ old('tahun_tanah') }}">
                    @error('tahun_tanah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-8">
                    <label class="form-label">No Buku Tanah (hubungkan)</label>
                    <input type="text" name="buku_tanah_no" class="form-control @error('buku_tanah_no') is-invalid @enderror" value="{{ old('buku_tanah_no') }}" placeholder="Masukkan No Buku Tanah atau ID">
                    @error('buku_tanah_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex justify-content-end mt-2">
                    <a href="{{ route('admin.suratukur.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

