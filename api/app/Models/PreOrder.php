<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $table = 'pre_orders';

    protected $fillable = [
        'name',
        'items_left',
        'category',
        'image'
    ];
}
