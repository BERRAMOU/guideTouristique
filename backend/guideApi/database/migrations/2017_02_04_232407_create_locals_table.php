<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('address')->nullable();
            $table->string('imagePath')->nullable();
            $table->boolean('wifi')->nullable();
            $table->string('detail')->nullable();
            $table->double('latitude');
            $table->double('longitude');
            $table->integer('city_id')->unsigned();



            $table->foreign('city_id')->references('id')->on('cities');
        });

        Schema::create('categorie_local', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('local_id')->unsigned()->index();
            $table->integer('categorie_id')->unsigned()->index();

            $table->foreign('local_id')->references('id')->on('locals')->onDelete('cascade');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locals');
        Schema::dropIfExists('categorie_local');
    }
}
