<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class TrackAndTraceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_and_trace', function (Blueprint $table) {
            //nhi in nz is 7 characters but rounding to 10 for ease, same for ward
            $table->increments('id');
            $table->string('nhi', 10);
            $table->string('ward' , 30);
            $table->string('status' , 30)->default('Chart Recieved');
            $table->boolean('chart_query')->default(false);;
            $table->timestamp('receival_time');
            $table->timestamp('completed_time');
            $table->timestamp('query_time');
            $table->timestamp('resolved_query_time');
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
        Schema::drop('track_and_trace');
    }
}
