<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('title');
            $table->integer('ordering')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('skill_id')->unsigned();
            $table->integer('procedure_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('assign_user_id')->unsigned();
            $table->integer('estimated_hours')->unsigned();
            $table->integer('estimated_minutes')->unsigned();
            $table->integer('created_by_user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('tasks');
    }
}
