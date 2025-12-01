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
        Schema::table('surat_ukur', function (Blueprint $table) {
            // Ensure column exists
            if (Schema::hasColumn('surat_ukur', 'buku_tanah_id')) {
                // Drop foreign key constraint first if it exists
                try {
                    $table->dropForeign('surat_ukur_buku_tanah_id_foreign');
                } catch (\Exception $e) {
                    // ignore if foreign key not present
                }

                // Drop the unique constraint on buku_tanah_id if it exists
                try {
                    $table->dropUnique('surat_ukur_buku_tanah_id_unique');
                } catch (\Exception $e) {
                    // index may not exist; ignore
                }

                // Add a non-unique index for performance
                try {
                    $table->index('buku_tanah_id', 'surat_ukur_buku_tanah_id_index');
                } catch (\Exception $e) {
                    // ignore if index already exists
                }

                // Recreate foreign key constraint (will use non-unique index)
                try {
                    $table->foreign('buku_tanah_id', 'surat_ukur_buku_tanah_id_foreign')
                          ->references('id')
                          ->on('buku_tanah')
                          ->onDelete('cascade');
                } catch (\Exception $e) {
                    // ignore if cannot re-add
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_ukur', function (Blueprint $table) {
            // Drop the non-unique index and restore unique constraint
            try {
                $table->dropIndex('surat_ukur_buku_tanah_id_index');
            } catch (\Exception $e) {
                // ignore
            }

            try {
                $table->unique('buku_tanah_id', 'surat_ukur_buku_tanah_id_unique');
            } catch (\Exception $e) {
                // ignore
            }
        });
    }
};
