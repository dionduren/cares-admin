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
        Schema::create('tr_attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tiket')->unsigned();
            $table->string('tipe_tiket');
            $table->string('nama_file_original');
            $table->string('nama_file_altered');
            $table->string('tipe_file');
            $table->string('format_file');
            $table->string('file_location');
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
        Schema::dropIfExists('tr_attachments');
    }
};
