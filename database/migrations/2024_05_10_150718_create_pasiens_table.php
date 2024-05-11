<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->bigIncrements('id_pasien');
            $table->string('nomor_identitas', 30);
            $table->string('nama_pasien', 80);
            $table->enum('jenis_kelamin', ['L', 'P'])->comment('L: Laki-laki, P: Perempuan');
            $table->text('alamat');
            $table->string('no_telp', 12);
            $table->integer('nik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
}
