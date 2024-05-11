<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratRujukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_rujukan', function (Blueprint $table) {
            $table->id('id_surat_rujukan');
            $table->string('nomor_surat', 20);
            $table->date('tgl_surat');
            $table->unsignedBigInteger('id_pasien');
            $table->foreign('id_pasien')->references('id_pasien')->on('pasien');
            $table->string('nama_pasien', 100);
            $table->integer('usia_pasien');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->text('diagnosis');
            $table->string('dokter_pengirim', 100);
            $table->text('catatan');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_rujukans');
    }
}
