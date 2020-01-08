<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->increments('id_tiket');
            $table->unsignedInteger('id_kendaraan_fk');
            $table->string('kode_tiket',25);
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar');
            $table->string('no_plat',15);
            $table->string('status_tiket',30);
            $table->timestamps();

            $table->foreign('id_kendaraan_fk')->references('id_kendaraan')->on('kendaraans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tikets');
    }
}
