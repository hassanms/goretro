<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Encore\Admin\Grid\Filter\Where;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


function checkTier()
{
    /**Iterate over current user cart */
    $tier1 = DB::table('carts')
        ->select()
        ->where('tier', 'Tier 1')->get();
    $itemsTier1 = count($tier1);

    $tier2 = DB::table('carts')
        ->select()
        ->where('tier', 'Tier 2')->get();
    $itemsTier2 = count($tier2);

    $tier3 = DB::table('carts')
        ->select()
        ->where('tier', 'Tier 3')->get();
    $itemsTier3 = count($tier3);

    if ($itemsTier1 > 0 && $itemsTier2 == 0 && $itemsTier3 == 0) {
        /**
         * Here if a customer only purchase items from Tier 1,
         * We will not let them checkout
         */
        return
            [
                "disableCheckout" => true,
                "message" => "You cannot purchase only Tier 1 Items",
                "items" => "Tier 1: " . $itemsTier1 . " items\n" . "Tier 2: " . $itemsTier2 . " items\n" . "Tier 3: " . $itemsTier3 . " items"
            ];
    } else if ($itemsTier1 == 0 && $itemsTier2 == 0 && $itemsTier3 == 0) {
        /**
         * Cart is Empty
         */
        return
            [
                "disableCheckout" => true,
                "message" => "No items in cart",
                "items" => "Tier 1: " . $itemsTier1 . " items\n" . "Tier 2: " . $itemsTier2 . " items\n" . "Tier 3: " . $itemsTier3 . " items"
            ];
    } else if ($itemsTier1 > 0 && $itemsTier2 > 0 && $itemsTier3 == 0) {
        /**
         * Customer can't only purchase itesm from two tier
         */
        return
            [
                "disableCheckout" => true,
                "message" => "You must purchase items from Tier 3",
                "items" => "Tier 1: " . $itemsTier1 . " items\n" . "Tier 2: " . $itemsTier2 . " items\n" . "Tier 3: " . $itemsTier3 . " items"
            ];
    } else if ($itemsTier1 > 0 && $itemsTier2 == 0 && $itemsTier3 > 0) {
        /**
         * Customer can't only purchase itesm from two tier
         */
        return
            [
                "disableCheckout" => true,
                "message" => "You must purchase items from Tier 2",
                "items" => "Tier 1: " . $itemsTier1 . " items\n" . "Tier 2: " . $itemsTier2 . " items\n" . "Tier 3: " . $itemsTier3 . " items"
            ];
    } else if ($itemsTier1 == 0 && $itemsTier2 > 0 && $itemsTier3 > 0) {
        /**
         * Customer can't only purchase itesm from two tier
         */
        return
            [
                "disableCheckout" => true,
                "message" => "You must purchase items from Tier 1",
                "items" => "Tier 1: " . $itemsTier1 . " items\n" . "Tier 2: " . $itemsTier2 . " items\n" . "Tier 3: " . $itemsTier3 . " items"
            ];
    } else if ($itemsTier1 > 0 && $itemsTier2 == ($itemsTier1 * 2) && $itemsTier3 == ($itemsTier1 * 2)) {
        /**
         * Proceed to checkout
         */
        $cart = DB::table('carts')->select()->get();

        return response(
            $cart,
            200
        );
    } else {
        return
            [
                "disableCheckout" => true,
                "message" => "Checkout conditions not met",
                "items" => "Tier 1: " . $itemsTier1 . " items\n" . "Tier 2: " . $itemsTier2 . " items\n" . "Tier 3: " . $itemsTier3 . " items"
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
            ->where('item_category', $category)
            ->where('received', 1)
            ->get();

        $preOrder = DB::table('products')
            ->select()
            ->where('item_category', $category)
            ->where('received', 0)
            ->get();

        if (count($query) > 0) {
            foreach ($query as $record) {

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
            }
            return [$this->item, "Current Stock"];
        } else {
            foreach ($preOrder as $record) {

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
            }
            return [$this->item, "Pre Order"];
        }
    }

    function showDamage(Request $request)
    {
        $damageImage = DB::table('products')
            ->select('second_images_path')
            ->where('item_name', $request->name)
            ->get();

        if ($damageImage[0]->second_images_path != null) {
            return $damageImage[0]->second_images_path;
        } else {
            return "No damage in product";
        }
    }

    function addToCart(Request $request)
    {

        $sessionID = $request->ip();

        $checkLock = DB::table('carts')
            ->select('lock_item')->where('name', $request->name)
            ->get();

        if (count($checkLock) > 0) {
            if ($checkLock[0]->lock_item == 1) {
                return [
                    "disableCheckout" => true,
                    "message" => "This item is already in other customer cart"
                ];
            }
        }

        $cart = new Cart();

        $cart->name = $request->name;
        $cart->category = $request->category;
        $cart->price = $request->price;
        $cart->tier = $request->tier;
        $cart->status = $request->status;
        $cart->email = $request->email;
        $cart->session = $sessionID;
        $cart->lock_item = 1;

        $result = $cart->save();

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
            $cart = DB::update('update carts set lock_item = 0');
            if ($cart)
                return "Timer Expired All items are now unlocked";
            else {
                return "Error in checkoutCart Function";
            }
        } else {
            return checkTier();
        }
    }



    function showTier1()
    {
        $tier = DB::table('carts')
            ->select()
            ->where('tier', 'Tier 1')->get();
        return [
            "items" => $tier,
            "count" => count($tier)
        ];
    }


    function showTier2()
    {
        $tier = DB::table('carts')
            ->select()
            ->where('tier', 'Tier 2')->get();
        return ["items" => $tier, "count" => count($tier)];
    }


    function showTier3()
    {
        $tier = DB::table('carts')
            ->select()
            ->where('tier', 'Tier 3')->get();
        return ["items" => $tier, "count" => count($tier)];
    }
}
