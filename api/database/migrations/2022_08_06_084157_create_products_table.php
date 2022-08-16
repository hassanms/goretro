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
            $table->integer('current_stock_id')->unsigned(); // foreign Key
            $table->string('item_category');
            $table->string('item_name');
            $table->string('brand');
            $table->string('color');
            $table->longText('main_images_path');
            $table->longText('second_images_path');
            $table->integer('price');
            $table->string('tier');
            $table->boolean('locked');
            $table->boolean('received');
            $table->integer('batch');
            $table->integer('quantity');
            $table->date('arrival_date');
            
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
