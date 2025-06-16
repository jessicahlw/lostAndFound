<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailLokasiToBarangsTable extends Migration
{
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->string('detailLokasi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            // $table->dropColumn('detailLokasi');
        });
    }
}
