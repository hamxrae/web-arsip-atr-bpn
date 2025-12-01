<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\SuratUkur;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::with('suratUkur')->get();
        return view('peminjam.index', compact('peminjams'));
    }

    public function create()
    {
        $suratUkur = SuratUkur::all();
        return view('peminjam.create', compact('suratUkur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:peminjams,email',
            'surat_ukur_id' => 'required|exists:surat_ukur,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_peminjam',
            'no_hp',
            'email',
            'surat_ukur_id',
        ]);

        if($request->hasFile('foto')){
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/peminjam', $filename);
            $data['foto'] = $filename;
        }

        try {
            Peminjam::create($data);
            return redirect()->route('admin.peminjam.index')->with('success', 'Data peminjam berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit(Peminjam $peminjam)
    {
        $suratUkur = SuratUkur::all();
        return view('peminjam.edit', compact('peminjam', 'suratUkur'));
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:peminjams,email,' . $peminjam->id,
            'surat_ukur_id' => 'required|exists:surat_ukur,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_peminjam',
            'no_hp',
            'email',
            'surat_ukur_id',
        ]);

        if($request->hasFile('foto')){
            // Hapus foto lama jika ada
            if($peminjam->foto && file_exists(storage_path('app/public/peminjam/' . $peminjam->foto))){
                unlink(storage_path('app/public/peminjam/' . $peminjam->foto));
            }
            
            // Upload foto baru
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/peminjam', $filename);
            $data['foto'] = $filename;
        }

        try {
            $peminjam->update($data);
            return redirect()->route('admin.peminjam.index')->with('success', 'Data peminjam berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(Peminjam $peminjam)
    {
        if($peminjam->foto && file_exists(storage_path('app/public/peminjam/' . $peminjam->foto))){
            unlink(storage_path('app/public/peminjam/' . $peminjam->foto));
        }

        $peminjam->delete();

        return redirect()->route('admin.peminjam.index')->with('success', 'Data berhasil dihapus.');
    }
}
