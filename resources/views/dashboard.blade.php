@extends('layouts.simple')

@section('content')
    <div class="dashboard-header card-flat p-4 mb-4 bg-white">
        <h2 class="mb-1"><i class="fas fa-chart-bar"></i> Dashboard</h2>
        <p class="text-muted mb-0">Sistem Manajemen Arsip ATR/BPN</p>
    </div>

    <div class="stats-grid mb-4">
        @extends('layouts.admin')

        @section('title', 'Dashboard - ATR BPN')

        @section('content')
            <div class="container-fluid">
                <h3 class="mb-3" style="color:#234; font-weight:600">DATA PEMINJAMAN BUKU TANAH ARSIP ATR/BPN GARUT</h3>

                <div class="card card-clean mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center" style="gap:12px">
                            <i class="fas fa-book text-success" style="font-size:20px"></i>
                            <h5 class="mb-0">Daftar Buku Tanah</h5>
                        </div>
                        <a href="{{ route('admin.bukutanah.create') }}" class="btn btn-success btn-sm">+ Tambah Buku Tanah</a>
                    </div>
                </div>

                <div class="card card-clean">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
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
                                    @forelse($bukuTanah as $item)
                                        <tr>
                                            <td>{{ $item->no_buku_tanah }}</td>
                                            <td>{{ $item->nama_pemilik }}</td>
                                            <td>{{ $item->desa_kelurahan }}</td>
                                            <td>{{ $item->kecamatan }}</td>
                                            <td>{{ $item->jenis_pelayanan }}</td>
                                            <td><span class="badge bg-info text-dark">{{ $item->status_berkas }}</span></td>
                                            <td>
                                                <a href="{{ route('admin.bukutanah.edit', $item->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('admin.bukutanah.destroy', $item->id) }}" method="POST" style="display:inline-block; margin-left:6px">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
