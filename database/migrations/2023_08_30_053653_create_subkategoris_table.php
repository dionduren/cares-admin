<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ms_subkategori', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kategori')->unsigned();
            // $table->string('id_kategori');
            $table->string('nama_kategori');
            $table->string('nama_subkategori');
            $table->string('tipe_tiket')->nullable();
            $table->integer('level_dampak')->nullable();
            $table->integer('level_urgensi')->nullable();
            $table->string('updated_by');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_subkategori');
    }
};
