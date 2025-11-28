@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Peminjam</div>
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

                    <form method="POST" action="{{ route('admin.peminjam.update', $peminjam->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama Peminjam</label>
                            <input name="nama_peminjam" type="text" class="form-control" value="{{ old('nama_peminjam', $peminjam->nama_peminjam) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input name="no_hp" type="tel" class="form-control" value="{{ old('no_hp', $peminjam->no_hp) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ old('email', $peminjam->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surat Ukur</label>
                            <select name="surat_ukur_id" class="form-select" required>
                                @foreach($suratUkur as $surat)
                                    <option value="{{ $surat->id }}" {{ $peminjam->surat_ukur_id == $surat->id ? 'selected' : '' }}>{{ $surat->no_surat_tanah }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            @if($peminjam->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/peminjam/'.$peminjam->foto) }}" alt="foto" class="img-thumbnail" style="max-width:150px">
                                </div>
                            @endif
                            <input name="foto" type="file" class="form-control">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.peminjam.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
