<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\SuratUkur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'nama_peminjam' => ['required','string','max:255'],
            'no_hp' => ['required','string','max:20','regex:/^(\+62|0)[0-9]{8,12}$/'],
            'email' => ['required','email', Rule::unique('peminjams','email')],
            'surat_ukur_id' => ['required', Rule::exists((new SuratUkur)->getTable(), 'id')],
            'foto' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
        ], [
            'nama_peminjam.required' => 'Nama peminjam harus diisi',
            'no_hp.regex' => 'Format no HP harus dimulai dengan 62 atau 0, diikuti 8-12 angka',
            'email.unique' => 'Email sudah terdaftar',
            'surat_ukur_id.exists' => 'Surat ukur yang dipilih tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
        ]);

        $data = $request->only([
            'nama_peminjam',
            'no_hp',
            'email',
            'surat_ukur_id',
        ]);

        if($request->hasFile('foto')){
            try {
                $file = $request->file('foto');
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '', $file->getClientOriginalName());
                $file->storeAs('public/peminjam', $filename);
                $data['foto'] = $filename;
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal upload foto: ' . $e->getMessage())->withInput();
            }
        }

        try {
            Peminjam::create($data);
            return redirect()->route('admin.peminjam.index')->with('success', 'Data peminjam berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Peminjam $peminjam)
    {
        $peminjam->load('suratUkur');
        return view('peminjam.show', compact('peminjam'));
    }

    public function edit(Peminjam $peminjam)
    {
        $suratUkur = SuratUkur::all();
        return view('peminjam.edit', compact('peminjam', 'suratUkur'));
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $request->validate([
            'nama_peminjam' => ['required','string','max:255'],
            'no_hp' => ['required','string','max:20','regex:/^(\+62|0)[0-9]{8,12}$/'],
            'email' => ['required','email', Rule::unique('peminjams','email')->ignore($peminjam->id)],
            'surat_ukur_id' => ['required', Rule::exists((new SuratUkur)->getTable(), 'id')],
            'foto' => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
        ], [
            'nama_peminjam.required' => 'Nama peminjam harus diisi',
            'no_hp.regex' => 'Format no HP harus dimulai dengan 62 atau 0, diikuti 8-12 angka',
            'email.unique' => 'Email sudah terdaftar',
            'surat_ukur_id.exists' => 'Surat ukur yang dipilih tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus JPG, JPEG, atau PNG',
        ]);

        $data = $request->only([
            'nama_peminjam',
            'no_hp',
            'email',
            'surat_ukur_id',
        ]);

        if($request->hasFile('foto')){
            try {
                // Hapus foto lama jika ada
                if($peminjam->foto && file_exists(storage_path('app/public/peminjam/' . $peminjam->foto))){
                    @unlink(storage_path('app/public/peminjam/' . $peminjam->foto));
                }
                
                // Upload foto baru
                $file = $request->file('foto');
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9_.-]/', '', $file->getClientOriginalName());
                $file->storeAs('public/peminjam', $filename);
                $data['foto'] = $filename;
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal upload foto: ' . $e->getMessage())->withInput();
            }
        }

        try {
            $peminjam->update($data);
            return redirect()->route('admin.peminjam.index')->with('success', 'Data peminjam berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Peminjam $peminjam)
    {
        try {
            // Hapus foto jika ada
            if($peminjam->foto && file_exists(storage_path('app/public/peminjam/' . $peminjam->foto))){
                @unlink(storage_path('app/public/peminjam/' . $peminjam->foto));
            }

            $peminjam->delete();
            return redirect()->route('admin.peminjam.index')->with('success', 'Data peminjam berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
