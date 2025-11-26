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
        Schema::create('surat_ukur', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buku_tanah_id')->unique();

        $table->string('ukuran_luar_tanah');
        $table->string('no_surat_tanah');
        $table->string('tahun_tanah');
        $table->timestamps();

        $table->foreign('buku_tanah_id')
              ->references('id')
              ->on('buku_tanah')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_ukur');
    }
};
