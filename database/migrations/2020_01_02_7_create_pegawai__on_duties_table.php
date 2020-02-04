<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiOnDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai__on_duties', function (Blueprint $table) {
            $table->increments('id_pegawaiOnDuty');
            $table->unsignedInteger('id_shift_fk');
            $table->unsignedInteger('id_pegawai_fk');
            $table->unsignedInteger('id_tiket_fk');
            $table->unsignedInteger('id_transaksi_fk');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_shift_fk')->references('id_shift')->on('shifts');
            $table->foreign('id_pegawai_fk')->references('id_pegawai')->on('pegawais');
            $table->foreign('id_tiket_fk')->references('id_tiket')->on('tikets');
            $table->foreign('id_transaksi_fk')->references('id_transaksi')->on('transaksis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai__on_duties');
    }
}
