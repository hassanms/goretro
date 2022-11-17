<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CurrentStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<=60; $i++){
            DB::table('current_stocks')->insert([
                'name'=>'Men Jeans',
                'items_left'=>'12',
                'category'=>'New Arrival',
                'image'=>'https://m.media-amazon.com/images/I/81I2qjL2arL._AC_UL320_.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);}
    }
}
