<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id_pegawai');
            $table->unsignedInteger('id_role_fk');
            $table->string('nama_pegawai',100);
            $table->string('nip_pegawai',30);
            $table->string('username_pegawai',15);
            $table->string('password_pegawai',100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_role_fk')->references('id_role')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
