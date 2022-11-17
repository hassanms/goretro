<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Stripe\BaseStripeClient;

class StripeController extends Controller
{
    public $stripe = "";
    public $subTotal = 0;

    function processStripe(Request $request)
    {
         $stripe = new StripeClient("sk_test_51LUnwyAfMRsGlJd4pP09sGAOLvtgTIOpd2ecSE8xUp79QAgHvhbror2lesg25UH4c9bhlj3qYldUNvGvRjVuAhqa00Zu8Wnaos");
         /**
          *  Add a Product
          */
          $subTotal = $request->total;
          $cart = $request->cartObj;

          foreach($cart as $data)
          {
                $res[] = [
                  "name" => $data['name'],
                  "price" => $data['price']];

                 
          }

          /**
           *  Create Product
           */
          for($x=0; $x<count($res); $x++)
          {
            $product = $stripe->products->create([
              'name' => $res[$x]['name']
            ]);
            
            $prices[] = $res[$x]['price'];

            $productsID[] = [
                              "name" => $res[$x]['name'],
                              "id" => $product->id
                            ];
          }

        /**
         * Assign Price to Product
         */

        for($x=0; $x<count($productsID); $x++)
        {
          
        $price = $stripe->prices->create(
          [
            'product' => $productsID[$x]['id'],
            'unit_amount' => $prices[$x]*100,
            'currency' => 'gbp',
          ]
        );

        $priceID[] = [
              "id" => $price->id,
              "product" => $price->product
        ];

        }
        /**
         * Create Payment Link
         */

        $paymentLink = $stripe->paymentLinks->create([
                        
          'line_items' => [
                         
                          ['price' => $priceID[0]['id'],
                          'quantity' => 1,],

                          
                          ['price' => $priceID[1]['id'],
                          'quantity' => 1,],

                          
                          ['price' => $priceID[2]['id'],
                          'quantity' => 1,],

                          ['price' => $priceID[3]['id'],
                          'quantity' => 1,],

                          ['price' => $priceID[4]['id'],
                          'quantity' => 1,],
                      
                        ]

                  ]);

        return[$paymentLink->url];
        /**
         * Create a Customer
         */

        // $result = $stripe->customers->create(
        //     [
        //       'name' => 'Mughees Shah',
        //       'email' => 'mughees.shah@gmail.com',
        //       'description' => 'GoRetro Test Customer',
        //       'balance' => -100000,
        //     ]
        //   );

        /***
         * Create Invoice
         */
        // $stripe->invoiceItems->create(
        //     ['customer' => 'cus_ME51LMriifLczl', 'price' => 'price_1LVcidAfMRsGlJd4pILJMFsr']
        //   );

        // $result = $stripe->invoices->create(
        //     [
        //       'customer' => 'cus_ME51LMriifLczl',
        //     ]
        //   );

        // $stripe->invoices->finalizeInvoice('in_1LVcxuAfMRsGlJd4K1YgzPuD', []);

        
    }
}
