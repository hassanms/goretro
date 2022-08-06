<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public $item = [];
    //
    function getAllProducts()
    {
        $products[] = Products::all();

        return [$products];
    }

    function addProduct(Request $request)
    {
        $product = new Products();

        $product->current_stock_id = $request->stock_id;
        $product->item_category = $request->item_category;
        $product->item_name = $request->item_name;
        $product->brand = $request->brand;
        $product->color = $request->color;
        $product->main_images_path = $request->main_image;
        $product->second_images_path = $request->secondary_image;
        $product->price = $request->price;
        $product->tier = $request->tier;
        $product->locked = $request->locked;

        $result = $product->save();

        if($result)
        {
            
            return ['Result' => 'Data saved successfully'];
        }
        else
        {
            return ['Result' => 'Operation Failed'];
        }
    }

    //Method for display carousel
    function displayProductByCategory($category)
    {

        $query = DB::table('products')
        ->select('item_name', 'brand', 'main_images_path', 'second_images_path', 'price')
        ->where('item_category' , $category)->get();

        foreach($query as $record)
        {
            $this->item[] = [
                'item: ' => $record->item_name,
                'brand' => $record->brand,
                'image_path' => $record->main_images_path,
                'price' => $record->price
            ];

            if($record->second_image_path != null)
            {
                $this->item[] = [
                    'damage_image_path' => $record->second_images_path
                ];
            }
            else
            {
                $this->item[] = [
                    'damage_image_path' => "null"
                ];
            }
        }

        return [$this->item];
    }

     function checkItemLock($status)
    {
        $locked = 0;       
        $query = DB::table('products')
        ->select('id', 'item_name', 'locked')
        ->where('locked', $status)->get();

        foreach($query as $record)
        {
            $this->item[] = [
                'id: ' => $record->id,
                'item' => $record->item_name,
                'locked' => $record->locked,
            ];
            $locked = $record->locked;
        }
        
        if($locked = 1)
        {
            return[$this->item, "This item has been chosen by another customer and is in their cart. It will become available if they do not purchase within 1 hour"];
        }
        else if($locked = 0)
        {
            return[$this->item, "Item is unlocked please proceed to checkout."];
        }
        return[$this->item, $locked];
    }
}
