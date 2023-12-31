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
            $table->string('kategori_sla');
            $table->string('tipe_sla');
            $table->integer('sla_hours_target')->unsigned()->nullable();
            $table->integer('id_tiket')->unsigned();
            $table->datetime('business_start_time')->nullable();
            $table->datetime('business_stop_time')->nullable();
            $table->string('business_elapsed_time')->nullable();
            $table->double('business_time_percentage', 10, 4)->nullable();
            $table->integer('business_days')->unsigned()->nullable();
            $table->integer('business_hours')->unsigned()->nullable();
            $table->integer('business_minutes')->unsigned()->nullable();
            $table->integer('business_seconds')->unsigned()->nullable();
            $table->string('status_sla');
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('actual_stop_time')->nullable();
            $table->string('actual_elapsed_time')->nullable();
            $table->double('actual_time_percentage', 10, 4)->nullable();
            $table->integer('actual_days')->unsigned()->nullable();
            $table->integer('actual_hours')->unsigned()->nullable();
            $table->integer('actual_minutes')->unsigned()->nullable();
            $table->integer('actual_seconds')->unsigned()->nullable();
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
        Schema::dropIfExists('tr_sla');
    }
};
