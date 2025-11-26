<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku_tanah', function (Blueprint $table) {
            $table->id();
           $table->string('no_buku_tanah')->unique();
            $table->string('nama_pemilik');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->enum('jenis_pelayanan', ['Wakaf', 'Balik_nama', 'Roya', 'Perubahan_hak' , 'Skpt']);
            $table->string('status_berkas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tanah');
    }
};
