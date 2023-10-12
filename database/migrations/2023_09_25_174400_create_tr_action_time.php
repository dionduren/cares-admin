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
        Schema::create('tr_action_time', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tiket')->unsigned();
            $table->string('action');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('durasi_total');
            $table->integer('durasi')->unsigned();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_action_time');
    }
};
