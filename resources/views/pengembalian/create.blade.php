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

