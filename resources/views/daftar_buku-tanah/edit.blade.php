@extends('layouts.admin')

@section('title', 'Edit Buku Tanah - ATR BPN')

@section('content')

@include('partials.form-header', ['title' => 'Edit Buku Tanah', 'subtitle' => 'Form edit data buku tanah - tampilan konsisten dengan dashboard', 'total' => 0, 'icon' => 'fas fa-book', 'iconColor' => '#10b981', 'iconBg' => '#d1fae5'])

<!-- ===== ACTION BAR ===== -->
<div style="margin-bottom: 24px; display: flex; justify-content: flex-end; gap:8px;">
    <a href="{{ route('admin.bukutanah.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<!-- ===== FORM CARD ===== -->
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.bukutanah.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">No Buku Tanah</label>
                    <input type="text" name="no_buku_tanah" class="form-control @error('no_buku_tanah') is-invalid @enderror" value="{{ old('no_buku_tanah', $data->no_buku_tanah) }}">
                    @error('no_buku_tanah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror" value="{{ old('nama_pemilik', $data->nama_pemilik) }}">
                    @error('nama_pemilik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Desa / Kelurahan</label>
                    <input type="text" name="desa_kelurahan" class="form-control @error('desa_kelurahan') is-invalid @enderror" value="{{ old('desa_kelurahan', $data->desa_kelurahan) }}">
                    @error('desa_kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan', $data->kecamatan) }}">
                    @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jenis Pelayanan</label>
                    <select name="jenis_pelayanan" class="form-select @error('jenis_pelayanan') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Balik_nama" {{ old('jenis_pelayanan', $data->jenis_pelayanan)=='Balik_nama' ? 'selected' : '' }}>Balik Nama</option>
                        <option value="Wakaf" {{ old('jenis_pelayanan', $data->jenis_pelayanan)=='Wakaf' ? 'selected' : '' }}>Wakaf</option>
                        <option value="Roya" {{ old('jenis_pelayanan', $data->jenis_pelayanan)=='Roya' ? 'selected' : '' }}>Roya</option>
                        <option value="Perubahan_hak" {{ old('jenis_pelayanan', $data->jenis_pelayanan)=='Perubahan_hak' ? 'selected' : '' }}>Perubahan Hak</option>
                        <option value="Skpt" {{ old('jenis_pelayanan', $data->jenis_pelayanan)=='Skpt' ? 'selected' : '' }}>SKPT</option>
                    </select>
                    @error('jenis_pelayanan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Status Berkas</label>
                    <select name="status_berkas" class="form-select @error('status_berkas') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="Berkas Masuk" {{ old('status_berkas', $data->status_berkas)=='Berkas Masuk' ? 'selected' : '' }}>Berkas Masuk</option>
                        <option value="Berkas Keluar" {{ old('status_berkas', $data->status_berkas)=='Berkas Keluar' ? 'selected' : '' }}>Berkas Keluar</option>
                        <option value="Lengkap" {{ old('status_berkas', $data->status_berkas)=='Lengkap' ? 'selected' : '' }}>Lengkap</option>
                        <option value="Belum Lengkap" {{ old('status_berkas', $data->status_berkas)=='Belum Lengkap' ? 'selected' : '' }}>Belum Lengkap</option>
                    </select>
                    @error('status_berkas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex justify-content-end mt-2">
                    <a href="{{ route('admin.bukutanah.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
