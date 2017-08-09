<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorPerDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_per_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned()->nullable();
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('CASCADE');
            $table->dateTime('date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('total')->nullable()->default(0)->index();
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
        Schema::dropIfExists('visitor_per_days');
    }
}
