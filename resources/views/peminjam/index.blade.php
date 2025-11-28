@extends('layouts.app')

@section('content')
<style>
    .page-header{ padding:12px 16px; margin-bottom:1rem; background:#fff; border:1px solid #e9ecef; border-radius:8px; display:flex; justify-content:space-between; align-items:center }
    .page-header h3{ margin:0; font-size:1.25rem }
    .table-container{ background:#fff; border:1px solid #e9ecef; border-radius:8px; padding:12px }
    .img-preview{ width:56px; height:56px; object-fit:cover; border-radius:6px }
    .empty-state{ text-align:center; padding:32px 12px; color:#6c757d }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h3><i class="fas fa-users"></i> Daftar Peminjam</h3>
    </div>
    <a href="{{ route('admin.peminjam.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus"></i> Tambah Peminjam
    </a>
</div>

<!-- Table Container -->
<div class="table-container">
    @if($peminjams->isEmpty())
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h4>Belum ada data peminjam</h4>
            <p>Klik tombol "Tambah Peminjam" untuk menambahkan data baru</p>
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Peminjam</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>No Surat Tanah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjams as $item)
                <tr>
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/peminjam/'.$item->foto) }}" alt="Foto Peminjam" class="img-preview">
                        @else
                            <div class="img-preview" style="background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user" style="color: #999; font-size: 24px;"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $item->nama_peminjam }}</strong></td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->suratUkur->no_surat_tanah ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.peminjam.edit', $item->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.peminjam.destroy', $item->id) }}" method="POST" style="display:inline;">
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
