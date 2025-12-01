<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTanah;

class BukuTanahController extends Controller
{
    public function index()
    {
        $data = BukuTanah::all();
        return view('daftar_buku-tanah.index', compact('data'));
    }

    public function create()
    {
        return view('daftar_buku-tanah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_buku_tanah' => 'required|unique:buku_tanah',
            'nama_pemilik' => 'required|string|max:255',
            'desa_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'jenis_pelayanan' => 'required|in:Wakaf,Balik_nama,Roya,Perubahan_hak,Skpt',
            'status_berkas' => 'required|string|max:255',
        ], [
            'no_buku_tanah.required' => 'No Buku Tanah harus diisi',
            'no_buku_tanah.unique' => 'No Buku Tanah sudah terdaftar',
            'nama_pemilik.required' => 'Nama Pemilik harus diisi',
        ]);

        try {
            BukuTanah::create($request->all());
            return redirect()->route('admin.bukutanah.index')->with('success', 'Data berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $data = BukuTanah::findOrFail($id);
        return view('daftar_buku-tanah.show', compact('data'));
    }

    public function edit($id)
    
{
    $data = BukuTanah::findOrFail($id);
    return view('daftar_buku-tanah.edit', compact('data'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'no_buku_tanah' => 'required|unique:buku_tanah,no_buku_tanah,' . $id,
        'nama_pemilik' => 'required|string|max:255',
        'desa_kelurahan' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'jenis_pelayanan' => 'required|in:Wakaf,Balik_nama,Roya,Perubahan_hak,Skpt',
        'status_berkas' => 'required|string|max:255',
    ]);

    try {
        $data = BukuTanah::findOrFail($id);
        $data->update($request->all());
        return redirect()->route('admin.bukutanah.index')->with('success', 'Data berhasil diupdate!');
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage())->withInput();
    }
}

    public function destroy($id)
    {
        try {
            BukuTanah::destroy($id);
            return redirect()->route('admin.bukutanah.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
