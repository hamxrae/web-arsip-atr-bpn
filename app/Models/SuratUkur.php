<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratUkur extends Model
{
    protected $table = 'surat_ukur';

    protected $fillable = [
        'buku_tanah_id',
        'ukuran_luar_tanah',
        'no_surat_tanah',
        'tahun_tanah'
    ];

    public function bukuTanah()
    {
        return $this->belongsTo(BukuTanah::class);

    }
    public function peminjams()
{
    return $this->hasMany(Peminjam::class, 'surat_ukur_id');
}
}