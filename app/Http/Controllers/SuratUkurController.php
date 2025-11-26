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
        // hanya buku tanah yang belum punya surat ukur
        $bukuTanah = BukuTanah::doesntHave('suratUkur')->get();

        return view('daftar_surat_ukur.create', compact('bukuTanah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_tanah_id' => 'required|unique:surat_ukur,buku_tanah_id',
            'ukuran_luar_tanah' => 'required',
            'no_surat_tanah' => 'required',
            'tahun_tanah' => 'required',
        ]);

        SuratUkur::create($request->all());

        return redirect()->route('suratukur.index')->with('success', 'Data berhasil ditambahkan!');
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
        'buku_tanah_id' => 'required|unique:surat_ukur,buku_tanah_id,' . $id,
        'ukuran_luar_tanah' => 'required',
        'no_surat_tanah' => 'required',
        'tahun_tanah' => 'required',
    ]);

    $data->update($request->all());

    return redirect()->route('suratukur.index')
                     ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        SuratUkur::destroy($id);
        return redirect()->route('suratukur.index')->with('success', 'Data berhasil dihapus!');
    }
}
