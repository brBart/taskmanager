<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password', 60);
            $table->rememberToken();
            $table->integer('company_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->string('photo');
            $table->string('position');
            $table->string('phone');
            $table->string('city');
            $table->string('country');
            $table->string('timezone');
            $table->string('activation_code');
            $table->tinyInteger('activated')->unsigned()->default(0);
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
        Schema::drop('users');
    }
}
