<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_procedure', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('skill_id')->unsigned();
            $table->integer('procedure_id')->unsigned();
            $table->tinyInteger('related');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('skill_procedure');
    }
}
