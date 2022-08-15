<?php

namespace App\Http\Controllers;

use App\Models\CurrentStock;
use Illuminate\Http\Request;
use App\Models\PreOrder;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

function getViews($category)
{
    if($category === 'popular')
    {
        return rand(4,6);
    }

    else if($category === 'average')
    {
        return rand(0,3);
    }

    else if($category === 'common')
    {
        return rand(0,2);
    }
}

class PreOrderController extends Controller
{
    //
    public $pre_order;

    function preOrders()
    {
        $new_data = [];
        $data = PreOrder::all();
        foreach($data as $record)
        {
            $new_data[] = 
            [
                'id' => $record->id,
                'name' => $record->name,
                'category' => $record->category,
                'image' => $record->image,
                'items_left' => $record->items_left
            ];
        }

        return $new_data;
    }

    function preOrderCart($category)
    {
         /**
         * This api will display products in carousel by category
         */

        $query = DB::table('products')
            ->select()
            ->where('item_category', $category)->get();

        
        foreach ($query as $record) {
            

            //Pre Order Stock
            if($record->received == 0)
                {
                    $this->item[] = [
                        'id' => $record->id,
                        'item' => $record->item_name,
                        'brand' => $record->brand,
                        'image_path' => $record->main_images_path,
                        'price' => $record->price,
                        'color' => $record->color,
                        'tier' => $record->tier,
                        'category' => $record->item_category,
                        'received' => $record->received,
                        'damage_image_path' => $record->second_images_path != null ? $record->second_images_path : null
                    ];
                    return[$this->item];
                }

        }
    }

    function filterByBatch($batch)
    {
        $batch1 = [];
        $batch2 = [];
        $batch3 = [];
        $batch4 = [];
        
        $pre_order = DB::table('products')
        ->select()
        ->where('batch', $batch)->get();

        foreach($pre_order as $data)
        {
           if($data->batch == 'Batch 1')
           {
            $batch1 = [
                
            ];
           }
           
           else if($data->batch == 'Batch 2')
           {
            $batch2 = [
               
            ];
           }
           
           else if($data->batch == 'Batch 3')
           {
            $batch3 = [
               
            ];
           }

           else if($data->batch == 'Batch 4')
           {
            $batch4 = [
                
            ];
           }
        }

        if(count($batch1) > 1)
        {
            return[$batch1, "Batch arriving soonest"];
        }
        else if(count($batch2) > 1)
        {
            return[$batch2, "Batch arriving second"];
        }
        else if(count($batch3) > 1)
        {
            return[$batch3, "Batch arriving third"];
        }
        else if(count($batch4) > 1)
        {
            return[$batch4, "Batch arriving fourth"];
        }
    }
}
