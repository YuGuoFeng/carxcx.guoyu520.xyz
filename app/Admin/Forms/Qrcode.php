<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;

// use App\Admin\Repositories\WxQrCode;
use App\Models\WxQrCode;
use Illuminate\Support\Facades\DB;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Contracts\LazyRenderable;
class Qrcode extends Form  implements LazyRenderable
{
    use LazyWidget;
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
            // 获取外部传递参数
            $id = $this->payload['id'] ?? null;
            // return $this->response()->error('Your error message.');
            $model =new  WxQrCode();
            $row = $model->find($input['id']);
            if(empty($row)) $row = $model;
            $row->state        = $input['state'];
            $row->failure_time = $input['failure_time']??0;
            $row->radius       = $input['radius'];
            $row->money        = $input['money']??0;

            if($input['location']){
                $row->location     = $input['location'];
            }
            if($input['lat']){
                $row->lat          = $input['lat'];
            }
            if($input['lng']){
                $row->lng          = $input['lng'];
            }
            
            $row->save();
            
        return $this
				->response()
				->success('Processed successfully.')
				->location('wechat/qrcode');
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
        $id = $this->payload['id'] ?? null;
        $this->hidden('id');
        $this->radio('state')->when(1,function($v){
            $v->datetime('failure_time');
        })->options([
            0 => '永不失效',
            1 => '失效时间'
        ])->default(0);
        $this->number('radius');
        $this->currency('money');
       if($id){
            $this->display('lat');
            $this->display('lng');
            $this->display('location');
            $this->map('lat','lng','扫码地点','location');
       }else{
        $this->map('lat','lng','扫码地点','location')->required();
       }
       
    }

   // 返回表单数据，如不需要可以删除此方法
   public function default()
   {
       // 获取外部传递参数
        $id = $this->payload['id'] ?? null;

        $info = (new WxQrCode)->where('id',$id)->first();
        
        if($info){
            $info = $info->toArray();
        }else{
            $info = [];
        }
        return $info;
       
   }
}
