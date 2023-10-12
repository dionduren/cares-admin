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
        Schema::create('tr_tiket', function (Blueprint $table) {
            $table->id();
            $table->string('user_id_creator')->nullable();
            $table->integer('id_tiket_prev')->unsigned()->nullable();
            $table->string('nomor_tiket')->nullable();
            $table->string('tipe_tiket');
            $table->integer('id_kategori')->unsigned();
            $table->string('kategori_tiket');
            $table->integer('id_subkategori')->unsigned();
            $table->string('subkategori_tiket');
            $table->integer('id_item_kategori')->unsigned()->nullable();
            $table->string('item_kategori_tiket')->nullable();
            $table->string('judul_tiket');
            $table->text('detail_tiket');
            $table->string('status_tiket');
            $table->text('attachment')->nullable();
            $table->integer('level_dampak')->unsigned()->nullable();
            $table->integer('level_prioritas')->unsigned()->nullable();
            $table->string('tipe_matriks')->nullable();
            $table->integer('id_group')->unsigned()->nullable();
            $table->string('assigned_group')->nullable();
            $table->string('id_technical')->nullable();
            $table->string('assigned_technical')->nullable();
            $table->integer('id_solusi')->unsigned()->nullable();
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
        Schema::dropIfExists('tr_tiket');
    }
};
