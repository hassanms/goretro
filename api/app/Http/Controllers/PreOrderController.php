<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreOrder;
use Illuminate\Support\Facades\DB;

class PreOrderController extends Controller
{
    //
    public $pre_order;

    function preOrders()
    {
        return[PreOrder::all()];
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
        $pre_order = DB::table('pre-orders')
        ->select()
        ->where('batch', $batch)->get();

        foreach($pre_order as $data)
        {
            
        }
    }
}
