<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\WxQrCode;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
class WxQrCodeController extends AdminController
{
    public function index(Content $Content){
        return $Content->header("用户列表")
                    ->body($this->grid());
    }  
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new WxQrCode(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('location');
            $grid->column('lng');
            $grid->column('lat');
            $grid->column('state');
            $grid->column('failure_time');
            $grid->column('radius');
            $grid->column('money');
            $grid->column('add_time');
            $grid->column('update_time');
        
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
        return Show::make($id, new WxQrCode(), function (Show $show) {
            $show->field('id');
            $show->field('location');
            $show->field('lng');
            $show->field('lat');
            $show->field('state');
            $show->field('failure_time');
            $show->field('radius');
            $show->field('money');
            $show->field('add_time');
            $show->field('update_time');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new WxQrCode(), function (Form $form) {
            $form->display('id');
            $form->text('location');
            $form->text('lng');
            $form->text('lat');
            $form->text('state');
            $form->text('failure_time');
            $form->text('radius');
            $form->text('money');
            $form->text('add_time');
            $form->text('update_time');
        });
    }
}
