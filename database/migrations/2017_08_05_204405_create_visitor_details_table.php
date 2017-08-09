<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_per_day_id')->unsigned()->nullable();
            $table->foreign('visitor_per_day_id')->references('id')->on('visitor_per_days')->onDelete('CASCADE');
            $table->ipAddress('ip_address');
            $table->string('page', 100)->index();
            $table->string('browser', 100)->nullable()->index();
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
        Schema::dropIfExists('visitor_details');
    }
}
