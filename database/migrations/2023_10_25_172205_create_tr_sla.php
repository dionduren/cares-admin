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
        Schema::create('tr_sla', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sla')->unsigned();
            $table->string('tipe_sla');
            $table->integer('id_tiket')->unsigned();
            $table->integer('status_sla')->unsigned();
            $table->datetime('business_start_time')->nullable();
            $table->datetime('business_stop_time')->nullable();
            $table->string('business_elapsed_time');
            $table->double('business_time_percentage', 10, 4);
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('actual_stop_time')->nullable();
            $table->string('actual_elapsed_time');
            $table->double('actual_time_percentage', 10, 4);
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
        Schema::dropIfExists('tr_sla');
    }
};
