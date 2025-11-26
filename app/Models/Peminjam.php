<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_peminjam',
        'no_hp',
        'email',
        'surat_ukur_id',
        'foto',
    ];

    public function suratUkur()
    {
        return $this->belongsTo(SuratUkur::class, 'surat_ukur_id');
    }

    // Helper untuk path foto
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/peminjam/' . $this->foto) : null;
    }
}
