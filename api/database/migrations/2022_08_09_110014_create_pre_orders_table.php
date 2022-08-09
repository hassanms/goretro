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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('supplier_name');
            $table->string('supplier_address');
            $table->string('status');
            $table->string('batch');
            $table->date('due_date');
            $table->string('item_category');
            $table->string('item_name');
            $table->string('brand');
            $table->string('color');
            $table->longText('main_images_path');
            $table->longText('second_images_path');
            $table->integer('price');
            $table->string('tier');
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
        Schema::dropIfExists('pre_orders');
    }
};
