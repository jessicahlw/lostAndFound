<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKlaimFieldsToBarangTable extends Migration
{
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->enum('statusKlaim', ['belum', 'sudah'])->default('belum')->after('id'); // ganti after('keterangan') jadi after('id') atau kolom lain yang pasti ada
            $table->unsignedBigInteger('id_pengklaim')->nullable()->after('statusKlaim');

            $table->foreign('id_pengklaim')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['id_pengklaim']);
            $table->dropColumn(['statusKlaim', 'id_pengklaim']);
        });
    }
}
