<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
// use App\Admin\Repositories\WxQrCode;
use App\Models\WxQrCode;
use Illuminate\Support\Facades\DB;
use Dcat\Admin\Layout\Content;
class Qrcode extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {   
        try{
            // return $this->response()->error('Your error message.');
            $model =new  WxQrCode();
            $row = $model->find($input['id']);
            if(empty($row)) $row = $model;
            $row->state        = $input['state'];
            $row->failure_time = $input['failure_time']??0;
            $row->radius       = $input['radius'];
            $row->money        = $input['money']??0;
            $row->location     = $input['location'];
            $row->lat          = $input['lat'];
            $row->lng          = $input['lng'];
            $row->save();
            
        return $this
				->response()
				->success('Processed successfully.')
				->refresh();
        }catch(\Exception $e ){
            return $this->response()->error($e->getMessage());
        }
      

        
    }


    public function info($id){

        return (new WxQrCode)->find($id);

    }


    public function destroy( $id){
        try{

           $row =  (new WxQrCode)->find($id);
           
           if(!$row) throw new \Exception("数据不存在");
           
           $row->delete();

           return $this->response()->success("删除成功")->refresh();
            
        }catch(\Exception $e){
            return $this->response()->error($e->getMessage());
        }
    }

    /**
     * Build a form here.
     */
    public function form()
    {
       $this->hidden('id');
       $this->radio('state')->when(1,function($v){
           $v->datetime('failure_time');
       })->options([
           0 => '永不失效',
           1 => '失效时间'
       ])->default(0);

       $this->number('radius');
       $this->currency('money');
       $this->map('lat','lng','扫码地点','location')->required();

    }

    /**
     * The data of the form.
     *
     * @return array
     */
    /* public function default()
    {
        return [
            'name'  => 'John Doe',
            'email' => 'John.Doe@gmail.com',
        ];
    } */
}
