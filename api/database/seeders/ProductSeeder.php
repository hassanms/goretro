<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Products;

use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Schema::disableForeignKeyConstraints();
        for($u=0; $u<=50; $u++){
                DB::table('products')->insert([
                    'current_stock_id'=> 12,
                    'item_category'=>'New Arrival',
                    'item_name'=>'Hoddie',
                    'brand'=>'Addidas',
                    'color'=>'White',
                    'main_images_path'=> 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQakPASD1ZrHeAgKHmt3dTOt2YMi4DdtM0TzA&usqp=CAU',
                    'second_images_path'=>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxE0h4B0vHpuszrgKLzLNUwki2zUnlAOIzGg&usqp=CAU',
                    'price'=>'5000',
                    'tier'=>'Tier 2',
                    'locked'=>'10',
                    'received'=>'20',
                    'batch'=>'45',
                    'quantity'=>'50',
                    'arrival_date' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),


            ]);
        }
    }
}
