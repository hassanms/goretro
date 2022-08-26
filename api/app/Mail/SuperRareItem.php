<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cart;
use App\Models\SuperRareModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SuperRareItem extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $rareProduct;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cart $cart, SuperRareModel $rareProduct)
    {
        $this->cart = $cart;
        $this->rareProduct = $rareProduct;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->cart = Cart::all();
        $this->rareProduct = SuperRareModel::all();
        return $this->view('rareitem');
    }
}
