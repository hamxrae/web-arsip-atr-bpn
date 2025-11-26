@extends('layouts.app')

@section('content')
<h3>Tambah Buku Tanah</h3>

<form method="POST" action="{{ route('bukut.store') }}">
    @csrf

    <label>No Buku Tanah</label>
    <input type="text" name="no_buku_tanah" class="form-control mb-2" required>

    <label>Nama Pemilik</label>
    <input type="text" name="nama_pemilik" class="form-control mb-2" required>

    <label>Desa / Kelurahan</label>
    <input type="text" name="desa_kelurahan" class="form-control mb-2" required>

    <label>Kecamatan</label>
    <input type="text" name="kecamatan" class="form-control mb-2" required>

    <label>Jenis Pelayanan</label>
    <select name="jenis_pelayanan" class="form-control mb-2" required>
        <option value="">-- Pilih Jenis Pelayanan --</option>
        <option value="Wakaf">Wakaf</option>
        <option value="Balik_nama">Balik Nama</option>
        <option value="Roya">Roya</option>
        <option value="Perubahan_hak">Perubahan Hak</option>
        <option value="Skpt">SKPT</option>
    </select>

    <label>Status Berkas</label>
    <input type="text" name="status_berkas" class="form-control mb-2" required>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
