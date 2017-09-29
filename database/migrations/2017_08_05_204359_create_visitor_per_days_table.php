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
        Schema::create('article_visitor_per_days', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_visitor_id')->unsigned()->nullable();
            $table->foreign('article_visitor_id')->references('id')->on('article_visitors')->onDelete('CASCADE');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('article_visitor_per_days');
    }
}
