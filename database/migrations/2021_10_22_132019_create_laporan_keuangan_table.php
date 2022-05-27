<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKeuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_keuangan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->foreignId('organisasi_id');
            $table->string('jmlh_pemasukan');
            $table->string('jmlh_pengeluaran');
            $table->date('tanggal');
            $table->string('sumber_dana');
            $table->string('nama_barang')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('harga_satuan')->nullable();
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
        Schema::dropIfExists('laporan_keuangan');
    }
}