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
        text-decoration: none;
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

    .btn-action {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
        margin-right: 5px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background: linear-gradient(135deg, #0066cc, #0088ff);
        color: white;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #0055aa, #0077ee);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: linear-gradient(135deg, #cc3333, #ff5555);
        color: white;
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
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div>
        <h3><i class="fas fa-undo"></i> Data Pengembalian</h3>
    </div>
    <a href="{{ route('pengembalian.create') }}" class="btn-add">
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
                        <a href="{{ route('pengembalian.edit', $p->id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('pengembalian.destroy', $p->id) }}" method="POST" style="display:inline;">
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