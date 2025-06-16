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
        Schema::table('barangs', function (Blueprint $table) {
            $table->text('keterangan_klaim')->nullable();
            $table->string('foto_klaim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropColumn(['keterangan_klaim', 'foto_klaim']);
            // $table->string('detailLokasi')->nullable(); // ← ini harus dihapus atau dikomen

        });
    }
};
