<?php

namespace App\Http\Controllers;

use App\Models\BukuTanah;
use App\Models\SuratUkur;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBukuTanah = BukuTanah::count();
        $totalSuratUkur = SuratUkur::count();
        $totalPeminjam = Peminjam::count();

        return view('dashboard', [
            'totalBukuTanah' => $totalBukuTanah,
            'totalSuratUkur' => $totalSuratUkur,
            'totalPeminjam' => $totalPeminjam,
        ]);
    }
}
