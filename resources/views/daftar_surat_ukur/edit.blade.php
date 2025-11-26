@extends('layouts.app')

@section('content')
<h3>Edit Surat Ukur</h3>

<form method="POST" action="{{ route('suratukur.update', $data->id) }}">
    @csrf
    @method('PUT')

    <label>Pilih Buku Tanah</label>
    <select name="buku_tanah_id" class="form-control mb-2" required>
        @foreach($bukuTanah as $b)
            <option value="{{ $b->id }}" 
                {{ $data->buku_tanah_id == $b->id ? 'selected' : '' }}>
                {{ $b->no_buku_tanah }} - {{ $b->nama_pemilik }}
            </option>
        @endforeach
    </select>

    <label>Ukuran Luar Tanah</label>
    <input type="text" 
           name="ukuran_luar_tanah" 
           value="{{ $data->ukuran_luar_tanah }}" 
           class="form-control mb-2" 
           required>

    <label>No Surat Tanah</label>
    <input type="text" 
           name="no_surat_tanah" 
           value="{{ $data->no_surat_tanah }}" 
           class="form-control mb-2" 
           required>

    <label>Tahun Tanah</label>
    <input type="text" 
           name="tahun_tanah" 
           value="{{ $data->tahun_tanah }}" 
           class="form-control mb-2" 
           required>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
