@extends('layouts.app')

@section('content')
<style>
    .page-header{ padding:12px 16px; margin-bottom:1rem; background:#fff; border:1px solid #e9ecef; border-radius:8px; display:flex; justify-content:space-between; align-items:center }
    .page-header h3{ margin:0; font-size:1.25rem }
    .table-container{ background:#fff; border:1px solid #e9ecef; border-radius:8px; padding:12px }
    .empty-state{ text-align:center; padding:32px 12px; color:#6c757d }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h3><i class="fas fa-undo"></i> Data Pengembalian</h3>
    </div>
    <a href="{{ route('admin.pengembalian.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Tambah Pengembalian
    </a>
</div>

<!-- Table Container -->
<div class="table-container">
    @if($pengembalians->isEmpty())
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h4>Belum ada data pengembalian</h4>
            <p>Klik tombol "Tambah Pengembalian" untuk menambahkan data baru</p>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No Buku Tanah</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Waktu Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengembalians as $p)
                <tr>
                    <td><strong>{{ $p->nama }}</strong></td>
                    <td>{{ $p->bukuTanah->no_buku_tanah ?? '-' }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->waktu_pengembalian)->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.pengembalian.edit', $p->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.pengembalian.destroy', $p->id) }}" method="POST" style="display:inline;">
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
