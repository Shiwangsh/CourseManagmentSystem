<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_submits', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->string('status')->nullable();
            $table->bigInteger('assignment_id')->unsigned();
            $table->bigInteger('module_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('assignment_id')
                ->references('id')->on('assignments')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('module_id')
                ->references('id')->on('modules')
                ->onDelete('cascade');

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
        Schema::dropIfExists('assignment_submits');
    }
}
