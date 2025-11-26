<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\BukuTanah;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('bukuTanah')->get();
        return view('pengembalian.index', compact('pengembalians'));
    }

    public function create()
    {
        $bukuTanah = BukuTanah::all();
        return view('pengembalian.create', compact('bukuTanah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'buku_tanah_id' => 'required|exists:buku_tanah,id',
            'no_hp' => 'required',
            'email' => 'required|email',
            'waktu_pengembalian' => 'required|date',
        ]);

        Pengembalian::create($request->all());

        return redirect()->route('pengembalian.index')
                         ->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    public function edit(Pengembalian $pengembalian)
    {
        $bukuTanah = BukuTanah::all();
        return view('pengembalian.edit', compact('pengembalian', 'bukuTanah'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $request->validate([
            'nama' => 'required',
            'buku_tanah_id' => 'required|exists:buku_tanah,id',
            'no_hp' => 'required',
            'email' => 'required|email',
            'waktu_pengembalian' => 'required|date',
        ]);

        $pengembalian->update($request->all());

        return redirect()->route('pengembalian.index')
                         ->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')
                         ->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
