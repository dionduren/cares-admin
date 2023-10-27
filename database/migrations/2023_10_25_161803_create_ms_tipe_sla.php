<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_tipe_sla', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sla');
            $table->string('tipe_sla');
            $table->string('tipe_tiket');
            $table->string('tipe_waktu');
            $table->string('durasi_text');
            $table->integer('durasi_jam')->unsigned();
            $table->text('keterangan');
            $table->string('updated_by');
            $table->string('created_by');
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
        Schema::dropIfExists('ms_tipe_sla');
    }
};
