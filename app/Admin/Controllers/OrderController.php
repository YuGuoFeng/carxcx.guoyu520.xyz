<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Order(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('approach_number');
            $grid->column('user_id');
            $grid->column('order_id');
            $grid->column('name');
            $grid->column('mobile');
            $grid->column('wl_company');
            $grid->column('car_number');
            $grid->column('trailer_number');
            $grid->column('pay_time');
            $grid->column('state');
            $grid->column('pay_data');
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Order(), function (Show $show) {
            $show->field('id');
            $show->field('approach_number');
            $show->field('user_id');
            $show->field('order_id');
            $show->field('name');
            $show->field('mobile');
            $show->field('wl_company');
            $show->field('car_number');
            $show->field('trailer_number');
            $show->field('pay_time');
            $show->field('state');
            $show->field('pay_data');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Order(), function (Form $form) {
            $form->display('id');
            $form->text('approach_number');
            $form->text('user_id');
            $form->text('order_id');
            $form->text('name');
            $form->text('mobile');
            $form->text('wl_company');
            $form->text('car_number');
            $form->text('trailer_number');
            $form->text('pay_time');
            $form->text('state');
            $form->text('pay_data');
        });
    }
}
