<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('slug')->unique()->nullable();
            $table->string("name", 255)->nullable(false); //titulo del producto
            $table->text("goal")->nullable(); //objetivo del curso
            $table->text("made_for")->nullable(); // dirigo a quien
            $table->date('date')->nullable(); //fecha
            $table->string("place", 255)->nullable(); //lugar
            $table->string("photo", 255)->nullable();
            $table->decimal("price", 8, 2);
            $table->boolean("status")->nullable(false)->default(true);
            $table->timestamps();
        });

        // Schema::table('products', function (Blueprint $table) {
        //     $table->foreign('category_id')->references('id')->on('categories');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
