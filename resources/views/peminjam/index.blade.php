@extends('layouts.app')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #004d00 0%, #006600 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 25px rgba(0, 77, 0, 0.25);
    }

    .page-header h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 0;
    }

    .btn-add {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid white;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-add:hover {
        background: white;
        color: #004d00;
    }

    .table-container {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
        overflow-x: auto;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: linear-gradient(135deg, #004d00, #006600);
        color: white;
        border: none;
        font-weight: 700;
        padding: 15px;
        text-align: left;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #e0e0e0;
    }

    .table tbody tr:hover {
        background-color: rgba(0, 77, 0, 0.05);
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
    }

    .img-preview {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e0e0e0;
    }

    .btn-action {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
        margin-right: 5px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background: linear-gradient(135deg, #0066cc, #0088ff);
        color: white;
        border: none;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #0055aa, #0077ee);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: linear-gradient(135deg, #cc3333, #ff5555);
        color: white;
        border: none;
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #aa2222, #ee4444);
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 15px;
        }

        .table-container {
            padding: 15px;
        }

        .table thead th,
        .table tbody td {
            padding: 10px;
            font-size: 14px;
        }

        .img-preview {
            width: 50px;
            height: 50px;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h3><i class="fas fa-users"></i> Daftar Peminjam</h3>
    </div>
    <a href="{{ route('peminjam.create') }}" class="btn-add">
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
                        <a href="{{ route('peminjam.edit', $item->id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('peminjam.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus
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