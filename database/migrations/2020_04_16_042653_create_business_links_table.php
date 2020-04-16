<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_links', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('business')->unsigned();
            $table->bigInteger('link')->unsigned();
            $table->string('value', '300');
            $table->foreign('business')->references('id')->on('businesses');
            $table->foreign('link')->references('id')->on('links');
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
        Schema::dropIfExists('business_links');
    }
}
