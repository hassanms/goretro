<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CurrentStock;

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
            ];
            if($record->category === 'popular')
            {
               $viewing = rand(1,4);
               $new_data[] = [
                'views' => $viewing
               ];  
            }
    
            else if($record->category === 'average')
            {
                $viewing = rand(0,3);
               $new_data[] = [
                'views' => $viewing
               ];    
            }
    
            else if($record->category === 'common')
            {
                $viewing = rand(0,1);
                $new_data[] = [
                 'views' => $viewing
                ];    
            }
           
        }

        return [$new_data, $viewing];
    }

    function getViews($category)
    {
        $views = DB::table('current_stocks')
        ->select('views')
        ->where('category', $category)->get();

        $items_left = DB::table('current_stocks')
        ->select('items_left')
        ->where('category', $category)->get();

        return [$views, $items_left];
    }
}
