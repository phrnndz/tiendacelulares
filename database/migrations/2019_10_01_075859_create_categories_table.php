<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            'nombre' => "Apple"
        ]);

        DB::table('categories')->insert([
            'nombre' => "Huawei"
        ]);

        DB::table('categories')->insert([
            'nombre' => "LG"
        ]);

        DB::table('categories')->insert([
            'nombre' => "Samsung"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
