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
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name');
            $table->string('category');
            $table->string('price');
            $table->string('tier');
            $table->string('status');
            $table->string('session');
            $table->boolean('lock_item');
            $table->string('email');
            $table->text('main_image');
            $table->text('second_image');
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
        Schema::dropIfExists('carts');
    }
};
