<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreOrder;
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
                'items_left' => $record->items_left,
                'category' => $record->category,
                'image' => $record->image,
                'views' => getViews($record->category)
            ];
        }

        return $new_data;
    }

    function addOrder(Request $request)
    {
        $pre_order = new PreOrder();

        foreach($request as $data)
        {
            $pre_order->supplier_name = $data->supplier_name;
            $pre_order->supplier_address = $data->supplier_address;
            $pre_order->status = $data->status;
            $pre_order->batch = $data->batch;
            $pre_order->due_date = $data->due_date;
            $pre_order->item_category = $data->item_category;
            $pre_order->item_name = $data->item_name;
            $pre_order->brand = $data->brand;
            $pre_order->color = $data->color;
            $pre_order->main_images_path = $data->main_image;
            $pre_order->second_images_path = $data->secondary_image;
            $pre_order->price = $data->price;
            $pre_order->tier = $data->tier;
        }

        $result = $pre_order->save();

        if($result)
        {
            return["Order addedd successfully"];
        }
        else
        {
            return["Operation failed"];
        }
    }

    function filterByBatch($batch)
    {
        $batch1 = [];
        $batch2 = [];
        $batch3 = [];
        $batch4 = [];
        
        $pre_order = DB::table('pre-orders')
        ->select()
        ->where('batch', $batch)->get();

        foreach($pre_order as $data)
        {
           if($data->batch == 'Batch 1')
           {
            $batch1 = [
                'supplier_name' => $data->supplier_name,
                'supplier_address' => $data->supplier_address,
                'status' => $data->status,
                'due_date' => $data->due_date,
                'item_category' => $data->item_category,
                'item_name' => $data->item_name,
                'brand' => $data->brand,
                'color' => $data->color,
                'main_images_path' => $data->main_images_path,
                'second_images_path' => $data->second_images_path,
                'price' => $data->price,
                'shopping_cart' => $data->shopping_cart,
                'tier' => $data->tier,
            ];
           }
           
           else if($data->batch == 'Batch 2')
           {
            $batch2 = [
                'supplier_name' => $data->supplier_name,
                'supplier_address' => $data->supplier_address,
                'status' => $data->status,
                'due_date' => $data->due_date,
                'item_category' => $data->item_category,
                'item_name' => $data->item_name,
                'brand' => $data->brand,
                'color' => $data->color,
                'main_images_path' => $data->main_images_path,
                'second_images_path' => $data->second_images_path,
                'price' => $data->price,
                'shopping_cart' => $data->shopping_cart,
                'tier' => $data->tier,
            ];
           }
           
           else if($data->batch == 'Batch 3')
           {
            $batch3 = [
                'supplier_name' => $data->supplier_name,
                'supplier_address' => $data->supplier_address,
                'status' => $data->status,
                'due_date' => $data->due_date,
                'item_category' => $data->item_category,
                'item_name' => $data->item_name,
                'brand' => $data->brand,
                'color' => $data->color,
                'main_images_path' => $data->main_images_path,
                'second_images_path' => $data->second_images_path,
                'price' => $data->price,
                'shopping_cart' => $data->shopping_cart,
                'tier' => $data->tier,
            ];
           }

           else if($data->batch == 'Batch 4')
           {
            $batch3 = [
                'supplier_name' => $data->supplier_name,
                'supplier_address' => $data->supplier_address,
                'status' => $data->status,
                'due_date' => $data->due_date,
                'item_category' => $data->item_category,
                'item_name' => $data->item_name,
                'brand' => $data->brand,
                'color' => $data->color,
                'main_images_path' => $data->main_images_path,
                'second_images_path' => $data->second_images_path,
                'price' => $data->price,
                'shopping_cart' => $data->shopping_cart,
                'tier' => $data->tier,
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
