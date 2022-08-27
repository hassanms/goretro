<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\SuperRareModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuperRareItem;
use Illuminate\Support\Facades\Log;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to customer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            /**
             *   We will send email to customer after 7 days of purchase
             */
            $rareProduct = new SuperRareModel();
            $cartItem = new Cart();

            /**
             *  Collecting Unique Emails from Database
             */
            $emails = Cart::all()
                ->sortBy("email");

            $unique = $emails->unique("email");
            
            $collection = $unique->map(function ($array) {
                return collect($array)->unique("email")->all();
            });

            $finalEmails = Cart::orderBy("email")
                ->whereIn('id', $collection)
                ->get();
                
            for ($x = 0; $x < count($finalEmails); $x++) {

                /**
                 *      Check each unique email cart and sum their prices
                 */
                $uniqueEmails[] = $finalEmails[$x]['email'];
                $cart = DB::table('carts')
                    ->select('price')->where('email', $uniqueEmails[$x])->get();
                $price = 0;
                foreach ($cart as $data) {
                    $price += $data->price;
                }
                  
            // if ($price > 1000) {

            /**
             * Every unique customer whose cart price total is
             * above 1000 we will send them email
             */

            $xx[] = $uniqueEmails[$x];

            Mail::to($xx[$x])->send(new SuperRareItem($cartItem, $rareProduct));
            //}
            
            } 
            return 0;
    }
}
