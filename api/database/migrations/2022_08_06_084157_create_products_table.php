<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('current_stock_id')->unsigned(); //Foreign Key
            $table->string('item_category');
            $table->string('item_name');
            $table->string('brand');
            $table->string('color');
            $table->longText('main_images_path');
            $table->longText('second_images_path');
            $table->integer('price');
            $table->string('tier');
            $table->boolean('locked');
            
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table)
        {
            $table->foreign('current_stock_id')->references('id')->on('current_stocks')
            ->onDelete('cascade');
        });

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
};
