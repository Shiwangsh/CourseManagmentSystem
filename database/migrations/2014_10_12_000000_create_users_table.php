<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('fname');
            $table->string('lname');
            $table->date('dob')->nullable();
            $table->string('contact')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('roles', ['admin', 'tutor', 'student'])->default('student');
            $table->enum('gender', ['male', 'female', 'other'])->default('other');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
