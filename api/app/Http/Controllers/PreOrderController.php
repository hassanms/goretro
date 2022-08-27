<?php

namespace App\Http\Controllers;

use App\Models\CurrentStock;
use Illuminate\Http\Request;
use App\Models\PreOrder;
use App\Models\Products;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

function getViews($category)
{
    if ($category === 'popular') {
        return rand(4, 6);
    } else if ($category === 'average') {
        return rand(0, 3);
    } else if ($category === 'common') {
        return rand(0, 2);
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
        foreach ($data as $record) {
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
       
        $pastDates = "";
        $preOrders = Products::all()
        ->sortBy('arrival_date'); 

        $unique = $preOrders->unique('arrival_date')->where('received',0);

        $today = Carbon::today()->toDateString();
        foreach($unique as $data)    
        {
            $date = $data->arrival_date->toDateString();
            if($data->arrival_date > $today)
            {
                $dates[] = $data->arrival_date;
            }
            else
            {
                $pastDates = "Not Working";
            }
        }
       
        $collection = $unique->map(function ($array) {
            return collect($array)->unique('arrival_date')->all();
        });

        $finalPro = Products::orderBy("arrival_date")
            ->whereIn('id', $collection)
            ->get();

        
           
        return [$today, $unique[0]->arrival_date];

        if ($request->batch == 'Batch Arriving Soonest') {
          $batch1 = DB::table('products')
          ->select()->where('arrival_date', $dates[0]);

          return $batch1;
        } else if ($request->batch == 'Batch Arriving Second') {
           
        } else if ($request->batch == 'Batch Arriving Third') {
           

        } else if ($request->batch == 'Batch Arriving Fourth') {
            
        }
    }
}
