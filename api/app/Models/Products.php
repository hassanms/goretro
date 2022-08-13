<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;

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

$form = new Form(new Products);

// Displays the record id
$form->display('id', 'ID');

// Add an input box of type text
$form->text('item_category', 'item_category');

$form->text('item_name', 'item_name');

$form->text('brand', 'brand');

$form->text('color', 'color');

$form->text('main_images_path', 'main_images_path');
$form->text('second_images_path', 'second_images_path');

// Number input
$form->number('price', 'price');

$form->text('tier', 'tier');

$form->switch('locked', 'locked?');

// Display two time column 
$form->display('created_at', 'Created time');
$form->display('updated_at', 'Updated time');
