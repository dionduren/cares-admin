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
        Schema::create('ms_kategori', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_order')->unsigned();
            $table->integer('id_unit_layanan')->unsigned()->nullable();
            $table->string('nama_unit_layanan')->nullable();
            $table->integer('id_grup')->unsigned()->nullable();
            $table->string('nama_grup')->nullable();
            $table->string('nama_kategori');
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
        Schema::dropIfExists('ms_kategori');
    }
};
