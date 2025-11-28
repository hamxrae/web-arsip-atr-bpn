@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">Tambah Peminjam Baru</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.peminjam.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                            <input id="nama_peminjam" name="nama_peminjam" type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" value="{{ old('nama_peminjam') }}" required>
                            @error('nama_peminjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input id="no_hp" name="no_hp" type="tel" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                            @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="surat_ukur_id" class="form-label">Surat Ukur</label>
                            <select id="surat_ukur_id" name="surat_ukur_id" class="form-select @error('surat_ukur_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Surat Ukur --</option>
                                @foreach($suratUkur as $surat)
                                    <option value="{{ $surat->id }}" {{ old('surat_ukur_id') == $surat->id ? 'selected' : '' }}>{{ $surat->no_surat_tanah }}</option>
                                @endforeach
                            </select>
                            @error('surat_ukur_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil (opsional)</label>
                            <input id="foto" name="foto" type="file" class="form-control">
                            @error('foto') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('admin.peminjam.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
