@extends('layouts.app')

@section('content')
<h3>Edit Buku Tanah</h3>

<form method="POST" action="{{ route('bukut.update', $data->id) }}">
    @csrf
    @method('PUT')

    <label>No Buku Tanah</label>
    <input type="text" name="no_buku_tanah" class="form-control mb-2" value="{{ $data->no_buku_tanah }}" required>

    <label>Nama Pemilik</label>
    <input type="text" name="nama_pemilik" class="form-control mb-2" value="{{ $data->nama_pemilik }}" required>

    <label>Desa / Kelurahan</label>
    <input type="text" name="desa_kelurahan" class="form-control mb-2" value="{{ $data->desa_kelurahan }}" required>

    <label>Kecamatan</label>
    <input type="text" name="kecamatan" class="form-control mb-2" value="{{ $data->kecamatan }}" required>

    <label>Jenis Pelayanan</label>
    <select name="jenis_pelayanan" class="form-control mb-2" required>
        <option value="Wakaf" {{ $data->jenis_pelayanan == 'Wakaf' ? 'selected' : '' }}>Wakaf</option>
        <option value="Balik_nama" {{ $data->jenis_pelayanan == 'Balik_nama' ? 'selected' : '' }}>Balik Nama</option>
        <option value="Roya" {{ $data->jenis_pelayanan == 'Roya' ? 'selected' : '' }}>Roya</option>
        <option value="Perubahan_hak" {{ $data->jenis_pelayanan == 'Perubahan_hak' ? 'selected' : '' }}>Perubahan Hak</option>
        <option value="Skpt" {{ $data->jenis_pelayanan == 'Skpt' ? 'selected' : '' }}>SKPT</option>
    </select>

    <label>Status Berkas</label>
    <input type="text" name="status_berkas" class="form-control mb-2" value="{{ $data->status_berkas }}" required>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
