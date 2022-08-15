<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CurrentStock;

function getViews($category)
{
    if($category === 'popular')
    {
        return rand(4,6);
    }

    else if($category === 'average')
    {
        return rand(1,3);
    }

    else if($category === 'common')
    {
        return rand(0,2);
    }
}

class CurrentStockController extends Controller
{
    function getData() 
    {
        $data = CurrentStock::all();
        
        $new_data = [];

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
}
