<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\BukuTanah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'nama' => ['required','string','max:255'],
            'buku_tanah_id' => ['required', Rule::exists((new BukuTanah)->getTable(), 'id')],
            'no_hp' => ['required','string','max:20','regex:/^(\+62|0)[0-9]{8,12}$/'],
            'email' => ['required','email'],
            'waktu_pengembalian' => ['required','date_format:Y-m-d\TH:i'],
        ], [
            'nama.required' => 'Nama harus diisi',
            'buku_tanah_id.required' => 'Buku tanah harus dipilih',
            'buku_tanah_id.exists' => 'Buku tanah yang dipilih tidak valid',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.regex' => 'Format no HP harus dimulai dengan 62 atau 0, diikuti 8-12 angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'waktu_pengembalian.required' => 'Waktu pengembalian harus diisi',
            'waktu_pengembalian.date_format' => 'Format tanggal/waktu harus sesuai (YYYY-MM-DDTHH:MM)',
        ]);

        try {
            Pengembalian::create($request->all());
            return redirect()->route('admin.pengembalian.index')
                           ->with('success', 'Data pengembalian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load('bukuTanah');
        return view('pengembalian.show', compact('pengembalian'));
    }

    public function edit(Pengembalian $pengembalian)
    {
        $bukuTanah = BukuTanah::all();
        return view('pengembalian.edit', compact('pengembalian', 'bukuTanah'));
    }

    public function update(Request $request, Pengembalian $pengembalian)
    {
        $request->validate([
            'nama' => ['required','string','max:255'],
            'buku_tanah_id' => ['required', Rule::exists((new BukuTanah)->getTable(), 'id')],
            'no_hp' => ['required','string','max:20','regex:/^(\+62|0)[0-9]{8,12}$/'],
            'email' => ['required','email'],
            'waktu_pengembalian' => ['required','date_format:Y-m-d\TH:i'],
        ], [
            'nama.required' => 'Nama harus diisi',
            'buku_tanah_id.required' => 'Buku tanah harus dipilih',
            'buku_tanah_id.exists' => 'Buku tanah yang dipilih tidak valid',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.regex' => 'Format no HP harus dimulai dengan 62 atau 0, diikuti 8-12 angka',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'waktu_pengembalian.required' => 'Waktu pengembalian harus diisi',
            'waktu_pengembalian.date_format' => 'Format tanggal/waktu harus sesuai (YYYY-MM-DDTHH:MM)',
        ]);

        try {
            $pengembalian->update($request->all());
            return redirect()->route('admin.pengembalian.index')
                           ->with('success', 'Data pengembalian berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Pengembalian $pengembalian)
    {
        try {
            $pengembalian->delete();
            return redirect()->route('admin.pengembalian.index')
                           ->with('success', 'Data pengembalian berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
