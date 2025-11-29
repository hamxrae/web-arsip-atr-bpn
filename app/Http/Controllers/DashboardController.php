<?php

namespace App\Http\Controllers;

use App\Models\BukuTanah;
use App\Models\SuratUkur;
use App\Models\Peminjam;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBukuTanah = BukuTanah::count();
        $totalSuratUkur = SuratUkur::count();
        $totalPeminjam = Peminjam::count();
        $totalPengembalian = Pengembalian::count();
        // also pass recent buku tanah list for dashboard table
        $bukuTanah = BukuTanah::orderBy('id', 'desc')->limit(20)->get();

        return view('dashboard', [
            'totalBukuTanah' => $totalBukuTanah,
            'totalSuratUkur' => $totalSuratUkur,
            'totalPeminjam' => $totalPeminjam,
            'totalPengembalian' => $totalPengembalian,
            'bukuTanah' => $bukuTanah,
        ]);
    }
}
