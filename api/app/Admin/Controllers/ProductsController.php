<?php

namespace App\Admin\Controllers;

use App\Models\Products;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Products());

        $grid->column('id', __('Id'));
        $grid->column('current_stock_id', __('Current stock id'));
        $grid->column('item_category', __('Item category'));
        $grid->column('item_name', __('Item name'));
        $grid->column('brand', __('Brand'));
        $grid->column('color', __('Color'));
        $grid->column('main_images_path', __('Image 1'))->image('', '70', '70')->display(function ($val) {
            if (empty($val)) {
                return 'No Image';
            }
            return $val;
        });
        $grid->column('second_images_path', __('Image 2'))->image('', '70', '70')->display(function ($val) {
            if (empty($val)) {
                return 'No Image';
            }
            return $val;
        });
        $grid->column('price', __('Price'));
        $grid->column('tier', __('Tier'));
        $grid->column('locked', __('Locked'))->bool();
        $grid->column('received', __('Received'))->bool();
        $grid->column('batch', __('Batch'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('arrival_date', __('Arrival date'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Products::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('current_stock_id', __('Current stock id'));
        $show->field('item_category', __('Item category'));
        $show->field('item_name', __('Item name'));
        $show->field('brand', __('Brand'));
        $show->field('color', __('Color'));
        $show->field('main_images_path', __('Image 1'))->image('','200','200');
        $show->field('second_images_path', __('Image 2'))->image('','200','200');
        $show->field('price', __('Price'));
        $show->field('tier', __('Tier'));
        $show->field('locked', __('Locked'));
        $show->field('received', __('Received'));
        $show->field('batch', __('Batch'));
        $show->field('quantity', __('Quantity'));
        $show->field('arrival_date', __('Arrival date'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Products());

        $form->number('current_stock_id', __('Current stock id'));
        $form->text('item_category', __('Item category'));
        $form->text('item_name', __('Item name'));
        $form->text('brand', __('Brand'));
        $form->color('color', __('Color'));
        $form->image('main_images_path', __('Main image'));
        $form->image('second_images_path', __('Second image'));
        $form->number('price', __('Price'));
        $form->text('tier', __('Tier'));
        $states=[
            'on'=>['value'=>1, 'text'=>'Yes', 'color'=>'success'],
            'off'=>['value'=>0, 'text'=>'No', 'color'=>'default'],
        ];
        $form->switch('locked', __('Locked'))->states($states);
        $form->switch('received', __('Received'))->states($states);
        $form->number('batch', __('Batch'));
        $form->number('quantity', __('Quantity'))->default(1);
        $form->date('arrival_date', __('Arrival date'))->default(date('Y-m-d'));

        return $form;
    }
}
