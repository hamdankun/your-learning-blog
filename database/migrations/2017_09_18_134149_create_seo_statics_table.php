<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoStaticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_statics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 50)->nullable()->index();
            $table->string('attribute_key', 100)->nullable()->index();
            $table->string('attribute_name', 100)->nullable();
            $table->text('attribute_content')->nullable();
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
        Schema::dropIfExists('seo_statics');
    }
}
