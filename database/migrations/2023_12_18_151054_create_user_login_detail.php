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
        Schema::create('user_login_detail', function (Blueprint $table) {
            $table->id();
            $table->string('emp_no');
            $table->string('nama');
            $table->string('gender')->nullable();
            $table->string('emp_grade')->nullable();
            $table->string('emp_grade_title')->nullable();
            $table->string('area')->nullable();
            $table->string('area_title')->nullable();
            $table->string('sub_area')->nullable();
            $table->string('sub_area_title')->nullable();
            $table->string('company')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('email')->nullable();
            $table->string('hp')->nullable();
            $table->string('pos_id')->nullable();
            $table->string('pos_title')->nullable();
            $table->string('pos_grade')->nullable();
            $table->string('pos_kategori')->nullable();
            $table->string('pos_level')->nullable();
            $table->string('org_id')->nullable();
            $table->string('org_title')->nullable();
            $table->string('dept_id')->nullable();
            $table->string('dept_title')->nullable();
            $table->string('komp_id')->nullable();
            $table->string('komp_title')->nullable();
            $table->string('dir_id')->nullable();
            $table->string('dir_title')->nullable();
            $table->string('sup_emp_no')->nullable();
            $table->string('sup_pos_id')->nullable();
            $table->string('bag_id')->nullable();
            $table->string('bag_title')->nullable();
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
        Schema::dropIfExists('user_login_detail');
    }
};
