<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratUkur;
use App\Models\BukuTanah;

class SuratUkurController extends Controller
{
    public function index()
    {
        $data = SuratUkur::with('bukuTanah')->get();
        return view('daftar_surat_ukur.index', compact('data'));
    }

    public function create()
    {
        // Ambil semua buku tanah untuk dropdown
        $bukuTanah = BukuTanah::all();

        return view('daftar_surat_ukur.create', compact('bukuTanah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_tanah_id' => 'required|exists:buku_tanah,id',
            'ukuran_luar_tanah' => 'required|string',
            'no_surat_tanah' => 'required|unique:surat_ukur,no_surat_tanah',
            'tahun_tanah' => 'required|integer|min:1900|max:2100',
        ]);

        try {
            SuratUkur::create($request->all());
            return redirect()->route('admin.suratukur.index')->with('success', 'Data surat ukur berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $data = SuratUkur::with('bukuTanah')->findOrFail($id);
        return view('daftar_surat_ukur.show', compact('data'));
    }

    public function edit($id)
    {
        $data = SuratUkur::findOrFail($id);
        $bukuTanah = BukuTanah::all();

        return view('daftar_surat_ukur.edit', compact('data','bukuTanah'));
    }

    public function update(Request $request, $id)
    {
        $data = SuratUkur::findOrFail($id);

        $request->validate([
            'buku_tanah_id' => 'required|exists:buku_tanah,id',
            'ukuran_luar_tanah' => 'required|string',
            'no_surat_tanah' => 'required|unique:surat_ukur,no_surat_tanah,' . $id,
            'tahun_tanah' => 'required|integer|min:1900|max:2100',
        ]);

        try {
            $data->update($request->all());
            return redirect()->route('admin.suratukur.index')
                           ->with('success', 'Data surat ukur berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            SuratUkur::destroy($id);
            return redirect()->route('admin.suratukur.index')->with('success', 'Data surat ukur berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
