<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\ReponseData as r;
use Illuminate\Http\Request;
use App\Models\WxQrCode as wqcm;
use App\Models\Order as om;
use Illuminate\Support\Facades\DB;
use App\Models\Order ;
use App\Tool as t;
class OrderCodeController extends Controller
{


    
   //查询订单列表
   public function getOrderList(Request $request){
        try{
            $p = [
                'size' => ['size',10,true,'每页显示的数量'],
                'page' => ['page',1,true,'分页'],
                'qr_id' => ['qr_id','',true,'分页'],
            ];
            $get = $this->ParamArr($p,$request->all());
            $offset = t::getOffSet($get['page'],$get['size']);
            $data = (new om)
            ->where('qr_code_id',$get['qr_id'])
            ->offset($offset)
            ->limit($get['page'])
            ->orderBy('id','desc')
            ->get();
            return r::rMsgData(200,'ok',$data);
        }catch(\Exception $e){
            return r::tryMsg($e);
        }
   }


    


}