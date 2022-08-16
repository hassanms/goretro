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

    function filterByBatch(Request $request)
    {
        $batch1 = [];
        $batch2 = [];
        $batch3 = [];
        $batch4 = [];
        
        if($request->batch == 'Batch 1')
        {
            $preOrders = DB::table('products')
            ->select()
            ->where('received', 0)->get();

            return[$preOrders];
        }
        else if($request->batch == 'Batch 2')
        {
            return["Batch 2 OK"];
        }
        else if($request->batch == 'Batch 3')
        {
            return["Batch 3 OK"];           
        }
        else if($request->batch == 'Batch 4')
        {
            return["Batch 4 OK"];           
        }
       
    }
}
