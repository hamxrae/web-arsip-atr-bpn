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
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_peminjam');
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->unsignedBigInteger('surat_ukur_id'); // relasi ke surat ukur
            $table->string('foto')->nullable(); // menambahkan kolom foto (opsional)
            $table->timestamps();

            $table->foreign('surat_ukur_id')
                  ->references('id')->on('surat_ukur')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
