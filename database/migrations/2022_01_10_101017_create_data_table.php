<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
			$table->string('nama');
			$table->string('tempat_lahir');
			$table->timestamp('tgl_lahir');
			$table->string('foto');
			$table->string('jenis_kelamin');
			$table->string('gol_darah');
			$table->string('alamat');
			$table->string('rt');
			$table->string('rw');
			$table->string('kelurahan');
			$table->string('kecamatan');
			$table->string('agama');
			$table->string('status');
			$table->string('pekerjaan');
			$table->string('kewarganegaraan');
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
        Schema::dropIfExists('data');
    }
}
