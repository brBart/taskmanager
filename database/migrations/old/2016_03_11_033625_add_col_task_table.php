<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //

            $table->dropColumn('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
             $table->dropColumn('status_id');
             $table->dropColumn('skill_id');
             $table->dropColumn('procedure_id');
             $table->dropColumn('assign_user_id');
             $table->dropColumn('estimate');
        });
    }
}
