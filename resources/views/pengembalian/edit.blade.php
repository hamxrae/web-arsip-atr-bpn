@extends('layouts.app')

@section('content')
<h3>Edit Pengembalian</h3>

<form method="POST" action="{{ route('pengembalian.update', $pengembalian->id) }}">
    @csrf
    @method('PUT')

    <label>Nama</label>
    <input type="text" name="nama" class="form-control mb-2" value="{{ $pengembalian->nama }}" required>

    <label>No Buku Tanah</label>
    <select name="buku_tanah_id" class="form-control mb-2" required>
        @foreach ($bukuTanah as $b)
            <option value="{{ $b->id }}" {{ $pengembalian->buku_tanah_id == $b->id ? 'selected' : '' }}>
                {{ $b->no_buku_tanah }}
            </option>
        @endforeach
    </select>

    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control mb-2" value="{{ $pengembalian->no_hp }}" required>

    <label>Email</label>
    <input type="email" name="email" class="form-control mb-2" value="{{ $pengembalian->email }}" required>

    <label>Waktu Pengembalian</label>
    <input type="datetime-local" name="waktu_pengembalian" class="form-control mb-3"
           value="{{ date('Y-m-d\TH:i', strtotime($pengembalian->waktu_pengembalian)) }}" required>

    <button class="btn btn-primary">Update</button>
</form>
@endsection
