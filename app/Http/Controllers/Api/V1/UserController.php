<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\ReponseData as r;
use Illuminate\Http\Request;
use App\Models\WxQrCode as wqcm;
use Illuminate\Support\Facades\DB;
use App\Models\Order ;
use App\Services\WechatServices as ws;
class UserController extends Controller
{

    // 获取小程序openid
    public function getWeiOpenId(Request $request){

        $data = (new ws)->index();

        return r::rMsgData(200,'ok',$data);       
    }

}