<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned()->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('CASCADE');
            $table->string('type')->nullable();
            $table->string('attribute_key')->nullable();
            $table->string('attribute_value')->nullable();
            $table->string('content')->nullable();
            $table->string('prefix')->nullable();
            // $table->integer('seo_property_id')->unsigned()->nullable();
            // $table->foreign('seo_property_id')->references('id')->on('seo_properties')->onDelete('CASCADE');
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
        Schema::dropIfExists('seo_articles');
    }
}
