<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->foreign('lokasi')->references('id')->on('daerah');
        });
        
        Schema::table('komentar', function (Blueprint $table) {
            $table->foreign('id_berita')->references('id')->on('berita');
            $table->foreign('id_user')->references('id')->on('user');
        });
        
        Schema::table('feedback_berita', function (Blueprint $table) {
            $table->foreign('id_berita')->references('id')->on('berita');
            $table->foreign('id_user')->references('id')->on('user');
        });
        
        Schema::table('kategori_berita', function (Blueprint $table) {
            $table->foreign('id_berita')->references('id')->on('berita');
            $table->foreign('id_kategori')->references('id')->on('kategori');
        });
        
        Schema::table('bookmark', function (Blueprint $table) {
            $table->foreign('id_berita')->references('id')->on('berita');
            $table->foreign('id_user')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function (Blueprint $table) {
            //
        });
    }
}
