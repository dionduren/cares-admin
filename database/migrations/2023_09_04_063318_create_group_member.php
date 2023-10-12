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
        Schema::create('ms_group_member', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_group')->unsigned();
            $table->string('nama_group');
            $table->string('nik_member');
            $table->string('nama_member');
            $table->string('role_member');
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
        Schema::dropIfExists('ms_group_member');
    }
};
