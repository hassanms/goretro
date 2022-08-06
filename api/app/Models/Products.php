<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $tables = 'products';

    protected $fillable = [
        'item_category',
        'item_name',
        'brand',
        'color',
        'main_images_path',
        'second_images_path',
        'price',
        'shopping_cart',
        'tier',
        'locked'
    ];
}
