<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CurrentStock;

class CurrentStockController extends Controller
{
    function getData() 
    {
        $data = CurrentStock::all();
        
        // $new_data = [];

        // foreach($data as $d)
        // {
        //     $new_data[] = [
        //         'id' => $d->id,
        //         'name' => $d->name,
        //         'items_left' => $d->items_left,
        //         'viewing' => if($d->category === 'popular') { random_int(1,3) } elseif 
        //         'created_at' => $d->created_at,
        //         'updated_at' => $d->updated_at
        //     ];
        // }

        return [$data];
    }
}
