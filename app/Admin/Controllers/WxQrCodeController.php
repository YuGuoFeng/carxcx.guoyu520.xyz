<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Qrcode;
use App\Admin\Repositories\WxQrCode;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Modal;
use App\Admin\Actions\Grid\QrcodeEdit;
use Illuminate\Routing\Controller;
class WxQrCodeController extends Controller
{
    public function index(Content $Content){
        return $Content->header("用户列表")
                    ->body($this->grid());
    } 
    
    
    public function edit($id,Content $content){
        $form = Qrcode::make()->payload(['id' => $id]);
        return $content
        ->translation(null)
        ->title('修改')
        ->description('edit')
        ->body('<div class="card">'.$form.'</div>');
    }
    public function create(Content $content)
    {
       $form =Qrcode::make();//(new Qrcode)->form()->render();
        return $content
            ->translation("222")
            ->title("添加")
            ->description("create")
            ->body(<<<HTML
            <div class="card">{$form}</div>
            HTML);
    }
    public function creates(){
        $form = Qrcode::make();
        return   Modal::make()  
                    ->title('添加s')  
                    ->lg()
                    ->body($form)
                    // ->render();
                    ->button(<<<HTML
                    <div class="pull-right " data-responsive-table-toolbar="grid-table">
                        <button  class="btn btn-primary dialog-create btn-outline"><i class="feather icon-plus"></i><span class="d-none d-sm-inline">&nbsp; s新增</span></button>
                    </div>
                HTML);
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
            $grid->column('created_at');
            $grid->column('updated_at');
            // $grid->disableEditButton();
            // $grid->actions([new QrcodeEdit()]);
            // $grid->disableCreateButton();
            // $grid->tools($this->creates());
            
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
    /* protected function form(){
        return Qrcode::make();
    } */
    protected function form()
    {   
        
        return Form::make(new WxQrCode(), function (Form $form) {

            dump($form);
           
            $form->display('id');
            $form->radio('state')->when(1,function(Form $fm){
                $fm->datetime('failure_time');
            })->options([
                0 => '永不失效',
                1 => '失效时间',
            ])
            ->default(0);
            $form->number('radius');
            $form->currency('money');
            $latitude = 'lat';
            $longitude = 'lng';
            $label = 'location';
            $form->map($latitude, $longitude, $label,'location');
                
            // dump($form->model()->stat);
            $form->submitted(function (Form $form) {
                // 接收表单参数
                // dump();
            });
           
        });
    }
}
