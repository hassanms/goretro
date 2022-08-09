<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $table = 'pre_orders';

    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'status',
        'batch',
        'due_date',
        'item_category',
        'item_name',
        'brand',
        'color',
        'main_images_path',
        'second_images_path',
        'price',
        'shopping_cart',
        'tier',
    ];
}
