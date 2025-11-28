@extends('layouts.app')

@section('content')
<style>
    /* Simple, Bootstrap-first styles */
    .page-header{ padding: 12px 16px; margin-bottom: 1rem; background: #fff; border:1px solid #e9ecef; border-radius:8px; display:flex; justify-content:space-between; align-items:center }
    .page-header h3{ margin:0; font-size:1.25rem; }
    .table-container{ background:#fff; border:1px solid #e9ecef; border-radius:8px; padding:12px; }
    .empty-state{ text-align:center; padding:32px 12px; color:#6c757d }
    .btn-add{ text-decoration:none }
    .badge{ border-radius: 0.5rem; padding:.35rem .6rem }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h3><i class="fas fa-book"></i> Daftar Buku Tanah</h3>
    </div>
    <a href="{{ route('admin.bukutanah.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Tambah Buku Tanah
    </a>
</div>

<!-- Table Container -->
<div class="table-container">
    @if($data->isEmpty())
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h4>Belum ada data buku tanah</h4>
            <p>Klik tombol "Tambah Buku Tanah" untuk menambahkan data baru</p>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>No Buku Tanah</th>
                    <th>Nama Pemilik</th>
                    <th>Desa / Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>Jenis Pelayanan</th>
                    <th>Status Berkas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td><strong>{{ $item->no_buku_tanah }}</strong></td>
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->desa_kelurahan }}</td>
                    <td>{{ $item->kecamatan }}</td>
                    <td>{{ $item->jenis_pelayanan }}</td>
                    <td>
                        <span class="badge badge-{{ strtolower($item->status_berkas) == 'aktif' ? 'success' : (strtolower($item->status_berkas) == 'proses' ? 'warning' : 'info') }}">
                            {{ $item->status_berkas }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.bukutanah.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.bukutanah.destroy', $item->id) }}" method="POST" style="display:inline;">
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


