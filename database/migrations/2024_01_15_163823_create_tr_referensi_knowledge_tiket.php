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
        Schema::create('tr_referensi_knowledge_tiket', function (Blueprint $table) {
            $table->id();
            $table->integer('id_knowledge_management')->unsigned()->nullable();
            $table->integer('id_tiket')->unsigned()->nullable();
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
        Schema::dropIfExists('tr_referensi_knowledge_tiket');
    }
};
