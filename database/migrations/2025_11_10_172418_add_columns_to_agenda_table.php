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
        Schema::table('agenda', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('agenda', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('judul');
            }
            if (!Schema::hasColumn('agenda', 'waktu_mulai')) {
                $table->time('waktu_mulai')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('agenda', 'waktu_selesai')) {
                $table->time('waktu_selesai')->nullable()->after('waktu_mulai');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agenda', function (Blueprint $table) {
            if (Schema::hasColumn('agenda', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
            if (Schema::hasColumn('agenda', 'waktu_mulai')) {
                $table->dropColumn('waktu_mulai');
            }
            if (Schema::hasColumn('agenda', 'waktu_selesai')) {
                $table->dropColumn('waktu_selesai');
            }
        });
    }
};
