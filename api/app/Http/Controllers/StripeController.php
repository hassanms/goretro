<?php
namespace App\Http\Controllers;

use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    public $stripe = "";
    public Response $response;

    function processStripe()
    {
         $stripe = new StripeClient("sk_test_51LUnwyAfMRsGlJd4pP09sGAOLvtgTIOpd2ecSE8xUp79QAgHvhbror2lesg25UH4c9bhlj3qYldUNvGvRjVuAhqa00Zu8Wnaos");

         /**
          *  Add a Product
          */

        // $stripe->products->create(
        //     [
        //         'name' => 'Yellow T-Shirt',
        //     ]
        //  );

        /**
         * Assign Price to Product
         */

        //  $result = $stripe->prices->create(
        //     [
        //       'product' => 'prod_ME4ra4BVda9LDE',
        //       'unit_amount' => 1000,
        //       'currency' => 'gbp',
        //     ]
        //   );

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

        $response = $stripe->invoices->sendInvoice('in_1LVcxuAfMRsGlJd4K1YgzPuD', []);

         return [$response];
    }
}
