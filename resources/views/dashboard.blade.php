@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="mb-0">Dashboard</h3>
            <p class="text-muted">Ringkasan singkat sistem</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Buku Tanah</h6>
                    <h3 class="card-text">{{ $totalBukuTanah }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Surat Ukur</h6>
                    <h3 class="card-text">{{ $totalSuratUkur }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Peminjam</h6>
                    <h3 class="card-text">{{ $totalPeminjam }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">Menu Utama</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Kelola Buku Tanah</li>
                        <li class="list-group-item">Kelola Surat Ukur</li>
                        <li class="list-group-item">Data Peminjam</li>
                        <li class="list-group-item">Pengembalian Dokumen</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">Informasi</div>
                <div class="card-body">
                    <p class="mb-0 text-muted">Gunakan menu di sebelah kiri untuk mengakses modul utama.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
