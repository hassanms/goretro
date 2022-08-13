<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CurrentStock;

function getViews($category)
{
    if($category === 'popular')
    {
        $viewing = rand(4,6);
        return $viewing;
    }

    else if($category === 'average')
    {
        $viewing = rand(0,3);
        return $viewing;
    }

    else if($category === 'common')
    {
        $viewing = rand(0,2);
        return $viewing;
    }
}

class CurrentStockController extends Controller
{
    function getData() 
    {
        $viewing = "";

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

        return [$new_data];
    }
}
