<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

function checkTier()
{
    /**Iterate over current user cart */
    $tier1 = Cart::all()->where('tier', 'Tier 1');

    if (count($tier1) <= 2) {
        return [
            "id" => 1,
            "message" => "Proceed to checkout",
            "disableCheckout" => false
        ];
    } else {
        return [
            "id" => 0,
            "message" => "you must add " . count($tier1) * 2 . " items from Tier 2 & Tier 3 to proceed",
            // "disableCheckout" => true
        ];
    }
}

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
        $product->received = $request->received;
        $product->batch = $request->batch;
        $product->quantity = $request->quantity;
        $product->arrival_date = $request->arrival_date;

        $result = $product->save();

        /**
         *  Add products to stripe dynamically using webhooks
         */

        if ($result) {

            return ['Result' => 'Data saved successfully'];
        } else {
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
            ->select()
            ->where('item_category', $category)->get();

        
        foreach ($query as $record) {
            

            //Pre Order Stock
            if($record->received == 0)
                {
                    $this->item[] = [
                        'id' => $record->id,
                        'item' => $record->item_name,
                        'brand' => $record->brand,
                        'image_path' => $record->main_images_path,
                        'price' => $record->price,
                        'color' => $record->color,
                        'tier' => $record->tier,
                        'category' => $record->item_category,
                        'received' => $record->received,
                        'damage_image_path' => $record->second_images_path != null ? $record->second_images_path : null
                    ];
                    return[$this->item];
                }
            else if($record->received == 1)
            {
                $this->item[] = [
                    'id' => $record->id,
                    'item' => $record->item_name,
                    'brand' => $record->brand,
                    'image_path' => $record->main_images_path,
                    'price' => $record->price,
                    'color' => $record->color,
                    'tier' => $record->tier,
                    'category' => $record->item_category,
                    'received' => $record->received,
                    'damage_image_path' => $record->second_images_path != null ? $record->second_images_path : null
                ];
                return[$this->item];
            }
        

            // if($record->second_images_path != null)
            // {
            //     $this->item[] = [
            //         'damage_image_path' => $record->second_images_path
            //     ];
            // }
            // else
            // {
            //     $this->item[] = [
            //         'damage_image_path' => "null"
            //     ];
            // }
        }
        

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

        foreach ($query as $record) {
            $this->item[] = [
                'id: ' => $record->id,
                'item' => $record->item_name,
                'locked' => $record->locked,
            ];
            $locked = $record->locked;
        }

        if ($locked = $status) {
            return [$this->item, "This item has been chosen by another customer and is in their cart. It will become available if they do not purchase within 1 hour"];
        } else {
            return [$this->item, "Item is unlocked please proceed to checkout."];
        }
    }

    function addToCart(Request $request)
    {

        $sessionID = $request->ip();



        $cart = new Cart();

        $cart->name = $request->name;
        $cart->category = $request->category;
        $cart->price = $request->price;
        $cart->tier = $request->tier;
        $cart->status = $request->status;
        $cart->session = $sessionID;

        $result = $cart->save();

        /**
         *  Checkout to Stripe
         */

        if ($result) {

            return ['Result' => 'Cart updated successfully'];
        } else {
            return ['Result' => 'Operation Failed'];
        }
    }



    //Final checkout
    function checkoutCart(Request $request)
    {
        $currentUser = "";

        //You must call the function session_start() before
        //you attempt to work with sessions in PHP!
        session_start();

        //Check to see if our countdown session
        //variable has been initialized.
        if (!isset($_SESSION['countdown'])) {
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
        $remainingMins = round((abs($_SESSION['countdown'] - $timeSince)) / 180);

        //How many seconds are remaining?
        $remainingHours = round((abs($_SESSION['countdown'] - $timeSince)) / 7200);

        //Print out the countdow
        // echo "$remainingHours hour $remainingMins minutes remaining for checkout ";

        //Check if the countdown has finished.
        if ($remainingSeconds < 1) {
            //Finished! Do something.
            // echo "Purchase Time Limit exceeded";
            /**
             * Unlock all items in cart
             */
        } else {
            $result = checkTier();

            if ($result['id'] == 1) {
                $carts = Cart::all();
                $subtotal = Cart::sum('price');
                // $total_items = Cart::count('name');
                $ip = $request->ip();

                $extra = [
                    "subtotal" => $subtotal,
                    // "items" => $total_items
                ];

                $first = collect(["cart" => $carts]);
                $second = collect($extra);

                foreach ($carts as $data) {
                    $currentUser = $data->session;

                    if ($currentUser == $ip) {
                        $merged = $first->merge($second);
                        return $merged->toArray();
                    } else {
                        return ["Guest user not found"];
                    }
                }
            } //End of nested IF
            else if ($result['id'] == 0) {
                return [
                    "disableCheckout" => true, 
                    "message" => $result['message']
                ];
            }
        }
    }



    function showTier1()
    {
        $tier = Cart::all()->where('tier', 'Tier 1');
        return count($tier);
    }


    function showTier2()
    {
        $tier = Cart::all()->where('tier', 'Tier 2');
        return count($tier);
    }


    function showTier3()
    {
        $tier = Cart::all()->where('tier', 'Tier 3');
        return count($tier);
    }
}
