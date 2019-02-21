<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('categories_id');
            $table->string('recipe_name', 100);
            $table->string('description', 100);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('prep_time')->default(0);
            $table->unsignedBigInteger('cook_time')->default(0);
            $table->unsignedBigInteger('servings')->nullable();
            $table->string('serving_size')->nullable();
            $table->string('slug');

            $table->foreign('categories_id')->references('id')->on('categories');
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
        Schema::dropIfExists('recipes');
    }
}
