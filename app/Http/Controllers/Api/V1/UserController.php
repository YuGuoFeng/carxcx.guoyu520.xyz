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

        try{
            $code = $request->get('code');
            if($code == null){
                throw new \Error('缺少code 值');
            }
            $data = (new ws)->getWeiOpenId($code);

            return r::rMsgData(200,'ok',$data); 
        }catch(\Exception $e){
            return r::tryMsg($e);
        }
    }

    public function getTel(Request $request){

        try{
            $session = $request->get('session');
            $iv = $request->get('iv');
            $encryptedData = $request->get('encryptedData');


            if($session == null){
                throw new \Error('缺少code 值');
            }
            $data = (new ws)->decryptData($session, $iv, $encryptedData);

            return r::rMsgData(200,'ok',$data); 
        }catch(\Exception $e){
            return r::tryMsg($e);
        }
    }

}