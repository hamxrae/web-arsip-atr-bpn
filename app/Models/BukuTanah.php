<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTanah extends Model
{
    protected $table = 'buku_tanah';

    protected $fillable = [
        'no_buku_tanah',
        'nama_pemilik',
        'desa_kelurahan',
        'kecamatan',
        'jenis_pelayanan',
        'status_berkas'
    ];

    public function suratUkur()
    {
        return $this->hasOne(SuratUkur::class, 'buku_tanah_id');
    }

    public function pengembalian()
{
    return $this->hasMany(Pengembalian::class);
}


}
