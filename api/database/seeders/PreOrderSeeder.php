<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PreOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($u=0; $u<=80; $u++){
            DB::table('pre_orders')->insert([
                'name'=>'Hoddie',
                'items_left'=>'14',
                'category'=>'New Arrival',
                'image'=> 'https://m.media-amazon.com/images/I/81XDp4Pm+dL._AC_UL320_.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),

            ]);
    }
}

}