<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\ReponseData as r;
use Illuminate\Http\Request;
use App\Models\WxQrCode as wqcm;
use Illuminate\Support\Facades\DB;
use App\Models\Order ;
class WxQrCodeController extends Controller
{
    // 根据id 获取
    public function qrData(Request $request,$id){

        try{
            $data = (new wqcm)->where('id',$id)->first();
            return r::rMsgData(200,'ok',$data);
        }catch(\Exception $e){
            return r::tryMsg($e);
        }


    }
    //  添加表单
    public function form(Request $request){
        try{
            $p = [
                'name'           => ['name','',true,'姓名'],
                'mobile'         => ['mobile','',true,'手机号'],
                'wl_company'     => ['wl_company','',true,'物流公司'],
                'car_number'     => ['car_number','',true,'车牌号'],
                'trailer_number' => ['trailer_number','',true,'挂车号'],
                'qr_code_id'     => ['qr_code_id','',true,'二维码id'],
                'user_id'     => ['user_id','',true,'用户id'],
            ];
            $post = $this->ParamArr($p,$request->all());
            $getNewOrderId = (new Order)->getNewOrderId();
            $post['order_id']        = $getNewOrderId['order_id'];
            $post['approach_number'] = $getNewOrderId['approach_number'];
            $post['add_time']        = time();

            Order::create($post);
            return r::rMsgData(200,'ok',[]);
        }catch(\Exception $e){
            return r::tryMsg($e);
        }
    }


    


}