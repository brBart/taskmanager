<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Readd2ColumnTimespent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timespent', function (Blueprint $table) {
            //
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timespent', function (Blueprint $table) {
            //
        });
    }
}
