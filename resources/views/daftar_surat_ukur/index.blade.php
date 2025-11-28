@extends('layouts.app')

@section('content')
<style>
    .page-header{ padding: 12px 16px; margin-bottom: 1rem; background: #fff; border:1px solid #e9ecef; border-radius:8px; display:flex; justify-content:space-between; align-items:center }
    .page-header h3{ margin:0; font-size:1.25rem }
    .table-container{ background:#fff; border:1px solid #e9ecef; border-radius:8px; padding:12px }
    .empty-state{ text-align:center; padding:32px 12px; color:#6c757d }
    .btn-add{ text-decoration:none }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h3><i class="fas fa-file"></i> Data Surat Ukur</h3>
    </div>
    <a href="{{ route('admin.suratukur.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Tambah Surat Ukur
    </a>
</div>

<!-- Table Container -->
<div class="table-container">
    @if($data->isEmpty())
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h4>Belum ada data surat ukur</h4>
            <p>Klik tombol "Tambah Surat Ukur" untuk menambahkan data baru</p>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No Surat Tanah</th>
                    <th>Ukuran Luar</th>
                    <th>Tahun</th>
                    <th>No Buku Tanah</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td><strong>{{ $item->no_surat_tanah }}</strong></td>
                    <td>{{ $item->ukuran_luar_tanah }}</td>
                    <td>{{ $item->tahun_tanah }}</td>
                    <td>{{ $item->bukuTanah->no_buku_tanah ?? '-' }}</td>
                    <td>{{ $item->bukuTanah->nama_pemilik ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.suratukur.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.suratukur.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
