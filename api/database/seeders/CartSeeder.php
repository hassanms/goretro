<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=1; $i<=30; $i++){
            DB::table('carts')->insert([
                'name'=>'Global',
                'category'=>'New Arrival',
                'price'=>'RS. 23400',
                'tier'=>'Tier 1',
                'status'=>'Avaliable',
                'session'=>'Start',
                'lock_item'=>'10',
                'email'=>'global@gmail.com',
                'main_image'=>'https://images.pexels.com/photos/12446409/pexels-photo-12446409.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'second_image'=>'https://images.pexels.com/photos/9740386/pexels-photo-9740386.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

            DB::table('carts')->insert([
                'name'=>'Local',
                'category'=>'Damage',
                'price'=>'RS. 23400',
                'tier'=>'Tier 2',
                'status'=>'May be',
                'session'=>'Mid',
                'lock_item'=>'20',
                'email'=>'local@gmail.com',
                'main_image'=>'https://images.pexels.com/photos/11142589/pexels-photo-11142589.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'second_image'=>'https://images.pexels.com/photos/8148576/pexels-photo-8148576.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

            DB::table('carts')->insert([
                'name'=>'Domestic',
                'category'=>'Moderate',
                'price'=>'RS. 23300',
                'tier'=>'Tier 3',
                'status'=>'Not Avaliable',
                'session'=>'Mid',
                'lock_item'=>'40',
                'email'=>'domestic@gmail.com',
                'main_image'=>'https://images.pexels.com/photos/8148577/pexels-photo-8148577.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'second_image'=>'https://images.pexels.com/photos/2553790/pexels-photo-2553790.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);



    }
}
}
