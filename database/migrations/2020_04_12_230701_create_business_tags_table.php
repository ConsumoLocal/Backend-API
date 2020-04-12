<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('business')->unsigned();
            $table->bigInteger('tag')->unsigned();
            $table->foreign('business')->references('id')->on('businesses');
            $table->foreign('tag')->references('id')->on('tags');
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
        Schema::dropIfExists('business_tags');
    }
}
