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
        Schema::create('ms_knowledge_management', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_tiket');
            $table->integer('id_kategori')->unsigned();
            $table->string('kategori_tiket');
            $table->integer('id_subkategori')->unsigned();
            $table->string('subkategori_tiket');
            $table->integer('id_item_kategori')->unsigned()->nullable();
            $table->string('item_kategori_tiket')->nullable();
            $table->text('judul_solusi');
            $table->text('detail_solusi');
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
        Schema::dropIfExists('ms_knowledge_management');
    }
};
