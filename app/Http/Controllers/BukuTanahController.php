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
            'nama_pemilik' => 'required',
            'desa_kelurahan' => 'required',
            'kecamatan' => 'required',
            'jenis_pelayanan' => 'required|in:Wakaf,Balik_nama,Roya,Perubahan_hak,Skpt',
            'status_berkas' => 'required',
        ]);

        BukuTanah::create($request->all());

        return redirect()->route('admin.bukutanah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    
{
    $data = BukuTanah::findOrFail($id);
    return view('daftar_buku-tanah.edit', compact('data'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'no_buku_tanah' => 'required',
        'nama_pemilik' => 'required',
        'desa_kelurahan' => 'required',
        'kecamatan' => 'required',
       'jenis_pelayanan' => 'required|in:Wakaf,Balik_nama,Roya,Perubahan_hak,Skpt',
        'status_berkas' => 'required',
    ]);

    $data = BukuTanah::findOrFail($id);
    $data->update($request->all());

    return redirect()->route('admin.bukutanah.index')->with('success', 'Data berhasil diupdate!');
}

    public function destroy($id)
    {
        BukuTanah::destroy($id);
        return redirect()->route('admin.bukutanah.index')->with('success', 'Data berhasil dihapus!');
    }
}
