<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('organisasi_id');
            $table->foreignId('user_id');
            $table->string('total');
            $table->date('tanggal');
            $table->date('nama_barang');
            $table->date('jmlh_barang');
            $table->date('satuan_harga');
            $table->string('sumber_dana');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
}
