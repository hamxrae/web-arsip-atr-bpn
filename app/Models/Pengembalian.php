<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = [
        'nama',
        'buku_tanah_id',
        'no_hp',
        'email',
        'waktu_pengembalian',
    ];

    public function bukuTanah()
    {
        return $this->belongsTo(BukuTanah::class);
    }
}
