<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public $item = [];
    //
    function getAllProducts()
    {
        /**
         * This api will fetch and return all products in DB
         */
        $products[] = Products::all();

        return [$products];
    }

    function addProduct(Request $request)
    {
        /**
         * This api will add a single product in DB
         */
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

        /**
         *  Add products to stripe dynamically using webhooks
         */

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
        /**
         * This api will display products in carousel by category
         */

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

            if($record->second_images_path != null)
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
        /**
         * This api will check that item is not in any customers cart
         */

        $locked = 0;       
        $query = DB::table('products')
        ->select()
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
        
        if($locked = $status)
        {
            return[$this->item, "This item has been chosen by another customer and is in their cart. It will become available if they do not purchase within 1 hour"];
        }
        else
        {
            return[$this->item, "Item is unlocked please proceed to checkout."];
        }
    }

    function shoppingCart(Request $req)
    {
        $tier1 = []; 
        $tier2 = []; 
        $tier3 = [];

        $count1 = [];
        $count2 = [];
        $count3 = [];

        $products = new Products();

        foreach($req as $d)
        {
            $products->tier = $req->tier;

            if($products->tier == "Tier 1")
            {
                $tier1 = [
                    'name:' => $req->item_name,
                    'category' => $req->item_category,
                    'brand' => $req->brand,
                    'color' => $req->color,
                    'price' => $req->price,
                ]; 

                $count1 = array_count_values($tier1);
            }

            else if($products->tier == "Tier 2")
            {
                $tier2 = [
                    'name:' => $req->item_name,
                    'category' => $req->item_category,
                    'brand' => $req->brand,
                    'color' => $req->color,
                    'price' => $req->price,
                ];
                
                $count2 = array_count_values($tier2);
            }

            else if($products->tier == "Tier 3")
            {
                $tier3 = [
                    'name:' => $req->item_name,
                    'category' => $req->item_category,
                    'brand' => $req->brand,
                    'color' => $req->color,
                    'price' => $req->price,
                    'tier' => $req->tier       
                ];
                $count3 = array_count_values($tier3);
            }
        }

        //Logic for make sure that customer do not buy out all good stuff.

        $tier33 = $count3['Tier 3']+19;
        
    }

    function addToCart(Request $request)
    {
        $cart = new Cart();

        $cart->name = $request->name;
        $cart->category = $request->category;
        $cart->price = $request->price;
        $cart->email = $request->email;
        $cart->status = $request->status;

        $result = $cart->save();

        /**
         *  Checkout to Stripe
         */

        if($result)
        {
            
            return ['Result' => 'Cart updated successfully'];
        }
        else
        {
            return ['Result' => 'Operation Failed'];
        }
    }

    //Final checkout
    function checkout()
    {
        
        //You must call the function session_start() before
        //you attempt to work with sessions in PHP!
        session_start();

        //Check to see if our countdown session
        //variable has been initialized.
        if(!isset($_SESSION['countdown']))
        {
        //Set the countdown to 120 seconds.
        $_SESSION['countdown'] = 5400;
        //Store the timestamp of when the countdown began.
        $_SESSION['time_started'] = time();
        }

        //Get the current timestamp.
        $now = time();

        //Calculate how many seconds have passed since
        //the countdown began.
        $timeSince = $now - $_SESSION['time_started'];

        //How many seconds are remaining?
        $remainingSeconds = abs($_SESSION['countdown'] - $timeSince);

        //How many minutes are remaining?
        $remainingMins = round((abs($_SESSION['countdown'] - $timeSince))/180);

        //How many seconds are remaining?
        $remainingHours = round((abs($_SESSION['countdown'] - $timeSince))/3600);

        //Print out the countdow
        echo "$remainingHours hour $remainingMins minutes remaining for checkout ";

        $sessionID = $_COOKIE['PHPSESSID'];
        //Check if the countdown has finished.
            if($remainingSeconds < 1)
            {
                //Finished! Do something.
                echo "Purchase Time Limit exceeded";
                /**
                 * Unlock all items in cart
                 */
            }
            else
            {
               $carts = Cart::all();              
            }
            $subtotal = Cart::sum('price');
            $total_items = Cart::count('name');

            return[$carts, $subtotal, $total_items];
        }


}
