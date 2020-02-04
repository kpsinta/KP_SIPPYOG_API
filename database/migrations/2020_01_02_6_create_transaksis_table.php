<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->unsignedInteger('id_tiket_fk');
            $table->timestamp('waktu_transaksi');
            $table->double('total_transaksi');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_tiket_fk')->references('id_tiket')->on('tikets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
