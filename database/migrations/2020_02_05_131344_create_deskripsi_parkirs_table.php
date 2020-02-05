<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskripsiParkirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deskripsi_parkirs', function (Blueprint $table) {
            $table->increments('id_deskripsi_parkir');
            $table->string('waktu_operasional',300);
            $table->string('alamat_tkp',300);
            $table->string('nomor_telepon',20);
            $table->string('deskripsi',300);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deskripsi_parkirs');
    }
}
