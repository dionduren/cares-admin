<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('jabatan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('email')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->integer('role_id')->unsigned();
            $table->string('atasan_id')->nullable();
            $table->text('avatar')->nullable();     //DIFFERENT
            $table->rememberToken();
            $table->string('updated_by');
            $table->string('created_by');
            $table->timestamps();
        });
        // User::create(['name' => 'admin', 'email' => 'admin@themesdesign.com', 'password' => Hash::make('123456'), 'email_verified_at' => '2022-01-02 17:04:58', 'avatar' => 'avatar-1.jpg', 'created_at' => now(),]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
