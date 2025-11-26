@extends('layouts.app')

@section('content')
<h3>Tambah Surat Ukur</h3>

<form method="POST" action="{{ route('suratukur.store') }}">
    @csrf

    <label>Pilih Buku Tanah</label>
    <select name="buku_tanah_id" class="form-control mb-2" required>
        <option value="">-- pilih --</option>
        @foreach($bukuTanah as $b)
            <option value="{{ $b->id }}">
                {{ $b->no_buku_tanah }} - {{ $b->nama_pemilik }}
            </option>
        @endforeach
    </select>

    <input type="text" name="ukuran_luar_tanah" placeholder="Ukuran Luar Tanah" class="form-control mb-2">
    <input type="text" name="no_surat_tanah" placeholder="No Surat Tanah" class="form-control mb-2">
    <input type="text" name="tahun_tanah" placeholder="Tahun Tanah" class="form-control mb-2">

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
