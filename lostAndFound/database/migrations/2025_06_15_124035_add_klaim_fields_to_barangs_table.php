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
            $table->enum('statusKlaim', ['belum', 'diklaim'])->default('belum');
            $table->unsignedBigInteger('id_pengklaim')->nullable()->after('user_id');

            $table->foreign('id_pengklaim')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->timestamp('tanggal_klaim')->nullable();
            $table->text('pesan_klaim')->nullable();
            $table->boolean('is_notified')->default(false);
        });
    }
};
